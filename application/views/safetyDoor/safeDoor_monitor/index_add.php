<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("cecontrol");
$type = $_POST['type'];
$id = $_POST['id'];
$data['ceControlMaster'] = $_POST['master'];//			"name":name,
$data['ceControlPosition'] = $_POST['position'];//			"number":number,
$data['ceControlNote'] = $_POST['note'];//			"model":model,
//$data['device_price'] = $_POST['price'];//			"price":price,
//$data['device_amount'] = $_POST['summary'];//			"summary":summary
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'ceControlId');
/*
//$data['id']="2";
$data['name'] = $_POST['name'];
$data['sex']=$_POST['sex'];

$mysqlModel->add($data);

//$devicClassLists = $mysqlModel ->selectAll();

//$msg = $devicClassLists[0]['name'];
		*/
$msg=$id;

echo json_encode($msg);
