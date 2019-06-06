<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("toolslist");
$type = $_POST['type'];
$id = $_POST['id'];
$data['toListName'] = $_POST['name'];
$data['toListType'] = $_POST['typel'];
$data['toListWarehouseId'] = $_POST['warehouseId'];
$data['toListMaster'] = $_POST['MasterId'];
$data['toListAdmin'] = $_SESSION['userInfo']['adminBumenId'];
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'toListId');

$msg=$res;
echo json_encode($msg);