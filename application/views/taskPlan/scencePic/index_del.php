<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$delid = $_POST['delid'];
//print_r($imgArr);
$mysqlModel = new Model("picture_now");

 
$mysqlModel->delete($delid,"pictureId");

unset($_SESSION['toolsCheck_scencePic']);//重置缓存


echo json_encode("success");