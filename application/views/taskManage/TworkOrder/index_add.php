<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

	$pManageIdsArr = $_POST['pManageIds'];

    $pmanage = array();
	$mysqlModel = new Model("pmanage_builders");
	// foreach ($_POST['name'] as $key => $value) {
	// 	array_push($pmanage,$mysqlModel ->select($value,"pManageName"));
	// }
	$pManageIds = join(',', $pManageIdsArr); 
    $sql = "select * from pmanage_builders where pManageId in ($pManageIds)";
	$pmanage = $mysqlModel->query($sql);

	$date = date("Y-m-d");
	$mysqlModel_workperson = new Model("tworkorder_workers");
	$qingkong = $mysqlModel_workperson -> delete($_POST['TwOrderId'],"twkeWorkOrderId");

	$data = array();
	foreach ($pmanage as $K => $V) {
		$data['twkePersonId'] = $V['pManageId'];
		$data['twkeDate'] = $date;
		$data['twkeWorkOrderId'] = $_POST['TwOrderId'];
		$data['twkeAdmin'] = $_SESSION['userInfo']['adminBumenId'];
		$WP = $mysqlModel_workperson -> add($data); 
	}
	echo json_encode($data);