<?php //session_start();
//引入数据库模型
//require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
// // 获取ajax发送来的值

$msg = "success";

/*$userName = $_POST['userName'];
$password = $_POST['password'];

$data['pManageName'] = $userName;
$data['pManagePassword'] = $password;

$mysqlModel = new Model('Pmanage');
//$res返回的是一个二维数组
$res1 = $mysqlModel->selectByCondition($data,' limit 1');
$pManageId =  $res1[0]['pManageId'];




if (empty($res)){//用户不存在
	$msg = "error";
} 
else{//用户存在，判断单位是否存在及已通过审核
	
	
	 
	$getModel =  new Model('Pmanage','zmanage','bmanage');
	
	$res = $getModel->unionSelectAll_3('pManagePosition','zManageId','zManageBranch','bManageId',' pManageId = '.$pManageId);

	$_SESSION['userInfo'] = $res[0];
	
	 
	
	$msg = "success";

}*/


echo json_encode($msg);





