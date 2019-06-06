<?php
  
  require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";


  
  $mysqlModel = new Model("gpsUpdateRecode");

  //工具包的读卡器编号集合
  $toobagsReaderCodes = $_POST['toobagsReaderCodes'];
  $toobagsReaderCodes = ltrim($toobagsReaderCodes, ",");
  $toobagsReaderCodes = rtrim($toobagsReaderCodes, ",");
  $readerCodeArr = explode(",", $toobagsReaderCodes);//数组形式
  //工具包的ID号集合
  $toobagsIds = $_POST['toobagsIds'];
  $toobagsIds = ltrim($toobagsIds, ",");
  $toobagsIds = rtrim($toobagsIds, ",");
  $toobagsIdArr = explode(",", $toobagsIds);//数组形式

  //更新每个工具包的更新时间，并逐个触发
  foreach($readerCodeArr as $key => $value){

    //记录最新的更新时间
    $readerCode = $value;//工具包的读卡器编号
    $data['gpsurOrderId'] = $_POST['twtltWorkOrderId'];//工单号
    $data['toobagReaderCode'] = $readerCode;//工具包的读卡器编号
    $data['toobagId'] = $toobagsIdArr[$key];//工具包的ID号
    $mysqlModel->add($data);

    /** 触发该工具包 **/
    $URL ='http://120.203.14.45:9004/send.jsp?bag_id='.$readerCode.'&command=1'; //定义访问jsp的url  GL4SAB1832000009
    //初始化curl 
    $ch = curl_init(); 
    //设置curl返回结果 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    //设置url 
    curl_setopt($ch, CURLOPT_URL, $URL); 
    //执行调用 
    $data_exec = curl_exec($ch) or die(curl_error($ch)); 
    //关闭连接 
    curl_close($ch); 
    //usleep(500);
  }
 
$msg = "success";
echo json_encode($msg);