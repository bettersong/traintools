<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("toolsclass");
$id = $_POST['id'];
$mysqlModel->delete($id,'toClassId');


$msg='success';

echo json_encode($msg);