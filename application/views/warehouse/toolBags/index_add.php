<?php
session_start();

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tm_tool_bag");
$type = $_POST['type'];
$id = $_POST['id'];

$data['tb_name'] = $_POST['tb_name'];
$data['rfid_code'] = $_POST['tools'];
$data['rfid_reader_code'] = $_POST['reader'];

//定位器
$mysqlModel_gpslibs = new Model("gpslibs");
$oldGPSId = $_POST['oldGPSId'];
$gpslibs['GPSisUse'] = 0;
$mysqlModel_gpslibs->update($oldGPSId,$gpslibs,'GPSId');
$GPSId = $_POST['GPSId'];
$gpslibs['GPSisUse'] = 1;
$mysqlModel_gpslibs->update($GPSId,$gpslibs,'GPSId');

$data['tb_GPSId'] = $GPSId;
$data['type'] = $_POST['tool_type'];
$data['rep_id'] = $_POST['house'];
$data['state'] = $_POST['state'];
$data['gmt_modified'] = date("Y-m-d H:i:s");
$data['adminBumenId'] = $_SESSION['userInfo']['adminBumenId'];
$msg = "";
if($type == "add") {
	$data['gmt_create'] = date("Y-m-d H:i:s");
	$msg = $mysqlModel->add($data);
}
else if($type == "update") {
	$tmp = $mysqlModel->select($id,"tb_id");
	$data['gmt_create'] = $tmp['gmt_create'];
	$msg = $mysqlModel->update($id, $data,'tb_id');
}

echo json_encode($msg);
