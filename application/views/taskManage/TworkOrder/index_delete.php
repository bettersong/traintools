<?php

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder");
$id = $_POST['id'];
$mysqlModel->delete($id,'twOrderId');


$msg=$id;

echo json_encode($msg);