<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("peopleforms");
$type = $_POST['type'];
$id = $_POST['id'];
$data['peFormsName'] = $_POST['name'];//			"name":name,
$data['peFormsTool'] = $_POST['tool'];//			"number":number,
$data['peFormsMaster'] = $_POST['master'];//			"model":model,
//$data['device_price'] = $_POST['price'];//			"price":price,
//$data['device_amount'] = $_POST['summary'];//			"summary":summary
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'peFormsId');
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