<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("deviclist");
$id = $_POST['id'];
$mysqlModel->delete($id,'deListId');


$msg='success';

echo json_encode($msg);