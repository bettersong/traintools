<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>安全揭示</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		   .setline{
		   	 
		   }
		   .mui-top{
		   	padding: 20px 12px 10px;
		   	background: #fff;
		   	font-size: 20px;
		   	color: #666;
			text-align: center;
		   }
		   .list i{
		   	margin-right: -25px;
		   	font-size: 13px;
		   	color: #888;
		   }
		</style>
	</head>

	<body class="mui-fullscreen">

		<div class="mui-content mui-scroll-wrapper"><!--下拉刷新容器,包含整个body内容-->
		<div id="setting" class="mui-page">
			<div class="mui-navbar-inner mui-bar mui-bar-nav">
				<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
					<span class="mui-icon mui-icon-left-nav"></span>
				</button>
				<h1 class="mui-center mui-title">安全揭示</h1>
			</div>
			
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						
						<div class="mui-top">
								<img style="vertical-align: text-top;" src='/public/images/safetylogo.png' width="26px" >
								<span>安全揭示内容</span>
						</div>
                        <div style="padding:5px 10px 5px 10px;color:#555; border:1px solid #eee;text-indent: 2em;">
                        <?=$safetyInform[0]['twSafecon']?>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="/public/js/mui.min.js "></script>
</html>