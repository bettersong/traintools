<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>工器具准备</title>
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		.mui-table-view-cell img {
	width:110px
}
.list {
	display:flex;
	justify-content:space-between;
	line-height:35px;
	color:#555;
	font-size:13px
}
.list li {
	text-align:center;
	width:80px
}
.switch {
	margin-top:5px
}
.amount {
	width:10%!important
}
.selBigId {
	width:87px !important;
}
.selBag {
	width:87px !important
}
.delete {
	color:#1989fa
}
.mui-popover {
	height:130px
}
.checkbox {
	left:10px!important;
	top:10px!important
}
.bigTools {
	margin-top:15px
}
.submit {
	display:block;
	margin:20px auto;
	width:80%;
	margin-bottom:120px
}
#div {
	width:0;
	height:0;
	background:red;
	position:fixed;
	top:30%;
	left:50%
}
select {
	border:1px solid rgba(0,0,0,.15)!important;
	border-radius:6px;
	background:transparent;
	height:40px;
	padding:0 0 0 10px!important;
	background:url(/public/images/pulldown.png) no-repeat;
	background-position:right;
	background-size:20px
}
.smallBtn {
	margin:0 auto
}
.smallto {
	z-index:99999
}
.toolsbag {
	width:38px;
	height:38px;
	vertical-align:middle;
	opacity:.2
}
.gray {
	opacity:1
}
.actice {
	color:red
}
.bg_id {
	display:inline-block;
	width:46%;
	text-align:center;
	border:1px solid #eee;
	margin:5px 2% 0;
	border-radius:3px
}
.toolBagNum {
	color:#555
}
.delete img {
	width:18px
}
.selBag img,.selBigId img {
 	width:16px;
	margin-top:-3px
}
.amount img {
	width:12px;
	margin-top:-2px
}
.selBigGps img {
	width:16px;
	margin-top:-3px
}
	    ul.th li{color:#111;}
		.history{opacity: 0.2;}
	
		
		</style>

	</head>
	<body class="muia">

		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">工器具准备</h1>
		</header>
		<div class="mui-content" >
			<div class="mui-page-content" >
					<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style=";padding:20px 0px 0px 5px">  
						<div class="smallTools">
						<input class="<?=$_GET['orderType']?>" type="submit" value="添加小工具" id='smallbtn'>
						<ul class="th mui-table-view mui-table-view-chevron list">
							<li>工具名称</li>
							<li class='amount'>数量</li>
							<li>所在仓库</li>
							<li>选择工具包</li>
							<li>删除</li>
						</ul> 
						<div id='ulBox'>
						<?php foreach ($toolsArr as $key => $value) { ?>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li id='<?=$value['twtlToolId']?>' tid='<?=$value['twtlId']?>' class='smallToolName smallId'><?=$value['twtlName']?></li>
							<li class='amount amount1' tid='<?=$value['twtlId']?>' bgid='<?=$value['tb_id']?>' smallId='<?=$value['twtlToolId']?>' num='<?=$value['twtlAmount']?>'>
								<span class="updateObj"><?=$value['twtlPreparedAmount']?></span>
								<img class="<?=$_GET['orderType']?>" src="/public/images/edit.png?a2" />
							</li>
							<li><?=$value['waMessageName']?></li>
							<li class="selBag" tid='<?=$value['twtlId']?>' bgid='<?=$value['tb_id']?>' smallId='<?=$value['twtlToolId']?>' num='<?=$value['twtlAmount']?>'>
							 <span class="updateObj"><?php
							   if ($value['twtltToolBagId']==0) echo "<span class=' smallTools_null ".$_GET['orderType']."'>选择工具包</span>";
							   else echo $value['tb_name'];
							?></span>
							<img class="<?=$_GET['orderType']?>" src="/public/images/pulldown.png?a2">
					        </li>
							<li class='delete <?=$_GET['orderType']?>' tid='<?=$value['twtlId']?>'><img src="/public/images/delete.png?a1"></li>
						</ul>
						<?php } ?>
						</div>
						</div>
						<div class="bigTools">
						<input class="<?=$_GET['orderType']?>" type="submit" value="添加大工具" id='bigbtn'>
						<ul class="th mui-table-view mui-table-view-chevron list">
							<li>工具名称</li>
							<li>所在仓库</li>
							<li>工具编号</li>
							<li>定位器</li>
							<li>删除</li>
						</ul> 
						<div id='ulBox2'>
						<?php  foreach ($toolsArr_big as $key => $value) { ?>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li><?=$value['twtlName']?></li>
							<li><?=$value['waMessageName']?></li>
							<li class="selBigId" DetailId=<?=$value['DetailId']?> IDbig=<?=$value['IDbig']?> twtlId=<?=$value['twtlId']?> toListId=<?=$value['toListId']?> >
								<span class="updateObj detail_<?=$value['toListId']?>" value="<?=$value['DetailId']?>"><?php
									if ($value['DetailCode']!="") echo $value['DetailCode'];
									else echo "<span class='bigTools_null ".$_GET['orderType']."'>选择编号</span>";
								?></span>
								<img class="<?=$_GET['orderType']?>" src="/public/images/pulldown.png?a2">
							</li>
							<li class="selBigGps" IDbig=<?=$value['IDbig']?> twtlId=<?=$value['twtlId']?> toListId=<?=$value['toListId']?> >
							<span class="updateObj gpscode gpscode_<?=$value['toListId']?>" value="<?=$value['GPSId']?>"><?php
									if ($value['GPSCode']=="") echo "无";
									else echo $value['GPSCode'];
								?></span>
								<img class="<?=$_GET['orderType']?>" src="/public/images/pulldown.png?a2"></li>
							<li class="delete <?=$_GET['orderType']?>" IDbig=<?=$value['IDbig']?> twtlId=<?=$value['twtlId']?> toListId=<?=$value['toListId']?>><img src="/public/images/delete.png?a1"></li>
						</ul>
						<?php } ?>
						</div>
						</div>
						<button type="button" id="submit_confirm" class="<?=$_GET['orderType']?> mui-btn mui-btn-success submit">确认准备完毕
						</button>
				</div>
			</div>
		</div>
		<div class="<?php if( $orderInfoArr['twOrderConfirmed_tools']==1) echo 'confirmedTools';?>" title="已确认完毕">&nbsp;</div>
		<script src=" /public/js/jquery-1.8.3.min.js"></script>
		<script src="/public/js/mui.min.js"></script>
		<script type="text/javascript">
		    var isHistory = "<?=$_GET['orderType']=='history'?'yes':'no'?>";
			var CURRENT_DIR = "<?=CURRENT_DIR?>";
			var toolsArr_big_All = <?=$toolsArr_big_AllJson?>;
			var toolsAllArr = <?=json_encode($toolsAllArr)?>;
			var toolsArr = <?=json_encode($toolsArr)?>;
			var tool_tbgJson = <?=$tool_tbgJson?>;
			var toolsArr_big = <?=json_encode($toolsArr_big)?>;
			console.log(toolsArr_big);
			var twtltWorkOrderId = <?=json_encode($_GET['twOrderId']) ?>;
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
			var btnArray = ['取消', '确认'];
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
			//DetailCode
			function remove3(arr,item){
				var result = [];
				for(var i=0;i<arr.length;i++){
                 if(arr[i]['DetailCode'] != item){
                 	result.push(arr[i]);
                 }
				}
				return result;
			}
			//添加小工具弹出框
			document.getElementById("smallbtn").addEventListener("tap", function() {
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				//调用隐藏/显示弹出层
				//构造弹窗内容
				//工具名称
				var tolOption = "";
				console.log(toolsAllArr);
				if(toolsAllArr == ''){
                     console.log(0);
                     tolOption += '<option value="">无</option>';
                }
                else{
                	$.each(toolsAllArr,function(index,row){
                    //alert(device_id);
                      tolOption += '<option value="'+row['toListId']+'">'+row['toListName']+'</option>';
                });
                }
                
                var smallSelect1 = '<p>'+'<label>请选择小工具：</label>'+'<select class="smalltool mui-select tiny" id="select">'+tolOption+'</select>'+'</p>';
				//工具包
				var toosBagImg = '';
				$.each(tool_tbgJson,function(index,row){
					toosBagImg += '<div class="bg_id">'+'<img class="toolsbag" id="'+row['tb_id']+'" rfidReader_code="'+row['rfid_reader_code']+'" src="/public/images/icon-png/toolbag3.png" /><div class="toolBagNum">'+row['tb_name']+'</div></div>';
				});
				//alert(toosBagImg);
				var tooslbag1 = '<p style="margin:0 0 0;">'+'<label>请选择工具包：<label>'+toosBagImg+'</p>';
                //数量
                var numIput = '<p>'+'<label>数量：</label>'+'<input class="smalltoolsNum" type="text" value="">'+'</p>';
				mui.confirm(smallSelect1+tooslbag1+numIput, '添加小工具', btnArray, function(e) {
					if(e.index==1){//$(this).hasClass('gray')
					var smalltoolsId = $('.smalltool option:selected').val();
				    var smalltoolsbag = '';
				    //构造获取选中工具包的方法
				    $('.muia').find('.gray').each(function(){
                        smalltoolsbag += $(this).attr('id');//工具包
				    	
				    //}	
				    });
					 
					var smalltoolsNum = $('.smalltoolsNum').val();
					console.log(smalltoolsNum);
					console.log(typeof(parseInt(smalltoolsNum)));
					if(smalltoolsNum==''){
						mui.alert('数量不能为空','提示');
						return false;
					}
					if(typeof(parseInt(smalltoolsNum)) != 'number'){
						mui.alert('数量类型有误！');
					}
					var type='add';
					if (smalltoolsbag=="") smalltoolsbag=0;
						$.ajax({
							url: '<?=CURRENT_DIR?>/index_add.php?',
							type: 'POST',
							dataType: 'json',
							data: {
								'type':type,
								'twtltWorkOrderId':twtltWorkOrderId,
								'smalltoolsId' :smalltoolsId,
								'smalltoolsNum':smalltoolsNum,
								'smalltoolsbag':smalltoolsbag,
							},
						})
						.done(function(msg) {
							mui.toast("添加完成");
							location.reload();
						})
						.fail(function(msg) {
							console.log("error");
						})
					}else{
					}
				})

			});
			//小工具选择工具包selBag

			$('#ulBox').on('click','.selBag',function(){
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				var thisObj =  $(this);
				var obj_update = $(this).find(".updateObj").eq(0);//修改数据的操作对象
				var tid = $(this).attr('tid');
				var smalltoolsId = $(this).attr('smallid');
				//var smalltoolsNum=$(this).attr('num');
				var bgid = $(this).attr('bgid');
				
              //工具包
				var toosBagImg = '';
				$.each(tool_tbgJson,function(index,row){
					if(row['tb_id'] == bgid){
					  toosBagImg += '<div class="bg_id">'+'<img class="toolsbag gray" id="'+row['tb_id']+'" rfidReader_code="'+row['rfid_reader_code']+'" src="/public/images/icon-png/toolbag3.png" /><div class="toolBagNum">'+row['tb_name']+'</div></div>';	
					}else{
					  toosBagImg += '<div class="bg_id">'+'<img class="toolsbag" id="'+row['tb_id']+'" rfidReader_code="'+row['rfid_reader_code']+'" src="/public/images/icon-png/toolbag3.png" /><div class="toolBagNum">'+row['tb_name']+'</div></div>';	
					}
					
				});
				var tooslbag1 = '<p>'+toosBagImg+'</p>';//'<p>'+'<label>请选择工具包：<label>'+toosBagImg+'</p>';
                mui.confirm(tooslbag1, '请选择工具包', btnArray, function(e) {
					if(e.index==1){
					var smalltoolsbag = '';
					var rfidReader_code = '';//工具包的读取器编码
				    //构造获取选中工具包的方法
						smalltoolsbag =$('.toolsbag.gray').eq(0).attr('id');
						smalltoolsbagName =$('.toolsbag.gray').eq(0).next(".toolBagNum").eq(0).text();
						rfidReader_code += $('.toolsbag.gray').eq(0).attr('rfidReader_code');//工具包
					//});
				    var twtltWorkOrderId = <?=json_encode($_GET['twOrderId']) ?>;
                    var type='updateToolBag';
					//未选择工具包，弹出提示
                    if (smalltoolsbag=="" || smalltoolsbag==undefined){
						mui.alert("请选择工具包");
						return false;
				    }
                    $.ajax({
                   	url: '<?=CURRENT_DIR?>/index_add.php?',
                   	type: 'POST',
                   	dataType: 'json',
                   	data: {
                   		'type': type,
                   		'tid':tid,//
                   		'twtltWorkOrderId':twtltWorkOrderId,//
                   		'smalltoolsId':smalltoolsId,//
                   		'smalltoolsbag': smalltoolsbag,//
                   	},
                   	success: function (msg){
						obj_update.html(smalltoolsbagName);
						thisObj.attr("bgid",smalltoolsbag)
						//location.reload();
                    },
                    error: function(msg){
				            mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
				            console.log(msg);
				        }
                   })

			}
            });
});
            $('.muia').on('click','.toolsbag',function(){
                    $('.gray').removeClass('gray');
                  	$(this).toggleClass("gray");
                    });
			
            $(function(){
			//删除小工具
            $('#ulBox').on('click','.delete',function(){
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
                var thisObj = $(this);
				mui.confirm("确定要删除吗？", '提示', btnArray, function(e) {
					if(e.index==1){
						thisObj.parents('ul').remove();
						var twtlId = thisObj.parents('ul').find('.smallId').attr('tid');
						$.ajax({
							url: '<?=CURRENT_DIR?>/index_delete_small.php?',
							type: 'POST',
							dataType: 'json',
							data: {
								'twtlId': twtlId
							},
						})
						.done(function(msg) {
							mui.toast("删除成功");
							location.reload();
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
             		console.log(false);
             	}else{
             		$(this).addClass('mui-active');
             		console.log(true);
             	}
             	
             })
            })
			//小工具编辑数量
			$('#ulBox').on('click','.amount',function(){
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				//var smalltoolsNum=$(this).attr('num');
                var obj_update = $(this).find(".updateObj").eq(0);//修改数据的操作对象
				var amount = $(this).find('.updateObj').html();
				console.log(amount);
				var smallToolName  = $(this).parents("ul").eq(0).find(".smallToolName").eq(0).text();
				var smalltoolsId = $(this).attr('smallid');
				var tid = $(this).attr('tid');
				var smalltoolsbag = $(this).attr('bgid');
				mui.prompt('',amount,'修改数量',function(e){
				  if(e.index == 1){
				   var newAmount = e.value;
                    
				    //var smalltoolsNum=$('.amount1').attr('num');
				    var twtltWorkOrderId = <?=json_encode($_GET['twOrderId']) ?>;
				    
                    var type='updateNums';
                    if (smalltoolsbag=="") smalltoolsbag=0;
					if(newAmount==""){
						mui.alert("没有修改");
						return false;
					}
					var thisToolNums = 0;
					//判断参考中该工具中的数量
					 
					$.ajax({
						async:false,
						url: '<?=CURRENT_DIR?>/index_getThisTtoolNums.php',
						type: 'POST',
						dataType: 'json',
						data: {							 
							'smalltoolsId':smalltoolsId 
						},
						success: function (msg){
							 
						 thisToolNums = msg;
						  
						//location.reload();
						},
						error: function(msg){
							alert(msg);
								console.log(msg);
						}
                   })
				 if(newAmount > thisToolNums){
					 mui.alert("超过仓库数量，"+smallToolName+"仓库中数量为"+thisToolNums);
					 return false;
				 }
				//修改数量
                   $.ajax({
                   	url: '<?=CURRENT_DIR?>/index_add.php?',
                   	type: 'POST',
                   	dataType: 'json',
                   	data: {
                   		'type': type,
                   		'tid':tid,//
                   		'twtltWorkOrderId':twtltWorkOrderId,//
                   		'smalltoolsId':smalltoolsId,//
                   		'smalltoolsNum':newAmount,
                   		'smalltoolsbag': smalltoolsbag,//
                   	},
                   	success: function (msg){
					  obj_update.html(newAmount);
                      //location.reload();
                    },
                    error: function(msg){
				            console.log(msg);
				        }
                   })
				}else{
					console.log('取消');
				}   
				})

			});
			//小工具end

			//大工具start
			//大工具添加
            document.getElementById("bigbtn").addEventListener("tap", function() {
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
                //构造弹窗内容
				//工具名称
				var tolOption = "";
                $.each(toolsArr_big_All,function(index,row){
                    //alert(device_id);
                     tolOption += '<option value="'+row['toListId']+'">'+row['toListName']+'</option>';
                });
                var bigSelect = '<p>'+'<label>请选择大工具：</label>'+'<select class="smalltool mui-select tiny" id="select">'+tolOption+'</select>'+'</p>';
				
				mui.confirm(bigSelect, '添加大工具', btnArray, function(e) {
					if(e.index==1){
					var bigtoolsId = $('.smalltool option:selected').val();
				    var twtltWorkOrderId = <?=json_encode($_GET['twOrderId']) ?>;
					var type='add';
					$.ajax({
						url: '<?=CURRENT_DIR?>/index_add_big.php?',
						type: 'POST',
						dataType: 'json',
						data: {
							'type':type,
							'twtltWorkOrderId':twtltWorkOrderId,
							'bigtoolsId' :bigtoolsId,
						},
					})
					.done(function(msg) {
						console.log(msg); 
						if(msg=='error'){
						mui.alert("仓库数量不足！");
						}else{
						mui.toast("添加完成");
						location.reload();
						}
						
					})
					.fail(function(msg) {
						console.log(msg);
						mui.alert(msg.status+'添加失败');
						console.log(twtltWorkOrderId,bigtoolsId);
					})
					}else{
					}
				})

            });
            //大工具工具编号
            var detailJson = '';
            $('#ulBox2').on('click','.selBigId',function(){
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				var obj_update = $(this).find(".updateObj").eq(0);//修改数据的操作对象
				var toListId = $(this).attr('toListId');
				var twtlId = $(this).attr('twtlId');
				var IDbig = $(this).attr('IDbig');
				var DetailId = $(this).attr('DetailId');
				var thisId = $(this).find('.updateObj').html();
				console.log(thisId);
				var bigIdOption = '';
				var usedId = [];
				$('.selBigId').find('.updateObj').each(function(i,n){
                	var gpsCodes = $('.selBigId').find('.updateObj')[i];
                	if(gpsCodes.innerHTML != '选择编码'){
                        usedId.push(gpsCodes.innerHTML);
                	}
                });
                //console.log(usedId);
                usedId = remove(usedId,thisId);
                //console.log(usedId);
                //alert(twtlId+"  toListId:"+toListId);
                $.ajax({
                   	url: '<?=CURRENT_DIR?>/index_big_toolNum.php',
                   	type: 'POST',
                   	dataType: 'json',
                   	data: {
						'twtlId':twtlId,
                   		'toListId':toListId,//
                   	},
                   	success: function (msg){
						   
                   		detailJson = msg;
                   		console.log(detailJson);
                   		var newdetailJson = [];
		                for(var i=0;i<usedId.length;i++){
		                	newdatailJson = remove3(detailJson,usedId[i]);
		                }
		                console.log(detailJson);
		                if(detailJson==''){
		                	bigIdOption += '<option selected value="">'+'无'+'</option>';
		                }else{
		                $.each(detailJson,function(index,row){
						if(row['DetailId']==DetailId){
							bigIdOption += '<option selected value="'+row['DetailId']+'">'+row['DetailCode']+'</option>';
						}
						else{
							bigIdOption += '<option value="'+row['DetailId']+'">'+row['DetailCode']+'</option>';
						}
						});	
		                }
						
						var tooslbag1 = '<p>'+'<select class="bigid">'+bigIdOption+'</select>'+'</p>';
                		mui.confirm(tooslbag1, '请选择工具编号', btnArray, function(e) {
						if(e.index==1){
							var bigid = $('.bigid option:selected').val();
							var bigCode = $('.bigid option:selected').html();
							obj_update.html(bigCode).attr("value",bigid);
							var bigidStrs = "";//id集合
							$(".detail_"+toListId).each(function(index, element) {
								bigidStrs += ","+$(this).attr("value");
							});
							bigidStrs = bigidStrs.substr(1);
                    		var type='update';
                    		$.ajax({
                   				url: '<?=CURRENT_DIR?>/index_add_big.php?',
                   				type: 'POST',
                   				dataType: 'json',
                   				data: {
                   					'type': type,
                   					'twtlId':twtlId,
                   					'IDbig':IDbig,
                   					'toListId':toListId,//
                   					'bigid':bigidStrs,//
                   				},
                   			success: function (msg){
								//更新大工具对应的默认绑定的定位器
								var gpscode = msg;
								obj_update.parents("ul.list").find(".gpscode").html(gpscode);
                   				//console.log(msg);
                    		},
                    		error: function(msg){
				            	mui.alert(msg.status + "服务繁忙2，请刷新或稍后再试。");
				        	}
                   		})

			     	}
                });
                    },
                    error: function(msg){
				            mui.alert(msg.status + "服务繁忙1，请刷新或稍后再试。");
				        }
                   })
				
            });
            //大工具定位器
            var gpslibJson = <?=$gpslibJson?>;
            console.log(gpslibJson);            
            $('#ulBox2').on('click','.selBigGps',function(){
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				//操作定位器应该提示必须首先选定工具编码 bigTools_null
				if( $(this).parents("ul.list").find(".bigTools_null").length >0 ){
					mui.alert("请先选择工具编码！");
					return false;
				}
				var obj_update = $(this).find(".updateObj").eq(0);//修改数据的操作对象
				var toListId = $(this).attr('toListId');
				var twtlId = $(this).attr('twtlId');
				var IDbig = $(this).attr('IDbig');
				var bigIdOption = '';
				var gpsId = $(this).find(".updateObj").attr("value");
				var gpsCode = $(this).find(".updateObj").html();
				var gpsUsedCodes = [];//保存已使用的定位器
                $('.selBigGps').find('.updateObj').each(function(i,n){
                	var gpsCodes = $('.selBigGps').find('.updateObj')[i];
                	if(gpsCodes.innerHTML != '无'){
                        gpsUsedCodes.push(gpsCodes.innerHTML);
                	}
                });
				var newgpsUsedCodes = remove(gpsUsedCodes,gpsCode);
				var newGPSJSON = [];
				if (newgpsUsedCodes.length==0) {newGPSJSON=gpslibJson;}
				else{
					for(var i=0;i<newgpsUsedCodes.length;i++){
						gpslibJson = remove2(gpslibJson,newgpsUsedCodes[i]);
					}
					newGPSJSON = gpslibJson;
				}
					
				console.log(gpslibJson);
				console.log(newGPSJSON);
				bigIdOption += '<option selected value="'+gpsId+'">'+gpsCode+'</option>';
				$.each(newGPSJSON,function(index,row){	
					bigIdOption += '<option value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';	
				});
				var tooslbag1 = '<p>'+'<select class="bigGps">'+bigIdOption+'</select>'+'</p>';
                mui.confirm(tooslbag1, '下拉选择定位器', btnArray, function(e) {
					if(e.index==1){
					var smalltoolsbag = '';
					var bigGps = $('.bigGps option:selected').val();
					var bigGpsHtml = $('.bigGps option:selected').html();
 				    obj_update.html(bigGpsHtml).attr("value",bigGps);

                    var type='GPS';
                    $.ajax({
                   	url: '<?=CURRENT_DIR?>/index_add_big.php?',
                   	type: 'POST',
                   	dataType: 'json',
                   	data: {
                   		'type': type,
                   		'toListId':toListId,//
                   		'twtlId':twtlId,
                   		'bigGps':bigGps,
                   		'IDbig':IDbig,
                   	},
                   	success: function (msg){
						
                   		console.log(msg);
                    },
                    error: function(msg){
				            mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
				            console.log(msg);
				        }
                   })

			     }
                   });
            });
            //删除大工具
            $('#ulBox2').on('click','.delete',function(){
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				var thisObj = $(this);
				mui.confirm("确定要删除吗？", '提示', btnArray, function(e) {
					if(e.index==1){
						thisObj.parents('ul').remove();
						var IDbig = thisObj.attr('IDbig');
						var twtlId = thisObj.attr('twtlId');
						$.ajax({
							url: '<?=CURRENT_DIR?>/index_delete.php?',
							type: 'POST',
							dataType: 'json',
							data: {
								'twtlId':twtlId,
								'IDbig':IDbig,
							},
						})
						.done(function(msg) {
							mui.toast("删除成功");
							location.reload();
						})
						.fail(function(msg) {
							console.log(msg);
							console.log("error");
						})
				    }
			   });

            });
			
            //获取多选框的选中值
            mui('.mui-scroll').on('change', 'input', function() {
			var value = this.checked?"true":"false";
			if(this.checked){
				console.log($(this).val());
			}
		   });
            
		   //确认准备完毕
		   $("#submit_confirm").on('click',function(){
				//判断小工具和大工具是否有未准备的
				if( $(".smallTools_null").length>0 ){mui.alert("<span style='color:#f30'>请把全部小工具放入工具包</span>"); return false;}
				else if( $(".bigTools_null").length>0 ){mui.alert("<span style='color:#f30'>请选择相应的大工具</span>"); return false;}
				//提交确认
				if(isHistory=="yes"){mui.alert("<span style='color:#f30'>非编辑状态</span>"); return false;} //历史工单等，设为不可编辑
				var txt = '<span style="color:#f30">确认后不可再修改，请谨慎操作！';
				mui.confirm(txt, '确认准备完毕', btnArray, function(e) {
						if(e.index==1){
						//alert(twtltWorkOrderId);return false;
						$.ajax({
							url: '<?=CURRENT_DIR?>/index_orderConfirmed.php',
							type: 'POST',
							dataType: 'json',
							data: {
								'type': 'confirmed_tools',
								'twtltWorkOrderId':twtltWorkOrderId
							},
							success: function (msg){
								mui.toast("确认完成");
								setTimeout('location.reload()',1000);
							},
							error: function(msg){
									mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
								}
						});
					} 
				});
		   });//end确认
		   //如已确认完毕则弹出框提示
		   $(".confirmedTools").click(function(e) {
             mui.toast("已确认，无法操作"); 
			 return false;
          });

		</script>
	</body>

</html>