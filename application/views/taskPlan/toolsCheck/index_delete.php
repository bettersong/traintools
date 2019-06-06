<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_toollists");
$twtlId = $_POST['twtlId'];
$twtlInformation = $mysqlModel->select($twtlId,"twtlId");

$DetailArr = explode(",", $twtlInformation['twtlDetail']);
$IDbig = $_POST['IDbig'];
foreach ($DetailArr as $key => $value) {
	if ($key == $IDbig) unset($DetailArr[$key]);
}
$DetailStrs = implode(",", $DetailArr);
$data['twtlDetail'] = $DetailStrs;
$data['twtlPreparedAmount'] = $twtlInformation['twtlPreparedAmount'] - 1;//班前准备减1

$msg = $mysqlModel->update($twtlId,$data,"twtlId");

unset($_SESSION['toolsCheck_toolsArr_big']);//重置toolsCheck中相应的缓存


echo json_encode($msg);