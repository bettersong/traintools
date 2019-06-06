<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("rfidtag");
$id = $_POST['id'];
$mysqlModel->delete($id,'RFIDTagId');


$msg='success';

echo json_encode($msg);