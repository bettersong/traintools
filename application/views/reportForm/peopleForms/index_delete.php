<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("peopleforms");
$id = $_POST['id'];
$mysqlModel->delete($id,'peFormsId');


$msg="success";

echo json_encode($msg);