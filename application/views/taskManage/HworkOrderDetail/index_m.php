<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>高铁检修综合管理平台</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="/public/css/mui.min.css?1.0">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		   .setline{
		   	height:50px;
		   	line-height: 50px;
		   }
		   .list{line-height: 35px;color:#666;font-size: 13px;clear:both;width:80%;margin:0 auto;height:120px;}
		   .list li{text-align: center;width:80px;}
           .first{float: left;width:30%;}
           .first li{width:100%;background: #f5f7fa;border:1px solid #eee;border-radius: 10px 0 0 10px;}
           .li-2{height:74px !important; line-height: 74px}
           .li-3{height:111px !important; line-height: 111px}
           .sub{float:left;width:70%;}
		   .sub li{width:100%;border:1px solid #eee;border-radius: 0 10px 10px 0;}
		   .submit{display: block;margin: 20px auto;width: 80%;margin-bottom:100px;}
		   .navbox{margin-top:20px !important;font-size:13px;width:80%;margin:0 auto;}
		   .navbox li{border-radius:5px;color:#fff;}
		   .firstLi{float:left;background:#ddd;padding:5px;}
		   .secondLi{float:left;}
		   .secondLi img{vertical-align: middle;}
		   .img_banner{width:80%;margin:20px auto;text-align:center;background:#1989fa;padding:5px;color:#fff;}
		   .showImg img{width: 100%;height:300px;}
		</style>
	</head>

	<body class="mui-fullscreen">
		
		<div class="mui-page">
			<div class="mui-navbar-inner mui-bar mui-bar-nav">
				<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
					<span class="mui-icon mui-icon-left-nav"></span>
				</button>
				<h1 class="mui-center mui-title">计划执行详情</h1>
			</div>
			
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
					  <div class='tools'>
						<ul class="navbox">
							<li class="firstLi" style="background: #3f51b5">工具出入库情况</li>
							<li class="secondLi"><img src="/public/images/gongju.png"></li>	
						</ul>
						<div class="list">
						<ul class="mui-table-view-chevron first">
							<li>工单所需</li>
							<li>实际出库</li>
							<li>实际入库</li>
						</ul>
						<ul class="mui-table-view-chevron sub ">
							<li>33件</li>
							<li>32件</li>
							<li>32件</li>	
						</ul>
					    </div>
					  </div>
					  <div class='tools' style="margin-top:20px">
						<ul class="navbox">
							<li class="firstLi" style="background: #009688">作业门人脸识别情况</li>
							<li class="secondLi"><img src="/public/images/renlian.png"></li>	
						</ul>
						<div class="list">
						<ul class="mui-table-view-chevron first">
							<li>工单所需</li>
							<li>进作业门</li>
							<li>出作业门</li>
						</ul>
						<ul class="mui-table-view-chevron sub ">
							<li>14人</li>
							<li>14人</li>
							<li>14人</li>	
						</ul>
					    </div>
					  </div>
					  <div class='tools'>
						<ul class="navbox">
							<li class="firstLi" style="background: #ff4d00">作业门开锁情况</li>
							<li class="secondLi"><img src="/public/images/suo.png"></li>	
						</ul>
						<div class="list" style="height:200px !important;margin-bottom:100px;">
						<ul class="mui-table-view-chevron first">
							<li>作业时间</li>
							<li class="li-2">标准进出门</li>
							<li class="li-2">实际开锁情况</li>
						</ul>
						<ul class="mui-table-view-chevron sub ">
							<li>2019-1-12</li>
							<li>进》3号门</li>
							<li>出《5号门</li>
							<li>3号门：2019/01/12 03.00</li>
							<li>5号门：2019/01/12 05.00</li>	
						</ul>
					    </div>
					  </div>	
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="/public/js/jquery-1.8.3.min.js"></script>
	<script src="/public/js/mui.min.js"></script>
	<script>

		mui.init();
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();

		
</script>
</html>