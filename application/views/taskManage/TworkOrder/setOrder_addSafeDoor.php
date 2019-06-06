<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

	 
	$id = $_POST['twOrderId'];
	

	$mysqlModel = new Model("tworkorder");
	$data = array();
	$data['twSafeDoor_in'] = $_POST['safeDoorInId'];
	$data['twSafeDoor_out'] = $_POST['safeDoorOutId'];

	$res = $mysqlModel->update($id, $data,'twOrderId');
	
	$msg = "success";
	echo json_encode($res);