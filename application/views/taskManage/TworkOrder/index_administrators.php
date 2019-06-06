<?php
	session_start();
	require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
	
	$date = Date("Y-m-d");
	$mysqlModel = new Model("tworkorder_adminstrators");
	$type = $_POST['type'];
	$id = $_POST['twamId'];

	$data['twamUserJobName'] = $_POST['JobName'];
	$data['twamDate'] = $date;
	$data['twamName'] = $_POST['name'];
	$data['twamtWorkOrderId'] = $_POST['twtltWorkOrderId'];
	$data['twamAdmin'] = $_SESSION['userInfo']['adminBumenId'];
	$res = "";
	if($type == "add") $res = $mysqlModel->add($data);
	else if($type == "update") $res = $mysqlModel->update($id, $data,'twtlId');
	
	echo json_encode($res);