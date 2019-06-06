<?php  session_start();


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("cecontrol");
$type = $_POST['type'];
$id = $_POST['id'];
$data['ceLockId'] = $_POST['code'];
$data['ceName'] = $_POST['door'];
$data['ceGPS_x'] = $_POST['ceGPS_x'];
$data['ceGPS_y'] = $_POST['ceGPS_y'];
$data['ceControlMaster'] = $_POST['master'];
$data['ceControlPosition'] = $_POST['position'];
$data['ceControlNote'] = $_POST['note'];
$data['ceAdminBumenId'] = $_SESSION['userInfo']['adminBumenId']; //主管单位
$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'ceControlId');
$msg=$id;

echo json_encode($msg);
