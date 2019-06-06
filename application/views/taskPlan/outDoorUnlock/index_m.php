<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>高铁检修综合管理平台</title>
		<link rel="stylesheet" href="/public/css/mui.min.css">
		
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		.mui-table-view-cell img{
			width: 110px;
		}
		.list{display: flex;justify-content: space-between;line-height: 35px;color:#666;font-size: 13px;}
		.list li{text-align: center;width:80px;}
		.switch{margin-top:5px;}
		.top{padding:5px;width:100px;margin:0 auto;}
		.top img{vertical-align: middle;}
		.mui-popover {height: 130px;}
		.checkbox{left:10px !important;top:10px !important;}
		.hint{margin-top:30px;}
	    </style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">出门开锁</h1>
		</header>
		<div class="mui-content" >
						<div class="mui-page-content" >
				<div class="mui-scroll-wrapper">
					<div class="mui-scroll" style="padding:30px 0px 0px 5px">
						<ul class="mui-table-view mui-table-view-chevron">
							<li class='top'><img src='/public/images/out.png'>出门开锁</li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>工单编号</li>
							<li>工单时间</li>
							<li>安全门编号</li>
							<li>开关锁控制</li>
							
						</ul>
						<div id='ulBox'>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>23456</li>
							<li>2018-01-06</li>
							<li>二号安全门</li>
							<li>
							<div class="mui-switch mui-active switch">
						       <div class="mui-switch-handle"></div>
					        </div>
					        </li>
						</ul>
						
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>23457</li>
							<li>2018-01-06</li>
							<li>二号安全门</li>
							<li>
							<div class="mui-switch mui-active switch">
						       <div class="mui-switch-handle"></div>
					        </div>
					        </li>
						</ul>
						<ul class="mui-table-view mui-table-view-chevron list">
							<li>23458</li>
							<li>2018-01-06</li>
							<li>一号安全门</li>
							<li>
							<div class="mui-switch mui-active switch">
						       <div class="mui-switch-handle"></div>
					        </div>
					        </li>
						</ul>
						</div>
						<div class='hint'>
							<span style='color:red'>操作提示：</span>点击开/关,控制相应编号的远程安全门
						</div>
					</div>
				</div>
			</div>
			<!--弹出多选框-->
			<div id="middlePopover" class="mui-popover">
			<div class="mui-popover-arrow"></div>
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					
					<div class="mui-input-row mui-checkbox mui-left">
						<label>编号235621</label>
						<input name="checkbox" value="编号235621" type="checkbox" class='checkbox'>
					</div>
					<div class="mui-input-row mui-checkbox mui-left">
						<label>编号235622</label>
						<input name="checkbox" value="编号235622" type="checkbox" class='checkbox'>
					</div>
					<div class="mui-input-row mui-checkbox mui-left">
						<label>编号235623</label>
						<input name="checkbox" value="编号235623" type="checkbox" class='checkbox'>
					</div>
				
			        
				</div>
			</div>

		</div>
			
			
		</div>
		<script src="/public/js/mui.min.js"></script>
		<script src=" /public/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript">
			mui.init();
			mui('.mui-scroll-wrapper').scroll();
            $(function(){
            //添加
			$('#btn').on('click',function(){
				$('#ulBox').append('<ul class="mui-table-view mui-table-view-chevron list">'+'<li>扳手</li>'+'<li class="amount">5<img src="/public/images/edit.png"></li>'+'<li><a href="#middlePopover">无<img src="/public/images/jia.png"></a></li>'+'<li>1号仓库</li>'+'<li><div class="mui-switch switch newSwitch"><div class="mui-switch-handle"></div></div></li>'+'<li class="delete">删除</li></ul>');
			})
			//删除
            $('#ulBox').on('click','.delete',function(){
             	$(this).parents('ul').remove();
             	console.log($(this));
             })
            //解决动态创建元素的事件委托
            $('#ulBox').on('click','.newSwitch',function(){
             	console.log($(this));
             	if($(this).hasClass('mui-active')){
             		$(this).removeClass('mui-active');
             		console.log(false);
             	}else{
             		$(this).addClass('mui-active');
             		console.log(true);
             	}
             	
             })
            })
			//编辑数量
			$('#ulBox').on('click','.amount',function(){
				var amount = $(this).text();
				mui.prompt('修改数量',amount,function(e){
                   console.log(1);
				})
			})
            //获取多选框的选中值
            mui('.mui-scroll').on('change', 'input', function() {
			var value = this.checked?"true":"false";
			if(this.checked){
				console.log($(this).val())
			}
		   });
            


		</script>
	</body>

</html>