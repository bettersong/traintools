<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("pmanage");

$input_oldPwd = $_POST['input_oldPwd'];
$input_newPwd = $_POST['input_newPwd'];

//判断就密码是否正确
$data['pManageId'] = $_SESSION['userInfo']['pManageId']; 
$data['pManagePassword'] = $input_oldPwd; 
$res = $mysqlModel->selectByCondition($data);//,$customCondition='
     //echo  $res ;exit;
if(!$res){
	
	echo json_encode("oldPwdError");
}
else{

$id = $_SESSION['userInfo']['pManageId'];
$data['pManagePassword'] = $input_newPwd;  
$msg = $mysqlModel->update($id, $data,'pManageId');//update($id, $data,$idName='')

echo json_encode("success");

}