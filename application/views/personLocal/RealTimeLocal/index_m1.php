<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>高铁检修综合管理平台</title>
	<link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/local.css?<?=rand(1,99999)?>" />
    <link rel="stylesheet" href="/public/css/tree.css?<?=rand(1,99999)?>" />
	<link rel="stylesheet" href="/public/css/mui.min.css">
		<style>
			html,
			body {
				background-color: #efeff4;
			}
			p {
				text-indent: 22px;
			}
			span.mui-icon {
				font-size: 14px;
				color: #007aff;
				margin-left: -15px;
				padding-right: 10px;
			}
			.mui-off-canvas-left {
				color: #fff;
			}
			.title {
				margin: 35px 15px 10px;
			}
			.title+.content {
				margin: 10px 15px 35px;
				color: #bbb;
				text-indent: 1em;
				font-size: 14px;
				line-height: 24px;
			}
			input {
				color: #000;
			}
		</style>
	</head>

	<body>
		<div id="offCanvasWrapper" class="mui-off-canvas-wrap mui-draggable">
			<!--侧滑菜单部分-->
			<aside id="offCanvasSide" class="mui-off-canvas-left">
				<div id="offCanvasSideScroll" class="mui-scroll-wrapper">
					<div class="mui-scroll">
						<div class="title">侧滑导航</div>
						<div class="content">
                        <div class="f-tree">
<!--  -->
<?php foreach($bManage as $index=>$catlog1){?>
 <div class="f-treeListWrapper">
    <div class="f-treeList f-treeListOne">
      <div class="f-treeList-top">
        <div class="f-treeList-old f-on">
          <span class="f-iconJian"></span>
        </div>
        <div class="f-treeList-title">
          <div class="f-treeList-radio">
            <span class=""></span>
            <input value="1"></div>
          <div class="f-treeList-titleImg">
            <span class="f-iconKai"></span>
          </div>
          <p class="f-treeList-titleP" tip="一级目录"><?=$catlog1['bManageBranch']?></p></div>
      </div>

      
      <div class="f-treeListWrapper show">
        <div class="f-treeList-lineShu"></div>
        <div class="f-treeList">
          <div class="f-treeList-top">
            <div class="f-treeList-old f-on">
              <span class="f-iconJian"></span>
            </div>
            <div class="f-treeList-title">
              <div class="f-treeList-radio">
                <span class="f-iconRadio"></span>
                <input value="2"></div>
              <div class="f-treeList-titleImg">
                <span class="f-iconKai"></span>
              </div>
              <p class="f-treeList-titleP" tip="二级目录"><?=$catlog1['subcatlog']['bmname']?></p></div>
          </div>

          <?php foreach($local as $index=>$userInfo){
            if($userInfo['bManageId'] ==$catlog1['bManageId']){?>
          <div class="f-treeListWrapper">
            <div class="f-treeList-lineShuEnd"></div>
            <div class="f-treeList" userid="<?=$userInfo['pManageId']?>" localX="<?=$userInfo['localrX']?>" localY="<?=$userInfo['localrY']?>" username="<?=$userInfo['pManageName']?>">
              <div class="f-treeList-top">
                <div class="f-treeList-lineEnd"></div>
                <div class="f-treeList-title">
                  <div class="f-treeList-radio radioName">
                    <span class="f-iconRadioTrue" class2="f-iconRadio f-iconRadioTrue"></span>
                    <input value="<?=$userInfo['pManageId']?>"></div>
                  <div class="f-treeList-titleImg">
                    <span class="f-iconEnd"></span>
                  </div>
                  <p class="f-treeList-titleP name" userid="<?=$userInfo['pManageId']?>" tip="姓名"><?php if($userInfo['pManageName']=='') echo 无;else echo $userInfo['pManageName']; ?></p></div>
              </div>
            </div>
          </div>
        <?php 
              } //end 遍历用户
            }//end catlog2
        ?>
        </div>
      </div>
       
    </div>
  </div>
  
</div>
<?php }//end catlog1?>
<div id="myMenu" style="position: fixed;">
        <ul>
            <li id="track"><div class="list_icon"><img src="/public/images/guiji.png">轨迹回放</div></li>
            <li><div class="list_icon showUserInfo" id="showUserInfo"><img src="/public/images/Tourist.png">人员信息</div></li>
        </ul>
        </div>
        <div id="mask"></div>
       <div class="box_right" style="display:none">
      
      <div style="max-width:360px; margin:10px auto;" id="test1">
    <!-- <P style="margin-top:20px;">请选择日期：<input type="text" id="test1" value=""> -->
    <!-- <button class="form-submit btn-orange" type="submit" id="btn">确 定</button> -->
    <!-- </P> -->
