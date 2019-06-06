<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("reportforms");
$id = $_POST['id'];
$mysqlModel->delete($id,'reFormsId');


$msg='success';

echo json_encode($msg);
