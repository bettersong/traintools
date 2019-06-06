<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("deviclist");
$type = $_POST['type'];
$id = $_POST['id'];
$data['deListName'] = $_POST['name'];
$data['deListQuantity'] = $_POST['number'];
$data['deListClass'] = $_POST['model'];
$data['deListType'] = $_POST['device_type'];
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'deListId');
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