<?php
session_start();
$typeArr = array("jpg", "png", "gif","ico");
//允许上传文件格式
$path = "../../../../public/upload/senceImg/";
//上传路径
//print_r($path);
//if (!file_exists($path)) {
//	mkdir($path);
//}
$pManageId = $_SESSION['userInfo']['pManageId'];
if (isset($_POST)) {
	$name = $_FILES['file']['name'];
	$size = $_FILES['file']['size'];
	$name_tmp = $_FILES['file']['tmp_name'];
	if (empty($name)) {
		echo json_encode(array("error" => "您还未选择图片"));
		exit ;
	}
	$type = strtolower(substr(strrchr($name, '.'), 1));
	//获取文件类型

	if (!in_array($type, $typeArr)) {
		echo json_encode(array("error" => "请上传jpg,png或gif类型的图片！"));
		exit;
	}
	if ($size > (1024 * 1024)) {
		echo json_encode(array("error" => "图片大小已超过1MB！"));
		exit ;
	}

	$pic_name = $pManageId . rand(10000, 99999) . "." . $type;
	//图片名称
	$pic_url = $path . $pic_name;
	//上传后图片路径+名称
	if (move_uploaded_file($name_tmp, $pic_url)) {//临时文件转移到目标文件夹
		echo json_encode(array("error" => "0", "pic" => $pic_url, "name" => $pic_name));
	} else {
		echo json_encode(array("error" => "上传有误！"));
	}
}
?>