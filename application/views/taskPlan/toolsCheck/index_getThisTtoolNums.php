<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("detail");

$smalltoolsId = $_POST['smalltoolsId'];
$sql = "select * from detail where deToolListId=$smalltoolsId ";
$res2 = $mysqlModel->query($sql);

$thisToolNums = count($res2);

 
echo json_encode($thisToolNums);