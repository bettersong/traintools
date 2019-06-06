<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$twtlId = $_POST['twtlId'];
$mysqlModel_twtl = new Model("tworkorder_toollists");
$information = $mysqlModel_twtl->select($twtlId,"twtlId");
$twtlDetail = $information['twtlDetail'];
if($twtlDetail=="") $twtlDetail='""';
$DetailIdStr = "(".rtrim($twtlDetail,",").")";

$mysqlModel = new Model("detail");
$toListId = $_POST['toListId'];
$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
$sql = "where deToolListId = $toListId and DetailAdmin in ($myAdminBumensubArrString) and DetailId not in $DetailIdStr";
$Datail_information = $mysqlModel->selectAll($sql);


echo json_encode($Datail_information);