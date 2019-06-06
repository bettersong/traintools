<?php
 require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_summary");

$id = $_POST['orderId'];
$data['twsmSummaryTxt'] = $_POST['summaryCon'];

$mysqlModel->update($id, $data,"twsmIdWorkOrderId");//add($data);
 
echo json_encode("success");