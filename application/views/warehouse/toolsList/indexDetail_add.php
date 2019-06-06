<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("detail");
$type = $_POST['type'];
$id = $_POST['id'];
$data['deToolListId'] = $_POST['deToolListId'];
$data['DetailCode'] = $_POST['toolCode'];
if ($_POST['toListGPSId']==0) {	//小工具
	$data['toListRFIDCode'] = $_POST['toListRFIDCode'];
}
else //大工具
{
	$mysqlModel_gpslibs = new Model("gpslibs");
	$OldGPSId = $_POST['toListOldGPSId'];
	$gpslibs['GPSisUse'] = 0;
	$mysqlModel_gpslibs->update($OldGPSId,$gpslibs,'GPSId');

	$GPSId = $_POST['toListGPSId'];
	$gpslibs['GPSisUse'] = 1;
	$mysqlModel_gpslibs->update($GPSId,$gpslibs,'GPSId');

	$data['toListGPSId'] = $GPSId;
}

$data['DetailAdmin'] = $_SESSION['userInfo']['adminBumenId'];
$msg = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'DetailId');

echo json_encode($res);