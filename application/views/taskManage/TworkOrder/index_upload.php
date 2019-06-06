<?php session_start();
$msg = 'success';
//上传工单到服务器
if ($_FILES["file"]["error"] > 0)
{
  echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else
{
  $picname = iconv("UTF-8", "GB2312", $_FILES["file"]["name"]);//$_FILES['mypic']['name']; 
  //类型
  $type = substr(strrchr($picname, '.'), 1);

  $rand = rand(100, 999); 
  $filename1 = date("YmdHis") . $rand.'.'.$type;; //命名图片名称 
  
  $filepath = $_SERVER['DOCUMENT_ROOT']."/public/upload/workorder/";
  $filename = $filepath.$filename1;//包含路径
   	
  if (file_exists($filename))
  {
    echo $filename1 . " already exists. ";
  }
  else
  {
    move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
  }
  
  
}

//分析工单的Excel文件

$fileName = $filename;

$startTime = time(); //返回当前时间的Unix 时间戳

require_once 'Classes/PHPExcel/IOFactory.php';

$objPHPExcel = PHPExcel_IOFactory::load($fileName);

//获取sheet表格数目

$sheetCount = $objPHPExcel->getSheetCount();

//默认选中sheet0表

$sheetSelected = 0;$objPHPExcel->setActiveSheetIndex($sheetSelected);

//获取表格行数

//$rowCount = $objPHPExcel->getActiveSheet()->getHighestRow();
$rowCount = 50;
//获取表格列数

$columnCount = $objPHPExcel->getActiveSheet()->getHighestColumn();

$dataArr = array();

/* 循环读取每个单元格的数据 */

//行数循环
for ($row = 3; $row <= $rowCount; $row++){

//列数循环 , 列数是以A列开始

	for ($column = 'A'; $column != $columnCount; $column++) {
    $temp = $objPHPExcel->getActiveSheet()->getCell($column.$row)->getValue();
		$dataArr[]   = $temp;
	}
	$data[$row] = $dataArr;
	$dataArr = NULL;
}
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$date['JiHuaDate'] = date('Y-m-d');

$mysqlModel = new Model("tworkorder");
$tools = array();
$rowNums = 1;

date_default_timezone_set('PRC'); //设置默认市区

$i=0;
$excelRows = array();
foreach ($data as $key => $value) {

  if($value[0] == '' && $value[1] == '') //如果工单第一列和第二列为空，则认为后面没有信息，跳出循环
    break;

 
  $excelRows[$i]['adminBumenId'] = $_SESSION['userInfo']['adminBumenId'];//登陆用户的主管单位
  $excelRows[$i]['XuHao'] = $value[0];
  //$excelRows[$i]['JiHuaDate'] =  $value[1];

  $excelRows[$i]['JiHuaDate'] =  $date['JiHuaDate'];
  $excelRows[$i]['XianLuName'] = $value[2];
  $excelRows[$i]['HangBie'] = $value[3];
  $excelRows[$i]['TianChuangDYMC'] = $value[4];
  $excelRows[$i]['TianChuangDYQDCZ'] = $value[5];
  $excelRows[$i]['TianChuangDYZDCZ'] = $value[6];
  $excelRows[$i]['ZuoYeQSLC'] = $value[7];
  $excelRows[$i]['ZuoYeZZLC'] = $value[8];
  $excelRows[$i]['ZuoYeJB'] = $value[9];
  $excelRows[$i]['WeiXiuXM'] = $value[10];
  $excelRows[$i]['TianChuangLB'] = $value[11];
  $excelRows[$i]['TianChuangJB'] = $value[12];
  $excelRows[$i]['ZuoYeXM'] = $value[13];
  $excelRows[$i]['CheJian'] = $value[14];
  $excelRows[$i]['ZhuTiZYBZ'] = $value[15];
  $excelRows[$i]['GongTongZYBZ'] = $value[16];
  $excelRows[$i]['PeiHeZYBZ'] = $value[17];
  $excelRows[$i]['ZuoYeFL'] = $value[18];
  $excelRows[$i]['ZuoYeDD'] = $value[19];
  $excelRows[$i]['ZuoYeMWZ'] = $value[20];
  $excelRows[$i]['DengJiCZ'] = $value[21];
  $excelRows[$i]['ZhuZhanFHYSZZ'] = $value[22];
  $excelRows[$i]['LuYongCSFZ'] = $value[23];
  $excelRows[$i]['ZhuTiZYFZR'] = $value[24];//主体作业负责人
  $excelRows[$i]['GongYongZYFZR'] = $value[25];
  $excelRows[$i]['PeiHeZYFZR'] = $value[26];
  $excelRows[$i]['ZhiJianY'] = $value[27];
  $excelRows[$i]['FeiGongWPHDW'] = $value[28];
  $excelRows[$i]['ShiFouZFZCZK'] = $value[29];
  $excelRows[$i]['ZuoYeYY'] = $value[30];
  $excelRows[$i]['ZuoYeNR'] = $value[31];
  $excelRows[$i]['ZuoYeL'] = $value[32];
  $excelRows[$i]['ZhuYaoGJJ'] = $value[33];
  $excelRows[$i]['ZhuZhanFHY'] = $value[34];
  $excelRows[$i]['ZhuZhanFHYuan'] = $value[35];
  $excelRows[$i]['GongDiFHY'] = $value[36];
  $excelRows[$i]['ZhuSuoFHY'] = $value[37];
  $excelRows[$i]['ZhiGongZYRS'] = $value[38];
  $excelRows[$i]['FuZhuGZYRS'] = $value[39];
  $excelRows[$i]['ShiFouYLYCPH'] = $value[40];
  $excelRows[$i]['XiangLinXTCNSFYLYC'] = $value[41];
  $excelRows[$i]['ShiFouSX'] = $value[42];
  $excelRows[$i]['QiQiSJ'] = $value[43];
  $excelRows[$i]['ZhuYaoBL'] = $value[44];
  $excelRows[$i]['ZhuangTai'] = $value[45];
  $excelRows[$i]['BaoBaoGB'] = $value[46];
  $excelRows[$i]['twSafecon'] = $value[47];
  $excelRows[$i]['pushTime'] = date('Y-m-d H:i:s');
  
  //判断主体作业负责人是否存在，如果不存在则返回提示信息
  $ZhuTiZYFZR = $excelRows[$i]['ZhuTiZYFZR'];
  $temp = str_replace('）',')',$ZhuTiZYFZR);
  $temp = str_replace('，',',',$ZhuTiZYFZR);
  $tempArr = explode('(', $temp);
  $ZhuTiZYFZR_name = $tempArr[0];
   //判断主体作业负责人是否存在
   $mysqlModel_checkCharge = new Model("pmanage");
   $datal_checkCharge['pManageName'] = $ZhuTiZYFZR_name; 
   $res = $mysqlModel_checkCharge->selectByCondition($datal_checkCharge);//,$customCondition='
   if(!$res){
      echo  'noCharge作业负责人“'.$ZhuTiZYFZR_name.'”不存在，请更改！' ;
      exit;
   }
   else{
      $pManageId = $res[0]['pManageId'];//负责人ID;
      //判断负责人+工单日期的工单是否存在，存在则拒绝
      $jiHuaDate = $excelRows[$i]['JiHuaDate'];
      $res = $mysqlModel->query("select * from tworkorder where JiHuaDate='$jiHuaDate' and twOrderManagerId = $pManageId ");
      if($res){//改负责人该日期已经有工单，拒绝并提示
        echo  'orderExist作业负责人“'.$ZhuTiZYFZR_name.'”'.$jiHuaDate.'日的工单已存在！' ;
        exit;
      }
      
      $excelRows[$i]['twOrderManagerId'] = $pManageId;//负责人ID
      $excelRows[$i]['twOrderManagerName'] = $ZhuTiZYFZR_name;//负责人姓名
   }  
  // if( !existZhuTiZYFZR($ZhuTiZYFZR_name) ){
  //   echo  'noCharge作业负责人“'.$ZhuTiZYFZR_name.'”不存在，请更改！' ;
  //   exit;
  // }
  
  $i++;
}
//工单表信息正确，开始保存到数据库
foreach ($excelRows as $key => $value) {
 
  $V = array();
  $V = $value; //一个工单信息（Excel中的一行）
  $res = '';
  $res = $mysqlModel->add($V); //把工单信息保存到数据库

  //取出工单表中工具进行分析
  $toolLists = $V['ZhuYaoGJJ'];//工器集合，字符串形式
  $toolLists = str_replace(' ', '',$toolLists);
  $toolLists = str_replace('）',')',$toolLists);
  $toolLists = str_replace('（','(',$toolLists);
  $toolListArr = explode(',', $toolLists);//工具集合的数组
  $mysqlModeld = new Model("toolslist");
  $mysqlModelt = new Model("tworkorder_toollists");
  foreach($toolListArr as $index => $value)
  {//根据工单获取工单工具名称并从工具表中查出数据加入工单工具表中
        $valArr = explode('(', $value);
        $toolAmount = '';
        foreach ($valArr as $num => $Va)
        {
            if($num!=0)
            $toolAmount .= "(". $Va;
        }
        //提取数量中的数值
        $patterns = "/\d+/"; //第一种
        //$patterns = "/\d/";  //第二种
        preg_match_all($patterns,$toolAmount,$arr);
        $toolNums = $arr[0][0];
        $toolUnit = str_replace($toolNums,"",$toolAmount);//工具单位，如：只、个

        $tools = $mysqlModeld -> select_toollistForm($valArr[0]);
        $K['twtlToolId'] = is_null($tools['toListId'])?0:$tools['toListId'];
        $K['twtlName'] = $valArr[0];
        $K['twtlDate'] = $date['JiHuaDate'];
        $K['twtlAmount'] = $toolNums;//$toolAmount;
        $K['twtlPreparedAmount'] = $K['twtlAmount'];//班前准备数量默认为工单中的数量
        $K['twtlUnit'] = $toolUnit;//
        $K['twtlMaster'] = is_null($tools['toListMaster'])?0:$tools['toListMaster'];//$tools['waMessageMaster'];
        $K['twtlBumenId']= $_SESSION['userInfo']['adminBumenId'];
        $K['twtltWorkOrderId'] = $res;
        $T = $mysqlModelt->add($K); //把工具添加到数据表tworkorder_toollists
  }
  $msg = count($toolListArr);

  //核心人员处理
  $administrators = array();
  $administrators['ZhuTiZYFZR']['userinfo'] = $V['ZhuTiZYFZR'];//主体作业负责人
  $administrators['ZhiJianY']['userinfo'] = $V['ZhiJianY'];//质检员
  $administrators['ZhuZhanFHYuan']['userinfo'] = $V['ZhuZhanFHYuan'];//驻站防护员
  $administrators['GongDiFHY']['userinfo'] = $V['GongDiFHY'];//工地防护员
  $administrators['ZhuSuoFHY']['userinfo'] = $V['ZhuSuoFHY'];//驻所防护员

  $administrators['ZhuTiZYFZR']['userJobName'] = '主体作业负责人';//主体作业负责人
  $administrators['ZhiJianY']['userJobName'] = '质检员';//质检员
  $administrators['ZhuZhanFHYuan']['userJobName'] = '驻站防护员';//驻站防护员
  $administrators['GongDiFHY']['userJobName'] = '工地防护员';//工地防护员
  $administrators['ZhuSuoFHY']['userJobName'] = '驻所防护员';//驻所防护员

  $mysqlModelp = new Model("pmanage");
  $mysqlModela = new Model("tworkorder_adminstrators");
  //遍历核心人员
  foreach($administrators as $index => $userinfoArr){
      
      $userinfo = $userinfoArr['userinfo'];
      $userinfo = str_replace('）',')',$userinfo);
      $userinfo = str_replace('，',',',$userinfo);
      $valArr = explode('(', $userinfo);
      if(count($valArr)>1)$valArr[1]='('.$valArr[1];//补充左括号
      if(count($valArr)<=1)$valArr = explode(',', $userinfo);//如果左括号识别失败，则用尝试用逗号

      $person = $mysqlModelp -> select($valArr[0],"pManageName");
      $I['twamName'] = $valArr[0];
      $I['twamPersonId'] = $person['pManageId']!=''?$person['pManageId']:0;
      $I['twamDate'] = $V['JiHuaDate'];
      $I['twamAdmin']= $_SESSION['userInfo']['adminBumenId'];
      $I['twamtWorkOrderId'] = $res;
      $I['twamUserJobName'] = $userinfoArr['userJobName'];
      $p = $mysqlModela->add($I);
    }
}
echo json_encode($msg);