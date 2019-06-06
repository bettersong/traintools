<?php

include_once "./PHPExcel.php";
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("test.xls",$encode='utf-8');
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();//取得总行数
        $highestColumn = $sheet->getHighestColumn();//取得总列数
        $data = array();
        for($i=2;$i<=$highestRow;$i++){
            for($j='A';$j<=$highestColumn;$j++){
                $data[$i][] = $objPHPExcel->getActiveSheet()->getCell("$j$i")->getValue();
            }
        }
        return $data;