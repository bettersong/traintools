<?php
 
class personToolsCheckInModel extends Model
{
    //小工具清点/统计
    public function getSmallToolsData(){
        
        /*【表】
        工单-工具列表-tworkorder_toollists ： 工具包ID
        工具包表-tm_tool_bag ：RFID集合
        工具详情表-detail: 工具类别ID
        工具类别表-toolslist ：工具类别名称 
        //$this->assign('AllOrder', $AllOrder);

        */
        $mysqlModel = new Model("");
        
        $twOrderId = $_GET['twOrderId'];

        //获取工具包最后的更新时间
        $sql_getLastUpdateTime = "select gpsurUpdateTime from gpsUpdateRecode where gpsurOrderId=$twOrderId order by gpsurId desc limit 1 ";
        $res_LastUpdateTime = $mysqlModel->query($sql_getLastUpdateTime);
        $toolbagLastUpdateTime = $res_LastUpdateTime[0]['gpsurUpdateTime'];
 
       //获取小工具名称，及所在工具包编号等信息
       $sql = "SELECT * from  tworkorder_toollists left join toolslist on twtlToolId=toListId  left join tm_tool_bag on twtltToolBagId=tb_id
       where twtltWorkOrderId=$twOrderId  and twtlPreparedAmount>0 and toListType=1 ";
       
       //echo " toolbagLastUpdateTime: ".$toolbagLastUpdateTime;

       $res = $mysqlModel->query($sql);
       //print_r($res);// twtlRealAmount
       
        $toolsArr = array();
       //遍历全部小工具，并获取在工具包的情况
       foreach($res as $index => $value){
          $toListId = $value['toListId'];//小工具的所属分类编号
          
          //$toListId = $value['toListId'];//小工具的所属分类编号
          
          //把该小工具的基本信息储存到数组中
          $toolsArr[$toListId]['toolBagName'] = $value['tb_name'];
          $toolsArr[$toListId]['toolBagId'] = $value['tb_id'];
          $toolsArr[$toListId]['toolBagReaderCode'] = $value['rfid_reader_code'];
          $toolsArr[$toListId]['toolId'] = $toListId; //id
          $toolsArr[$toListId]['toolName'] = $value['twtlName']; //工具名
          $toolsArr[$toListId]['twtlAmount'] = $value['twtlAmount']; //工单中的数量
          $toolsArr[$toListId]['twtlPreparedAmount'] = $value['twtlPreparedAmount']; //班前准备的数量
          
          //获取该小工具 在工具包中最后一次更新到现在时间的真实数量 //FIND_IN_SET(str,strlist)函数 查询字段(strlist)中包含(str)的结果，返回结果为null或记录
          $sql2 = "SELECT * from   detail left join tm_toolbag_realtime on  FIND_IN_SET(rfid_code,toListRFIDCode)  where read_time>'$toolbagLastUpdateTime' and deToolListId=$toListId and rfid_code!=''  group by toListRFIDCode  ";
          
          //echo " <br><br>sql2: ".$sql2;

          $res2 = $mysqlModel->query($sql2);
          $toolnums = count($res2);
       
          $toolsArr[$toListId]['twtlRealAmount'] = $toolnums ;//总数
          
       }


      // print_r($toolsArr);
       return $toolsArr;
    }
    //【大工具】清点/统计
    public function getBigToolsData(){
        // global DistanceRange_safeDoor;
        $mysqlModel = new Model("");

         $twOrderId = $_GET['twOrderId'];
         //判断是进门还是出门
         if($_GET['direction']=='in'){
             $twSafeDoor = "twSafeDoor_in";
          }
          else{
             $twSafeDoor = "twSafeDoor_out";
          }
          //工单的作业门-进
        $sql = "SELECT * from  tworkorder left join cecontrol on  $twSafeDoor=ceControlId where twOrderId=$twOrderId ";
        //echo $sql;
       $sth = $this->_dbHandle->prepare($sql);
       $sth->execute();
       $res = $sth->fetchAll();
       $safaDoorinId = $res[0]['twSafeDoor_in'];
       $safaDoorinName = $res[0]['ceName'];
       $safaDoorGPS_x = $res[0]['ceGPS_x'];
       $safaDoorGPS_y = $res[0]['ceGPS_y'];
 
       //echo $safaDoorinId.'  '.$safaDoorinName.'  '.$safaDoorGPS_x.'  '.$safaDoorGPS_y;
       //echo '<br><br>';
 
        //对应工单中的全部大工具
        $sql = "SELECT * from  tworkorder_toollists left join toolslist on twtlToolId=toListId  left join tm_tool_bag on twtltToolBagId=tb_id
         where twtltWorkOrderId=$twOrderId  and twtlPreparedAmount>0 and toListType=2 ";
        
         //echo $sql;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();
       
        $toolsArr = array();
        foreach($res as $key => $value){
             $twtlToolId = $value['twtlToolId'];
             //工具ID集合
            $bigToolIds = $value['twtlDetail'];
            $bigToolIds =rtrim($bigToolIds,",,");
            $bigToolIds =rtrim($bigToolIds,",");
            $bigToolIdsTemp = explode(",", $bigToolIds);//array_filter( explode(",", $bigToolIds) );
             //工具GPS集合
            $sql_gps = "SELECT GPSCode from  detail left join gpslibs on toListGPSId=GPSId where DetailId in($bigToolIds)";
            $bigToolGPSs = $mysqlModel->query($sql_gps);
            
            //echo '<br> '; print_r($bigToolGPSs);

             //$toolsArr[$twtlToolId]['name'] = $value['toListName'];
             $toolsArrTemp[$twtlToolId] = $bigToolIds;
             $toolnums_list = 0;
             foreach($bigToolIdsTemp as $key2=>$value2){
                 //$toolsArr[$twtlToolId]['name']
                 $gpsCode = $bigToolGPSs[$key2]['GPSCode'];
                 $bigToolIdsArr[$twtlToolId]['details'][$key2]['gpsCode']=$gpsCode;
                 //$bigToolIdsArr[$twtlToolId]['details'][$key2]['toolId']=$value['toListId'];
                 $bigToolIdsArr[$twtlToolId]['details'][$key2]['toolName']=$value['toListName'];
                
                 
                  //获取具体工具的经纬度，并计算与安全门的距离
                 $sql2 = "SELECT * from  tm_dev_location  where dev_imei=$gpsCode order by id desc limit 1";
                
                 //echo $sql2.'<br>';

                $sth = $this->_dbHandle->prepare($sql2);
                $sth->execute();
                $res2 = $sth->fetchAll(); //工具的经纬度信息
                $distance = "";
                $devGPS_x = "";
                $devGPS_y = "";
                $bigToolIdsArr[$twtlToolId]['details'][$key2]['status']= 0;//是否找到定位
               
                //print_r($res2);

                if($res2){//找到经纬度信息
                     $devGPS_x = $res2[0]['loc_longitude'];
                     $devGPS_y = $res2[0]['loc_latitude'];
                     //经纬度纠偏
                     $realGPS = $this->transform($devGPS_y, $devGPS_x);//纠偏后经纬度-数组形式
                     $devGPS_y = $realGPS[0];//纠偏后的纬度
                     $devGPS_x = $realGPS[1];//纠偏后的经度
 
                     //计算距离
                     //echo '<br>devGPS_x:'.$devGPS_x.'  devGPS_y:'.$devGPS_y.'   safaDoorGPS_x:'.$safaDoorGPS_x.'  safaDoorGPS_y:'.$safaDoorGPS_y;
                     $distance = $this->getDistance($devGPS_x, $devGPS_y, $safaDoorGPS_x, $safaDoorGPS_y, 1);
                     
                     //if( $distance<=DistanceRange_safeDoor) $toolnums_list ++;//DistanceRange_safeDoor米以内
                     if($distance=="") $bigToolIdsArr[$twtlToolId]['details'][$key2]['status']= 0;//未找到
                     else if( $distance>DistanceRange_safeDoor){
                         $bigToolIdsArr[$twtlToolId]['details'][$key2]['status']= 2; //超出范围
                     }
                     else {//DistanceRange_safeDoor米以内
                         $bigToolIdsArr[$twtlToolId]['details'][$key2]['status']= 1;//定位设备找到，且在x米范围内。
                         $toolnums_list ++;
                     }
                }
                else{//为找到实时经纬度信息
 
                     
 
                }
                $bigToolIdsArr[$twtlToolId]['details'][$key2]['devGPS_x']= $devGPS_x;
                $bigToolIdsArr[$twtlToolId]['details'][$key2]['devGPS_y']= $devGPS_y;
                $bigToolIdsArr[$twtlToolId]['details'][$key2]['distance']= $distance;
 
 
                //echo '<br>'.$devGPS_x.'  '.$devGPS_y.' distance='.$distance.'m<br>';
 
 
             }
             $bigToolIdsArr[$twtlToolId]['thInfo']['safaDoorinName'] = $safaDoorinName;
             $bigToolIdsArr[$twtlToolId]['thInfo']['toListId'] = $value['toListId'];
             $bigToolIdsArr[$twtlToolId]['thInfo']['name'] = $value['toListName'];
             $bigToolIdsArr[$twtlToolId]['thInfo']['twtlPreparedAmount'] = $value['twtlPreparedAmount'];//班前数量
             $bigToolIdsArr[$twtlToolId]['thInfo']['twtlRealAmount'] = $toolnums_list;
             $bigToolIdsArr[$twtlToolId]['thInfo']['amountDiffer'] = $value['twtlPreparedAmount'] - $toolnums_list;
              //echo '  len='.count($bigToolIdsArr).'  ';
             //工具集合对应的定位器集合
             //$bigToolIds = $value['twtlDetail'];
             //$bigToolIdsArr =  $bigToolIdsArr =  explode(",", $bigToolIds);;
             
              //echo   '<br>'; print_r($bigToolIdsArr);
        }
        //print_r($bigToolIdsArr);
        return $bigToolIdsArr;
  
         
     }

