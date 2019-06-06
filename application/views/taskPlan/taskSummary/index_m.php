<!DOCTYPE html>
<html>
	<head>
<meta charset="utf-8">
<title>作业总结</title>
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="stylesheet" href="/public/css/mui.min.css">
<link rel="stylesheet" href="/public/css/ui.css?1.1">
<style>
   /**工具和人员**/
	.setline{
		height:50px;
		line-height: 50px;
		}
		.list{display: flex;justify-content: space-between;margin-left: 5px;line-height: 35px;color:#666;font-size: 13px;clear:both;}
		.list.th{background:#eee;}
		.list li{text-align: center;width:80px;}
		.list li:nth-child(2){width:90px;}
		li.lastLi{width:16px;margin:0 15px 0 5px;}
		.sub:nth-child(odd){background: #f5f7fa}
		.submit{display: block;margin: 20px auto;width: 80%;margin-bottom:100px;}
		.navbox{margin-top:10px;font-size: ;}
		.title{display:inline-block;background:#1296db;color:#fff;text-align:center;margin-left: 5px;padding:4px 5px;font-size:1em;}
		.secondLi{float:right;background:#009688;padding:5px;color:#fff;}
		.secondLi img{vertical-align: middle; height:15px;}
		.amountDiffer{color:#3a7ae2;}
		.workerOrder{border:1px solid #ccc;margin-left: 5px;}
		.workerOrder tr td{padding:2px 2px 2px 5px;border:1px solid #ddd;color:#222;}
		.workerOrder tr td.td1{text-align:center;width:80px;}
		.workerOrder span{color:#666;font-size:0.9em;}
   /**统计信息**/
   .showImg{width:100%;height:100%;background: rgba(0,0,0,0.5);}
   .showImg img{width: 100%;height:300px;}

   .imgShow{background: #fff !important}
   .imgShow li{padding: 0px !important;
    margin: 0px !important;
    background: #fff !important;
    width: 30%;
    margin: 0 0 5px 2% !important;
     }
     .twork{font-size: 16px;color:#000;}
     .twork li{border: 1px solid #ccc}
     .twork span{font-size:14px;color:#888;border-left:1px solid #ccc;height: 100%;}
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
<div id="setting" class="mui-page">
	<!-- <div class="mui-navbar-inner mui-bar mui-bar-nav">
		<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
			<span class="mui-icon mui-icon-left-nav"></span>
		</button>
		<h1 class="mui-center mui-title">作业总结</h1>
	</div> -->
	<div class="mui-page-content" >
		<div class="mui-content mui-scroll-wrapper"><!--下拉刷新容器,包含整个body内容-->
			<div class="mui-scroll" style="margin-top:45px">
		<div>
			

		</div>
		<div class="navbox">
			<span class="title">工单概况</span>
			<!-- <ul class="mui-table-view mui-table-view-chevron twork">
				<li id='workPlace'>施工地点：<span></span></li>
				<li id='workTime'>天窗时间：<span></span></li>
				<li id='mainPerson'>核心人员：<span></span></li>
				<li id='workPerson'>施工人员：<span></span></li>
			</ul> -->
			<table border="1" class="workerOrder" width="100%">
					<tr id='workPlace'>
						<td class="td1">施工地点</td>
						<td ><span></span></td>
					</tr>
					<tr id='workTime'>
						<td class="td1">天窗时间</td>
						<td><span></span></td>
					</tr>
					<tr id='mainPerson'>
						<td class="td1">核心人员</td>
						<td><span></span></td>
					</tr>
					<tr id='workPerson'>
						<td class="td1">施工人员</td>
						<td><span></span></td>
					</tr>
			</table>
		</div>		
			<div class='box toolsBag'>
						<ul class="navbox">
							<li class="title">小工具详情</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list th">
							<li>名称</li>
							<li>工单要求数量</li>
							<li>班前数量</li>
							<li>进出安全门</li>
							<li class="openDetail lastLi">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
						</ul>
						<div class='ulBox' style="display: none">
						  <?php 
						  
						  foreach($smallTools as $key => $val){?>
							<ul class="detailToolItem mui-table-view mui-table-view-chevron list sub">
							<li><?=$val['twtlName']?></li>
							<li><?=$val['twtlAmount']?></li>
							<li><?=$val['twtlPreparedAmount']?></li>
							<li><?=$val['twtlExitSafeDoorAmount']?></li>
							<li class="lastLi"></li>
							</ul>
							<?php } ?>
						</div>
					</div>
					<div class='box bigTools'>
						<ul class="navbox">
							<li class="title">大工具详情</li>
							<!-- <li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li> -->
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list th">
							<li>名称</li>
							<li>工单要求数量</li>
							<li>班前数量</li>
							<li>进出安全门</li>
							<li class="openDetail lastLi">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
						</ul>
						<div class='ulBox' style="display: none">
						 <?php 
						   foreach($bigTools as $key => $value){?>
							<ul class="detailToolItem mui-table-view mui-table-view-chevron list sub">
								<li><?=$value['twtlName']?></li>
								<li><?=$value['twtlAmount']?></li>
								<li><?=$value['twtlPreparedAmount']?></li>
								<li><?=$value['twtlExitSafeDoorAmount']?></li>
								<li></li>	
							</ul>
						<?php } ?>
						 </div>				
						 
					</div>
					<div class='box corePerson'>
						<ul class="navbox">
							<li class="title">核心人员详情</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list th">
							<li>名称</li>
							<li>是否进安全门</li>
							<li>是否出安全门</li>
							<li class="openDetail lastLi">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
						</ul> 
						<div class='ulBox' style="display: none">
							<?php 
						   foreach($admin as $key => $value){?>
 							<ul class="mui-table-view mui-table-view-chevron list sub">
							<li><?=$value['twamName']?></li>
							<li><?php if($value['twamIntoSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li><?php if($value['twamExitSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li></li>
							</ul>
						   <?php } ?>
												  
						 </div>
						</div>
						<div class='box workPerson'>
						<ul class="navbox">
							<li class="title">施工人员详情</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list th">
							<li>名称</li>
							<li>是否进安全门</li>
							<li>是否出安全门</li>
							<li class="openDetail lastLi">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
						</ul> 
						<div class='ulBox' style="display:none">
 							<?php 
						   foreach($worker as $key => $value){?>
 							<ul class="mui-table-view mui-table-view-chevron list sub">
							<li><?=$value['pManageName']?></li>
							<li><?php if($value['twamIntoSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li><?php if($value['twamExitSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li></li>
							</ul>
						   <?php } ?>			  
						 </div>
						</div>	  
	    <div class="navbox summary_titleBox" style="clear:both;"><div class="title">现场照片(<?=count($photos)?>张)</div></div>
	    <div class="mui-content" style='background: #fff;margin-bottom: 5px'>
        <ul style="border:0; margin-top:5px;" class="mui-table-view mui-grid-view mui-grid-9 imgShow" id="ul_pics">
		</ul>
	    
</div>
<button type="button" id="submit_confirm" class="<?=$_GET['orderType']?> mui-btn mui-btn-success submit">确认总结完毕</button>
					
</div>
</div>
</div>
<div class="mui-scrollbar mui-scrollbar-vertical showImg" style="transition-duration: 500ms; opacity: 0;"><div class="mui-scrollbar-indicator" style="transition-duration: 0ms; display: block; height: 271px; transform: translate3d(0px, 394px, 0px) translateZ(0px); transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);"></div>
</div>

</div>

<div class="<?php if( $orderInfoArr['twOrderConfirmed_summary']==1) echo 'confirmedTools';?>" title="已确认完毕">&nbsp;</div>

<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script>
var photos = <?=json_encode($photos)?>;
var admin = <?=json_encode($admin)?>;
var OrderInfo = <?=json_encode($OrderInfo)?>;
console.log(OrderInfo);
$('#workPlace').find('span').html(OrderInfo[0]['TianChuangDYMC']);
$('#workTime').find('span').html(OrderInfo[0]['QiQiSJ']);
var worker = <?=json_encode($worker)?>;
var adminPerson= '';
$.each(admin,function(index,row){
	if(row['twamName']!='') adminPerson += row['twamName']+',';
});
var workPerson= '';
$.each(worker,function(index,row){
	workPerson += row['pManageName']+',';
});
var adminLast = adminPerson.lastIndexOf(',');
adminPerson = adminPerson.slice(0,adminLast);
var workerLast = workPerson.lastIndexOf(',');
workPerson = workPerson.slice(0,workerLast);
$('#mainPerson').find('span').html(adminPerson);
$('#workPerson').find('span').html(workPerson);
var path = '/public/upload/senceImg/';
mui.init();
var btnArray = ['取消', '确认'];
//初始化单页的区域滚动
mui('.mui-scroll-wrapper').scroll();
//mui.previewImage();
//图片显示
var imgList = '';
$.each(photos,function(index,row){
		imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">'+'<img alt="现场照片" class="mainImg" src="'+ path+row['pictureResource']+'">'+'</li>';
	});
console.log(imgList);
$('.imgShow').html(imgList);
//展开收缩
$('.openDetail').on('click',function(){
	var ulBoxObj=$(this).parents('.box').find('.ulBox');
	ulBoxObj.toggle();
	if(ulBoxObj.is(':visible')){
    $(this).find("img").attr("src","/public/images/zhankai1.png");
	}else{
		$(this).find("img").attr("src","/public/images/zhankai2.png");
	}
})

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
					setTimeout('location.reload()',1000);
				},
				error: function(msg){
						mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
				}
			})
		} 
	});
});//end确认
//如已确认完毕则弹出框提示
$(".confirmedTools").click(function(e) {
		mui.toast("已确认，无法操作"); 
		return false;	
});
</script>
</html>