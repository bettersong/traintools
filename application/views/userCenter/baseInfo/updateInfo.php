<?php  session_start(); //开启session
//手机访问，则跳转到手机页面
if($ism){
    //echo $_SERVER["SERVER_NAME"];
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
   #bar-chart{background-color:#37474f;width:800px;height:350px;font-family:Lato,Helvetica-Neue,monospace}.minBox{float:right}.minBox ul{list-style:none}.minBox ul li{width:25px;height:25px;margin-top:5px}.minBox ul li:nth-child(1){background:#be1e2d}.minBox ul li:nth-child(2){background:#00a79d}.minBox ul li span{margin-left:-75px;line-height:25px;color:#000}#userIofo tr td{border:1px solid #ddd;color:#333;padding:5px 10px}#userIofo tr td.td1{text-align:right;font-weight:600;border-right-color:#ddd}#userIofo tr td.td2{min-width:735px}tr.th td{text-align:center!important;font-weight:500!important}#userIofo tr.th td.td2{text-align:left!important}.updateInfoBtn{color:#59f;font-weight:600;border-bottom:1px solid #ddd;cursor:pointer}#userIofo tr td.td3{color:#aaa;text-align:center}#updateInputBox{padding:20px}.updateInputBtn{display:inline;border-bottom:0;margin:0 0 0 3px;background-color:#1e9fff;border:0;width:50px;height:26px;color:#fff;padding:3px 10px;text-align:center;border-radius:2px!important}
    </style>
</head>
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
         <div class="container-fluid">
            <div class="row-fluid">
               <div class="span12">
                   <h3 class="page-title" style="color:#000">
                     个人基本信息
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">首页</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                           个人基本信息
                       </li>
                       <li class="pull-right search-wrap">
                           <form action="search_result.html" class="hidden-phone">
                               <div class="input-append search-input-area">
                                   <input class="" id="appendedInputButton" type="text">
                                   <button class="btn" type="button"><img src="/public/images/search.png" width="40px" height="40px"></button>
                               </div>
                           </form>
                       </li>
                   </ul>
               </div>
            </div>
               <div class="row-fluid">
                 <table id="userIofo">
                 <tr class="th"><td class="td1">属性</td><td class="td2">名称</td><td>操作</td></tr>
                <tr><td class="td1">主管单位：</td><td class="td2"><?=$_SESSION['userInfo']['adminBumenName']?></td><td class="td3">-</td></tr>
                 <tr><td class="td1">部门/职位：</td><td class="td2"><?=$_SESSION['userInfo']['bumenTree']?></td><td class="td3">-</td></tr>
                 <tr><td class="td1">登陆账号：</td><td class="td2"><?=$_SESSION['userInfo']['pManageName']?></td><td class="td3">-</td></tr>
                 <tr><td class="td1">性&nbsp;&nbsp;别：</td><td class="td2" name="sex"><?=$_SESSION['userInfo']['pManageSex']==1?"男":"女"?>
                   </td><td><sapn class="updateInfoBtn updateSex">更改</span></td>
                 </tr>
                 <tr><td class="td1">联系方式：</td><td class="td2" name="contact"><?=$_SESSION['userInfo']['pManageContact']?> 
                   </td><td><sapn class="updateInfoBtn updateInput">更改</span></td>
                 </tr>
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
<script type="text/javascript">
var gpslibsArr = <?= json_encode($gpslibs)?>;
console.log(gpslibsArr);
//修改联系方式
$(".updateInput").click(function(e) {
	layer.open({
        type: 1,
        skin: 'layui-layer-rim', //加上边框
        area: ['420px', '150px'], //宽高
        content: '<div id="updateInputBox">修改手机号码：<input placeholder="请输入新的手机号" style="padding-left:6px;" /><button class="updateInfoBtn updateInputBtn submitPhone">提交</button></div>'
  });
  
  $(".submitPhone").click(function(event) {
    var url = "/application/views/userCenter/baseInfo/user_action.php?act=updatePhone";
    var newPhone = $("#updateInputBox").find("input").val();
    if (!newPhone) {
      layer.alert("联系方式不能为空！", {icon:0,title: '【提示】'});
      return false;
    }
    if (isNaN(newPhone)) {
      layer.alert("联系方式必须为数字！", {icon:0,title: '【提示】'});
      return false;
    }
    $("#userIofo tr").find('td[name="contact"]').html(newPhone);
    var id = "";
    id = '<?=$_SESSION['userInfo']["pManageId"]?>';
    $.ajax({
      async:false,
      type: "post",
      data: {
        "newPhone":newPhone,
        "id":id
      },
      dataType: 'json',
      url:url,
      success: function (msg) {
        $(".layui-layer-close").click();
        setTimeout('layer.alert("修改联系方式成功！", {icon:1,title: "【提示】"})',300);
      },
      error: function (msg) {
        layer.alert("服务繁忙，请刷新或稍后再试。", {icon:0,title: '【提示】'});
      }
    });
  });
});
//弹出修改性别框
var sexValue = '<?=$_SESSION["userInfo"]["pManageSex"]?>';
$(".updateSex").click(function(e) {
  layer.open({
    type: 1,
    skin: 'layui-layer-rim', //加上边框
    area: ['420px', '150px'], //宽高
    content: '<div id="updateInputBox">修改性别：<select style="margin: 0;"><option value="1" id="sex1">男</option><option  id="sex2" value="2">女</option></select><button class="updateInfoBtn updateInputBtn submitSex">提交</button></div>'
  });
  setCurrentSex(sexValue);
});
//设置当前性别
function setCurrentSex(sexValue){
  if(sexValue=="")sexValue=2;
  $("#sex2").removeAttr('selected');
  if(sexValue==2)$("#sex2").attr("selected","selected");
}
//提交设置的性别到后台
$(".submitSex").live('click',function(event) {
  var url = "/application/views/userCenter/baseInfo/user_action.php?act=updateSex";
  sexValue = $("#updateInputBox select option:selected").val();
  var newSex="";
  if (sexValue==1) {
    newSex="男";
  }
  else if (sexValue==2) {
    newSex="女";
  }
  $("#userIofo tr").find('td[name="sex"]').html(newSex);
  var id = "";
  id = '<?=$_SESSION['userInfo']["pManageId"]?>';
  $.ajax({
    async:false,
    type: "post",
    data: {
      "sexValue":sexValue,
      "id":id
    },
    dataType: 'json',
    url:url,
    success: function (msg) {
      $(".layui-layer-close").click();
      setTimeout('layer.alert("修改性别成功！", {icon:1,title: "【提示】"})',300);
    },
    error: function (msg) {
      layer.alert("服务繁忙，请刷新或稍后再试。", {icon:0,title: '【提示】'});
    }
  });
});
console.log("<?php echo $_SESSION['userInfo']["pManageSex"]?>");
var pmanageChartArr = "";//<,?=$pmanageChartArr==""?"":$pmanageChartArr?>;
console.log(pmanageChartArr);
            var chart;
            var toolsData = [
                {
                  "name": "定位设备",
                  "value":30,
  			          "color":"#74B749"
                },
				        {
                  "name": "人脸识别设备",
                  "value":12,
				          "color":"#FF6600"
                },
                {
                  "name": "RFID标签",
                  "value":123,
                  "color":"#ff9e01" 
                }
            ];
            AmCharts.ready(function () {
                chart = new AmCharts.AmPieChart();
                chart.addTitle("设备数量统计", 17);
                chart.dataProvider = toolsData;
                chart.titleField = "name";   
                chart.valueField = "value"; 
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.labelText = "[[title]][[value]]";
				        chart.colorField = "color";
                chart.innerRadius = "30%";
                chart.startDuration =2;  //饼图的渲染时间
                chart.labelRadius = 10;  //饼图上标签
                chart.balloonText = "[[title]][[value]]";
                chart.depth3D = 10;  //3D效果的立体度 
                chart.angle = 20;  //角度占的分额基数                          
                chart.write("toolsChuku");
            });
			
//图3
            var chart;
            var chartData = [
                {
                    "name": "路局",
                    "value": 0.01
                },
                {
                    "name": "工务段",
                    "value": 0.01
                },
                {
                    "name": "车间",
                    "value": 0.01
                },
                {
                    "name": "班组",
                    "value": 0.01
                }
                
            ];

            AmCharts.ready(function () {
                chart = new AmCharts.AmPieChart();
                chart.addTitle("各部门人员情况", 17);
                chart.dataProvider = pmanageChartArr;
                chart.titleField = "name";   
                chart.valueField = "value"; 
                chart.sequencedAnimation = true;
                chart.startEffect = "elastic";
                chart.innerRadius = "30%";
                chart.startDuration =2;  //饼图的渲染时间
                chart.labelRadius = 10;  //饼图上标签
                chart.balloonText = "[[title]][[value]]";
                //chart.depth3D = 10;  //3D效果的立体度 
                //chart.angle = 20;  //角度占的分额基数                            
                chart.write("chartdiv");
            });
//图2
var data = {
    labels: ["路局", "工务段", "车间", "班组"],
    datasets: [
        {
            label: "应到人数",
            fillColor: "#be1e2d",
            //strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            //highlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81]
        },
        {
            label: "实到人数",
            fillColor: "#00a79d",
            //strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            //highlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19]
        }
    ]
};
var options = {
  scaleFontColor: "#000"
};
var ctx = document.getElementById("bar-canvas").getContext("2d");
var myBarChart = new Chart(ctx).Bar(data, options);

</script>
</body>
<!-- END BODY -->
</html>
