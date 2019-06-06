<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("detail");
$id = $_POST['id'];
$mysqlModel->delete($id,'DetailId');


$msg='delete success';

echo json_encode($msg);