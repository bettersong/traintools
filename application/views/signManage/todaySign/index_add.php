<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$data1['twamDate'] = $_POST['oDate'];
$data2['twkeDate'] = $data1['twamDate'];
$mysqlModel1 = new Model("tworkorder_adminstrators");
$mysqlModel2 = new Model("tworkorder_workers");
$mysqlModel = new Model("Pmanage","zmanage","bmanage"); 
$personnerArr = $mysqlModel ->unionSelectAll('pManagePosition','zManageId','zManageBranch','bManageId');

 

//查询获取今天的工单
$adminstrators = $mysqlModel1 ->selectByCondition($data1);
$workers = $mysqlModel2 ->selectByCondition($data2);
$person = array_merge($adminstrators,$workers);
 foreach ($person as $key => $value) {
 	foreach ($personnerArr as $K => $V) {
 		if(isset($value['twamPersonId'])){
 			if ($value['twamPersonId']==$V['pManageId']) {
 			$person[$key]=array_merge($value,$V);
 			break;
 			}
 		}
 		else
 			if ($value['twkePersonId']==$V['pManageId']) {
 				$person[$key]=array_merge($value,$V);
 				break;
 			}
	}
}


echo json_encode($person);