</div>

  </div>
							<span class="android-only">；4.Android手机按back键；5.Android手机按menu键
							</span>。
							<p style="margin: 10px 15px;">
								<button id="offCanvasHide" type="button" class="mui-btn mui-btn-danger mui-btn-block" style="padding: 5px 20px;">关闭侧滑菜单</button>
							</p>

						</div>
						
					</div>
				</div>
			</aside>
			<!--主界面部分-->
			<div class="mui-inner-wrap">
				<header class="mui-bar mui-bar-nav">
					<a href="#offCanvasSide" class="mui-icon mui-action-menu mui-icon-bars mui-pull-left"></a>
					<a class="mui-action-back mui-btn mui-btn-link mui-pull-right">关闭</a>
					<h1 class="mui-title">div模式右滑菜单</h1>
				</header>
				<div id="offCanvasContentScroll" class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll">
						<div class="mui-content-padded">
                        <div class="map" id="mapContainer">
                        <div style="position:absolute;bottom:60px;left:100px;z-index:999999;background:#ffac53" id="bo_text"><?php echo "该区域人数为：".count($local).",工具数量为：".count($localDevice); ?></div>
                        </div>
							<p style="padding: 5px 20px;margin-bottom: 5px;">
								<button id="offCanvasShow" type="button" class="mui-btn mui-btn-primary mui-btn-block" style="padding: 10px;">
									显示侧滑菜单
								</button>
							</p>
							

						</div>

						

					</div>
				</div>
				<!-- off-canvas backdrop -->
				<div class="mui-off-canvas-backdrop"></div>
			</div>
		</div>
		<script src="/public/js/mui.min.js"></script>
        <script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<script src="/public/js/laydate/laydate.js?1.0"></script>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    
</script>
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/toastr.min.js"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>

<script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<style>
.txtTip{
    color:#f30;
}
.amap-marker-content{
    color:#f30;
    border-bottom: 1px dashed #aaa;
}
</style>

<script>
console.log(JSON.parse('<?php echo json_encode($bManage);?>'));
toastr.options.positionClass = 'toast-top-center';
var APP_URL = "<?=APP_URL?>";
//鼠标进入地图区域让滚轮只能缩放不能滚动页面
$('#gaodeMap').bind('mousewheel', function () {
            return false;
   });
   var localDevice =JSON.parse('<?php echo json_encode($localDevice);?>');
    console.log(localDevice);

