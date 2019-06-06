<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>高铁检修综合管理平台</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<script src="/public/js/jquery-1.8.3.min.js"></script>
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
		   .submit{display: block;margin: 20px auto;width: 80%;margin-bottom:120px;}
		   .navbox{margin-top:20px;font-size:13px;}
		   .firstLi{float:left;background:#ddd;padding:5px;}
		   .secondLi{float:right;background:#009688;padding:5px;color:#fff;}
		   .firstLi,.secondLi{font-size:1.1em;}
		   .secondLi img{vertical-align: middle; height:15px;}
		   .amountDiffer{color:#3a7ae2;}
		   .subList ul.sub{background: #dcdcdc;color:  ;}
		   /* 图片循环旋转 */
		   @-webkit-keyframes rotation{
			from {-webkit-transform: rotate(0deg);}
			to {-webkit-transform: rotate(360deg);}
		   }
		   .rotation{
			-webkit-transform: rotate(360deg);
			animation: rotation 2s linear infinite;
			-moz-animation: rotation 2s linear infinite;
			-webkit-animation: rotation 2s linear infinite;
			-o-animation: rotation 2s linear infinite;
			}
		</style>
	</head>
	<body class="mui-fullscreen">
    <?php //设置进/出门标记
	   if($_GET['direction']=='in'){
		  $directionTxt = "进";
		  $check_doorType = "check_doorIn";
	   }
	   else{
		$directionTxt = "出";
		$check_doorType = "check_doorOut";

	   }
	?>
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
				<h1 class="mui-center mui-title"><?=$directionTxt?>作业门前清点人员和工器具</h1>
			</div>
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="margin-top:40px">
						<div class='toolsBag'>
						<ul class="navbox">
							<li class="firstLi">小工具清点</li>
							<li  class="secondLi"><span id="updateData_toolBag" class="gray">刷新<img id="toolbag_loading" class="" src='/public/images/ref3.png' /></span></li>
							
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>名称</li>
							<li>所属工具包</li>
							<li>班前数量</li>
							<li>实际数量</li>
							<li>相差</li>
							<li>是否符合</li>
						</ul>
						<div id='ulBox'>
						  <?php 
						  $smallTool_preparedAmount = 0;//统计班前准备总数
						  $smallTool_realAmount = 0;//统计清点时时间数量
						  foreach($smallToolsArr as $index=>$val){?>
							<ul toolListId="<?=$val['toolId']?>" class="detailToolItem mui-table-view mui-table-view-chevron list sub">
							<li><?=$val['toolName']?></li>
							<li><?=$val['toolBagName']?></li>
							<li><?=$val['twtlPreparedAmount']?></li>
							<li><?=$val['twtlRealAmount']?></li>
							<li class="amountDiffer"><?=$val['twtlPreparedAmount'] - $val['twtlRealAmount']?></li>
							<li><img width="16px" src="/public/images/<?php if($val['twtlPreparedAmount'] == $val['twtlRealAmount'])
							echo 'right3';else echo 'error4';?>.png" /></li>
							</ul>
						  <?php 
						    $_SESSION['workOrderId'] = $_GET['twOrderId'];
							$smallTool_preparedAmount += $val['twtlPreparedAmount'];
							$smallTool_realAmount += $val['twtlRealAmount'];
							$_SESSION['smallTool_preparedAmount'] = $smallTool_preparedAmount;
							$_SESSION['smallTool_realAmount'] = $smallTool_realAmount;

							 //echo " aaaaaaaaaaaa : ".$_SESSION['smallTool_realAmount'];
						  }?>
							
						</div>
					</div>
					<div class='bigTools'>
						<ul class="navbox">
							<li class="firstLi">大工具清点</li>
							<!--<li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li>-->
							
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>名称</li>
							<li>班前数量</li>
							<li style="width: 110px;"><?=DistanceRange_safeDoor?>米内数量</li>
							<li>相差</li>
							<li>是否符合</li>
							<li>详情</li>
						</ul>
						<div id='ulBox'>
						 <?php 
						   $bigTool_preparedAmount = 0;//统计班前准备总数
						   $bigTool_realAmount = 0;//统计清点时时间数量  
						   foreach($bigToolsArr as $twtlToolId=>$value){?>
							<ul toollistid="<?=$value['thInfo']['toListId']?>" class="detailToolItem mui-table-view mui-table-view-chevron list sub">
								<li><?=$value['thInfo']['name']?></li>
								<li><?=$value['thInfo']['twtlPreparedAmount']?></li>
								<li><?=$value['thInfo']['twtlRealAmount']?></li>
								<li class="amountDiffer"><?=$value['thInfo']['amountDiffer']?></li>
								<li><img width="16px" src="/public/images/<?php if($value['thInfo']['amountDiffer'] == 0)
							echo 'right3';else echo 'error4';?>.png" /></li>
								<li class="openDetail" twtlToolId="<?=$twtlToolId?>">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
								</li>
							</ul>
						   
							<div id="sub_<?=$twtlToolId?>" class="subList" style="display:none;">
								<ul style="background: #3a7ae2;color:#fff;" class="mui-table-view mui-table-view-chevron list">
									<li>名称</li>
									<li>GPS编号</li>
									<li>当前位置</li>
									<li>作业门</li>
									<li>相距(米)</li>
									<li>范围内</li>
								</ul>
							 <?php foreach($value['details'] as $key2=>$details){?>
								<ul class="mui-table-view mui-table-view-chevron list sub">
									<li><?=$details['toolName']?></li>
									<li><?=$details['gpsCode']?></li>
									<li><?php if($details['status']!=0)echo '<a href="/personLocal/taskdoorCheck/index_m&type=bigTool&gps_x='.$details["devGPS_x"].'&gps_y='.$details["devGPS_y"].'">
										<img width="16px" src="/public/images/icon-png/local5.png" /></a>';
										else echo '无数据';
										?></li>
									<li><?=$value['thInfo']['safaDoorinName']?></li>
									<li><?=$details['distance']?></li>
									<li><?=$details['status']==1?"是":"否"?><!--<img width="16px" src="/public/images/<?php if($details['status'] ==1 )
								echo 'right3';else echo 'error4';?>.png" />--></li>
								</ul>
							 <?php }?>
							 </div>
							 <?php 
								$bigTool_preparedAmount += $value['thInfo']['twtlPreparedAmount'];
								$bigTool_realAmount += $value['thInfo']['twtlRealAmount'];
								//echo $bigTool_preparedAmount.'  '.$bigTool_realAmount;
							 }
							 $_SESSION['bigTool_preparedAmount'] = $bigTool_preparedAmount;
							 $_SESSION['bigTool_realAmount'] = $bigTool_realAmount;
							 ?>
						 </div>		
					</div>					

          
					<div class='bigTools'>
						<ul class="navbox">
							<li class="firstLi">人员清点</li>
							<!--<li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li>-->
							
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>姓名</li>
							<li>班前数量</li>
							<li style="width:110px;"><?=DistanceRange_safeDoor?>米内数量</li>
							<li>相差</li>
							<li>是否符合</li>
							<li>详情</li>
						</ul> 
						<div id='ulBox'>
 							<ul class="mui-table-view mui-table-view-chevron list sub">
								<li>核心人员</li>
								<li><?=$personsArr['item']['twtlPreparedAmount']?></li>
								<li><?=$personsArr['item']['twtlRealAmount']?></li>
								<li class="amountDiffer"><?=$personsArr['item']['amountDiffer']?></li>
								<li><img width="16px" src="/public/images/<?php if($personsArr['item']['amountDiffer'] == 0)
							echo 'right3';else echo 'error4';?>.png" /></li>
								<li class="openDetail" twtlToolId="personSub">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
								</li>
							</ul>
						   
							<div id="sub_personSub" class="subList" style="display:none;">
								<ul style="background: #3a7ae2;color:#fff;" class="mui-table-view mui-table-view-chevron list">
									<li>姓名</li>
									<li>GPS编号</li>
									<li>当前位置</li>
									<li>作业门</li>
									<li>相距(米)</li>
									<li>范围内</li>
								</ul>
							 <?php 
							 $_SESSION['persons_preparedAmount'] = $personsArr['item']['twtlPreparedAmount'];//统计班前准备总数
							 $_SESSION['persons_realAmount'] = $personsArr['item']['twtlRealAmount'];//统计清点时时间数量  
							 foreach($personsArr['personsInfo'] as $key2=>$person){?>
								<ul class="mui-table-view mui-table-view-chevron list sub">
									<li><?=$person['pManageName']?></li>
									<li><?=$person['gpsCode']?></li>
									<li><?php if($person['status']!=0)echo '<a href="/personLocal/taskdoorCheck/index_m&type=mainperson&gps_x='.$person["devGPS_x"].'&gps_y='.$person["devGPS_y"].'">
										<img width="16px" src="/public/images/icon-png/local5.png" /></a>';
										else echo '无数据';
										?></li>
									<li><?=$person['safaDoorinName']?></li>
									<li><?=$person['distance']?></li>
									<li><?=$person['status']==1?"是":"否"?><!--<img width="16px" src="/public/images/<?php if($details['status'] ==1 )
								echo 'right3';else echo 'error4';?>.png" />--></li>
								</ul>
							 <?php }?>
							 </div>						  
						 </div>

						 <div id='ulBox'>
 							<ul class="mui-table-view mui-table-view-chevron list sub">
								<li>施工人员</li>
								<li><?=$buildersArr['item']['twtlPreparedAmount']?></li>
								<li><?=$buildersArr['item']['twtlRealAmount']?></li>
								<li class="amountDiffer"><?=$buildersArr['item']['amountDiffer']?></li>
								<li><img width="16px" src="/public/images/<?php if($buildersArr['item']['amountDiffer'] == 0)
							echo 'right3';else echo 'error4';?>.png" /></li>
								<li class="openDetail" twtlToolId="buildersSub">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
								</li>
							</ul>
						   
							<div id="sub_buildersSub" class="subList" style="display:none;">
								<ul style="background: #3a7ae2;color:#fff;" class="mui-table-view mui-table-view-chevron list">
									<li>姓名</li>
									<li>GPS编号</li>
									<li>当前位置</li>
									<li>作业门</li>
									<li>相距(米)</li>
									<li>范围内</li>
								</ul>
							 <?php 
							  $_SESSION['builders_preparedAmount'] = $buildersArr['item']['twtlPreparedAmount'];//统计班前准备总数
							  $_SESSION['builders_realAmount'] = $buildersArr['item']['twtlRealAmount'];//统计清点时时间数量  
							  foreach($buildersArr['personsInfo'] as $key2=>$person){?>
								<ul class="mui-table-view mui-table-view-chevron list sub">
									<li><?=$person['pManageName']?></li>
									<li><?=$person['gpsCode']?></li>
									<li><?php if($person['status']!=0)echo '<a href="/personLocal/taskdoorCheck/index_m&type=taskperson&gps_x='.$person["devGPS_x"].'&gps_y='.$person["devGPS_y"].'">
										<img width="16px" src="/public/images/icon-png/local5.png" /></a>';
										else echo '无数据';
										?></li>
									<li><?=$person['safaDoorinName']?></li>
									<li><?=$person['distance']?></li>
									<li><?=$person['status']==1?"是":"否"?><!--<img width="16px" src="/public/images/<?php if($details['status'] ==1 )
								echo 'right3';else echo 'error4';?>.png" />--></li>
								</ul>
							 <?php }?>
							 </div>						  
						 </div> 
					</div>
 
					<button type="button" id="submit_confirm" class="mui-btn mui-btn-success submit">确认<?=$directionTxt?>作业们核对完毕</button>
						
					</div>
				</div>
			</div>
		</div>

		<?php
		 
			//echo " 开始触发工具包 ";
            /*
			$URL ='http://119.23.61.231:9004/send.jsp?bag_id=GL4SAB1832000009&command=1'; //定义访问jsp的url 
			//初始化curl 
			$ch = curl_init(); 
			//设置curl返回结果 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			//设置url 
			curl_setopt($ch, CURLOPT_URL, $URL); 
			//执行调用 
			$data = curl_exec($ch) or die(curl_error($ch)); 
			//关闭连接 
			curl_close($ch); 
            //usleep(100);
			//echo '   结束触发 ';
			*/
		 
		?>


	</body>
	<script src="/public/js/mui.min.js "></script>
	<script>
         
		mui.init();
		 
		var btnArray = ['取消','确定'];
        var twtltWorkOrderId = <?=$_GET['twOrderId']==""?0:$_GET['twOrderId']?>;
		//初始化单页的区域滚动
		mui('.mui-scroll-wrapper').scroll();
       
	   
	   //刷新工具包
	   $("#updateData_toolBag").click(function(e) {
		     //var waitingTime = 5//秒，工具包读取工具的最大时间
		     $("#toolbag_loading").addClass("rotation");//扫描中样式
			 mui.toast("工具包更新中...");
			 $.ajax({
				async:false,
				url: '<?=CURRENT_DIR?>/toolBag_update.php',//工具包出发服务器链接地址 http://120.203.14.45:9004/send.jsp?bag_id=GL4SAB1832000009&command=1
				type: 'POST',
				dataType: 'json',
				data: {
					//'type': 'trigger',
				},
				success: function (msg){
					//等待工具包扫描包内工具，等待x毫秒 
					setTimeout(function(){
						$("#toolbag_loading").removeClass("rotation");
						mui.toast("更新完成");
					}, 10000);
					setTimeout(function(){
						location.reload();
					}, 3000);
					 
 				},
				error: function(msg){
					$("#toolbag_loading").removeClass("rotation");
					mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
				}
			})
             
         });
       //展开详情
	   $(".openDetail").on('click',function(){
		    var twtltoolid = $(this).attr("twtltoolid");
            var subObj = $("#sub_"+twtltoolid);
 			
			if(subObj.is(':hidden')){　　//如果node是隐藏的则显示node元素，否则隐藏
			　　subObj.show();　
			   $(this).find("img").attr("src","/public/images/zhankai1.png");
			   
			}else{
			　　subObj.hide();
			$(this).find("img").attr("src","/public/images/zhankai2.png");
			}


	   });
		//确认清点完毕
		$("#submit_confirm").on('click',function(){
				var txt = '<span style="color:#f30">确认后不可再修改，请谨慎操作！';
				 
				mui.confirm(txt, '确认准备完毕', btnArray, function(e) {
						if(e.index==1){
						//alert(twtltWorkOrderId);return false;
						$.ajax({
							url: '<?=CURRENT_DIR?>/../toolsCheck/index_orderConfirmed.php?',
							type: 'POST',
							dataType: 'json',
							data: {
								'type': '<?=$check_doorType?>',
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
		   
		 $(".updateData").click(function(e) {
			 mui.toast("数据更新中...");
             location.reload();
         });
		
</script>
</html>