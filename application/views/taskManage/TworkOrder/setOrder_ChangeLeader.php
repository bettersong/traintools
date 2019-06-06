<?php
	session_start();
	require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

	$mysqlModel = new Model("tworkorder_adminstrators");
	$id = $_POST['twamId'];

	$data['twamPersonId'] = $_POST['twamPersonId'];
	$data['twamName'] = $_POST['twamName'];
	$data['twamAttendance'] = $_POST['twamAttendance'];
	$res = $mysqlModel->update($id, $data,'twamId');
	
	echo json_encode($_POST);