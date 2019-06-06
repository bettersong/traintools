<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>高铁检修综合管理平台</title>
	<link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/local.css?<?=rand(1,99999)?>" />
    <link rel="stylesheet" href="/public/css/tree.css?<?=rand(1,99999)?>" />
	  <link rel="stylesheet" href="/public/css/mui.min.css?<?=rand(1,99999)?>">
    <link rel="stylesheet" href="/public/css/app.css" />
    <link rel="stylesheet" href="/public/css/mui.picker.min.css" />
		<style>
			html,body{background-color:#efeff4}p{text-indent:22px}span.mui-icon{font-size:14px;color:#007aff;margin-left:-15px;padding-right:10px}.mui-off-canvas-left{color:#fff}.title{margin:35px 15px 10px}.title+.content{margin:10px 15px 35px;color:#bbb;text-indent:1em;font-size:14px;line-height:24px}input{color:#000}.f-tree{margin-top:30px;color:#000}.f-tree ul li{margin:10px;padding:3px}.f-tree ul li img{width:20px;height:20px;vertical-align:middle}#bo_text{display:block;width:100%;text-align:center;background:#ffac53}.topTitle{width:100%;height:50px;line-height:50px;text-align:center;margin:0 auto;color:#000;z-index:9999;display:block}.txtTip{color:#f30}.amap-marker-content{color:#f30;border-bottom:1px dashed #aaa}.left_firstLi{color:#fff;background:#cfe8a7}.clickAfter{color:blue}
		</style>
	</head>
	<body>
		<div id="offCanvasWrapper" class="mui-off-canvas-wrap mui-draggable">
			<!--主界面部分-->
			<div class="mui-inner-wrap">
				<header class="mui-bar mui-bar-nav">
					<a href="#offCanvasSide" class="mui-icon mui-action-menu mui-icon-bars mui-pull-left"></a>
					<a class="mui-action-back mui-btn mui-btn-link mui-pull-right">关闭</a>
					<h1 class="mui-title"></h1>
				</header>
				<div id="offCanvasContentScroll" class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll">
						<div class="mui-content-padded" style="margin:0px">
            <div class="map" id="mapContainer">
            <div style="position:absolute;bottom:45px;width:100%;z-index:999999;background:#ffac53" >
              <span id="bo_text"></span>
            </div>
            </div>
					</div>
				</div>
				<!-- off-canvas backdrop -->
				<div class="mui-off-canvas-backdrop"></div>
			</div>
		</div>
  </div>
<script src="/public/js/mui.min.js"></script>
<script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<script src="/public/js/laydate/laydate.js"></script>
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
<script src="/public/js/mui.picker.min.js?v=0.101"></script>
<script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<script>
var gps_x = <?=$_GET['gps_x']?>;
var gps_y = <?=$_GET['gps_y']?>;
var type = '<?=$_GET['type']?>';
console.log(gps_x,gps_y,type); 
var APP_URL = "<?=APP_URL?>";
//鼠标进入地图区域让滚轮只能缩放不能滚动页面
$('#gaodeMap').bind('mousewheel', function () {
            return false;
   });
var markerArr = [];//用来保存被选择用户的经纬度
$(document).ready(function(){
$('.tab3').addClass("active1");
var marker1Icon = '';
if(type == 'mainperson' || type == 'taskperson'){
    marker1Icon = '/public/images/z_green.svg';
    //userInfo = '<p>'+'<strong>'+'我是'+username+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>'+'<p> 工作状态：离线</p>';
    console.log('per');
  }else if(type == 'bigTool'){
    marker1Icon = '/public/images/tools.png';
    //userInfo = '<p>'+'<strong>'+'大工具：'+name+'</strong>'+'</p>'+'<p>定位时间：'+time+'</p>';
  }else{
    marker1Icon = '/public/images/toolbag.png';
    //userInfo = '<p>'+'<strong>'+'工具包：'+rfid_reader_code+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>'
    console.log('tools');
  }
    //显示初始人员
    var infoWindow = new AMap.InfoWindow(); 
      var personmarkerList = [];
      var markerToolsArr = [];
    $('.mui-title').html("实时定位");
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(gps_x, gps_y),
            icon: marker1Icon,
            //title: username
        });
        
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(gps_x, gps_y),
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-5, -25)
        });
        //显示定位
        //alert(userid);
        personmarkerList.push(marker1,marker2);
        
        var userInfo='<p>'+'<strong>'+'我是'+6+'</strong>'+'</p>'+'<p>定位时间：'+5+'</p>'+'<p> 工作状态：离线</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
       
        function markerClick(e){
            
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
      map.add(personmarkerList);
    
    })
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
        center:[gps_x,gps_y],
        resizeEnable: true
      });
</script>
		<script>
			mui.init();
			 //侧滑容器父节点
			var offCanvasWrapper = mui('#offCanvasWrapper');
			 //主界面容器
			var offCanvasInner = offCanvasWrapper[0].querySelector('.mui-inner-wrap');
			 //菜单容器
			var offCanvasSide = document.getElementById("offCanvasSide");
			 //移动效果是否为整体移动
			var moveTogether = false;
			
			var classList = offCanvasWrapper[0].classList;
			
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
							
								offCanvasWrapper[0].insertBefore(offCanvasSide, offCanvasWrapper[0].firstElementChild);
							}
							classList.add('mui-scalable');
							break;
						case 'menu-move':
							classList.add('mui-slide-in');
							break;
						case 'all-move':
							moveTogether = true;
							offCanvasInner.insertBefore(offCanvasSide, offCanvasInner.firstElementChild);
							break;
					}
					offCanvasWrapper.offCanvas().refresh();
				}
			});
			 //主界面和侧滑菜单界面均支持区域滚动；
			mui('#offCanvasSideScroll').scroll();
			mui('#offCanvasContentScroll').scroll();
			 //实现ios平台原生侧滑关闭页面；
			if (mui.os.plus && mui.os.ios) {
				mui.plusReady(function() { //5+ 
					plus.webview.currentWebview().setStyle({
						'popGesture': 'none'
					});
				});
			}
      $('.mui-inner-wrap').on('drag', function(event) {
      event.stopPropagation();
      });
      mui(".mui-off-canvas-wrap").on('tap','h2' ,function(){
      $(this).parent().hide();
      });
      //日期
     (function($) {
        $.init();
        var result = $('#result')[0];
        var btns = $('.btn4');
          mui(".mui-content-padded").on('tap', '.btn4', function(event){
            var _self = this;
            console.log(_self);
            if(_self.picker) {
              console.log(111);
              _self.picker.show(function (rs) {
                _self.picker.dispose();
                _self.picker = null;
                console.log(222);
              });
            } else {
              var optionsJson = this.getAttribute('data-options') || '{}';
              var options = JSON.parse(optionsJson);
              var id = this.getAttribute('id');
              _self.picker = new $.DtPicker(options);
              console.log(_self.picker);
              _self.picker.show(function(rs) {
                //result.innerText = '选择结果: ' + rs.text;
                oData=rs.text
                console.log(oData);
                console.log(userId);

        $.ajax({
        async:false,
        type: "post",
        data: {
            "date":oData,
            "userId":userId
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
          if(msg==""){mui.alert('暂无数据');}
            else{mui.alert('提交数据成功');
                datas = msg;
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
              }
            }, 
        error: function (msg) {
            mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
            console.log(oDate);
        } 
    });
                _self.picker.dispose();
                _self.picker = null;
              });
            }
          }, false);
        })
      (mui);
		</script>
	</body>
</html>