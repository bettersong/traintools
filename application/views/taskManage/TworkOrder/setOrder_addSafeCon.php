<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

	$safecon = $_POST['safecon'];
	$id = $_POST['twOrderId'];
	

	$mysqlModel = new Model("tworkorder");
	$data = array();
	$data['twSafecon'] = $_POST['safecon'];

	$res = $mysqlModel->update($id, $data,'twOrderId');
	
	$msg = "success";
	echo json_encode($res);