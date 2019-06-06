<!doctype html>
<html lang="en" class="feedback">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>高铁检修综合管理平台</title>
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		.mui-table-view-cell img{width: 110px;} 
		.list{display: flex;justify-content: space-between;line-height: 35px;color:#666;font-size: 13px;}
		.list li{text-align: center;width:80px;color:#555;}
		 ul.th li{color:#111;}
		.switch{margin-top:5px;}
		.delete{color:#1989fa;}
		.position{width:100px !important;}
		.mui-popover {height: 130px;}
		.checkbox{left:10px !important;top:10px !important;}
		.submit{display: block;margin: 20px auto;width: 80%;margin-bottom: 100px;}
		select{border: 1px solid rgba(0, 0, 0, .15) !important;border-radius: 6px;background: transparent;height: 40px;padding: 0 0 0 10px !important;background: url(/public/images/pulldown.png?a2) no-repeat;background-position: right;background-size: 20px;}	    
		.delete img{width:18px;}
		.selBag img,.selBigId img{width: 16px;margin-top: -3px;}
		li.name{ text-align: right;width: 60px;}
	    .amount img,.name img{ width: 12px; margin-top: 0;}
		.mainGps img, .gps img,.Gps img{ width:16px; margin-top:0;}
		.ul_title{display: inline-block;color: #fff;border: 1px solid #007aff;background-color: #007aff;padding: 0 12px;height: 32px;line-height: 30px;}
	    .updateObj{ }
		li.name .updateObj  {  }
		li.name  img{ }
	 
		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">作业人员准备</h1>
		</header>
		<div class="mui-content" >
			 <div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="margin-top:40px;padding:20px 0px 0px 5px">
						<div class="ul_title">核心人员</div>
						<ul class="th mui-table-view mui-table-view-chevron list">
						    <li>职务/职责</li>
							<li>姓名</li>
							<li>联系方式</li>
							<li>定位器</li>
						</ul> 
						<div id='ulBox'>
						<?php foreach ($personArr as $key => $value) {?>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li class='position'><?=$value['twamUserJobName']?></li>
							<?php if(strpos($value['twamUserJobName'],"作业负责人")===false){?>
							<li class="name" value=<?=$value['twamPersonId']?> twamId=<?=$value['twamId']?> >
								<?php if($value['twamName']=="")echo '<span class="updateObj noSelectedPerson">无'; else echo '<span class="updateObj">'.$value['twamName'];?></span>
								<img src="/public/images/edit.png?a2" />
							</li>
							<?php } else{//负责人不可编辑?>
							<li class="unedit name" style="text-align: center;" value="" twamId=<?=$value['twamId']?> >
								<span class="updateObj"><?php if($value['twamName']=="")echo "无";else echo $value['twamName'];?></span>
							</li>
							<?php }?>
							<li class="phone" style="width: ;"><?=$value['pManageContact']==""?"-":$value['pManageContact']?></li>
							<li class='Gps' value="<?=$value['GPSId']?>" twamId=<?=$value['twamId']?>>
							<span class="updateObj"><?php
								if ($value['GPSCode']=="") echo "无";
								else echo $value['GPSCode'];
							?></span>
							<img src="/public/images/pulldown.png?a2">
							</li>
						</ul>
						<?php } ?>
						<div style="margin-top: 15px;">
							<div class="ul_title">施工人员</div>
							<button class="ul_title" style="background-color: #74B749;border: 0;" id="add">+添加</button>
						</div>
						<ul class="th mui-table-view mui-table-view-chevron list">
							
						    <!-- <li>职务/职责</li> -->
							<li>姓名</li>
							<li>联系方式</li>
							<li>定位器</li>
							<li>删除</li>
						</ul> 
						<div id='ulBox' class="ulBox_builders">
						<?php foreach ($buildersArr as $key => $value) {?>
						<ul class="mui-table-view mui-table-view-chevron list shigongList">
							<!-- <li class='position'>施工人员</li> -->
							<li class="name" value=<?=$value['twkePersonId']?> twamId=<?=$value['twkeId']?> >
								<?php if($value['pManageName']=="")echo '<span class="updateObj noSelectedPerson">无'; else echo '<span class="updateObj">'.$value['pManageName'];?></span>
								<img src="/public/images/edit.png?a2" />
							</li>							
							<li class="phone" style="width: ;"><?=$value['pManageContact']==""?"-":$value['pManageContact']?></li>
							<li class='Gps' value="<?=$value['GPSId']?>" twamId=<?=$value['twkeId']?>>
							<span class="updateObj"><?php
								if ($value['GPSCode']=="") echo "无";
								else echo $value['GPSCode'];
							?></span>
							<img src="/public/images/pulldown.png?a2">
							</li>
							<li class="delete deleteBuilder" tid="<?=$value['twkeId']?>"><img src="/public/images/delete.png?a1"></li>
						</ul>
						<?php } ?>



						</div>
                       

						<button style="direction:ltr;display:block;" type="button" id="submit_confirm" class="mui-btn mui-btn-success submit">确认准备完毕</button>
					</div>
		</div>
		</div>	
		</div>
		
		<script src=" /public/js/jquery-1.8.3.min.js"></script>
		<script src="/public/js/mui.min.js"></script>
		<script type="text/javascript">
		    var isHistory = "<?=$_GET['orderType']=='history'?'yes':'no'?>";
			var CURRENT_DIR = "<?=CURRENT_DIR?>";
			var twOrderId = <?=$_GET['twOrderId']?>;
			var personArr = <?= json_encode($personArr)?>;
			var adminArrJson = <?=$adminArrJson?>;
			var buildersAllJson = <?=$buildersAllJson?>;
			var GPSLocateJson = <?=$GPSLocateJson?>;
			console.log(buildersAllJson)
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
            var btnArray = ['取消','确定'];
            //var personArr = [{toListId:1,toListName:'张三'},{toListId:2,toListName:'李四'},{toListId:3,toListName:'王五'}];
            $(function(){
            //添加施工人员
            document.getElementById("add").addEventListener("tap", function() {
            //施工人员
				var tolOption = "";
                $.each(buildersAllJson,function(index,row){
                    //alert(device_id);
                     tolOption += '<option value="'+row['pManageId']+'">'+row['pManageName']+'</option>';
                });
                var personSelect = '<p>'+'<label>请选择人员：</label>'+'<select class="personId mui-select tiny" id="select">'+tolOption+'</select>'+'</p>';
                mui.confirm(personSelect,'添加施工人员',btnArray,function(e){
                	if(e.index == 1){
                		console.log('确定');
                		var personId = $('.personId option:selected').val();
                		console.log(personId,twOrderId);
                		$.ajax({
							url: '<?=CURRENT_DIR?>/index_shigong_add.php?',
							type: 'POST',
							dataType: 'json',
							data: {
								'twOrderId': twOrderId,
								'personId': personId
							},
						})
						.done(function(msg) {
							mui.toast("添加完成");
							console.log(msg);
							var newList = '<ul class="mui-table-view mui-table-view-chevron list shigongList">'+'<li class="name" value="" twamId=msg["pManageId"] >'+
								'<span>'+msg["pManageName"]+'</span>'+'<img src="/public/images/edit.png" /></li>'+'<li class="phone" style="width: 90px;text-align:left;">'+msg["pManageContact"]+'</li>'+'<li class="Gps" value=msg["GPSId"] twamId=msg["twkeId"]>'+msg["pManagePosition"]+'<img src="/public/images/pulldown.png"></li>'+'<li class="delete deleteBuilder" tid='+msg["twkeId"]+'><img src="/public/images/delete.png"></li>'
								
												
							// <li class="phone" style="width: 90px;text-align:left;"><?=$value['pManageContact']?></li>
							// <li class='Gps' value="<?=$value['GPSId']?>" twamId=<?=$value['twkeId']?>>
							// <span class="updateObj"><?php
							// 	if ($value['GPSCode']=="") echo "无";
							// 	else echo $value['GPSCode'];
							// ?></span>
							// <img src="/public/images/pulldown.png?a2">
							// </li>
							// <li class="delete deleteBuilder" tid="<?=$value['twkeId']?>"><img src="/public/images/delete.png?a1"></li>
						'</ul>'
						$('.ulBox_builders').append(newList);
						})
						.fail(function(msg) {
							console.log("error");
						})
                	}
                })
            }) 
            
			//删除
            //$('#ulBox').on('click','.deleteBuilder',function(){
             	//$(this).parents('ul').remove();
             //});
			 //删除施工人员
			 $('#ulBox').on('click','.deleteBuilder',function(){
                var thisObj = $(this);
				mui.confirm("确定要删除吗？", '提示', btnArray, function(e) {
					if(e.index==1){
						thisObj.parents('ul').remove();
						var delId = thisObj.attr('tid');
						$.ajax({
							url: '<?=CURRENT_DIR?>/index_deleteBuilder.php',
							type: 'POST',
							dataType: 'json',
							data: {
								'delId': delId
							},
						})
						.done(function(msg) {
							mui.toast("删除成功");
						})
						.fail(function() {
							console.log("error");
						})
             	
					}
				 });
             	
             });
            //解决动态创建元素的事件委托
            $('#ulBox').on('click','.newSwitch',function(){
             	if($(this).hasClass('mui-active')){
             		$(this).removeClass('mui-active');
             	}else{
             		$(this).addClass('mui-active');
             	}
             	
             })
            })
			//弹出不可编辑提示
			$('#ulBox').on('click','.unedit',function(){
                mui.toast('不可编辑');
			});
			//编辑人员
			var btnArray = ['取消','确定'];
			$('#ulBox').on('click','.name',function(){
				var obj_update = $(this).find(".updateObj").eq(0);//修改数据的操作对象
				var phone = $(this).parents('ul').find('.phone');
				console.log(phone);
				var gps = $(this).parents('ul').find('.Gps').find('.updateObj');
				console.log(gps);
				var name = $(this).text();
				var personId = $(this).val();
				var twamId = $(this).attr('twamId');
				var type = 'changName';
				//操作对象：核心人员or施工人员
				var obj_type="adminPerson";
				if( $(this).parents(".ulBox_builders").length>0){
					obj_type="builders";
				}
				//构造人员
				var personOption = '';
                var newArry = adminArrJson;
				if(obj_type == "builders")newArry = buildersAllJson;
				//console.log(personId);
				 console.log(newArry)
                $.each(newArry,function(index,row){
                	if (personId == row['pManageId']) {
                		 personOption += '<option selected value="'+row['pManageId']+'">'+row['pManageName']+'</option>';}
                    else personOption += '<option value="'+row['pManageId']+'">'+row['pManageName']+'</option>';
                });
                console.log(personOption);
                var personBox = '<p>'+'<select class="person mui-select tiny">'+personOption+'</select>'+'</p>';
                //alert(twamId);
				mui.confirm(personBox,'下拉选择人员',btnArray,function(e){
					if(e.index==1){
                     var pManageId = $('.person option:selected').val();
                     var pManageName = $('.person option:selected').text();
                     $.ajax({
						url: '<?=CURRENT_DIR?>/index_add.php?',
						type: 'POST',
						dataType: 'json',
						data: {
							'type':type,
							'pManageId':pManageId,
							'pManageName':pManageName,
							'twamId':twamId,
							'obj_type':obj_type
						},
					})
					.done(function(msg) {
						obj_update.html(pManageName);
						phone.html(msg[0]['pManageContact']);
						gps.html(msg[0]['GPSCode']);
						//console.log(msg[0]['pManageContact'],msg[0]['GPSCode'])
						console.log(msg);
					})
					.fail(function(msg) {
						console.log(msg);
					})
					}else{
                      console.log(2);
					}
                   
				})
			});
			//定位器
			//封装删除单个数组元素方法
		    function remove(arr, item) {
		    var result=[];
		    for(var i=0; i<arr.length; i++){
		    if(arr[i]!=item){
		        result.push(arr[i]);
		       }
		    }
			 return result;
			}
			//GPSCode
			function remove2(arr,item){
				var result = [];
				for(var i=0;i<arr.length;i++){
                 if(arr[i]['GPSCode'] != item){
                 	result.push(arr[i]);
                 }
				}
				return result;
			}
			$('#ulBox').on('click','.Gps',function(){
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				//操作定位器应该提示必须首先选定工具编码 noSelectedPerson
				if( $(this).parents("ul.list").find(".noSelectedPerson").length >0 ){
					mui.alert("请先选择人员！");
					return false;
				}
				var obj_update = $(this).find(".updateObj").eq(0);//修改数据的操作对象
				var type = 'changGps';
				var twamId = $(this).attr('twamId');
				var gpsval = $(this).val();
				var gpsBoxContent = '';
				var gpsId = $(this).find(".updateObj").attr("value");
				var gpsCode = $(this).find(".updateObj").html();
				console.log(gpsval);
				var gpsUsedCodes = [];
				//操作对象：核心人员or施工人员
				var obj_type="adminPerson";
				if( $(this).parents(".ulBox_builders").length>0){
					obj_type="builders";
				}
				$('.Gps').find('.updateObj').each(function(i,n){
                	var gpsCodes = $('.Gps').find('.updateObj')[i];
                	if(gpsCodes.innerHTML != '无'){
                        gpsUsedCodes.push(gpsCodes.innerHTML);
                	}
                });
				var newgpsUsedCodes = remove(gpsUsedCodes,gpsCode);
				console.log(newgpsUsedCodes);
				var newGPSJSON = [];
				if (newgpsUsedCodes.length==0) {newGPSJSON=GPSLocateJson;}
				else{
					for(var i=0;i<newgpsUsedCodes.length;i++){
						GPSLocateJson = remove2(GPSLocateJson,newgpsUsedCodes[i]);
						console.log(newgpsUsedCodes[i]);
						console.log(newGPSJSON);
						newGPSJSON = GPSLocateJson;
					}
					console.log(22);
				}
					
					console.log(GPSLocateJson);
					console.log(newGPSJSON);
				//alert(twamId);return false;
				//构造测试数据
				//var gpsArray = newGPSJSON;
				//console.log(gpsArray);
				gpsBoxContent += '<option selected value="'+gpsId+'">'+gpsCode+'</option>';
                $.each(newGPSJSON,function(index,row){
                	if (gpsval==row['GPSId']) {gpsBoxContent += '<option selected value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';}
                	else gpsBoxContent += '<option value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';
                })
				var gpsBox = '<p>'+'<select class="gps mui-select tiny">'+gpsBoxContent+'</select>'+'</p>';
				mui.confirm(gpsBox,'下拉选择定位器',btnArray,function(e){
                     if(e.index == 1){
                     	var GPSTxt = $('.gps option:selected').html();
						var GPSId = $('.gps option:selected').val();
						obj_update.html(GPSTxt);//先更新页面显示，再修改后台。
                     	$.ajax({
						url: '<?=CURRENT_DIR?>/index_add.php?',
						type: 'POST',
						dataType: 'json',
						data: {
							'type':type,
							'GPSId':GPSId,
							'twamId':twamId,
							'obj_type':obj_type
						},
					})
					.done(function(msg) {
						
						
 						//console.log(msg);
						//location.reload();
					})
					.fail(function(msg){
						console.log(1);
					})
                     }else{
                     	console.log(2);
                     }
				})
			})
            //获取多选框的选中值
            mui('.mui-scroll').on('change', 'input', function() {
			var value = this.checked?"true":"false";
			if(this.checked){
				console.log($(this).val())
			}
		   });

		   //确认准备完毕
		   $("#submit_confirm").on('click',function(){
				var txt = '<span style="color:#f30">确认后不可再修改，请谨慎操作！</span>';
				var twtltWorkOrderId = <?=$_GET['twOrderId']?>;
				mui.confirm(txt, '确认准备完毕', btnArray, function(e) {
						if(e.index==1){
						//alert(twtltWorkOrderId);return false;
						$.ajax({
							url: '<?=CURRENT_DIR?>/../toolsCheck/index_orderConfirmed.php?',
							type: 'POST',
							dataType: 'json',
							data: {
								'type': 'confirmed_persons',
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
	</body>

</html>