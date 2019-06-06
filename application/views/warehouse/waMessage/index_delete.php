<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("warehousemessage");
$id = $_POST['id'];
$mysqlModel->delete($id,'waMessageId');
$msg='delete success';
echo json_encode($msg);