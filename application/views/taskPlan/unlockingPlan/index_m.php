<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>高铁检修综合管理平台</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script src="/public/js/jquery-1.8.3.min.js"></script>
        <script src="/public/js/mui.min.js"></script>
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		   .setline{height:50px;line-height:50px}.list{display:flex}.list li{color:#444;padding:10px 0;width:30%;text-align:center}li.num{width:80px}ul.th li{color:#111;}.firstLi{height:50px;padding-top:22px;margin-left:}.top{margin:10px 0 0 2px;color:#fff;padding:5px;background:#3385ff}
		</style>
	</head>
	<body class="mui-fullscreen">
		<div class="mui-page">
			<header class="mui-bar mui-bar-nav">
			    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			    <h1 class="mui-title">今日开锁计划（<?php echo Date('Y-m-d')?>）</h1>
			</header>
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						<ul class="mui-table-view mui-table-view-chevron ">
							<li class='firstLi'><span class='top'>今日开锁计划</span></li>	
						</ul>
						<ul class="th mui-table-view mui-table-view-chevron list">
							<li class="num">工单编号</li>
							<li>天窗单元名称</li>
							<li>施工时间</li>
						</ul>
						<?php foreach ($TworkOrderALL as $key => $value) {
							  
							  $url = "";
							  if ($_SESSION['userInfo']['canEdit']==1){//编辑者（作业负责人等）
								$url = "taskPlanDetail/index_m&twOrderId=".$value['twOrderId'];
							  }
							  else{//非编辑者（查看者）
								$url = "/taskPlan/taskSummary/index_m&twOrderId=".$value['twOrderId']."&orderType=history";
							  }
						?>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li class="num" style=""><?=$value['twOrderId']?></li>
							<li style=""><?=$value['TianChuangDYMC']?></li>
							<li style="min-width: 135px;"><?=$value['QiQiSJ']?></li>
							<a href="#" class="toAction mui-navigate-right"><i class="mui-pull-right update"></i></a>
						</ul>
					<?php } if(count($TworkOrderALL)==0)echo '<div style="color:#333;text-align:center;margin:10px 0 0;">暂无工单</div>';?>
					</div>
				</div>
			</div>
		</div>
		<script>
		$(".toAction").click(function(e) {
            mui.alert("抱歉，软硬件数据待对接...");
			return false;
        });
		</script>
	</body>
</html>