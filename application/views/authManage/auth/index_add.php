<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$mysqlModel = new Model("roleAuth");

//$type = $_POST['type'];
//$id = $_POST['id'];

/*$data['roleAuth_id'] = $_POST['id'];
$data['roleAuth_pid'] = $_POST['pid'];
if($_POST['pid']==0)$data['roleAuth_level']=1;
else $data['roleAuth_level']=2;
$data['roleAuth_roleId'] = $_POST['roleId'];
$data['roleAuth_asCatalog'] = $_POST['asCatalog'];
$data['roleAuth_c'] = $_POST['controller'];
$data['roleAuth_a'] = $_POST['action'];
$data['roleAuth_forbid'] = preg_replace('# #','',$_POST['auths']);//清除所有空格
*/
$msg="error";

$res = "";


 


//如果存在则不能重复插入
$data1['roleAuth_roleId'] = $_POST['roleId'];
$data1['roleAuth_asCatalog'] = $_POST['asCatalog'];
$data1['roleAuth_c'] = $_POST['controller'];
$data1['roleAuth_a'] = $_POST['action'];




$res1 = $mysqlModel->selectByCondition($data1,' limit 1');

if (empty($res1)){//用户不存在，插入新的数据
    
	$data1['roleAuth_forbid'] = preg_replace('# #','',$_POST['auths']);//清除所有空格
    $data1['roleAuth_level']=$_POST['level'];//$level;
	
	$res = $mysqlModel->add($data1);
	$msg="success";
} 

else{//存在，则放弃插入

    $bydata['roleAuth_roleId'] = $_POST['roleId'];
	$bydata['roleAuth_asCatalog'] = $_POST['asCatalog'];
	$bydata['roleAuth_c'] = $_POST['controller'];
	$bydata['roleAuth_a'] = $_POST['action'];

	$data_update['roleAuth_forbid'] = preg_replace('# #','',$_POST['auths']);//清除所有空格
	
	$res = $mysqlModel->updateByData($data_update, $bydata);
	$msg="success";
}

 




echo json_encode($msg);
