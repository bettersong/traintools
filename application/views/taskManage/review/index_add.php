<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("work_review");
$type = $_POST['type'];
$id = $_POST['id'];
$data['work_leader'] = $_POST['leader'];
$data['sub_time'] = $_POST['time'];
$data['work_state'] = $_POST['state'];
// $res = "";
// if($type == "add") $res = $mysqlModel->add($data);
// else if($type == "update") $res = $mysqlModel->update($id, $data);
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
