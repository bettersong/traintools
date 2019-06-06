<?php
	session_start();
	require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

	$mysqlModel = new Model("tworkorder");
	$data = $_POST['TworkOrder'];
	$data['ZhuTiZYFZR'] = $_POST['txt'];
	$id = $data['twOrderId'];
	$res = "";
	$res = $mysqlModel->update($id, $data,'twOrderId');
	echo json_encode($res);