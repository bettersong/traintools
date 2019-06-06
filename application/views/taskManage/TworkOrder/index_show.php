<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tool_from");
$type = $_POST['type'];
$id = $_POST['id'];
$data['tool_name'] = $_POST['name'];
$data['tool_leader'] = $_POST['leader'];
$data['tool_remarks'] = $_POST['remarks'];
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
