<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("cemanage");
$id = $_POST['id'];
$mysqlModel->delete($id,'ceManageId');


$msg='success';

echo json_encode($msg);
