<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("cecontrol");
$id = $_POST['id'];
$mysqlModel->delete($id,'ceControlId');


$msg=$id;

echo json_encode($msg);