    //【人员-核心人员】清点/统计  
    public function getPersonsData(){

        $mysqlModel = new Model("");
       
        $twOrderId = $_GET['twOrderId'];//工单ID


       //判断是进门还是出门
       if($_GET['direction']=='in'){
        $twSafeDoor = "twSafeDoor_in";
        }
        else{
            $twSafeDoor = "twSafeDoor_out";
        }
       $sql = "SELECT * from  tworkorder left join cecontrol on  $twSafeDoor=ceControlId where twOrderId=$twOrderId ";
       //echo $sql;
     
      $res = $mysqlModel->query($sql);
      //print_r($res);
      $safaDoorinId = $res[0]['twSafeDoor_in'];
      $safaDoorinName = $res[0]['ceName'];
      $safaDoorGPS_x = $res[0]['ceGPS_x'];
      $safaDoorGPS_y = $res[0]['ceGPS_y'];
      
      //获取人员信息
        $sql = "SELECT  pManageId,pManageName,GPSCode,loc_longitude,loc_latitude from  tworkorder_adminstrators left join pmanage on twamPersonId=pManageId left join gpslibs on pManageGpsId=GPSId 
         left join tm_dev_location on  id=(select max(id) from tm_dev_location where dev_imei=GPSCode ) where twamtWorkOrderId=$twOrderId and twamPersonId>0";
          //echo $sql;
    
       $res = $mysqlModel->query($sql);
       $personsArr['personsInfo'] = $res;
         //print_r($res);
       //$personsItem = array();//人员统计信息
       $personnums = 0;
       $devGPS_x = "";
       $devGPS_y = "";
       $distance = "";
       foreach($personsArr['personsInfo'] as $key => $value){

            $realGPS = $this->transform($value['loc_latitude'], $value['loc_longitude']);//纠偏后经纬度-数组形式
            $devGPS_y = $realGPS[0];//纠偏后的纬度
            $devGPS_x = $realGPS[1];//纠偏后的经度
             


           //$devGPS_x = $value['loc_longitude'];
           //$devGPS_y = $value['loc_latitude'];

           //计算距离
           //$bigToolsArr[$toListId]['details'][$key2]['gpsCode']=$gpsCode; ['safaDoorinName'] = $safaDoorinName;
           $personsArr['personsInfo'][$key]['gpsCode']=$value['GPSCode'];
           $personsArr['personsInfo'][$key]['safaDoorinName'] = $safaDoorinName;
           
           $personsArr['personsInfo'][$key]['status']= 0;
           if($devGPS_x!=""){
                $distance = $this->getDistance($devGPS_x, $devGPS_y, $safaDoorGPS_x, $safaDoorGPS_y, 1);
               if($distance!=""){//DistanceRange_safeDoor米以内
                   if( $distance<DistanceRange_safeDoor){
                       $personsArr['personsInfo'][$key]['status']= 1;//定位设备找到，且在x米范围内。
                       $personnums ++;
                   }
                    else  $personsArr['personsInfo'][$key]['status']= 2;//超出范围
               }
               $personsArr['personsInfo'][$key]['distance']=$distance;
               $personsArr['personsInfo'][$key]['devGPS_x']=$devGPS_x;
               $personsArr['personsInfo'][$key]['devGPS_y']=$devGPS_y;
           }
 
           //if( $distance<=DistanceRange_safeDoor) $personnums ++;//DistanceRange_safeDoor米以内
             
       }
       $personsArr['item']['twtlRealAmount'] = $personnums;
       //$bigToolsArr[$toListId]['thInfo']['amountDiffer'] = $value['twtlPreparedAmount'] - $personnums;
       $personsArr['item']['twtlPreparedAmount'] = count($personsArr['personsInfo']);
       $personsArr['item']['amountDiffer'] = count($personsArr['personsInfo']) -  $personnums;
        
       return $personsArr;//
       //print_r($personsArr);
   
    }
     //【人员-施工人员】清点/统计 GPSCode order by tm_dev_location.id desc limit 1
    public function getBuildersData(){
        
        $twOrderId = $_GET['twOrderId'];


       //判断是进门还是出门
       if($_GET['direction']=='in'){
        $twSafeDoor = "twSafeDoor_in";
        }
        else{
            $twSafeDoor = "twSafeDoor_out";
        }
       $sql = "SELECT * from  tworkorder left join cecontrol on  $twSafeDoor=ceControlId where twOrderId=$twOrderId ";
       //echo $sql;
      $sth = $this->_dbHandle->prepare($sql);
      $sth->execute();
      $res = $sth->fetchAll();
      $safaDoorinId = $res[0]['twSafeDoor_in'];
      $safaDoorinName = $res[0]['ceName'];
      $safaDoorGPS_x = $res[0]['ceGPS_x'];
      $safaDoorGPS_y = $res[0]['ceGPS_y'];
      
      //获取人员信息 pManageId,pManageName,GPSCode,loc_longitude,loc_latitude
        $sql = "SELECT  * from  tworkorder_workers left join pmanage_builders on twkePersonId=pManageId left join gpslibs on pManageGpsId=GPSId 
         left join tm_dev_location on  id=(select max(id) from tm_dev_location where dev_imei=GPSCode ) where twkeWorkOrderId=$twOrderId ";
         //echo $sql;
       $sth = $this->_dbHandle->prepare($sql);
       $sth->execute();
       $res = $sth->fetchAll();
 
       $personsArr['personsInfo'] = $res;
        //print_r($res);
       //$personsItem = array();//人员统计信息
       $personnums = 0;
       $devGPS_x = "";
       $devGPS_y = "";
       $distance = "";
       foreach($personsArr['personsInfo'] as $key => $value){

           $realGPS = $this->transform($value['loc_latitude'], $value['loc_longitude']);//纠偏后经纬度-数组形式
           $devGPS_y = $realGPS[0];//纠偏后的纬度
           $devGPS_x = $realGPS[1];//纠偏后的经度
            
           
           //$devGPS_x = $value['loc_longitude'];
           //$devGPS_y = $value['loc_latitude'];

           //计算距离
           //$bigToolsArr[$toListId]['details'][$key2]['gpsCode']=$gpsCode; ['safaDoorinName'] = $safaDoorinName;
           $personsArr['personsInfo'][$key]['gpsCode']=$value['GPSCode'];
           $personsArr['personsInfo'][$key]['safaDoorinName'] = $safaDoorinName;
          
           $personsArr['personsInfo'][$key]['status']= 0;
           if($devGPS_x!=""){
               $distance = $this->getDistance($devGPS_x, $devGPS_y, $safaDoorGPS_x, $safaDoorGPS_y, 1);
               if($distance!=""){//DistanceRange_safeDoor米以内
                    if( $distance<DistanceRange_safeDoor){
                        $personsArr['personsInfo'][$key]['status']= 1;//定位设备找到，且在x米范围内。
                        $personnums ++;
                    }
                    else  $personsArr['personsInfo'][$key]['status']= 2;//超出范围
               }
               $personsArr['personsInfo'][$key]['distance']=$distance;
               $personsArr['personsInfo'][$key]['devGPS_x']=$devGPS_x;
               $personsArr['personsInfo'][$key]['devGPS_y']=$devGPS_y;
           }

           


           
           
             
       }
       $personsArr['item']['twtlRealAmount'] = $personnums;
       //$bigToolsArr[$toListId]['thInfo']['amountDiffer'] = $value['twtlPreparedAmount'] - $personnums;
       $personsArr['item']['twtlPreparedAmount'] = count($personsArr['personsInfo']);
       $personsArr['item']['amountDiffer'] = count($personsArr['personsInfo']) -  $personnums;
        
       return $personsArr;//
       //print_r($personsArr);
       /* */
   
    }




/**
 * 功能：经纬度纠偏
 * 应用示例：
 *  $lng = '115.866318';//参数：经度
 *  $lat = '28.750057';//参数：纬度
 *  $realGPS = transform($lat, $lng);//纠偏后经纬度-数组形式
 *  $realLat = $realGPS[0];//纠偏后的纬度
 *  $realLng = $realGPS[1];//纠偏后的经度
*/  
//主函数：返回纠偏后的经纬度，传入参数$wgLat：纬度，$wgLon：经度
public function transform($wgLat, $wgLon) { 
    $pi = 3.14159265358979324;
    $a = 6378245.0;
    $ee = 0.00669342162296594323;
    
    $latlng = array();
    $latlon= array();
    if ($this->outOfChina($wgLat, $wgLon)) { 
        $latlng[0] = $wgLat;
        $latlng[1] = $wgLon;
        $latlon=$latlng;
        return $latlon;
    } 
    $dLat = $this->transformLat($wgLon - 105.0, $wgLat - 35.0);
    $dLon = $this->transformLon($wgLon - 105.0, $wgLat - 35.0);
    $radLat = $wgLat / 180.0 * $pi;
    $magic = sin($radLat);
    $magic = 1 - $ee * $magic * $magic;
    $sqrtMagic = sqrt($magic);

    $dLat = ($dLat * 180.0) / (($a * (1 - $ee)) / ($magic * $sqrtMagic) * $pi);
    $dLon = ($dLon * 180.0) / ($a / $sqrtMagic * cos($radLat) * $pi);
    $latlng[0] = $wgLat + $dLat;
    $latlng[1] = $wgLon + $dLon;
    $latlon=$latlng;
    return $latlon;
 }
 //是否在国内    
 public function outOfChina($lat, $lon) { 
     
    if ($lon < 72.004 || $lon > 137.8347) return true;
    if ($lat < 0.8293 || $lat > 55.8271) return true;
    return false;
 }
//辅助-转换纬度
public function transformLat($x, $y) { 
     
    $pi = 3.14159265358979324;
    $a = 6378245.0;
    $ee = 0.00669342162296594323;

    $ret = -100.0 + 2.0 * $x + 3.0 * $y + 0.2 * $y * $y + 0.1 * $x * $y + 0.2 * sqrt(abs($x));
    $ret += (20.0 * sin(6.0 * $x * $pi) + 20.0 * sin(2.0 * $x * $pi)) * 2.0 / 3.0;
    $ret += (20.0 * sin($y * $pi) + 40.0 * sin($y / 3.0 * $pi)) * 2.0 / 3.0;
    $ret += (160.0 * sin($y / 12.0 * $pi) + 320 * sin($y * $pi / 30.0)) * 2.0 / 3.0;
    return $ret;
 }
         
//辅助-转换经度
public function transformLon($x, $y) { 
    $pi = 3.14159265358979324;
    $a = 6378245.0;
    $ee = 0.00669342162296594323;

    $ret = 300.0 + $x + 2.0 * $y + 0.1 * $x * $x + 0.1 * $x * $y + 0.1 * sqrt(abs($x));
   

    $ret += (20.0 * sin(6.0 * $x * $pi) + 20.0 * sin(2.0 * $x * $pi)) * 2.0 / 3.0;
    $ret += (20.0 * sin($x * $pi) + 40.0 * sin($x / 3.0 * $pi)) * 2.0 / 3.0;
    $ret += (150.0 * sin($x / 12.0 * $pi) + 300.0 * sin($x / 30.0 * $pi)) * 2.0 / 3.0;
    return $ret;
 }
 //end 经纬度纠偏


    /**
     * 计算两点地理坐标之间的距离
     * @param  Decimal $longitude1 起点经度
     * @param  Decimal $latitude1  起点纬度
     * @param  Decimal $longitude2 终点经度 
     * @param  Decimal $latitude2  终点纬度
     * @param  Int     $unit       单位 1:米 2:公里
     * @param  Int     $decimal    精度 保留小数位数
     * @return Decimal
     */ 
    public function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=1){ 
        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926; 
        
        $radLat1 = $latitude1 * $PI / 180.0; 
        $radLat2 = $latitude2 * $PI / 180.0; 
        
        $radLng1 = $longitude1 * $PI / 180.0; 
        $radLng2 = $longitude2 * $PI /180.0; 
        
        $a = $radLat1 - $radLat2; 
        $b = $radLng1 - $radLng2; 
        
        $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2))); 
        $distance = $distance * $EARTH_RADIUS * 1000; 
        
        if($unit==2){ 
          $distance = $distance / 1000; 
        } 
        return round($distance, $decimal); 
    }
        
}
 