var localArr =JSON.parse('<?php echo json_encode($local);?>');
//$("#bo_text").html("该区域人数为+'localArr.length'+人");
console.log(localArr.length);
var markerArr = [];//用来保存被选择用户的经纬度
$(document).ready(function(){
$('.tab3').addClass("active1");
    /** 显示初始人员**/
    var markerList = [];
    var infoWindow = new AMap.InfoWindow();
    $.each(localArr, function(i, item){     
        //alert(item['username']);
        var localX=item['localrX'];
        var localY=item['localrY'];
        var username=item['pManageName'];
        var userid=item['localUserId'];
        //人员定位信息
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/z_green.svg', // 添加 Icon 图标 URL:z_green.svg表示在线，z_gray.svg表示离线中，
            title: username
        });
        //人员定位动态圆圈gif图
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/centerPt.gif', // 添加 Icon 图标 URL
            offset: new AMap.Pixel(-3, -25) // 相对于基点的偏移位置
        });
        //显示定位
        markerList.push(marker1,marker2);//多个点实例组成的数组
        markerArr[userid] = new Array(marker1,marker2);//把改用户的经纬度保存到数组中
        var userInfo='<p>'+'<strong>'+'我是'+username+'</strong>'+'</p>'+'<p>定位时间：2018-10-22</p>'+'<p> 工作状态：离线</p>' +
        '<p>考勤状态：迟到</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        //marker2.on('click', markerClick);
        
        function markerClick(e){
            //alert(e.target.getPosition());
            //console.log(111);
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
    });
    map.add(markerList);  
    /** 工具* */
    var DeviceArr=[];
    $.each(localDevice, function(i, item){     
        //alert(item['username']);
        var localX=item['localrX'];
        var localY=item['localrY'];
        var username=item['toListName'];
        var userid=item['localUserId'];
        var localTime=item['localTime'];
        //工具定位
        var tools = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),
            icon: '/public/images/tools.png', // 添加 Icon 图标 URL
            offset: new AMap.Pixel(-3, -25) // 相对于基点的偏移位置
        });
        
        //显示定位
        DeviceArr.push(tools);//多个点实例组成的数组
        markerArr[userid] = new Array(tools);//把改用户的经纬度保存到数组中
        var userInfo='<p>'+'<strong>'+username+'</strong>'+'</p>'+'<p>定位时间：'+localTime+'</p>';
        tools.content =userInfo;
        (tools).on('click', markerClick);
        //marker2.on('click', markerClick);
        map.add(DeviceArr);
        
        function markerClick(e){
            //alert(e.target.getPosition());
            //console.log(111);
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
    });
    
    /**初始化标志性建筑**/
    
    //仓库
    var buildingArr = [];
    var building1 = new AMap.Marker({
        position: new AMap.LngLat(115.867184, 28.750344),
        icon: APP_URL+'/public/images/cangku.png', 
        title: "仓库"
    });
    //仓库文字
    var building1_tip = new AMap.Marker({
        position: new AMap.LngLat(115.867184, 28.750344),   
        content:"仓库",
        offset: new AMap.Pixel(30, -35) // 相对于基点的偏移位置
    });

    //显示定位
    buildingArr.push(building1, building1_tip);//多个点实例组成的数组
    map.add(buildingArr);
    
    
    //显示定位
    //var markerList2 = [marker1, marker2];//多个点实例组成的数组
    //map.add(marker_chaungku);
    map.setFitView();  
 });

$(".f-iconRadio,.f-iconRadioTrue").click(function(e) {//选中显示定位
    //获取用户相关信息
    //var localXY = $(this).parents(".f-treeList").attr("localXY");
    var localX = $(this).parents(".f-treeList").attr("localX");
    var localY = $(this).parents(".f-treeList").attr("localY");
    var userid = $(this).parents(".f-treeList").attr("userid");
    var username = $(this).parents(".f-treeList").attr("username");
    //alert(username+" "+localX+" "+localY);
    
    //选中用户
   var markerList = [];
   if($(this).hasClass("f-iconRadio")){
       //设置选中样式
        $(this).removeClass("f-iconRadio").addClass('f-iconRadioTrue');
        m = $(this).parents('.radioName').find('input').val();
        //显示定位
        var infoWindow = new AMap.InfoWindow();
        //人员定位信息
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/z_green.svg', // 添加 Icon 图标 URL:z_green.svg表示在线，z_gray.svg表示离线中，
            title: username
        });
        //人员定位动态圆圈gif图
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/centerPt.gif', // 添加 Icon 图标 URL
            offset: new AMap.Pixel(-3, -25) // 相对于基点的偏移位置
        });
        
        //显示定位
        markerList.push(marker1,marker2);//多个点实例组成的数组;//var markerList = [marker1, marker2];//多个点实例组成的数组
        
        map.add(markerList);
        markerArr[userid] = markerList;//把改用户的经纬度保存到数组中
        var userInfo='<p>'+'<strong>'+'我是'+username+'</strong>'+'</p>'+'<p>定位时间：2018-10-22</p>'+'<p> 工作状态：离线</p>' +
        '<p>考勤状态：迟到</p>';
        //给Marker绑定单击事件
        marker1.content = marker2.content = userInfo;
       // marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        //marker2.on('click', markerClick);
        
        map.setFitView();
        function markerClick(e){
            //alert(e.target.getPosition());
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
          //组件加载
        AMapUI.loadUI([
            'overlay/SimpleMarker',//SimpleMarker
            'overlay/SimpleInfoWindow',//SimpleInfoWindow
            ]);
 }
 else {//取消定位
        
      $(this).removeClass('f-iconRadioTrue').addClass("f-iconRadio");
      map.remove(markerArr[userid]);
       //$('.amap-marker').eq(m-3).remove();

    }
});

