<!doctype html>
<html lang="en" class="feedback">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>高铁检修综合管理平台</title>
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" type="text/css" href="/public/css/feedback.css" />
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		.mui-table-view-cell img{
			width: 90px;
			height: 90px;
			border-radius: 50%;
		}
	    </style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">人员准备</h1>
		</header>
		<div class="mui-content" >
			<ul class="mui-table-view mui-grid-view mui-grid-9">
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/1.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/2.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/3.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/4.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/5.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/6.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/7.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img src="/public/images/scenephoto/8.jpg"></li>
		            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
			        <div id='image-list' class="row image-list"></div></li>
		    </ul> 
			<button value="" id="btn" class="btn2">确认准备完毕</button>
			
			
		</div>
		<script src="/public/js/mui.min.js"></script>
		<script src=" /public/js/feedback.js"></script>
		<script type="text/javascript">
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
		</script>
	</body>

</html>