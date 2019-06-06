<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <script src="/public/js/mui.min.js"></script>
    <link rel="stylesheet" href="/public/css/mui.min.css?<?=rand(1,99999)?>">
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <style>
	 #testDev {width:160px; margin-left:-80px; position:absolute;top:30px;left:50%;}
     #testDev li{
		background-color: #eee;
		background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0,#fcfcfc),color-stop(100%,#eee));
		background-image: -webkit-linear-gradient(top,#fcfcfc 0,#eee 100%);
		background-image: -moz-linear-gradient(top,#fcfcfc 0,#eee 100%);
		background-image: -ms-linear-gradient(top,#fcfcfc 0,#eee 100%);
		background-image: -o-linear-gradient(top,#fcfcfc 0,#eee 100%);
		background-image: linear-gradient(to bottom,#fcfcfc 0,#eee 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fcfcfc', endColorstr='#eeeeee', GradientType=0);
		background-repeat: no-repeat;
		border: 1px solid #d5d5d5;
		cursor:pointer;
		font-size:1.1em;
		font-weight:600;
		margin: 12px 0;
		padding: 5px 2px 5px 5px;
	 }
    </style>
</head>
<body class="android" style=" background:#fff;overflow:auto">
<div style="position:relative;">
<ul id="testDev" style="width:160px; margin-left:-80px; position:absolute;top:30px;left:50%;">
	<li id="dev_out" title="手持扫描设备" style="color:#03F;">仓库-工具出库</li>
    <li id="dev_in" title="手持扫描设备" style="color:#03F;">仓库-工具入库</li>
    <li id="toolbag" title="工具包每个5秒检测一次" style="color:#ff9b00;">工具包-存入工具</li>
    <li id="unsetAll" title="手持扫描设备" style="color:#888;">作业开始-重置数据</li>
   <!-- <li title="定位设备" style="color:#8a6de9;">人员定位实时情况</li>
    <li title="定位设备" style="color:#8a6de9;">人员定位实时情况</li>-->
</ul>
</div>
<script>
    // 
$("#dev_out,#dev_in,#toolbag ,#unsetAll").click(function(){
     
	var actType = $(this).attr("id");
    
    $.ajax({
        async:false,
        type: "post",
        data: {
            "actType":actType,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
			     //alert(" msg:"+msg);
                 alert('成功！');

              },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
            console.log(name);
        }
    });
});

function updateLocal(){
	
	
 $.ajax({
	  async:false,
	  type: "post",
	  data: {
		  "actType":"updateLocal",
	  },
	  dataType: 'json',
	  url: "<?=CURRENT_DIR?>/index_add.php?",
	  success: function (msg) {
			  // alert(" msg:"+msg);


			},
	  error: function (msg) {
		  alert(msg.status + "服务繁忙，请刷新或稍后再试。");
		  console.log(name);
	  }
  });
	
	
}
self.setInterval("updateLocal()",1000);
</script>