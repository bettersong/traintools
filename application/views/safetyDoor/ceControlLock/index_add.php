<?php
session_start();

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("cecontrollock");
$type = $_POST['type'];
$id = $_POST['id'];
$data['ceControlLockNum'] = $_POST['num'];
$data['ceControlLockNotes'] = $_POST['notes'];
$data['adminBumenId'] = $_SESSION['userInfo']['adminBumenId'];
$msg = "";
if($type == "add") {
	$data['ceControlLockStatic']=0;
	$msg = $mysqlModel->add($data);
}
else if($type == "update") {
	$tmp = $mysqlModel->select($id,"ceControlLockId");
	$data['ceControlLockStatic'] = $tmp['ceControlLockStatic'];
	$msg = $mysqlModel->update($id, $data,'ceControlLockId');
}

echo json_encode($msg);
