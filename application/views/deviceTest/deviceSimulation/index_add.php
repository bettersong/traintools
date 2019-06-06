<?php


require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysqlModel = new Model("tworkorder_dev");

$actType = $_POST['actType'];


//出库
if($actType=="dev_out"){
	$data_update['twdevStatus_out'] = 1;
	$bydata ="";;
	$res = $mysqlModel->updateByData($data_update,$bydata);//update($id, $data,'zManageId');
}
//入库
else if($actType=="dev_in"){
	$data_update['twdevStatus_in'] = 1;
	$bydata ="";
	$res = $mysqlModel->updateByData($data_update,$bydata);//update($id, $data,'zManageId');
}
//是否在工具包
else if($actType=="toolbag"){
	$data_update['twdevInToolbag'] = 1;
	$bydata['twdevNeedInToolbag'] = 1;
	$res = $mysqlModel->updateByData($data_update,$bydata);//update($id, $data,'zManageId');
}
//更新定位信息的人员ID
else if($actType=="updateLocal"){ //862643032882957:4-赵六  862643032877445:9-张江
    
	$mysqlModel2 = new Model("tm_dev_location");
	
	$data_update['localUserId'] = "4";
	$bydata['dev_imei'] = "862643032882957";
	$res = $mysqlModel2->updateByData($data_update,$bydata);//update($id, $data,'zManageId');
	
	$data_update['localUserId'] = "9";
	$bydata['dev_imei'] = "862643032877445";
	$res = $mysqlModel2->updateByData($data_update,$bydata);//update($id, $data,'zManageId');
	
}
//重置所有状态
else if($actType=="unsetAll"){
	$data_update['twdevStatus_out'] = 0;
	$data_update['twdevStatus_in'] = 0;
	$data_update['twdevInToolbag'] = 0;
	$data_update['twdevNeedInToolbag'] = 0;
	$bydata ="";
	$res = $mysqlModel->updateByData($data_update,$bydata);//update($id, $data,'zManageId');
}
 

/*$res = "";
if($type == "add") $res = $mysqlModel->add($data);
else if($type == "update") $res = $mysqlModel->update($id, $data,'zManageId');
*/
$msg="success";

echo json_encode($res);
