<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$mysqlModel = new Model("bmanage2");

$id = $_POST['bumenId'];
$roleIds = $_POST['roleIds'];
 

$data['bManageRoleIds'] = rtrim($_POST['roleIds'],',');

 
$res = $mysqlModel->update($id, $data,'bManageId');

$msg = "success";
	
 



echo json_encode($msg);
