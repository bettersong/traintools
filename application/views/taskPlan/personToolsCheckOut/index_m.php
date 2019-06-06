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
		   .list{display: flex;justify-content: space-between;line-height: 35px;color:#666;font-size: 13px;clear:both;}
		   .list li{text-align: center;width:80px;}
		   .list li:nth-child(2){width:90px;}
		   .sub:nth-child(odd){background: #f5f7fa}
		   .submit{display: block;margin: 20px auto;width: 80%;margin-bottom:100px;}
		   .navbox{margin-top:20px;font-size:13px;}
		   .firstLi{float:left;background:#ddd;padding:5px;}
		   .secondLi{float:right;background:#009688;padding:5px;color:#fff;}
		   .secondLi img{vertical-align: middle;}
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
				<h1 class="mui-center mui-title">出作业门前清点人员和工器具</h1>
			</div>
			
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						<div class='toolsBag'>
						<ul class="navbox">
							<li class="firstLi">工具包数据</li>
							<li class="secondLi">刷新<img src='/public/images/ref.png'></li>
							
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>工具名称</li>
							<li>所在工具包</li>
							<li>实际数量</li>
							<li>班前数量</li>
							<li>相差</li>
							<li>是否符合</li>
						</ul>
						<div id='ulBox'>
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>扳手</li>
							<li>一号工具包</li>
							<li>6</li>
							<li>5</li>
							<li>+1</li>
							<li>+1</li>
						</ul>
						
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>老虎钳</li>
							<li>二号工具包</li>
							<li>6</li>
							<li>6</li>
							<li>-</li>
							<li>+1</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>龙鳞</li>
							<li>三号工具包</li>
							<li>6</li>
							<li>5</li>
							<li>+1</li>
							<li>+1</li>
						</ul>
						</div>
					</div>
					<div class='bigTools'>
						<ul class="navbox">
							<li class="firstLi">大工具数据</li>
							<li class="secondLi">刷新<img src='/public/images/ref.png'></li>
							
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>工具名称</li>
							<li>实际数量</li>
							<li>班前数量</li>
							<li>相差</li>
							<li>是否符合</li>
						</ul>
						<div id='ulBox'>
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>大工具A</li>
							<li>6</li>
							<li>5</li>
							<li>+1</li>
							<li>+1</li>
						</ul>
						
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>大工具B</li>
							<li>6</li>
							<li>6</li>
							<li>-</li>
							<li>+1</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>大工具C</li>
							<li>6</li>
							<li>5</li>
							<li>+1</li>
							<li>+1</li>
						</ul>
						</div>
					</div>
					<div class='person'>
						<ul class="navbox">
							<li class="firstLi">人员数据</li>
							<li class="secondLi">刷新<img src='/public/images/ref.png'></li>
							
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>职位</li>
							<li>实际数量</li>
							<li>班前数量</li>
							<li>相差</li>
							<li>是否符合</li>
						</ul>
						<div id='ulBox'>
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>负责人</li>
							<li>6</li>
							<li>5</li>
							<li>+1</li>
							<li>+1</li>
						</ul>
						
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>防护员</li>
							<li>6</li>
							<li>6</li>
							<li>-</li>
							<li>+1</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list sub">
							<li>施工人员</li>
							<li>6</li>
							<li>5</li>
							<li>+1</li>
							<li>+1</li>
						</ul>
						</div>
					</div>
						<button type="button" id="submit_confirm" class="mui-btn mui-btn-success submit">确认出作业们核对完毕
						</button>
						
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


		//确认清点完毕
		$("#submit_confirm").on('click',function(){
				var txt = '<span style="color:#f30">确认后不可再修改，请谨慎操作！';
				mui.confirm(txt, '确认准备完毕', btnArray, function(e) {
						if(e.index==1){
						//alert(twtltWorkOrderId);return false;
						$.ajax({
							url: '<?=CURRENT_DIR?>/index_orderConfirmed.php?',
							type: 'POST',
							dataType: 'json',
							data: {
								'type': 'check_doorOut',
								'twtltWorkOrderId':twtltWorkOrderId
							},
							success: function (msg){
								mui.toast("确认完成");
								//location.reload();
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