<?php
 
class personToolsCheckInModel extends Model
{
    //小工具清点/统计
    public function getSmallToolsDataFromToolbag11(){
        
        /*【表】
        工单-工具列表-tworkorder_toollists ： 工具包ID
        工具包表-tm_tool_bag ：RFID集合
        工具详情表-detail: 工具类别ID
        工具类别表-toolslist ：工具类别名称 
        //$this->assign('AllOrder', $AllOrder);

        */
        $twOrderId = $_GET['twOrderId'];
        //获取工单中的小工具信息（名称、数量等）
       $sql = "SELECT * from  tworkorder_toollists left join toolslist on twtlToolId=toListId  left join tm_tool_bag on twtltToolBagId=tb_id
       where twtltWorkOrderId=$twOrderId  and toListType=1 ";
        //echo $sql;
    
       $sth = $this->_dbHandle->prepare($sql);
       $sth->execute();
       $res = $sth->fetchAll();
       // print_r($res);// twtlRealAmount
        $toolsArr = array();
       foreach($res as $index => $value){
          $toListId = $value['twtlToolId'];
          
          $toolsArr[$toListId]['toolBagName'] = $value['rfid_reader_code'];
          $toolsArr[$toListId]['toolId'] = $toListId; //id
          $toolsArr[$toListId]['toolName'] = $value['twtlName']; //工具名
          $toolsArr[$toListId]['twtlAmount'] = $value['twtlAmount']; //工单中的数量
          $toolsArr[$toListId]['twtlPreparedAmount'] = $value['twtlPreparedAmount']; //班前准备的数量
          
          //获取该工具 在工具包中的真实数量
          $sql2 = "SELECT count(*) as toolnums from   detail left join tm_tool_bag on toListRFIDCode in (rfid_code) where deToolListId=$toListId";
          //echo '<br>'.$sql2.'<br>';
          $sth2 = $this->_dbHandle->prepare($sql2);
          $sth2->execute();
          $res2 = $sth2->fetchAll();

          
          
          
          $toolsArr[$toListId]['twtlRealAmount'] = $res2[0]['toolnums']; //工单中的数量
       }


      // print_r($toolsArr);
       return $toolsArr;
    }
    public function getSmallToolsDataFromToolbag(){
        
        /*【表】
        工单-工具列表-tworkorder_toollists ： 工具包ID
        工具包表-tm_tool_bag ：RFID集合
        工具详情表-detail: 工具类别ID
        工具类别表-toolslist ：工具类别名称 
        //$this->assign('AllOrder', $AllOrder);

        */
        $mysqlModel = new Model("");

        $twOrderId = $_GET['twOrderId'];
        
       //获取小工具名称，及所在工具包编号等信息
       $sql = "SELECT * from  tworkorder_toollists left join toolslist on twtlToolId=toListId  left join tm_tool_bag on twtltToolBagId=tb_id
       where twtltWorkOrderId=$twOrderId  and toListType=1 ";
        //echo $sql;
    
       //$sth = $this->_dbHandle->prepare($sql);
       //$sth->execute();
       //$res = $sth->fetchAll();
       $res = $mysqlModel->query($sql);
       //print_r($res);// twtlRealAmount
       
        $toolsArr = array();
       //遍历全部小工具，并获取在工具包的情况
       foreach($res as $index => $value){
          $toListId = $value['toListId'];//小工具的所属分类编号
          
          //$toListId = $value['toListId'];//小工具的所属分类编号
          
          //把该小工具的基本信息储存到数组中
          $toolsArr[$toListId]['toolBagName'] = $value['rfid_reader_code'];
          $toolsArr[$toListId]['toolId'] = $toListId; //id
          $toolsArr[$toListId]['toolName'] = $value['twtlName']; //工具名
          $toolsArr[$toListId]['twtlAmount'] = $value['twtlAmount']; //工单中的数量
          $toolsArr[$toListId]['twtlPreparedAmount'] = $value['twtlPreparedAmount']; //班前准备的数量
          
          //获取该小工具 在工具包中的真实数量
          //$sql2 = "SELECT count(*) as toolnums from   detail left join tm_toolbag_realtime on rfid_code =toListRFIDCode  where deToolListId=$toListId and rfid_code!='' ";
          $sql2 = "SELECT * from   detail left join tm_toolbag_realtime on  FIND_IN_SET(rfid_code,toListRFIDCode)  where deToolListId=$toListId and rfid_code!=''  group by toListRFIDCode  ";
          //FIND_IN_SET(str,strlist)函数 查询字段(strlist)中包含(str)的结果，返回结果为null或记录
           //$sth2 = $this->_dbHandle->prepare($sql2);
          //$sth2->execute();
          //$res2 = $sth2->fetchAll();
          $res2 = $mysqlModel->query($sql2);
          $toolnums = count($res2);
       
          $toolsArr[$toListId]['twtlRealAmount'] = $toolnums ;//$res2[0]['toolnums']; //工单中的数量
       }


      // print_r($toolsArr);
       return $toolsArr;
    }
    //【大工具】清点/统计
    public function getBigToolsDataFromToolbag(){

        $mysqlModel = new Model("");
       // global DistanceRange_safeDoor;
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
      //$sth = $this->_dbHandle->prepare($sql);
      //$sth->execute();
      //$res = $sth->fetchAll();
      $res = $mysqlModel->query($sql);
      $safaDoorinId = $res[0]['twSafeDoor_in'];
      $safaDoorinName = $res[0]['ceName'];
      $safaDoorGPS_x = $res[0]['ceGPS_x'];
      $safaDoorGPS_y = $res[0]['ceGPS_y'];

      //echo $safaDoorinId.'  '.$safaDoorinName.'  '.$safaDoorGPS_x.'  '.$safaDoorGPS_y;
      //echo '<br><br>';

       //对应工单中的全部大工具
       $sql = "SELECT * from  tworkorder_toollists left join toolslist on twtlToolId=toListId  left join tm_tool_bag on twtltToolBagId=tb_id
        where twtltWorkOrderId=$twOrderId  and toListType=2 ";
       
        //echo $sql;
       //$sth = $this->_dbHandle->prepare($sql);
       //$sth->execute();
       //$res = $sth->fetchAll();
       $res = $mysqlModel->query($sql);
       //print_r($res);
       $toolsArr = array();
       //遍历每种大工具
       foreach($res as $key => $value){
            $toListId = $value['twtlToolId'];
            //工具ID集合
            $bigToolIds = $value['twtlDetail'];
            $bigToolIds =rtrim($bigToolIds,",,");
            $bigToolIds =rtrim($bigToolIds,",");
            $bigToolIdsTemp = explode(",", $bigToolIds);//array_filter( explode(",", $bigToolIds) );
            //工具GPS集合
            /*$bigToolGPSs = $value['twtltGPSCodes'];
            $bigToolGPSs =rtrim($bigToolGPSs,",,");
            $bigToolGPSs =rtrim($bigToolGPSs,",");
            $bigToolGPSs = explode(",", $bigToolGPSs);//array_filter( explode(",", $bigToolIds) );
            */
            //print_r($bigToolGPSs);
            $sql_gps = "SELECT GPSCode from  detail left join gpslibs on toListGPSId=GPSId where DetailId in($bigToolIds)";

            //echo $sql_gps;

            $bigToolGPSs = $mysqlModel->query($sql_gps);
            //print_r($bigToolGPSs);

            //每个工具的GPS信息
            $toolsArrTemp[$toListId] = $bigToolIdsTemp;
            $toolnums_list = 0;
            foreach($bigToolIdsTemp as $key2=>$value2){
                //$toolsArr[$toListId]['name']
                $gpsCode = $bigToolGPSs[$key2]['GPSCode'];
                $bigToolIdsArr[$toListId]['details'][$key2]['gpsCode']=$gpsCode;
                //$bigToolIdsArr[$toListId]['details'][$key2]['toolId']=$value['toListId'];
                $bigToolIdsArr[$toListId]['details'][$key2]['toolName']=$value['toListName'];
               
                
                 //获取具体工具的经纬度，并计算与安全门的距离
               $sql2 = "SELECT * from  tm_dev_location  where dev_imei=$gpsCode order by id desc limit 1";
               $res2 = $mysqlModel->query($sql2);
               $distance = "";
               $devGPS_x = "";
               $devGPS_y = "";
               $bigToolIdsArr[$toListId]['details'][$key2]['status']= 0;//是否在范围内
               if($res2){//找到经纬度信息
                    $devGPS_x = $res2[0]['loc_longitude'];
                    $devGPS_y = $res2[0]['loc_latitude'];

                    //计算距离
                    $distance = $this->getDistance($devGPS_x, $devGPS_y, $safaDoorGPS_x, $safaDoorGPS_y, 1);
                    
                    //if( $distance<=DistanceRange_safeDoor) $toolnums_list ++;//DistanceRange_safeDoor米以内
                    if($distance=="") $bigToolIdsArr[$toListId]['details'][$key2]['status']= 0;//未找到
                    else if( $distance>DistanceRange_safeDoor){
						$bigToolIdsArr[$toListId]['details'][$key2]['status']= 2; //超出范围
					}
					else {//DistanceRange_safeDoor米以内
                        $bigToolIdsArr[$toListId]['details'][$key2]['status']= 1;//定位设备找到，且在x米范围内。
                        $toolnums_list ++;
                    }
               }
               else{//为找到实时经纬度信息

                    

               }
               $bigToolIdsArr[$toListId]['details'][$key2]['devGPS_x']= $devGPS_x;
               $bigToolIdsArr[$toListId]['details'][$key2]['devGPS_y']= $devGPS_y;
               $bigToolIdsArr[$toListId]['details'][$key2]['distance']= $distance;


               //echo '<br>'.$devGPS_x.'  '.$devGPS_y.' distance='.$distance.'m<br>';


            }
            $bigToolIdsArr[$toListId]['thInfo']['safaDoorinName'] = $safaDoorinName;
            $bigToolIdsArr[$toListId]['thInfo']['toListId'] = $value['toListId'];
            $bigToolIdsArr[$toListId]['thInfo']['name'] = $value['toListName'];
            $bigToolIdsArr[$toListId]['thInfo']['twtlPreparedAmount'] = $value['twtlPreparedAmount'];//班前数量
            $bigToolIdsArr[$toListId]['thInfo']['twtlRealAmount'] = $toolnums_list;
            $bigToolIdsArr[$toListId]['thInfo']['amountDiffer'] = $value['twtlPreparedAmount'] - $toolnums_list;
             //echo '  len='.count($bigToolIdsArr).'  ';
            //工具集合对应的定位器集合
            //$bigToolIds = $value['twtlDetail'];
            //$bigToolIdsArr =  $bigToolIdsArr =  explode(",", $bigToolIds);;
            
             //echo   '<br>'; print_r($bigToolIdsArr);
       }
       //print_r($bigToolIdsArr);
       return $bigToolIdsArr;
 
        
    }

