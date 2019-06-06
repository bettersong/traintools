<?php session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder");

//$workOrderId = $_SESSION['workOrderId'];//工单号
 
$twtltWorkOrderId = $_POST['twtltWorkOrderId'];
$workOrderId = $twtltWorkOrderId;

$update_fieldName = "";//更新的字段

if($_POST['type']=='confirmed_tools') $update_fieldName = 'twOrderConfirmed_tools';//确认工具准备
else if($_POST['type']=='confirmed_persons') $update_fieldName = 'twOrderConfirmed_persons';//确认人员准备
else if($_POST['type']=='confirmed_summary') $update_fieldName = 'twOrderConfirmed_summary';//确认工作总结
else if($_POST['type']=='check_doorIn' || $_POST['type']=='check_doorOut'){                //确认进出作业门清点的总结数据
   
    //作业门清点的工作总结表
    $mysqlModel_summary = new Model("tworkorder_summary");

    //先判断总结表中是否有对应工单号的总结数据
    $sql = "select * from tworkorder_summary where twsmIdWorkOrderId = $workOrderId limit 1";
    $res = $mysqlModel_summary->query($sql);
    $data = array();
    
    if(!$res) //总结表中没有，则先插入【班前准备数据】
    {
        $data['twsmIdWorkOrderId'] = $workOrderId;
        $data['twsmPreparedAmount_smallTools']    = $_SESSION['smallTool_preparedAmount'];
        $data['twsmPreparedAmount_bigTools']      = $_SESSION['bigTool_preparedAmount'];
        $data['twsmPreparedAmount_adminstrators'] = $_SESSION['persons_preparedAmount'];
        $data['twsmPreparedAmount_workers']       = $_SESSION['builders_preparedAmount'];
        $mysqlModel_summary->add($data);//插入数据
    }

    
    if($_POST['type']=='check_doorIn'){ //【进门】清点数据
        $update_fieldName = 'twOrderCheck_doorIn';
        
        $data['twsmIntoSafeDoorAmount_smallTools']    = $_SESSION['smallTool_realAmount'];
        $data['twsmIntoSafeDoorAmount_bigTools']      = $_SESSION['bigTool_realAmount'];
        $data['twsmIntoSafeDoorAmount_adminstrators'] = $_SESSION['persons_realAmount'];
        $data['twsmIntoSafeDoorAmount_workers']       = $_SESSION['builders_realAmount'];
    }
    
    else if($_POST['type']=='check_doorOut'){ //【出门】清点数据
        $update_fieldName = 'twOrderCheck_doorOut';
        
        $data['twsmExitSafeDoorAmount_smallTools']    = $_SESSION['smallTool_realAmount'];
        $data['twsmExitSafeDoorAmount_bigTools']      = $_SESSION['bigTool_realAmount'];
        $data['twsmExitSafeDoorAmount_adminstrators'] = $_SESSION['persons_realAmount'];
        $data['twsmExitSafeDoorAmount_workers']       = $_SESSION['builders_realAmount'];
    }

    //同时更新总结表的总结数据
    $mysqlModel_summary->update($workOrderId, $data,'twsmIdWorkOrderId');//更新数据

}
 

 
//标记清点/核对完成完成
$data_checkTag[$update_fieldName] = 1;
$mysqlModel->update($twtltWorkOrderId, $data_checkTag,'twOrderId');
 


echo json_encode("success");