//收缩和展开用户
var foldtag = true;
$(".f-treeList-top").click(function(e) {
    if(foldtag){
        $(this).parent(".f-treeList").eq(0).find(".f-treeListWrapper").removeClass("show").addClass("hide");
    $(this).parent(".f-treeList").eq(0).find(".f-iconJian").removeClass("f-iconJian").addClass("f-iconJia");
    $(this).parent(".f-treeList").eq(0).find(".f-iconKai").removeClass("f-iconKai").addClass("f-iconBi");
        foldtag = false;
    }
    else{
        $(this).parent(".f-treeList").eq(0).find(".f-treeListWrapper").removeClass("hide").addClass("show");
    $(this).parent(".f-treeList").eq(0).find(".f-iconJia").removeClass("f-iconJian").addClass("f-iconJian");
    $(this).parent(".f-treeList").eq(0).find(".f-iconBi").removeClass("f-iconBi").addClass("f-iconKai");
        foldtag = true;
    }
});
  /*$(window).resize(function(){
    location.reload();
  });*/
  window.onload = function(){
      $('.amap-toolbar').removeAttr("style").addClass('amap-toolbar1');
      $('.f-treeList-title').children('.f-treeList-titleP').addClass('name');
      $('.f-treeList-titleP').eq(0).removeClass('name');
      $('.f-treeList-titleP').eq(1).removeClass('name');
      $('.f-treeList-top').eq(0).find('.f-iconRadioTrue').hide();
  };
  //tab切换
  $('.box_left_head li').on('click',function(){
        var i = $(this).index();
        $('.box_left_head li').eq(i).addClass("active").siblings().removeClass("active");
        $(".box_left").show();
        $(".box_right").hide();
  });
