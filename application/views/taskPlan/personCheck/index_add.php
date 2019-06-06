<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$type = $_POST['type'];//操作类型
$obj_type = $_POST['obj_type'];//被操作对象的类型：核心人员or施工人员
 
$twamId = $_POST['twamId'];//操作ID

if($obj_type == "builders"){//施工人员
    $mysqlModel1 = new Model("tworkorder_workers");
}
else $mysqlModel1 = new Model("tworkorder_adminstrators");//核心人员

$msg = "";
if ($type == "changName") {
    if($obj_type == "builders"){//施工人员 
        $data['twkePersonId'] = $_POST['pManageId'];
        $mysqlModel1->update($twamId, $data,'twkeId');
        
        $pmanageId = $_POST['pManageId'];
        $sql = "select * from pmanage_builders left join gpslibs on pManageGpsId = GPSId where pmanageId = $pmanageId";
        $msg = $mysqlModel1->query($sql);
    }
    else{//核心人员
         $data['twamPersonId'] = $_POST['pManageId'];
        $data['twamName'] = $_POST['pManageName'];
        $mysqlModel1->update($twamId, $data,'twamId');
        
        $pmanageId = $_POST['pManageId'];
        $sql = "select * from pmanage left join gpslibs on pManageGpsId = GPSId where pmanageId = $pmanageId";
        $msg = $mysqlModel1->query($sql);
    }
}
else if ($type == "changGps") {
    
    if($obj_type == "builders"){//施工人员
        $table_persorn = "pmanage_builders";
        $data = $mysqlModel1->select($twamId,"twkeId");
        $personId = $data['twkePersonId'];
    }
    else {//核心人员
        $table_persorn = "pmanage";//
        $data = $mysqlModel1->select($twamId,"twamId");
        $personId = $data['twamPersonId'];
    }
    
    $mysqlModel = new Model($table_persorn);

    $GPSId = $_POST['GPSId'];
 
    

    //获取人员信息
    $pmanageInformation = $mysqlModel->select($personId,"pManageId");
    //修改之前使用的定位器信息（设为未被使用）
    $mysqlModel_GPS = new Model("gpslibs");
    $GPS_Old = $pmanageInformation['pManageGpsId'];
    $GPSInfor['GPSisUse'] = 0;
    $msg = $mysqlModel_GPS->update($GPS_Old,$GPSInfor,"GPSId");

    //更新人员的定位器信息
    $sql = "UPDATE $table_persorn set pManageGpsId = '$GPSId' WHERE pManageId = $personId ";
    $msg = $mysqlModel->query($sql);
    //修改新使用的定位器信息（设为已被使用）
    $GPSInfor['GPSisUse'] = 1;
    $mysqlModel_GPS->update($GPSId,$GPSInfor,"GPSId");
    

    
    
    
}
echo json_encode($msg);