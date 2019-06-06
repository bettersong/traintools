<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$act = $_GET['act'];
$type = $_POST['type'];

$pushtime = date("Y/m/d");
//添加数据
if ($act == "add") {

  //判断是消息/通知
  if ($type =="info") {
    $videoSrc = "";
    $imgSrc = "";

    $mysqlModel = new Model("inform");
    $data['adminBumenId'] = $_SESSION['userInfo']['adminBumenId'];//登陆用户的主管单位
    $data['informTitle'] = $_POST['title'];
    $data['informType'] = $type;
    $data['informSourceFrom'] = $_POST['sourceFrom'];      
    $data['informContent'] = $_POST['content'];

    $data['informPublishTime'] = $pushtime;
    $data['informPublisher'] = 1;
    $data['isTop'] = 0;
    $data['videoSrc'] = $videoSrc;
    $data['thumbnail'] = $imgSrc;
    $data['informApplyPass'] = 1;
    $data['informAdmin'] = $_SESSION['userInfo']['adminBumenId'];
    $msg = "success";
    $res = $mysqlModel->add($data);
    if(!$res)$msg = "error";
    echo json_encode($msg);
  }
  else if ($type =="aqjs") {
    $videoSrc = "";
    $imgSrc = "";

    $mysqlModel = new Model("safety_disclosure");
    $data['safetyTitle'] = $_POST['title'];
    $data['safetyType'] = $type;
    $data['safetySourceFrom'] = $_POST['sourceFrom'];      
    $data['safetyContent'] = $_POST['content'];

    $data['safetyPublishTime'] = $pushtime;
    $data['safetyPublisher'] = 1;
    $data['isTop'] = 0;
    $data['videoSrc'] = $videoSrc;
    $data['thumbnail'] = $imgSrc;
    $data['safetyApplyPass'] = 1;
    $data['safetyAdmin'] = $_SESSION['userInfo']['adminBumenId'];

    $msg = "success";
    $res = $mysqlModel->add($data);
    if(!$res)$msg = "error";
    echo json_encode($msg);
  }
  
}
//修改数据
else if ($act == "update") {
  //判断是消息/通知
  if ($type =="info") {
    $videoSrc = "";
    $imgSrc = "";
    $id = $_POST['id'];

    $mysqlModel = new Model("inform");
    $data['informTitle'] = $_POST['title'];
    $data['informType'] = $type;
    $data['informSourceFrom'] = $_POST['sourceFrom'];      
    $data['informContent'] = $_POST['content'];

    $data['informPublishTime'] = $pushtime;
    $data['informPublisher'] = 1;
    $data['isTop'] = 0;
    $data['videoSrc'] = $videoSrc;
    $data['thumbnail'] = $imgSrc;
    $data['informApplyPass'] = 1;
    $data['informAdmin'] = $_SESSION['userInfo']['adminBumenId'];

    $res = $mysqlModel->update($id, $data,'informId');
    // $res=0表示未更新
    // $msg="success";
    // if(!$res)$msg = "error";
    echo json_encode($res);
  }
  else if ($type =="aqjs") {
    $videoSrc = "";
    $imgSrc = "";
    $id = $_POST['id'];
    $mysqlModel = new Model("safety_disclosure");
    $data['safetyTitle'] = $_POST['title'];
    $data['safetyType'] = $type;
    $data['safetySourceFrom'] = $_POST['sourceFrom'];      
    $data['safetyContent'] = $_POST['content'];

    $data['safetyPublishTime'] = $pushtime;
    $data['safetyPublisher'] = 1;
    $data['isTop'] = 0;
    $data['videoSrc'] = $videoSrc;
    $data['thumbnail'] = $imgSrc;
    $data['safetyApplyPass'] = 1;
    $data['safetyAdmin'] = $_SESSION['userInfo']['adminBumenId'];
    
    $res = $mysqlModel->update($id, $data,'safetyId');
    // $res=0表示未更新
    // $msg="success";
    // if(!$res)$msg = "error";
    echo json_encode($res);
  }
  
}
//删除数据
else if ($act == "delete") {
  //判断是消息/通知
  if ($type =="info") {
    $mysqlModel = new Model("inform");
    $id = $_POST['id'];
    $res = $mysqlModel->delete($id,'informId');
    $msg='success';

    echo json_encode($msg);

    
  }
  else if ($type =="aqjs") {
    $mysqlModel = new Model("safety_disclosure");
    $id = $_POST['id'];
    $res = $mysqlModel->delete($id,'safetyId');
    $msg='success';

    echo json_encode($msg);

  }
  
}

