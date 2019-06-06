<?php

require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
/*读取excel文件，并进行相应处理*/

$fileName = "test.xls";

// if (!file_exists($fileName)) {

// exit("文件".$fileName."不存在");

// }

$startTime = time(); //返回当前时间的Unix 时间戳

require_once 'Classes/PHPExcel/IOFactory.php';

$objPHPExcel = PHPExcel_IOFactory::load($fileName);

//获取sheet表格数目

$sheetCount = $objPHPExcel->getSheetCount();

//默认选中sheet0表

$sheetSelected = 0;$objPHPExcel->setActiveSheetIndex($sheetSelected);

//获取表格行数

//$rowCount = $objPHPExcel->getActiveSheet()->getHighestRow();
$rowCount = 48;

//获取表格列数

$columnCount = $objPHPExcel->getActiveSheet()->getHighestColumn();

echo "<div>Sheet Count : ".$sheetCount." 行数： ".$rowCount." 列数：".$columnCount."</div>";

$dataArr = array();

/* 循环读取每个单元格的数据 */

//行数循环

for ($row = 1; $row <= $rowCount; $row++){

//列数循环 , 列数是以A列开始

	for ($column = 'A'; $column != $columnCount; $column++) {

	$dataArr[]   = $objPHPExcel->getActiveSheet()->getCell($column.$row)->getValue();
	if($objPHPExcel->getActiveSheet()->getCell($column.$row)->getValue() != ''){
		echo $column.$row.":".$objPHPExcel->getActiveSheet()->getCell($column.$row)->getValue()."<br />";
	}
	}

	$data[$row] = $dataArr;

	$dataArr = NULL;
}
var_dump($data);
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


$mysqlModel = new Model("tworkorder");
$data['twOrderLocation'] = $data[3][2];
$data['twOrderLeader'] = $data[3][2];
$data['twOrderTime'] = $data[3][1];
$data['twOrderExTime'] = $data[3][1];
$res = $mysqlModel->add($data);