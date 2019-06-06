<?php
  
$type = $_POST['type'];
$mysqlModel1 = new Model("tworkorder_adminstrators");
$twamId = $_POST['twamId'];
$data = $mysqlModel1->select($twamId,"twamId");

if ($type == "changName") {
    $data['twamPersonId'] = $_POST['pManageId'];
    $data['twamName'] = $_POST['pManageName'];
    $mysqlModel1->update($twamId, $data,'twamId');
}
if ($type == "changGps") {
    $mysqlModel = new Model("pmanage");
    $GPSId = $_POST['GPSId'];
    $personId = $data['twamPersonId'];
    $mysqlModel->update_pmanage($personId,$GPSId);
}
$msg = "success";
echo json_encode($msg);