//右键自定义菜单
var windowwidth;
var windowheight;
var checkmenu;
$(window).ready(function(){
 $('#myMenu').hide();
  $('.name').bind("contextmenu",function(e){
      userId = $(this).attr('userid');
      console.log(userId);
    //   $.ajax({
    //     async:false,
    //     type: "post",
    //     data: {
    //         "userid":userid,
    //     },
    //     dataType: 'json',
    //     url: "<?=CURRENT_DIR?>/index_add.php?",
    //     success: function (msg) {
    //         //var localArr =JSON.parse('<?php echo json_encode($local);?>');
    //              alert('success'); 
    //              //console.log(localArr);
    //           },
    //     error: function (msg) {
    //         alert(msg.status + "服务繁忙，请刷新或稍后再试。");
    //         console.log(oDate);
    //     }
    // });
    var thiswidth = $(this).width();
    var x = $(this).offset().top-130;
    //console.log(x);
    var y = $(this).offset().left + thiswidth+10;
    var username = $(this).parents(".f-treeList").attr("username");
    var userid = $(this).parents(".f-treeList").attr("userid");
    $("#showUserInfo").attr({"username":username,"userid":userid});
    //console.log($(this).find('p').html());
  windowwidth = $(window).width();
  windowheight = $(window).height();
  checkmenu = 1;
  $('#mask').css({
  'height': windowheight,
  'width': windowwidth
  });
  $('#myMenu').show(500); 
    $('#myMenu').css({
    'top':x,//e.pageY*0.5+'px',
    'left':y //e.pageX+20+'px'
    });
    return false;
 });
//点击人员信息
$("#showUserInfo").on('click',function(e) {
    var username = $(this).attr("username");
    var userid = $(this).attr("userid");
    alert("我的用户名是："+username+",用户id是："+userid);
});

$('#mask').click(function(){
$(this).height(0);
$(this).width(0);
$('#myMenu').hide(500);
checkmenu = 0;
return false;
});
$('#mask').bind("contextmenu",function(){
$(this).height(0);
$(this).width(0);
$('#myMenu').hide(500);
checkmenu = 0;
return false;
});
$(window).resize(function(){
if(checkmenu == 1) {
windowwidth = $(window).width();
 windowheight = $(window).height();
 $('#mask').css({
 'height': windowheight,
 'width': windowwidth,
 });
}
});
});
</script>
<script type="text/javascript">
var AMapUIProtocol = 'https:';
</script>
<!-- https 方式引入入口文件 -->
<script src="https://webapi.amap.com/ui/1.0/main.js"></script>
  <script>
    //初始化地图
      var map=new AMap.Map("mapContainer",{
        zoom:18,//缩放级别
        center:[115.869114,28.747864],
        resizeEnable: true
      });

//轨迹回放
var flag=true;
document.getElementById("track").onclick=function(){
  // alert("轨迹回放");
  //防止重复点击
  $('.box_left').hide();
  $('#myMenu').hide();
  $('.box_right').show();

        };

    //地图中添加地图操作ToolBar插件
    map.plugin(["AMap.ToolBar"], function() {
        toolBar = new AMap.ToolBar({locationMarker: customMarker}); //设置地位标记为自定义标记
        map.addControl(toolBar);
    });

    //历史工单
    laydate.render({
        elem: '#test1',
        position: 'static',
        done: function(value, date, endDate){
            $('#test1').change();  
            console.log(value); //得到日期生成的值，如：2018-08-18
            oDate = value;
            //console.log(date);
        }
    });
   $('.laydate-btns-confirm').click(function(){
    //console.log(oDate);
    $.ajax({
        async:false,
        type: "post",
        data: {
            "date":oDate,
            "userId":userId
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
            toastr.success('提交数据成功');
                datas = msg;
              },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
            console.log(oDate);
        }
    });
    console.log(datas);
    var localArray = [];
    datas.forEach(function(item){
         localArray.push([item.localrX,item.localrY])
    });
    console.log(localArray);
if(flag){
  //组件加载
AMapUI.loadUI([
    'overlay/SimpleMarker',
    'overlay/SimpleInfoWindow',
    ]);
//加载PathSimplifier
AMapUI.load(['ui/misc/PathSimplifier'], function(PathSimplifier) {

    if (!PathSimplifier.supportCanvas) {
        alert('当前环境不支持 Canvas！');
        return;
    }
    //启动页面
    initPage(PathSimplifier);
});
  function initPage(PathSimplifier) {
    //创建组件实例
    var pathSimplifierIns = new PathSimplifier({
        zIndex: 100,
        map: map, //所属的地图实例
        getPath: function(pathData, pathIndex) {
            //返回轨迹数据中的节点坐标信息
            return pathData.path;
        },
        getHoverTitle: function(pathData, pathIndex, pointIndex) {
            //返回鼠标悬停时显示的信息
            if (pointIndex >= 0) {
                //鼠标悬停在某个轨迹节点上
                return pathData.name + '，点:' + pointIndex + '/' + pathData.path.length;
            }
            //鼠标悬停在节点之间的连线上
            return pathData.name + '，点数量' + pathData.path.length;
        },
        renderOptions: {
            //轨迹线的样式
            pathLineStyle: {
                strokeStyle: 'red',
                lineWidth: 2,
                dirArrowStyle: true
            }
        }
    });
    //路径
    var Opoints =  localArray;
    pathSimplifierIns.setData([{
        name: datas[0].pManageName,
        path: Opoints
    }]);
    //创建一个巡航器
    
    var navg = pathSimplifierIns.createPathNavigator(0, //关联第1条轨迹
        {
            loop: true, //循环播放
            speed: 100
        });

    navg.start();
}
}
flag = false;
   })

