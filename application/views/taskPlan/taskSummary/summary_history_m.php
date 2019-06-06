<!DOCTYPE html>
<html>
	<head>
<meta charset="utf-8">
<title>高铁检修综合管理平台</title>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="stylesheet" href="/public/css/mui.min.css">
<link rel="stylesheet" href="/public/css/ui.css?1.1">
<style>
    
   .showImg{width:100%;height:100%;background: rgba(0,0,0,0.5);}
   .showImg img{width: 100%;height:300px;}

   .imgShow{background: #fff !important}
   .imgShow li{padding: 0px !important;
    margin: 0px !important;
    background: #fff !important;
    width: 30%;
    margin: 0 0 5px 2% !important;
     }
   .imgShow li img{width:100%;height:100px;border-radius: 5px;}

   .table_summary{width: 96%;
    margin: 0 auto;
    text-align: center;font-size:1em;}
   .table_summary tr{}
	.table_summary tr th,.table_summary tr td{border: 1px solid #ddd;padding:2px 0;}
   .table_summary tr th{color: #555;font-weight:400;}
   .table_summary tr td{color:#555;font-size: 0.9em;}
	.table_summary tr .td1{color:#222;font-weight:600;}
	.img_banner{
		width: 96%;
    margin: 20px auto 0;
    border-bottom: 1px solid #ddd;
	}
   .summary_title{
	   display: inline-block;
	   background:#1296db;
	   color:#fff;
	   padding: 2px 5px;
	   margin:15px 0 0 2%; 
	  
	   }
	.summary_titleBox{border-bottom:1px solid #ddd;}
	.table_summary tr td.preparedAmount{color:;}
	.table_summary tr td.notAgree{color:#de380f;}
	.submit {
    display: block;
    margin: 20px auto;
    width: 80%;
    margin-bottom: 120px;
}
</style>
</head>

<body class="mui-fullscreen">
<div id="app" class="mui-views">
	<div class="mui-view">
		<div class="mui-navbar">
		</div>
		<div class="mui-pages">
		</div>
	</div>
</div>
<div id="setting" class="mui-page">
	<div class="mui-navbar-inner mui-bar mui-bar-nav">
		<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
			<span class="mui-icon mui-icon-left-nav"></span>
		</button>
		<h1 class="mui-center mui-title">作业总结</h1>
	</div>
	
	<div class="mui-page-content" >
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll" style="margin-top:45px">
		   
           <div class="summary_title" style="border:0;" >数量统计</div>
            <table class="table_summary" id="table_summary">
				<tr>
					<th>名称</th>
					<th>班前</th>
					<th>进作业</th>
					<th>出作业</th>
 				</tr>
				 <tr>
					<td class="td1">小工具</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_smallTools']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_smallTools']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_smallTools']?></td>
 				</tr>
				 <tr>
					<td class="td1">大工具</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_bigTools']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_bigTools']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_bigTools']?></td>
 				</tr>
				 <tr>
					<td class="td1">核心人员</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_adminstrators']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_adminstrators']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_adminstrators']?></td>
 				</tr>
				 <tr>
					<td class="td1">施工人员</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_workers']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_workers']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_workers']?></td>
 				</tr>
				 <!--<tr>
					<td class="td1">作业门开锁</td>
					<td><?=$summaryArr['twsmPreparedAmount_workers']?></td>
					<td><?=$summaryArr['twsmIntoSafeDoorAmount_workers']?></td>
					<td><?=$summaryArr['twsmExitSafeDoorAmount_workers']?></td>
 				</tr>
				 <tr>
					<td class="td1">作业门人脸识别</td>
					<td><?=$summaryArr['twsmPreparedAmount_workers']?></td>
					<td><?=$summaryArr['twsmIntoSafeDoorAmount_workers']?></td>
					<td><?=$summaryArr['twsmExitSafeDoorAmount_workers']?></td>
 				</tr>
				 -->
		    </table>

			  
	    <div class="summary_titleBox"><div class="summary_title">现场照片(<?=count($pictureArr)?>张)</div></div>
	    <div class="mui-content" style='background: #fff;margin-bottom: 5px'>
        <ul style="border:0; margin-top:5px;" class="mui-table-view mui-grid-view mui-grid-9 imgShow" id="ul_pics">
		</ul>
	    <div id="summary_txtBox"  style="overflow: hidden;">
			<div style="padding-left: 2%;" class="summary_txt">总结语</div>
 			<textarea disabled style="font-size:1em;border:1px solid #ddd;margin-bottom: 2px;" rows="3" cols="20" placeholder="工具损坏记录等..."><?=$summaryArr['twsmSummaryTxt']?></textarea>
  		</div>
        <!-- <div class='showImg'></div> -->
</div>
 					
</div>
</div>
</div>
<div class="mui-scrollbar mui-scrollbar-vertical showImg" style="transition-duration: 500ms; opacity: 0;"><div class="mui-scrollbar-indicator" style="transition-duration: 0ms; display: block; height: 271px; transform: translate3d(0px, 394px, 0px) translateZ(0px); transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);"></div>
</div>

</div>
</body>
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script>
var pictureArrJson =<?=json_encode($pictureArr)?>;
var path = '/public/upload/senceImg/';
mui.init();
var btnArray = ['取消', '确认'];
//初始化单页的区域滚动
mui('.mui-scroll-wrapper').scroll();
//mui.previewImage();
$("#table_summary tr").each(function(index, element) {
    if($(this).children(".intoSafeDoorAmount").html() != $(this).children(".preparedAmount").html()){
		$(this).children(".intoSafeDoorAmount").addClass("notAgree");
	}
	if($(this).children(".exitSafeDoorAmount").html() != $(this).children(".preparedAmount").html()){
		$(this).children(".exitSafeDoorAmount").addClass("notAgree");
	}
	
});
//提交总结语
$("#summary_txtBtn").click(function(e) {
    var txt =$.trim( $(this).prev("textarea").val() );
	if(txt==""){
		mui.alert("内容不能为空");
		return false;
	}
	$.ajax({
		url: '<?=CURRENT_DIR?>/index_add.php',
		type: 'POST',
		dataType: 'json',
		data: {
			'orderId': <?=$_GET['twOrderId']?>,
			'summaryCon': txt
		},
	})
	.done(function(msg) {
		mui.toast("提交成功");
	})
	.fail(function() {
		console.log("error");
	})
});
//显示现场图片
var imgList = '';
$.each(pictureArrJson,function(index,row){
	imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">'+'<img src="'+ path+row['pictureResource']+'">'+'</li>';
});//<img src='" + '/public/upload/senceImg/'+data.pic+ "'/>
$('.imgShow').html(imgList);
var popImg = false;
$('.imgShow').on('click','li',function(){
	$('.showImg').css({opacity:1});
	$('.showImg').html($(this).html());
	popImg = true;
	return false;
});
$('body,.showImg').on('click',function(e) {
	if(popImg){
		$('.showImg').css({opacity:0});
		$('.showImg').html('');
		popImg = false;
	}
});
// $('.showImg').on('click',function(){
// 	$(this).slideDown();
// 	console.log(11)
// })


//确认准备完毕
$("#submit_confirm").on('click',function(){
	var txt = '<span style="color:#f30">确认后不可再修改，请谨慎操作！';
	var twtltWorkOrderId = <?=$_GET['twOrderId']?>;
	mui.confirm(txt, '确认准备完毕', btnArray, function(e) {
			if(e.index==1){
			//alert(twtltWorkOrderId);return false;
			$.ajax({
				url: '<?=CURRENT_DIR?>/../toolsCheck/index_orderConfirmed.php',
				type: 'POST',
				dataType: 'json',
				data: {
					'type': 'confirmed_summary',
					'twtltWorkOrderId':twtltWorkOrderId
				},
				success: function (msg){
					mui.toast("确认完成");
				},
				error: function(msg){
						mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
					}
			})
		} 
	});
});//end确认
</script>
</html>