<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>班前准备</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<script src="/public/js/mui.min.js "></script>
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		   .setline{
		   	height:50px;
		   	line-height: 50px;
		   }
		   span.prepared{color:#094;}
    	   span.unPrepared{color:#FF6347;}
		</style>
	</head>

	<body class="mui-fullscreen">
		<div class="mui-content mui-scroll-wrapper"><!--下拉刷新容器,包含整个body内容-->
		<div id="setting" class="mui-page">
			<div class="mui-navbar-inner mui-bar mui-bar-nav">
				<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
					<span class="mui-icon mui-icon-left-nav"></span>
				</button>
				<h1 class="mui-center mui-title">班前准备</h1>
			</div>
			
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell setline">
								<a id="preMeeting" onClick="javascript:mui.alert('功能未接入','提示');" href="#" class="mui-navigate-right">班前会议</a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/taskPlan/toolsCheck/index_m&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>" class="mui-navigate-right">
								工器具准备（<?php 
                        if( $orderInfoArr['twOrderConfirmed_tools']==1 ) echo '<span class="prepared">已准备</span>';
                        else echo '<span class="unPrepared">未准备</span>';?>）
						       </a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/taskPlan/personCheck/index_m&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>" class="mui-navigate-right">
								人员准备（<?php 
                        if( $orderInfoArr['twOrderConfirmed_persons']==1 ) echo '<span class="prepared">已准备</span>';
                        else echo '<span class="unPrepared">未准备</span>';?>）
						        </a>
							</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell setline">
								<a href="/personLocal/RealTimeLocal/index_m&localname=0&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>" class="mui-navigate-right">地图定位</a>
							</li>
						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</body>
 
</html>