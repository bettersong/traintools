<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder_toollists");

$type = $_POST['type'];
$toolId = $_POST['smalltoolsId'];


if (isset($_POST['tid'])) {
	$twtlId = $_POST['tid'];
}

$id = "";

$msg = "success";
if($type == "add"){//添加小工具
    $data['twtlPreparedAmount'] = $_POST['smalltoolsNum'];
    $twtltWorkOrderId = $_POST['twtltWorkOrderId'];
    $information = $mysqlModel->select_dev_small($toolId);

    $data['twtlToolId'] = $_POST['smalltoolsId'];
    $data['twtlName'] = $information[0]['toListName'];

    $data['twtlAmount'] = 0;
    $data['twtlMaster'] = $information[0]['waMessageMaster'];
    $data['twtlDate'] = date("Y-m-d");
    $data['twtlBumenId'] = $_SESSION['userInfo']['adminBumenId'];
    $data['twtltWorkOrderId'] = $_POST['twtltWorkOrderId'];
    $data['twtltToolBagId'] = $_POST['smalltoolsbag'];

    $id = $mysqlModel->add($data);

    $msg = $mysqlModel->select_tool($twtltWorkOrderId,$id);
    foreach ($msg as $key => $value) {
            $toolId = $value['twtlToolId'];
            $tmp = $mysqlModel ->toolList_warehouse1($toolId);
            $msg[$key]['waMessageName'] = '';
            foreach ($tmp as $tmp_key => $tmp_value) {
                if (strpos($msg[$key]['waMessageName'],$tmp_value['waMessageName']) ===false) {
                    $msg[$key]['waMessageName'] .= ",".$tmp_value['waMessageName'];//获取工具仓库
                    $msg[$key]['waMessageName'] = ltrim($msg[$key]['waMessageName'], ","); //去除最前端逗号
                }
            }
        }

}
else if($type == "updateToolBag") {
    $data['twtltToolBagId'] = $_POST['smalltoolsbag'];
    $id = $mysqlModel->update($twtlId, $data,'twtlId');
}
else if($type == "updateNums") {//更新小工具的班前准备数量
    $data['twtlPreparedAmount'] = $_POST['smalltoolsNum'];
    $id = $mysqlModel->update($twtlId, $data,'twtlId');

}

unset($_SESSION['toolsCheck_toolsArr']);//重置toolsCheck中相应的缓存

echo json_encode($msg);