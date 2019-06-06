<?php  session_start(); //开启session
//手机访问，则跳转到手机页面
if($ism){
    header("Location: http://".$_SERVER["SERVER_NAME"].":8081/taskManage/TworkOrder/index_m");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>高铁检修综合管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <link href="/public/css/bootstrap.min<?=$_m?>.css?v=0.101" rel="stylesheet" />
    <link href="/public/css/bootstrap-responsive.min<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/style<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/style-default<?=$_m?>.css" rel="stylesheet" id="style_color" />
    <link rel="stylesheet" href="/public/css/jquery-pie-loader.css">
    <link rel="stylesheet" href="/public/css/uniform.default<?=$_m?>.css" />
    <style>
   #bar-chart{background-color:#37474f;width:800px;height:350px;font-family:Lato,Helvetica-Neue,monospace}.minBox{float:right}.minBox ul{list-style:none}.minBox ul li{width:25px;height:25px;margin-top:5px}.minBox ul li:nth-child(1){background:#be1e2d}.minBox ul li:nth-child(2){background:#00a79d}.minBox ul li span{margin-left:-75px;line-height:25px;color:#000}#userIofo tr td{border:1px solid #ddd;color:#333;padding:5px 10px}#userIofo tr td.td1{width:48px;height: 40px; border-right-color:#ddd}#userIofo tr td.td2{min-width:735px}tr.th td{text-align:center!important;font-weight:500!important}#userIofo tr.th .updateInfoBtn{color:#59f;font-weight:600;border-bottom:1px solid #ddd;cursor:pointer}#userIofo tr td.td3{color:#aaa;text-align:center}#updateInputBox{padding:20px}.updateInputBtn{display:inline;border-bottom:0;margin:0 0 0 3px;background-color:#1e9fff;border:0;width:50px;height:26px;color:#fff;padding:3px 10px;text-align:center;border-radius:2px!important}
    </style>
</head>
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
      <div class="container-fluid">
            <div class="row-fluid">
               <div class="span12" style=" text-align: center;">
                   <h3 class="page-title" style="color:#000">
                     查看建议
                   </h3>
               </div>
            </div>
          <div class="row-fluid">
                 <table id="userIofo" style="text-align: center;">
                  <tr class="th" style="font-weight: bold !important;">
                    <td class="td1">序号</td>
                    <td class="td2">意见内容</td>
                    <td>建议人</td>
                    <td>联系方式</td>
                    <td>上传时间</td>
                  </tr>
                  <?php foreach ($Allmessage as $key => $value) { ?>
                  <tr>
                    <td><?=$key+1?></td>
                    <td><?=$value['messageContent']?></td>
                    <td><?=$value['pManageName']?></td>
                    <td><?=$value['messageContact']?></td>
                    <td><?=$value['messagePushTime']?></td>
                  </tr>
                  <?php } ?>
               </table>
         </div>
      </div>
 </div>
<script src="/public/js/jquery.form.js"></script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/amcharts.js"></script>
<script src="/public/js/pie.js"></script>
<script src='/public/js/Chart.min.js'></script>
</body>
<!-- END BODY -->
</html>
