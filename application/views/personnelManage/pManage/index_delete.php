<?php

 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("pmanage");
$id = $_POST['id'];
//使定位器可用
$information = $mysqlModel->select($id,"pManageId");
$mysqlModel_gpslibs = new Model("gpslibs");
$OldGPSId = $information['pManageGpsId'];
$gpslibs['GPSisUse'] = 0;
$mysqlModel_gpslibs->update($OldGPSId,$gpslibs,'GPSId');

$mysqlModel->delete($id,'pManageId');


$msg='success';

echo json_encode($msg);
