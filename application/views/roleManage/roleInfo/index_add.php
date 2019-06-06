<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("rolebaseinfo");

$type = $_POST['type'];
$id = $_POST['id'];

$data['roleName'] = $_POST['roleName'];
$data['roleNote'] = $_POST['note'];

$msg = "";

if($type == "add") $msg = $mysqlModel->add($data);
else if($type == "update") $msg = $mysqlModel->update($id, $data,'roleId');

echo json_encode($msg);