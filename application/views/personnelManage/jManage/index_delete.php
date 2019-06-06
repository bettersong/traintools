<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("bmanage2");
$id = $_POST['id'];
$mysqlModel->delete($id,'bManageId');


$msg='success';

echo json_encode($msg);
