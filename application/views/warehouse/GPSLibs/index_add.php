<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("gpslibs");
$type = $_POST['type'];
$id = $_POST['id'];
$data['GPSCode'] = $_POST['GPS_code'];
$data['GPSNote'] = $_POST['note'];
$data['GPSAdmin'] = $_SESSION['userInfo']['adminBumenId'];
$msg = "";

if($type == "add") $msg = $mysqlModel->add($data);
else if($type == "update") $msg = $mysqlModel->update($id, $data,'GPSId');

echo json_encode($_POST);