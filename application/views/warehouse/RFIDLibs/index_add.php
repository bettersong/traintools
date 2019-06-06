<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("rfidtag");
$type = $_POST['type'];
$id = $_POST['id'];
$data['RFIDTagType'] = $_POST['RFID_type'];
$data['RFIDTagCode'] = $_POST['RFID_code'];
$data['RFIDTagNote'] = $_POST['note'];
$data['RFIDTagAdmin'] = $_SESSION['userInfo']['adminBumenId'];
$msg = "";

if($type == "add") $msg = $mysqlModel->add($data);
else if($type == "update") $msg = $mysqlModel->update($id, $data,'RFIDTagId');

echo json_encode($msg);