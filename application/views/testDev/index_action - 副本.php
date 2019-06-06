<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$mysqlModel = new Model("bmanage2");

$type = $_POST['type'];


$msg="error";
$res = "";
if($type == "add"){
	$addtype = $_POST['addtype'];
	$name = $_POST['name'];
	$pid = $_POST['pid'];
	
	
	$data['bumenOrZhiwei'] = $_POST['addtype'];
	$data['bManageName'] = $_POST['name'];
	$data['bManageParentId'] = $_POST['pid'];
	$data['level'] = $_POST['level'];

	$res = $mysqlModel->add($data);
	if($res!=0)$msg=$res;
}
else if($type == "update"){
	$id = $_POST['bumenid'];
	$data['bManageName'] = $_POST['bumenname'];
	$res = $mysqlModel->update($id, $data,'bManageId');
	
	$msg = "success";
	
}
else if($type == "del"){
	$id = $_POST['id'];
	$data_update['bManageHidden'] = 1;
	$res = $mysqlModel->update($id, $data_update,'bManageId');
	$msg = "success";
}
else if($type == "setAdminBumen"){
	$id = $_POST['bumenid'];
	$data['isAdministration'] = $_POST['setAdminBumenValue'];
	$res = $mysqlModel->update($id, $data,'bManageId');
	
	$msg = "success";
}




echo json_encode($msg);
