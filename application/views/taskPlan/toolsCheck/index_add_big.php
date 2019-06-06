<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_toollists");

$type = $_POST['type'];
//添加大工具
if ($type=="add") {
    $toolId = $_POST['bigtoolsId'];
    $twtltWorkOrderId = $_POST['twtltWorkOrderId'];
    $sql = "where twtltWorkOrderId = $twtltWorkOrderId and twtlToolId = $toolId";
    $twtlInfomation = $mysqlModel->selectAll($sql);
    //echo $twtlInfomation;
    //return false;
    $num = count($twtlInfomation);
    
    if ($num==0) {
        $mysqlModel_tool = new Model("toolslist");
        $tmpSelect = $mysqlModel_tool->select_tool_big($toolId);
        $data['twtlToolId'] = $tmpSelect['toListId'];
        $data['twtlName'] = $tmpSelect['toListName'];
        $data['twtlAmount'] = 0;
        $data['twtlPreparedAmount'] = 1;
        $data['twtlMaster'] = $tmpSelect['waMessageMaster'];
        $data['twtlDate'] = date("Y-m-d");
        $data['twtlBumenId'] = $_SESSION['userInfo']['adminBumenId'];
        $data['twtltWorkOrderId'] = $twtltWorkOrderId;
        $msg = $mysqlModel->add($data);
    }
    else
    {
        //工单中已经有的具体大工具数组
        $tools_big_DetailId = explode(",",$twtlInfomation[0]['twtlDetail']);
        $amount_now = count($tools_big_DetailId);

        //计算仓库中工具数量
        $mysqlModel_Detail_big = new Model("detail");
        $myAdminBumensubArrString = join(',', $_SESSION['myAdminBumen_subArr']);
        $sql = "where deToolListId = $toolId and DetailAdmin in ($myAdminBumensubArrString)";
        $Detail_big_amount = count($mysqlModel_Detail_big->selectAll($sql));

        if ($amount_now < $Detail_big_amount) {
            $twtlId = $twtlInfomation[0]['twtlId'];
            $data['twtlId'] = $twtlId;
            $data['twtlDetail'] = $twtlInfomation[0]['twtlDetail'].",";
            $data['twtlPreparedAmount'] = $twtlInfomation[0]['twtlPreparedAmount']+1;//大工具的班前准备数量
            $msg = $mysqlModel->update($twtlId,$data,"twtlId");
        }

        else
            $msg = "error";
        
    }
}
//修改工具编号
else if($type=="update")
{
    $twtlId =$_POST['twtlId'];
    $bigid =$_POST['bigid'];
    $data['twtlDetail'] = $bigid;
    $msg = $mysqlModel->update($twtlId,$data,'twtlId');
    //获取工具对应的默认的定位器
    $res2 = $mysqlModel->query("select GPSCode from detail left join gpslibs on toListGPSId=GPSId where DetailId='$bigid' ");
    $GPSCode = $res2[0]['GPSCode'];

    $msg = $GPSCode;

}
//修改定位器
else if ($type="GPS") {
    $twtlId=$_POST['twtlId'];
    $toollistInformation = $mysqlModel->select($twtlId,"twtlId");
    $DetailStrs = $toollistInformation['twtlDetail'];
    $DetailArr = explode(",", $DetailStrs);
    $DetailId = $DetailArr[$_POST['IDbig']];
    $mysqlModel_Detail = new Model("detail");
    $DetailInformation = $mysqlModel_Detail->select($DetailId,"DetailId");

    $GPSId = $DetailInformation['toListGPSId'];
    $mysqlModel_gpslibs = new Model("gpslibs");
    $gpslibs['GPSisUse'] = 0;
    $mysqlModel_gpslibs->update($GPSId,$gpslibs,"GPSId");
    $newGpsId = $_POST['bigGps'];
    $gpslibs['GPSisUse'] = 1;
    $mysqlModel_gpslibs->update($newGpsId,$gpslibs,"GPSId");

    $data['toListGPSId'] = $_POST['bigGps'];
    $msg = $mysqlModel_Detail->update($DetailId,$data,"DetailId");
}

unset($_SESSION['toolsCheck_toolsArr_big']);//重置toolsCheck中相应的缓存



echo json_encode($msg);