    //【人员-核心人员】清点/统计 GPSCode order by tm_dev_location.id desc limit 1
    public function getPersonsDataFromToolbag(){
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
       $sql = "SELECT * from  tworkorder left join cecontrol on  $twSafeDoor=ceControlId where twOrderId=$twOrderId ";
       //echo $sql;
    //   $sth = $this->_dbHandle->prepare($sql);
    //   $sth->execute();
    //   $res = $sth->fetchAll();
      $res = $mysqlModel->query($sql);
      //print_r($res);
      $safaDoorinId = $res[0]['twSafeDoor_in'];
      $safaDoorinName = $res[0]['ceName'];
      $safaDoorGPS_x = $res[0]['ceGPS_x'];
      $safaDoorGPS_y = $res[0]['ceGPS_y'];
      
      //获取人员信息
        $sql = "SELECT  pManageId,pManageName,GPSCode,loc_longitude,loc_latitude from  tworkorder_adminstrators left join pmanage on twamPersonId=pManageId left join gpslibs on pManageGpsId=GPSId 
         left join tm_dev_location on  id=(select max(id) from tm_dev_location where dev_imei=GPSCode ) where twamtWorkOrderId=$twOrderId ";
          //echo $sql;
    //    $sth = $this->_dbHandle->prepare($sql);
    //    $sth->execute();
    //    $res = $sth->fetchAll();
       $res = $mysqlModel->query($sql);
       $personsArr['personsInfo'] = $res;
         //print_r($res);
       //$personsItem = array();//人员统计信息
       $personnums = 0;
       $devGPS_x = "";
       $devGPS_y = "";
       $distance = "";
       foreach($personsArr['personsInfo'] as $key => $value){
           $devGPS_x = $value['loc_longitude'];
           $devGPS_y = $value['loc_latitude'];
           //计算距离
           //$bigToolIdsArr[$toListId]['details'][$key2]['gpsCode']=$gpsCode; ['safaDoorinName'] = $safaDoorinName;
           $personsArr['personsInfo'][$key]['gpsCode']=$value['GPSCode'];
           $personsArr['personsInfo'][$key]['safaDoorinName'] = $safaDoorinName;
           
           $personsArr['personsInfo'][$key]['status']= 0;
           if($devGPS_x!=""){
               $distance = $this->getDistance($devGPS_x, $devGPS_y, $safaDoorGPS_x, $safaDoorGPS_y, 1);
               if($distance!="" && $distance<DistanceRange_safeDoor){//DistanceRange_safeDoor米以内
                   $personsArr['personsInfo'][$key]['status']= 1;//定位设备找到，且在x米范围内。
                   $personnums ++;
               }
               $personsArr['personsInfo'][$key]['distance']=$distance;
               $personsArr['personsInfo'][$key]['devGPS_x']=$devGPS_x;
               $personsArr['personsInfo'][$key]['devGPS_y']=$devGPS_y;
           }

           


           
           //if( $distance<=DistanceRange_safeDoor) $personnums ++;//DistanceRange_safeDoor米以内
             
       }
       $personsArr['item']['twtlRealAmount'] = $personnums;
       //$bigToolIdsArr[$toListId]['thInfo']['amountDiffer'] = $value['twtlPreparedAmount'] - $personnums;
       $personsArr['item']['twtlPreparedAmount'] = count($personsArr['personsInfo']);
       $personsArr['item']['amountDiffer'] = count($personsArr['personsInfo']) -  $personnums;
        
       return $personsArr;//
       //print_r($personsArr);
   
    }
     //【人员-施工人员】清点/统计 GPSCode order by tm_dev_location.id desc limit 1
    public function getBuildersDataFromToolbag(){
        
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
           $devGPS_x = $value['loc_longitude'];
           $devGPS_y = $value['loc_latitude'];
           //计算距离
           //$bigToolIdsArr[$toListId]['details'][$key2]['gpsCode']=$gpsCode; ['safaDoorinName'] = $safaDoorinName;
           $personsArr['personsInfo'][$key]['gpsCode']=$value['GPSCode'];
           $personsArr['personsInfo'][$key]['safaDoorinName'] = $safaDoorinName;
          
           $personsArr['personsInfo'][$key]['status']= 0;
           if($devGPS_x!=""){
               $distance = $this->getDistance($devGPS_x, $devGPS_y, $safaDoorGPS_x, $safaDoorGPS_y, 1);
               if($distance!="" && $distance<DistanceRange_safeDoor){//DistanceRange_safeDoor米以内
                   $personsArr['personsInfo'][$key]['status']= 1;//定位设备找到，且在x米范围内。
                   $personnums ++;
               }
               $personsArr['personsInfo'][$key]['distance']=$distance;
               $personsArr['personsInfo'][$key]['devGPS_x']=$devGPS_x;
               $personsArr['personsInfo'][$key]['devGPS_y']=$devGPS_y;
           }

           


           
           
             
       }
       $personsArr['item']['twtlRealAmount'] = $personnums;
       //$bigToolIdsArr[$toListId]['thInfo']['amountDiffer'] = $value['twtlPreparedAmount'] - $personnums;
       $personsArr['item']['twtlPreparedAmount'] = count($personsArr['personsInfo']);
       $personsArr['item']['amountDiffer'] = count($personsArr['personsInfo']) -  $personnums;
        
       return $personsArr;//
       //print_r($personsArr);
       /* */
   
    }
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
 