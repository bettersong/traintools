<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("rolebaseinfo");
$id = $_POST['id'];
$mysqlModel->delete($id,'roleId');


$msg='success';

echo json_encode($msg);