<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>高铁检修综合管理平台</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		
		<style>
			html,
			body {
				width: 100%;
				height: 100%;
				margin: 0px;
				padding: 0px;
				overflow: hidden;
				background-color: #efeff4;
			}
			#holder {
				width: 300px;
				height: 300px;
				border: solid 1px #bbb;
				border-radius: 5px;
				margin: 50px auto;
				background-color: #fff;
			}
			#alert {
				text-align: center;
				padding: 20px 10px;
			}
		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
		<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#007aff;"></a>
			<h1 class="mui-title">手势图案锁屏</h1>
		</header>
		<div class="mui-content">
			<div id='holder' class="mui-locker" data-locker-options='{"ringColor":"rgba(210,210,210,1)","fillColor":"#ffffff","pointColor":"rgba(0,136,204,1)","lineColor":"rgba(0,136,204,1)"}' data-locker-width='300' data-locker-height='300'></div>
			<div id='alert'></div>
		</div>

		<script src="/public/js/mui.min.js"></script>
		<script src="/public/js/mui.locker.js"></script>
		<script>
			(function($, doc) {
				$.init();
				var holder = doc.querySelector('#holder'),
					alert = doc.querySelector('#alert'),
					record = [];
				//处理事件
				holder.addEventListener('done', function(event) {
					var rs = event.detail;
					if (rs.points.length < 4) {
						alert.innerText = '设定的手势太简单了';
						record = [];
						rs.sender.clear();
						return;
					}
					console.log(rs.points.join(''));
					record.push(rs.points.join(''));
					if (record.length >= 2) {
						if (record[0] == record[1]) {
							alert.innerText = '手势设定完成';
						} else {
							alert.innerText = '两次手势设定不一致';
						}
						rs.sender.clear();
						record = [];
					} else {
						alert.innerText = '请确认手势设定';
						rs.sender.clear();
					}
				});
			}(mui, document));
		</script>
	</body>

</html>