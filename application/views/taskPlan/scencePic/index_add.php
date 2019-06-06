<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$imgArr = $_POST['imgArr'];
//print_r($imgArr);
$mysqlModel = new Model("picture_now");
$data['pictureResource'] = $_POST['imgArr'];
$data['pictureUserId'] = $_POST['personId'];
$data['picturePushTime'] = date('Y-m-d H:i:s');
$data['pictureTwOrderId'] = $_POST['twOrderId'];
$data['adminBumenId'] = $_SESSION['userInfo']['adminBumenId'];
$mysqlModel->add($data);
$twOrderId = $_POST['twOrderId'];
//$myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
$sql_condition = "left join pmanage on pictureUserId = pManageId where pictureTwOrderId = $twOrderId";
$msg = $mysqlModel->selectAll($sql_condition);

unset($_SESSION['toolsCheck_scencePic']);//重置缓存

echo json_encode($msg);