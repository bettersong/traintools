<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$mysqlModel = new Model("bmanage");
$type = $_POST['type'];
$id = $_POST['id'];
$data['bManageBranch'] = $_POST['name'];

$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'bManageId');


$msg=$res;

echo json_encode($data);
