<?php
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysqlModel = new Model("pmanage");
$type = $_POST['type'];
$id = $_POST['id'];
$data['pManageName'] = $_POST['name'];
$data['pManageSex'] = $_POST['sex'];
$data['pManageBranch'] = $_POST['department'];
$data['pManagePosition'] = $_POST['position'];//			"price":price,
$data['pManageStaffId'] = $_POST['code'];
$data['pManageContact'] = $_POST['contact'];//			"summary":summary
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'pManageId');
$msg=$res;

echo json_encode($msg);
