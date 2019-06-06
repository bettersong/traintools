<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysql_Model = new Model("tworkorder");
$date = $_POST['date'];
$sql = " where JiHuaDate = '$date'";
$orderInformation = $mysql_Model->selectAll($sql);

echo json_encode($orderInformation);
