<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("pmanage");
$id = $_POST['id'];
$mysqlModel->delete($id,'pManageId');


$msg='success';

echo json_encode($msg);
