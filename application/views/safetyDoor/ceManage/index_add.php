<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("cemanage");
$type = $_POST['type'];
$id = $_POST['id'];
$data['ceManageName'] = $_POST['name'];//			"name":name,
$data['ceManageAmount'] = $_POST['amount'];//			"number":number,
$data['ceManageTime'] = $_POST['time'];//			"model":model,
//$data['device_price'] = $_POST['price'];//			"price":price,
//$data['device_amount'] = $_POST['summary'];//			"summary":summary
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'ceManageId');
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
