<?php

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_adminstrators");
$id = $_POST['id'];
$mysqlModel->delete($id,'twamId');


$msg='success';

echo json_encode($msg);