<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

 $mysqlModel = new Model("pmanage");
// $type = $_POST['type'];
// $id = $_POST['id'];
$data['pManageContact'] = $_POST['contact'];
$res = $mysqlModel->update($_POST['userName'], $data,'pManageName');
$name = $mysqlModel->select($_POST['userName'], 'pManageName');
$msg=$res;
$_SESSION['userInfo']['pManageContact'] = $_POST['contact'];
echo json_encode($name);
