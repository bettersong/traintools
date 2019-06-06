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
		</style>
		<?php
           if($_GET['direction']=='in'){
			  $directionTxt = "进";
			  $check_doorType = "check_doorIn";
		   }
		   else{
			$directionTxt = "出";
			$check_doorType = "check_doorOut";

<<<<<<< .mine
   .imgShow{background: #fff !important}
   .imgShow li{padding: 0px !important;
    margin: 0px !important;
    background: #fff !important;
    width: 30%;
    margin: 0 0 5px 2% !important;
     }
     .twork{font-size: 16px;color:#000;}
     .twork span{font-size:14px;color:#888;}
   .imgShow li img{width:100%;height:100px;border-radius: 5px;}

   .table_summary{width: 96%;
    margin: 0 auto;
    text-align: center;font-size:1em;}
   .table_summary tr{}
	.table_summary tr th,.table_summary tr td{border: 1px solid #ddd;padding:2px 0;}
   .table_summary tr th{color: #555;font-weight:400;}
   .table_summary tr td{color:#555;font-size: 0.9em;}
	.table_summary tr .td1{color:#222;font-weight:600;}
	.img_banner{
		width: 96%;
    margin: 20px auto 0;
    border-bottom: 1px solid #ddd;
	}
   .summary_title{
	   display: inline-block;
	   background:#1296db;
	   color:#fff;
	   padding: 2px 5px;
	   margin:15px 0 0 2%; 
	  
	   }
	.summary_titleBox{border-bottom:1px solid #ddd;}
	.table_summary tr td.preparedAmount{color:;}
	.table_summary tr td.notAgree{color:#de380f;}
	.title{background: #ccc;padding:5px;font-size: 13px}
	.submit {
    display: block;
    margin: 20px auto;
    width: 80%;
    margin-bottom: 120px;
}
</style>
</head>

<body class="mui-fullscreen">
<div id="app" class="mui-views">
	<div class="mui-view">
		<div class="mui-navbar">
||||||| .r665
   .imgShow{background: #fff !important}
   .imgShow li{padding: 0px !important;
    margin: 0px !important;
    background: #fff !important;
    width: 30%;
    margin: 0 0 5px 2% !important;
     }
   .imgShow li img{width:100%;height:100px;border-radius: 5px;}

   .table_summary{width: 96%;
    margin: 0 auto;
    text-align: center;font-size:1em;}
   .table_summary tr{}
	.table_summary tr th,.table_summary tr td{border: 1px solid #ddd;padding:2px 0;}
   .table_summary tr th{color: #555;font-weight:400;}
   .table_summary tr td{color:#555;font-size: 0.9em;}
	.table_summary tr .td1{color:#222;font-weight:600;}
	.img_banner{
		width: 96%;
    margin: 20px auto 0;
    border-bottom: 1px solid #ddd;
	}
   .summary_title{
	   display: inline-block;
	   background:#1296db;
	   color:#fff;
	   padding: 2px 5px;
	   margin:15px 0 0 2%; 
	  
	   }
	.summary_titleBox{border-bottom:1px solid #ddd;}
	.table_summary tr td.preparedAmount{color:;}
	.table_summary tr td.notAgree{color:#de380f;}
	.submit {
    display: block;
    margin: 20px auto;
    width: 80%;
    margin-bottom: 120px;
}
</style>
</head>

<body class="mui-fullscreen">
<div id="app" class="mui-views">
	<div class="mui-view">
		<div class="mui-navbar">
=======
		   }
		?>
	</head>
	<body class="mui-fullscreen">
		<div id="app" class="mui-views">
			<div class="mui-view">
				<div class="mui-navbar">
				</div>
				<div class="mui-pages">
				</div>
			</div>
>>>>>>> .r667
		</div>
<<<<<<< .mine
		<div class="mui-pages">
		</div>
	</div>
</div>
<div id="setting" class="mui-page">
	<div class="mui-navbar-inner mui-bar mui-bar-nav">
		<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
			<span class="mui-icon mui-icon-left-nav"></span>
		</button>
		<h1 class="mui-center mui-title">作业总结</h1>
	</div>
	<div class="mui-page-content" >
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll" style="margin-top:45px">
		<div class="toolsBag">
			<span class="title">工单情况</span>
			<ul class="mui-table-view mui-table-view-chevron twork">
				<li id='workPlace'>施工地点：<span></span></li>
				<li id='workTime'>天窗时间：<span></span></li>
				<li id='mainPerson'>核心人员：<span></span></li>
				<li id='workPerson'>施工人员：<span></span></li>
			</ul>
		</div>		
			<div class='box toolsBag'>
||||||| .r665
		<div class="mui-pages">
		</div>
	</div>
</div>
<div id="setting" class="mui-page">
	<div class="mui-navbar-inner mui-bar mui-bar-nav">
		<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
			<span class="mui-icon mui-icon-left-nav"></span>
		</button>
		<h1 class="mui-center mui-title">作业总结</h1>
	</div>
	



	
	<div class="mui-page-content" >
		<div class="mui-scroll-wrapper">
			<div class="mui-scroll" style="margin-top:45px">
		     

       

			<div class='toolsBag'>
=======
		<div id="setting" class="mui-page">
			<div class="mui-navbar-inner mui-bar mui-bar-nav">
				<button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
					<span class="mui-icon mui-icon-left-nav"></span>
				</button>
				<h1 class="mui-center mui-title"><?=$directionTxt?>作业门前清点人员和工器具</h1>
			</div>
			<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="">
						<div class='toolsBag'>
>>>>>>> .r667
						<ul class="navbox">
<<<<<<< .mine
							<li class="firstLi">小工具详情</li>
||||||| .r665
							<li class="firstLi">小工具数据</li>
							<li id="updateData_toolBag" class="secondLi">刷新工具包<img src='/public/images/ref3.png'></li>
							
=======
							<li class="firstLi">小工具清点</li>
							<li  class="secondLi"><span id="updateData_toolBag" class="gray">刷新<img src='/public/images/ref3.png' /><img style="display:none; float:left;margin:2px 0 0 -27px;" id="toolbag_loading" src='/public/images/loading5.gif' /></span></li>
							
>>>>>>> .r667
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>名称</li>
							<li>工单要求数量</li>
							<li>班前数量</li>
<<<<<<< .mine
							<li>进出安全门数量</li>
							<li class="openDetail" style="width:50px">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
||||||| .r665
							<li>进门数量</li>
							<li>相差</li>
							<li>是否符合</li>
=======
							<li>实际数量</li>
							<li>相差</li>
							<li>是否符合</li>
>>>>>>> .r667
						</ul>
						<div class='ulBox' style="display: none">
						  <?php 
<<<<<<< .mine
						  
						  foreach($smallTools as $key => $val){?>
							<ul class="detailToolItem mui-table-view mui-table-view-chevron list sub">
							<li><?=$val['twtlName']?></li>
							<li><?=$val['twtlAmount']?></li>
							<li><?=$val['twtlPreparedAmount']?></li>
							<li><?=$val['twtlExitSafeDoorAmount']?></li>
||||||| .r665
						  $smallTool_preparedAmount = 0;//统计班前准备总数
						  $smallTool_realAmount = 0;//统计清点时时间数量
						  foreach($smallToolsArr as $index=>$val){?>
							<ul toolListId="<?=$val['toolId']?>" class="detailToolItem mui-table-view mui-table-view-chevron list sub">
							<li><?=$val['toListName']?></li>
							<li><?=$val['rfid_reader_code']?></li>
							<li><?=$val['twtlIntoSafeDoorAmount']?></li>
							<li><?=$val['twtlExitSafeDoorAmount']?></li>
=======
						  $smallTool_preparedAmount = 0;//统计班前准备总数
						  $smallTool_realAmount = 0;//统计清点时时间数量
						  foreach($smallToolsArr as $index=>$val){?>
							<ul toolListId="<?=$val['toolId']?>" class="detailToolItem mui-table-view mui-table-view-chevron list sub">
							<li><?=$val['toolName']?></li>
							<li><?=$val['toolBagName']?></li>
							<li><?=$val['twtlPreparedAmount']?></li>
							<li><?=$val['twtlRealAmount']?></li>
>>>>>>> .r667
							<li></li>
							</ul>
							<?php } ?>
						</div>
					</div>
<<<<<<< .mine
					<div class='box bigTools'>
||||||| .r665



					<div class='bigTools'>
=======
					<div class='bigTools'>
>>>>>>> .r667
						<ul class="navbox">
<<<<<<< .mine
							<li class="firstLi">大工具详情</li>
							<!-- <li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li> -->
||||||| .r665
							<li class="firstLi">大工具数据</li>
							<li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li>
							
=======
							<li class="firstLi">大工具清点</li>
							<!--<li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li>-->
							
>>>>>>> .r667
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>名称</li>
							<li>工单要求数量</li>
							<li>班前数量</li>
							<li>进出安全门数量</li>
							<li class="openDetail" style="width:50px">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
						</ul>
						<div class='ulBox' style="display: none">
						 <?php 
						   foreach($bigTools as $key => $value){?>
							<ul class="detailToolItem mui-table-view mui-table-view-chevron list sub">
								<li><?=$value['twtlName']?></li>
								<li><?=$value['twtlAmount']?></li>
								<li><?=$value['twtlPreparedAmount']?></li>
								<li><?=$value['twtlExitSafeDoorAmount']?></li>
								<li></li>	
							</ul>
<<<<<<< .mine
						<?php } ?>
||||||| .r665
						   
							<div id="sub_<?=$twtlToolId?>" style="display:none;">
								<ul style="background: #094;color:#fff;" class="mui-table-view mui-table-view-chevron list">
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
									<li><img width="16px" src="/public/images/<?php if($details['status'] ==1 )
								echo 'right3';else echo 'error4';?>.png" /></li>
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
=======
						   
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
>>>>>>> .r667
						 </div>				
						 
					</div>
<<<<<<< .mine
					<div class='box corePerson'>
||||||| .r665


					
					<div class='bigTools'>
=======
					

          
					<div class='bigTools'>
>>>>>>> .r667
						<ul class="navbox">
<<<<<<< .mine
							<li class="firstLi">核心人员详情</li>
||||||| .r665
							<li class="firstLi">人员数据</li>
							<li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li>
							
=======
							<li class="firstLi">人员清点</li>
							<!--<li class="secondLi updateData">刷新<img src='/public/images/ref3.png'></li>-->
							
>>>>>>> .r667
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
<<<<<<< .mine
							<li>名称</li>
							<li>是否进安全门</li>
							<li>是否出安全门</li>
							<li class="openDetail" style="width:50px">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
||||||| .r665
							<li>姓名</li>
							<li>班前数量</li>
							<li style="width: 82px;"><?=DistanceRange_safeDoor?>米内数量</li>
							<li>相差</li>
							<li>是否符合</li>
							<li>详情</li>
=======
							<li>姓名</li>
							<li>班前数量</li>
							<li style="width:110px;"><?=DistanceRange_safeDoor?>米内数量</li>
							<li>相差</li>
							<li>是否符合</li>
							<li>详情</li>
>>>>>>> .r667
						</ul> 
						<div class='ulBox' style="display: none">
							<?php 
						   foreach($admin as $key => $value){?>
 							<ul class="mui-table-view mui-table-view-chevron list sub">
							<li><?=$value['twamName']?></li>
							<li><?php if($value['twamIntoSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li><?php if($value['twamExitSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li></li>
							</ul>
<<<<<<< .mine
						   <?php } ?>
												  
||||||| .r665
						   
							<div id="sub_personSub" style="display:none;">
								<ul style="background: #094;color:#fff;" class="mui-table-view mui-table-view-chevron list">
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
									<li><img width="16px" src="/public/images/<?php if($person['status'] ==1 )
								echo 'right3';else echo 'error4';?>.png" /></li>
								</ul>
							 <?php }?>
							 </div>						  
=======
						   
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
>>>>>>> .r667
						 </div>
<<<<<<< .mine
						</div>
						<div class='box workPerson'>
						<ul class="navbox">
							<li class="firstLi">施工人员详情</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>名称</li>
							<li>是否进安全门</li>
							<li>是否出安全门</li>
							<li class="openDetail" style="width:50px">								
									<img style="height: 16px;" src="/public/images/zhankai2.png" />
							</li>
						</ul> 
						<div class='ulBox' style="display:none">
 							<?php 
						   foreach($worker as $key => $value){?>
||||||| .r665


						 <div id='ulBox'>
=======

						 <div id='ulBox'>
>>>>>>> .r667
 							<ul class="mui-table-view mui-table-view-chevron list sub">
							<li><?=$value['pManageName']?></li>
							<li><?php if($value['twamIntoSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li><?php if($value['twamExitSafeDoor_tag']==0){echo '否';}else{echo '是';}?></li>
							<li></li>
							</ul>
<<<<<<< .mine
						   <?php } ?>			  
						 </div>
						</div>	  
	    <div class="summary_titleBox"><div class="summary_title">现场照片(<?=count($photos)?>张)</div></div>
	    <div class="mui-content" style='background: #fff;margin-bottom: 5px'>
        <ul style="border:0; margin-top:5px;" class="mui-table-view mui-grid-view mui-grid-9 imgShow" id="ul_pics">
		</ul>
	    
</div>
<button type="button" id="submit_confirm" class="<?=$_GET['orderType']?> mui-btn mui-btn-success submit">确认总结完毕</button>
					
</div>
</div>
</div>
<div class="mui-scrollbar mui-scrollbar-vertical showImg" style="transition-duration: 500ms; opacity: 0;"><div class="mui-scrollbar-indicator" style="transition-duration: 0ms; display: block; height: 271px; transform: translate3d(0px, 394px, 0px) translateZ(0px); transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);"></div>
</div>

</div>
</body>
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script>
var photos = <?=json_encode($photos)?>;
var admin = <?=json_encode($admin)?>;
var OrderInfo = <?=json_encode($OrderInfo)?>;
console.log(OrderInfo);
$('#workPlace').find('span').html(OrderInfo[0]['TianChuangDYMC']);
$('#workTime').find('span').html(OrderInfo[0]['QiQiSJ']);
var worker = <?=json_encode($worker)?>;
var adminPerson= '';
$.each(admin,function(index,row){
	adminPerson += row['twamName']+',';
});
var workPerson= '';
$.each(worker,function(index,row){
	workPerson += row['pManageName']+',';
});
var adminLast = adminPerson.lastIndexOf(',');
adminPerson = adminPerson.slice(0,adminLast);
var workerLast = workPerson.lastIndexOf(',');
workPerson = workPerson.slice(0,workerLast);
$('#mainPerson').find('span').html(adminPerson);
$('#workPerson').find('span').html(workPerson);
var path = '/public/upload/senceImg/';
mui.init();
var btnArray = ['取消', '确认'];
//初始化单页的区域滚动
mui('.mui-scroll-wrapper').scroll();
//mui.previewImage();
//图片显示
var imgList = '';
$.each(photos,function(index,row){
		imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">'+'<img class="mainImg" src="'+ path+row['pictureResource']+'">'+'</li>';
	});
console.log(imgList);
$('.imgShow').html(imgList);
//展开收缩
$('.openDetail').on('click',function(){
	$(this).parents('.box').find('.ulBox').toggle();
})

//确认准备完毕
$("#submit_confirm").on('click',function(){
	var txt = '<span style="color:#f30">确认后不可再修改，请谨慎操作！';
	var twtltWorkOrderId = <?=$_GET['twOrderId']?>;
	mui.confirm(txt, '确认准备完毕', btnArray, function(e) {
			if(e.index==1){
			//alert(twtltWorkOrderId);return false;
			$.ajax({
				url: '<?=CURRENT_DIR?>/../toolsCheck/index_orderConfirmed.php',
||||||| .r665
						   
							<div id="sub_buildersSub" style="display:none;">
								<ul style="background: #094;color:#fff;" class="mui-table-view mui-table-view-chevron list">
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
									<li><img width="16px" src="/public/images/<?php if($person['status'] ==1 )
								echo 'right3';else echo 'error4';?>.png" /></li>
								</ul>
							 <?php }?>
							 </div>						  
						 </div> 



 




           <div class="summary_title" style="border:0;" >数量统计</div>
            <table class="table_summary" id="table_summary">
				<tr>
					<th>名称</th>
					<th>班前</th>
					<th>进作业</th>
					<th>出作业</th>
 				</tr>
				 <tr>
					<td class="td1">小工具</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_smallTools']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_smallTools']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_smallTools']?></td>
 				</tr>
				 <tr>
					<td class="td1">大工具</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_bigTools']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_bigTools']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_bigTools']?></td>
 				</tr>
				 <tr>
					<td class="td1">核心人员</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_adminstrators']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_adminstrators']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_adminstrators']?></td>
 				</tr>
				 <tr>
					<td class="td1">施工人员</td>
					<td class="preparedAmount"><?=$summaryArr['twsmPreparedAmount_workers']?></td>
					<td class="intoSafeDoorAmount"><?=$summaryArr['twsmIntoSafeDoorAmount_workers']?></td>
					<td class="exitSafeDoorAmount"><?=$summaryArr['twsmExitSafeDoorAmount_workers']?></td>
 				</tr>
				 <!--<tr>
					<td class="td1">作业门开锁</td>
					<td><?=$summaryArr['twsmPreparedAmount_workers']?></td>
					<td><?=$summaryArr['twsmIntoSafeDoorAmount_workers']?></td>
					<td><?=$summaryArr['twsmExitSafeDoorAmount_workers']?></td>
 				</tr>
				 <tr>
					<td class="td1">作业门人脸识别</td>
					<td><?=$summaryArr['twsmPreparedAmount_workers']?></td>
					<td><?=$summaryArr['twsmIntoSafeDoorAmount_workers']?></td>
					<td><?=$summaryArr['twsmExitSafeDoorAmount_workers']?></td>
 				</tr>
				 -->
		    </table>

			  
	    <div class="summary_titleBox"><div class="summary_title">现场照片(<?=count($pictureArr)?>张)</div></div>
	    <div class="mui-content" style='background: #fff;margin-bottom: 5px'>
        <ul style="border:0; margin-top:5px;" class="mui-table-view mui-grid-view mui-grid-9 imgShow" id="ul_pics">
		</ul>
	    <div id="summary_txtBox"  style="overflow: hidden;">
			<div style="padding-left: 2%;" class="summary_txt">总结语(选填)</div>
 			<textarea style="font-size:1em;border:1px solid #ddd;margin-bottom: 2px;" rows="3" cols="20" placeholder="工具损坏记录等..."><?=$summaryArr['twsmSummaryTxt']?></textarea>
			<button id="summary_txtBtn" style="float:right;margin: -10px 5px 0 0;" type="button" class="mui-btn mui-btn-outlined">确认提交</button>
 		</div>
        <!-- <div class='showImg'></div> -->
</div>
<button type="button" id="submit_confirm" class="<?=$_GET['orderType']?> mui-btn mui-btn-success submit">确认总结完毕</button>
					
</div>
</div>
</div>
<div class="mui-scrollbar mui-scrollbar-vertical showImg" style="transition-duration: 500ms; opacity: 0;"><div class="mui-scrollbar-indicator" style="transition-duration: 0ms; display: block; height: 271px; transform: translate3d(0px, 394px, 0px) translateZ(0px); transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);"></div>
</div>

</div>
</body>
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script>
var pictureArrJson =<?=json_encode($pictureArr)?>;
var path = '/public/upload/senceImg/';
mui.init();
var btnArray = ['取消', '确认'];
//初始化单页的区域滚动
mui('.mui-scroll-wrapper').scroll();
//mui.previewImage();
$("#table_summary tr").each(function(index, element) {
    if($(this).children(".intoSafeDoorAmount").html() != $(this).children(".preparedAmount").html()){
		$(this).children(".intoSafeDoorAmount").addClass("notAgree");
	}
	if($(this).children(".exitSafeDoorAmount").html() != $(this).children(".preparedAmount").html()){
		$(this).children(".exitSafeDoorAmount").addClass("notAgree");
	}
	
});
//提交总结语
$("#summary_txtBtn").click(function(e) {
    var txt =$.trim( $(this).prev("textarea").val() );
	if(txt==""){
		mui.alert("内容不能为空");
		return false;
	}
	$.ajax({
		url: '<?=CURRENT_DIR?>/index_add.php',
		type: 'POST',
		dataType: 'json',
		data: {
			'orderId': <?=$_GET['twOrderId']?>,
			'summaryCon': txt
		},
	})
	.done(function(msg) {
		mui.toast("提交成功");
	})
	.fail(function() {
		console.log("error");
	})
});
//显示现场图片
var imgList = '';
$.each(pictureArrJson,function(index,row){
	imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">'+'<img src="'+ path+row['pictureResource']+'">'+'</li>';
});//<img src='" + '/public/upload/senceImg/'+data.pic+ "'/>
$('.imgShow').html(imgList);
var popImg = false;
$('.imgShow').on('click','li',function(){
	$('.showImg').css({opacity:1});
	$('.showImg').html($(this).html());
	popImg = true;
	return false;
});
$('body,.showImg').on('click',function(e) {
	if(popImg){
		$('.showImg').css({opacity:0});
		$('.showImg').html('');
		popImg = false;
	}
});
// $('.showImg').on('click',function(){
// 	$(this).slideDown();
// 	console.log(11)
// })


//确认准备完毕
$("#submit_confirm").on('click',function(){
	var txt = '<span style="color:#f30">确认后不可再修改，请谨慎操作！';
	var twtltWorkOrderId = <?=$_GET['twOrderId']?>;
	mui.confirm(txt, '确认准备完毕', btnArray, function(e) {
			if(e.index==1){
			//alert(twtltWorkOrderId);return false;
			$.ajax({
				url: '<?=CURRENT_DIR?>/../toolsCheck/index_orderConfirmed.php',
=======
						   
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
                    
 
						<button type="button" id="submit_confirm" class="mui-btn mui-btn-success submit">确认<?=$directionTxt?>作业们核对完毕
						</button>
						
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
		     $("#toolbag_loading").css("display","block");
			 mui.toast("工具包数据更新中...");
			 $.ajax({
				async:false,
				url: '<?=CURRENT_DIR?>/toolBag_update.php',//工具包出发服务器链接地址 http://119.23.61.231:9004/send.jsp?bag_id=GL4SAB1832000009&command=1
>>>>>>> .r667
				type: 'POST',
				dataType: 'json',
				data: {
					//'type': 'trigger',
				},
				success: function (msg){
					console.log(msg);
					//mui.toast.cancel(); 
					$("#toolbag_loading").css("display","none");
					mui.toast("更新数据完成");
 				},
				error: function(msg){
<<<<<<< .mine
						mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
				}
||||||| .r665
						mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
					}
=======
					$("#toolbag_loading").css("display","none");
					mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
				}
>>>>>>> .r667
			})
             location.reload();
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