<?php

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_adminstrators");
$id = $_POST['id'];
$mag = '';
$msg = $mysqlModel->delete($id,'twamId');

echo json_encode($msg);