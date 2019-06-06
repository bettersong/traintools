<?php

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_toollists");
$id = $_POST['id'];
$mag = '';
$msg = $mysqlModel->delete($id,'twtlId');

echo json_encode($msg);