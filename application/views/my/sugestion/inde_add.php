<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
date_default_timezone_set("Asia/Shanghai");//设置时区

$mysqlModel = new Model("message");

$data['messageContent'] = $_POST['message'];
$data['messagePersonId'] = $_POST['userId'];
$data['messageContact'] = $_POST['telNumber'];
$data['messagePushTime'] = date('Y-m-d H:i:s');
$data['adminBumenId'] = $_SESSION['userInfo']['adminBumenId'];
$mysqlModel->add($data);

echo json_encode($_POST);