<?php
session_start();
 require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("pmanage_builders");
$personId = $_POST['personId'];
$conditions = "left join gpslibs on pManageGpsId = GPSId";
$information = $mysqlModel->select($personId,'pManageId',$conditions);

$twOrderId = $_POST['twOrderId'];
$data['twkePersonId'] = $personId;
$data['twkeDate'] = date('Y-m-d');
$data['twkeAdmin'] = $_SESSION['userInfo']['adminBumenId'];
$data['twkeWorkOrderId'] = $twOrderId;
$mysqlModel_workers = new Model("tworkorder_workers");
$twtid = $mysqlModel_workers->add($data);
$information['tid'] = $twtid;
echo json_encode($information);