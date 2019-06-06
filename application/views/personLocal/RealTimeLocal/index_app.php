<?php
	 require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
	 $date = date('Y-m-d');
	 $mysqlModel = new Model("tm_dev_location");
	 $PersonMaxId = $mysqlModel ->maxId($date);  //获取人员定位最近时间的ID
	 $localP = $mysqlModel ->LocalPerson($date,$PersonMaxId);
	 
	 echo json_encode($localP);