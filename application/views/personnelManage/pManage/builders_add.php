<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysqlModel = new Model("pmanage_builders");
$type = $_POST['type'];

$data['pManageName'] = $_POST['name'];
$data['pManageSex'] = $_POST['sex'];
$data['pManageBranch'] = $_SESSION['userInfo']['bManageParentId'];//登录用户职位所属的部门就是添加的施工人员的部门 
$data['pManageStaffId'] = $_POST['code'];
$data['pManageContact'] = $_POST['contact'];
$data['pManageGpsId'] = $_POST['gps'];
$data['adminBumenId'] = $_SESSION['userInfo']['adminBumenId']; //登录用户职位所属的主管单位就是添加的施工人员的主管单位 
$res = "";
if($type == "add"){
	$res = $mysqlModel->add($data);
	
}
else if($type == "update"){
	
	$id = $_POST['id'];
	$res = $mysqlModel->update($id, $data,'pManageId');
	
}
$msg=$res;

echo json_encode($msg);
