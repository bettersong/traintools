<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysqlModel = new Model("pmanage");
$personId = $_POST['pManageId'];
$data['pManagePassword'] = $_POST['newPassword'];
$msg = $mysqlModel->update($personId, $data,"pManageId");
if ($msg==1) {
	$_SESSION['userInfo']['pManagePassword'] = $_POST['newPassword'];
}

echo json_encode($msg);
