<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("cecontrollock");
$id = $_POST['id'];
$mysqlModel->delete($id,'ceControlLockId');


$msg=$id;

echo json_encode($msg);
