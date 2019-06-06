<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("zmanage");
$id = $_POST['id'];
$mysqlModel->delete($id,'zManageId');


$msg='success';

echo json_encode($msg);
