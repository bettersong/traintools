<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("toolslist");
$id = $_POST['id'];
$mysqlModelDetail = new Model("detail");
$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
$sql = "where deToolListId=$id and DetailAdmin in ($myAdminBumensubArrString)";
$detailArr = $mysqlModelDetail->selectAll($sql);
$amount = count($detailArr);
if ($amount==0) {
	$msg = $mysqlModel->delete($id,'toListId');
}
else
	$msg = "error";
echo json_encode($msg);