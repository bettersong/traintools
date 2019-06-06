<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("devicclass");
$id = $_POST['id'];
$mysqlModel->delete($id,'deClassId');


$msg='success';

echo json_encode($msg);
