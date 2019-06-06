<?php
session_start();
 
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$act = $_GET['act'];
//修改定位器
if ($act == 'updategps') {
  $mysqlModel = new Model("pmanage");
  $id = $_POST['id'];
  $data['pManageGps'] = $_POST['gps'];
  $_SESSION['userInfo']["pManageGps"] = $_POST['gps'];
  $res = $mysqlModel->update($id, $data,'pManageId');
  $msg='success';
  echo json_encode($msg);
}
//修改手机号码
if ($act == 'updatePhone') {
  $mysqlModel = new Model("pmanage");
  $id = $_POST['id'];
  $data['pManageContact'] = $_POST['newPhone'];
  $_SESSION['userInfo']["pManageContact"] = $_POST['newPhone'];
  $res = $mysqlModel->update($id, $data,'pManageId');
  $msg='success';
  echo json_encode($msg);
}
//修改性别
else if ($act == 'updateSex') {
  $mysqlModel = new Model("pmanage");
  $id = $_POST['id'];
  $data['pManageSex'] = $_POST['sexValue'];
  $_SESSION['userInfo']["pManageSex"] = $_POST['sexValue'];
  $res = $mysqlModel->update($id, $data,'pManageId');
  $msg='success';
  echo json_encode($msg);
}
//修改密码
else if ($act == 'updatePwd') {
  $newPassword = $_POST['newPassword'];
  $oldPassword = $_POST['oldPassword'];
  $id = $_POST['id'];

  $data_check['pManageId'] = $id;
  $data_check['pManagePassword'] = $oldPassword;
  $msg = "success";
  $mysqlModel = new Model("pmanage");

  //判断原始密码是否正确
  $res = $mysqlModel->selectByCondition($data_check,' limit 1');
  if (empty($res)){//输入的原始密码不正确
    $msg = "nomatch";
  }
  else{//可以更新
    $data_update['pManageId'] = $id;
    $data_update['pManagePassword'] = $newPassword;
    $res2 = $mysqlModel->update($id,$data_update,"pManageId");
    
 
  }
  echo json_encode($msg);

}