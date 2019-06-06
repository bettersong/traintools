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
		   .setline img{vertical-align: middle;margin-right:6px;width:16px;height:16px;}
		   .setline span{vertical-align: middle;}
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
				<h1 class="mui-center mui-title">作业现场管理</h1>
			</div>
			
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						
						<ul class="mui-table-view mui-table-view-chevron">
						    <li class="mui-table-view-cell setline">
								<a href="/taskPlan/scencePic/index_m&twOrderId=<?=$_GET['twOrderId']?>" class="mui-navigate-right"><img src='/public/images/xiangji3.png'><span>现场照片</span></a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/personLocal/RealTimeLocal/index_m&localname=0&twOrderId=<?=$_GET['twOrderId']?>" class="mui-navigate-right"><img src='/public/images/zonghe3.png'><span>综合定位</span></a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/personLocal/RealTimeLocal/index_m&localname=1&twOrderId=<?=$_GET['twOrderId']?>" class="mui-navigate-right"><img src='/public/images/person5.png'><span>人员定位</span></a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/personLocal/RealTimeLocal/index_m&localname=2&twOrderId=<?=$_GET['twOrderId']?>" class="mui-navigate-right"><img src='/public/images/bigtools3.png'><span>大工具定位</span></a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/personLocal/RealTimeLocal/index_m&localname=3&twOrderId=<?=$_GET['twOrderId']?>" class="mui-navigate-right"><img src='/public/images/toolbag.png'><span>工具包定位</span></a>
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