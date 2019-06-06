<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysqlModel = new Model("pmanage");
$type = $_POST['type'];
$id = $_POST['id'];
$information = $mysqlModel->select($id,"pManageId");
$data['pManageName'] = $_POST['name'];
$data['pManageSex'] = $_POST['sex'];
$data['pManageBranch'] = $_POST['department'];
$data['pManageRoleIds'] = rtrim($_POST['roleIds'],",");
$data['pManageStaffId'] = $_POST['code'];
$data['pManageContact'] = $_POST['contact'];

$mysqlModel_gpslibs = new Model("gpslibs");
$OldGPSId = $information['pManageGpsId'];
$gpslibs['GPSisUse'] = 0;
$mysqlModel_gpslibs->update($OldGPSId,$gpslibs,'GPSId');

$GPSId = $_POST['gps'];
$gpslibs['GPSisUse'] = 1;
$mysqlModel_gpslibs->update($GPSId,$gpslibs,'GPSId');
$data['pManageGpsId'] = $_POST['gps'];

$data['adminBumenId'] =$_POST['adminBumenId'];;
$res = "";
if($type == "add"){
	$res = $mysqlModel->add($data);
}
else if($type == "update"){
	$res = $mysqlModel->update($id, $data,'pManageId');
}
$msg=$res;

echo json_encode($res);
