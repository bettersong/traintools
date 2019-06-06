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
		   .setline{
		   	height:50px;
		   	line-height: 50px;
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
				<h1 class="mui-center mui-title">作业门开锁</h1>
			</div>
			
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						
						<ul class="mui-table-view mui-table-view-chevron">
							
							<li class="mui-table-view-cell setline">
								<a href="/taskPlan/inDoorUnlock/index_m" class="mui-navigate-right">进门开锁</a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/taskPlan/outDoorUnlock/index_m" class="mui-navigate-right">出门开锁</a>
							</li>
						</ul>
						
						
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="/public/js/mui.min.js "></script>
	
	<script>

		mui.init();
		
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();
		
</script>
</html>