<?php
	session_start();
	require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
	
	$date = Date("Y-m-d");
	$mysqlModel = new Model("tworkorder_toollists");
	$type = $_POST['type'];
	$id = $_POST['twtlId'];

	$data['twtlAmount'] = $_POST['amount'];
	$data['twtlDate'] = $date;
	$data['twtlName'] = $_POST['twtlName'];
	$data['twtlToolId'] = $_POST['twtlToolId'];
	$data['twtlMaster'] = $_POST['master'];
	$data['twtltWorkOrderId'] = $_POST['twtltWorkOrderId'];
	$data['twtlBumenId'] = $_SESSION['userInfo']['adminBumenId'];
	$res = "";
	if($type == "add") $res = $mysqlModel->add($data);
	else if($type == "update") $res = $mysqlModel->update($id, $data,'twtlId');
	
	echo json_encode($data);