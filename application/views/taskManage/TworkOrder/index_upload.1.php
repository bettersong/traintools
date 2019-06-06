<?php session_start();
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

//开始分析并处理文件

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
$i=0;

date_default_timezone_set('PRC'); //设置默认市区

foreach ($data as $key => $value) {

  if($value[0] == '' && $value[1] == '') //如果工单第一列和第二列为空，则认为后面没有信息，跳出循环
    break;

  $V = array();
  $V['adminBumenId'] = $_SESSION['userInfo']['adminBumenId'];//登陆用户的主管单位
  $V['XuHao'] = $value[0];
  //$V['JiHuaDate'] =  $value[1];

  $V['JiHuaDate'] =  $date['JiHuaDate'];
  $V['XianLuName'] = $value[2];
  $V['HangBie'] = $value[3];
  $V['TianChuangDYMC'] = $value[4];
  $V['TianChuangDYQDCZ'] = $value[5];
  $V['TianChuangDYZDCZ'] = $value[6];
  $V['ZuoYeQSLC'] = $value[7];
  $V['ZuoYeZZLC'] = $value[8];
  $V['ZuoYeJB'] = $value[9];
  $V['WeiXiuXM'] = $value[10];
  $V['TianChuangLB'] = $value[11];
  $V['TianChuangJB'] = $value[12];
  $V['ZuoYeXM'] = $value[13];
  $V['CheJian'] = $value[14];
  $V['ZhuTiZYBZ'] = $value[15];
  $V['GongTongZYBZ'] = $value[16];
  $V['PeiHeZYBZ'] = $value[17];
  $V['ZuoYeFL'] = $value[18];
  $V['ZuoYeDD'] = $value[19];
  $V['ZuoYeMWZ'] = $value[20];
  $V['DengJiCZ'] = $value[21];
  $V['ZhuZhanFHYSZZ'] = $value[22];
  $V['LuYongCSFZ'] = $value[23];
  $V['ZhuTiZYFZR'] = $value[24];//主体作业负责人
  $V['GongYongZYFZR'] = $value[25];
  $V['PeiHeZYFZR'] = $value[26];
  $V['ZhiJianY'] = $value[27];
  $V['FeiGongWPHDW'] = $value[28];
  $V['ShiFouZFZCZK'] = $value[29];
  $V['ZuoYeYY'] = $value[30];
  $V['ZuoYeNR'] = $value[31];
  $V['ZuoYeL'] = $value[32];
  $V['ZhuYaoGJJ'] = $value[33];
  $V['ZhuZhanFHY'] = $value[34];
  $V['ZhuZhanFHYuan'] = $value[35];
  $V['GongDiFHY'] = $value[36];
  $V['ZhuSuoFHY'] = $value[37];
  $V['ZhiGongZYRS'] = $value[38];
  $V['FuZhuGZYRS'] = $value[39];
  $V['ShiFouYLYCPH'] = $value[40];
  $V['XiangLinXTCNSFYLYC'] = $value[41];
  $V['ShiFouSX'] = $value[42];
  $V['QiQiSJ'] = $value[43];
  $V['ZhuYaoBL'] = $value[44];
  $V['ZhuangTai'] = $value[45];
  $V['BaoBaoGB'] = $value[46];
  $V['Kong'] = $value[47];
  $V['pushTime'] = date('Y-m-d H:i:s');
  $res = '';
  $res = $mysqlModel->add($V);

  //取出工单表中工具进行分析
  $toolLists = $V['ZhuYaoGJJ'];
  $toolLists = str_replace(' ', '',$toolLists);
  $toolLists = str_replace('）',')',$toolLists);
  $toolLists = str_replace('（','(',$toolLists);
  $toolListArr = explode(',', $toolLists);
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
        $K['twtlUnit'] = $toolUnit;//
        $K['twtlMaster'] = $tools['waMessageMaster'];
        $K['twtlBumenId']= $_SESSION['userInfo']['adminBumenId'];
        $K['twtltWorkOrderId'] = $res;
        $T = $mysqlModelt->add($K);
  }


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

echo json_encode('success');