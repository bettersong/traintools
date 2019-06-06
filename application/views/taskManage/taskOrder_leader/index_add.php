<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("hworkorder");
$type = $_POST['type'];
$id = $_POST['id'];
$data['hwOrderLeader'] = $_POST['leader'];
$data['hwOrderTime'] = $_POST['down'];
$data['hwOrderState'] = $_POST['complete'];
$data['hwOrderRemarks'] = $_POST['remarks'];
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data);
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
