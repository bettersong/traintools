<?php

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_workers");
$delId = $_POST['delId'];
$mysqlModel->delete($delId,'twkeId');


$msg='success';

echo json_encode($msg);