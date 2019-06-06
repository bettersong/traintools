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
		   .setline{height:50px;line-height:50px;}
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
				<h1 class="mui-center mui-title">设置</h1>
			</div>
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell mui-media">
									<div class="mui-media-body">
										<?=$_SESSION['userInfo']['pManageName']?>
										<p class='mui-ellipsis'>职位:<?=$_SESSION['userInfo']['bManageName']?></p>
									</div>
							</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell setline">
								<a href="" class="mui-navigate-right">通用</a>
							</li>
							<li class="mui-table-view-cell setline">
								<a href="/my/locker/index_m" class="mui-navigate-right">手势密码</a>
							</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron">
							<li class="mui-table-view-cell setline">
								<a href="" class="mui-navigate-right">关于高铁APP<i class="mui-pull-right update">V1.0.0</i></a>
							</li>
						</ul>	
					</div>
				</div>
			</div>	
		</div>	
	</body>
	<script src="/public/js/jquery-1.8.3.min.js"></script>
	<script src="/public/js/mui.min.js "></script>
	<script>
        $('.tab4').addClass("active1");
		mui.init();
		var userInfo = <?= json_encode($_SESSION['userInfo'])?>;
		console.log(userInfo);
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();
		
		var dui={
    /**
	 * 手机信息 
	 
	 */
	getMachineInfo:function(){
			var json = {};
			json.name = plus.os.name;
			json.version = plus.os.version;
			json.language = plus.os.language;
			json.vendor = plus.os.vendor;
			var types = {};
			types[plus.networkinfo.CONNECTION_UNKNOW] = "未知";
			types[plus.networkinfo.CONNECTION_NONE] = "未连接网络";
			types[plus.networkinfo.CONNECTION_ETHERNET] = "有线网络";
			types[plus.networkinfo.CONNECTION_WIFI] = "WiFi网络";
			types[plus.networkinfo.CONNECTION_CELL2G] = "2G蜂窝网络";
			types[plus.networkinfo.CONNECTION_CELL3G] = "3G蜂窝网络";
			types[plus.networkinfo.CONNECTION_CELL4G] = "4G蜂窝网络";
			json.network = types[plus.networkinfo.getCurrentType()];	
			//callback(json);
			
			
	}
}
//console.log(json);
console.log(dui);
console.log(Object.keys(dui));
switch ( plus.os.name ) { 
    case "iOS":
        if ( plus.device.model.indexOf("iPhone") >= 0 ) { 
            plus.device.beep();
        } else {
            mui.alert('此设备不支持蜂鸣');
        }
    break;
    default:
        plus.device.beep();
    break;
}

	</script>

</html>