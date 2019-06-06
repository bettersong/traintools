<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$bumenid = $_POST['bumenid'];
$bumenorzhiwei = $_POST['bumenorzhiwei'];


 
if($bumenorzhiwei==1){
	$mysqlModel = new Model("bmanage2");

	$data['bManageParentId'] = $bumenid;
	
	$res = $mysqlModel->selectByCondition($data);

}
else {
	$mysqlModel = new Model("pmanage");

	$data['pManageBranch'] = $bumenid;

	$res = $mysqlModel->selectByCondition($data);
}
 
$msg = "no";

if($res) $msg = "yes";



echo json_encode($msg);
