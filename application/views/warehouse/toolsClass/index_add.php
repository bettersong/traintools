<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("toolsclass");
$type = $_POST['type'];
$id = $_POST['id'];
$data['toClassName'] = $_POST['name'];//			"name":name,
//$data['toClassType'] = $_POST['typel'];//			"number":number,
//$data['toClassTime'] = $_POST['tool_time'];//			"model":model,
//$data['device_price'] = $_POST['price'];//			"price":price,
//$data['device_amount'] = $_POST['summary'];//			"summary":summary
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'toClassId');
/*
//$data['id']="2";
$data['name'] = $_POST['name'];
$data['sex']=$_POST['sex'];

$mysqlModel->add($data);

//$devicClassLists = $mysqlModel ->selectAll();

//$msg = $devicClassLists[0]['name'];
		*/
$msg=$res;

echo json_encode($msg);