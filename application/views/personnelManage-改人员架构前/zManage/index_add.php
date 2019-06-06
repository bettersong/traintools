<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$mysqlModel = new Model("zmanage");
$type = $_POST['type'];
$id = $_POST['id'];
$data['zManagePosition'] = $_POST['zManageBranch'];
$data['zManageBranch'] = $_POST['name'];

$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'zManageId');

$msg=$res;

echo json_encode($res);
