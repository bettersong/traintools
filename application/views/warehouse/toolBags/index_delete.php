<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tm_tool_bag");
$id = $_POST['id'];
$mysqlModel->delete($id,'tb_id');


$msg=$id;

echo json_encode($msg);
