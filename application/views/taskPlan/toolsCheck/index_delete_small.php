<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_toollists");
$twtlId = $_POST['twtlId'];
$data['twtlPreparedAmount'] = 0;//删除工具：把班前准备设为0即可

$msg = $mysqlModel->update($twtlId,$data,"twtlId");

unset($_SESSION['toolsCheck_toolsArr']);//重置toolsCheck中相应的缓存

echo json_encode($msg);