</script>
		<script>
			mui.init();
			 //侧滑容器父节点
			var offCanvasWrapper = mui('#offCanvasWrapper');
			 //主界面容器
			var offCanvasInner = offCanvasWrapper[0].querySelector('.mui-inner-wrap');
			 //菜单容器
			var offCanvasSide = document.getElementById("offCanvasSide");
			if (!mui.os.android) {
				document.getElementById("move-togger").classList.remove('mui-hidden');
				var spans = document.querySelectorAll('.android-only');
				for (var i = 0, len = spans.length; i < len; i++) {
					spans[i].style.display = "none";
				}
			}
			 //移动效果是否为整体移动
			var moveTogether = false;
			 //侧滑容器的class列表，增加.mui-slide-in即可实现菜单移动、主界面不动的效果；
			var classList = offCanvasWrapper[0].classList;
			 //变换侧滑动画移动效果；
			mui('.mui-input-group').on('change', 'input', function() {
				if (this.checked) {
					offCanvasSide.classList.remove('mui-transitioning');
					offCanvasSide.setAttribute('style', '');
					classList.remove('mui-slide-in');
					classList.remove('mui-scalable');
					switch (this.value) {
						case 'main-move':
							if (moveTogether) {
								//仅主内容滑动时，侧滑菜单在off-canvas-wrap内，和主界面并列
								offCanvasWrapper[0].insertBefore(offCanvasSide, offCanvasWrapper[0].firstElementChild);
							}
							break;
						case 'main-move-scalable':
							if (moveTogether) {
								//仅主内容滑动时，侧滑菜单在off-canvas-wrap内，和主界面并列
								offCanvasWrapper[0].insertBefore(offCanvasSide, offCanvasWrapper[0].firstElementChild);
							}
							classList.add('mui-scalable');
							break;
						case 'menu-move':
							classList.add('mui-slide-in');
							break;
						case 'all-move':
							moveTogether = true;
							//整体滑动时，侧滑菜单在inner-wrap内
							offCanvasInner.insertBefore(offCanvasSide, offCanvasInner.firstElementChild);
							break;
					}
					offCanvasWrapper.offCanvas().refresh();
				}
			});
			 //主界面‘显示侧滑菜单’按钮的点击事件
			document.getElementById('offCanvasShow').addEventListener('tap', function() {
				offCanvasWrapper.offCanvas('show');
			});
			 //菜单界面，‘关闭侧滑菜单’按钮的点击事件
			document.getElementById('offCanvasHide').addEventListener('tap', function() {
				offCanvasWrapper.offCanvas('close');
			});
			 //主界面和侧滑菜单界面均支持区域滚动；
			mui('#offCanvasSideScroll').scroll();
			mui('#offCanvasContentScroll').scroll();
			 //实现ios平台原生侧滑关闭页面；
			if (mui.os.plus && mui.os.ios) {
				mui.plusReady(function() { //5+ iOS暂时无法屏蔽popGesture时传递touch事件，故该demo直接屏蔽popGesture功能
					plus.webview.currentWebview().setStyle({
						'popGesture': 'none'
					});
				});
			}
		</script>
	</body>

</html>