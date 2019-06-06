<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("rfidclass");
$id = $_POST['id'];
$mysqlModel->delete($id,'RFIDClassId');


$msg='success';

echo json_encode($msg);