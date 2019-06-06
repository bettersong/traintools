<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysqlModel = new Model("warehousemessage");
$type = $_POST['type'];
$id = $_POST['id'];
$data['waMessageName'] = $_POST['name'];
$data['waMessageMaster'] = $_POST['master'];
$data['waMessageNotes'] = $_POST['notes'];
$data['waMessageGPS_x'] = $_POST['wmGPS_x'];
$data['waMessageGPS_y'] = $_POST['wmGPS_y'];
$data['waMessageAdmin'] = $_SESSION['userInfo']['adminBumenId'];

$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'waMessageId');

$msg=$res;
echo json_encode($msg);