<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax_testDev.class.php";



$action = $_POST['action'];


$msg="error";
$res = "";
if($action == "testToolbag"){//工具包
    
	/*【表】
        工单-工具列表-tworkorder_toollists：工具名称 工具包ID
        工具包表-tm_tool_bag：RFID集合
        工具详情表-detail: 工具类别ID
        工具类别表-toolslist：工具类别名称  工具大小


        */
		
    $mysqlModel = new Model();//"tworkorder_toollists,toolslist"
	$mysqlModel ->testToolbag();
	/*$addtype = $_POST['addtype'];
	$name = $_POST['name'];
	$pid = $_POST['pid'];
	
	
	$data['bumenOrZhiwei'] = $_POST['addtype'];
	$data['bManageName'] = $_POST['name'];
	$data['bManageParentId'] = $_POST['pid'];
	$data['level'] = $_POST['level'];

	$res = $mysqlModel->add($data);
	if($res!=0)$msg=$res;*/
	
	
	$msg = $action; 
}
else if($action == "update"){
	 
	
}
 




echo json_encode($msg);
