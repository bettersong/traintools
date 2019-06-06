<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$mysqlModel = new Model("bmanage2");

$type = $_POST['type'];
$name = $_POST['name'];
$pid = $_POST['pid'];
$level = $_POST['level'];

$data['bManageName'] = $_POST['name'];
$data['bManageParentId'] = $_POST['pid'];


$msg="error";
$res = "";
if($type == "add"){
	$data['level'] = $_POST['level'];
	$res = $mysqlModel->add($data);
	if($res!=0)$msg=$res;
}
else if($type == "update"){
	$res = $mysqlModel->update($id, $data,'bManageId');
	
	$msg = "success";
	
}




echo json_encode($msg);
