<?php  session_start(); //开启session
//手机访问，则跳转到手机页面
if($ism){
    //echo $_SERVER["SERVER_NAME"];
    header("Location: http://".$_SERVER["SERVER_NAME"].":8081/taskManage/TworkOrder/index_m");
    exit;
}


 //print_r($_SESSION['userInfo']);

//$_SESSION['bumenArr']

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
    <link href="/public/css/style<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color" />
    <link rel="stylesheet" href="/public/css/jquery-pie-loader.css">
    <link rel="stylesheet" href="/public/css/uniform.default<?=$_m?>.css" />
    <style>
   #bar-chart{
    background-color: rgb(55, 71, 79);
    width: 800px;
    height: 350px;
    font-family: Lato, Helvetica-Neue, monospace;
    }
    .minBox{
        float:right;
    }
    .minBox ul{
        list-style:none;
    }
    .minBox ul li{
        width:25px;
        height:25px;
        margin-top:5px;
    }
    .minBox ul li:nth-child(1) {
        background:#be1e2d;
    }
    .minBox ul li:nth-child(2) {
        background:#00a79d;
    }
    .minBox ul li span{
        margin-left: -75px;
    line-height: 25px;
    color: #000;
    }


    </style>
</head>
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
               <div class="span12">
                   <h3 class="page-title" style="color:#000">
                     工作面板
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">首页</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                           工作面板
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
                
                
                <div class="span5" title="今日出勤情况" style="margin-left:65px">
                    <!-- BEGIN CHART PORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4>柱状图</h4>
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                            <h4 style="color:#000;font-weight:bold">今日出勤情况</h4>
                            <div class="minBox">
                            <ul>
                            <li><span >应到人数&nbsp;</span></li>
                            <li><span >实到人数&nbsp;</span></li>
                            </ul>
                            </div>
                            <canvas id="bar-canvas" width="450" height="150" style="clear: both;display:bolck;" ></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span5" title="设备数量统计" style="margin-left:55px">
                    <!-- BEGIN CHART PORTLET-->
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4>设备数量</h4>
                            
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                           
                            <div id="toolsChuku" style="width:440px; height:285px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END CHART PORTLET-->
                </div>
                
                </div>
                
                 
                <div class="row-fluid">
                <div class="span5" title="各部门人员情况" style="margin-left:65px">
                    <!-- BEGIN CHART PORTLET-->
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4>人员数量</h4>
                            
                        </div>
                        <div class="widget-body">
                            <div class="text-center">
                            <div id="chartdiv" style="width:440px; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END CHART PORTLET-->
                </div>
                
                
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
//图1

var pmanageChartArr = <?=$pmanageChartArr?>;
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
