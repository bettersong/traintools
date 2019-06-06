<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>高铁检修综合管理平台</title>
	<link rel="stylesheet" href="/public/css/ui.css?1.1">
	<style>
        body{
            overflow:hidden;
        }
        .amap-geolocation-con{
		    bottom: 40px !important;
        }
        .map{
            width:100%;
            height:87vh;/*所占视图高度百分比*/
        }
    </style>
</head>
<body>
	<div class="train-title">
        <div class="train-logo"><span class="train-v">实时定位</span></div>
    </div>
  <div class="map" id="mapContainer"></div>
  <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<script type="text/javascript">
	window.onload=function(){
         
         $('.tab3').addClass("active1");
    }
var AMapUIProtocol = 'https:';  //注意结尾包括冒号
</script>
<!-- https 方式引入入口文件 -->
<script src="https://webapi.amap.com/ui/1.0/main.js"></script>
  <script>
    //初始化地图
      var map=new AMap.Map("mapContainer",{
        zoom:18,//缩放级别
        // center:[115.869114,28.747864]
        resizeEnable: true
      });
      //实例化导航对象
      var driving=new AMap.Driving({
        map:map,
      // panel:"panel"
      });
      function tz_search(){
      var start=document.getElementById("start").value;
      var end=document.getElementById("end").value;
      driving.search([
      {keyword:start},
      {keyword:end}
      ]);
      };
      var geolocation;
      //加载地图，调用浏览器定位服务
        map.plugin('AMap.Geolocation', function() {
        geolocation = new AMap.Geolocation({
            enableHighAccuracy: true,//是否使用高精度定位，默认:true
            timeout: 10000,          //超过10秒后停止定位，默认：无穷大
            buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
            zoomToAccuracy: true,//定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
            buttonPosition:'LB',
            animateEnable:true//平移过程动画
        });
        map.addControl(geolocation);
        geolocation.getCurrentPosition();
        AMap.event.addListener(geolocation, 'complete', onComplete);//返回定位信息
        AMap.event.addListener(geolocation, 'error', onError);      //返回定位出错信息
    });
    //解析定位结果
    function onComplete(data) {
        var str=['定位成功'];
        str.push('经度：' + data.position.getLng());
        str.push('纬度：' + data.position.getLat());
        if(data.accuracy){
             str.push('精度：' + data.accuracy + '米');
        }//如为IP精确定位结果则没有精度信息
    }

     var toolBar;
     var customMarker = new AMap.Marker({
        offset: new AMap.Pixel(-14, -34),//相对于基点的位置
        icon: new AMap.Icon({  //复杂图标
            size: new AMap.Size(27, 36),//图标大小
            image: "http://webapi.amap.com/images/custom_a_j.png", //大图地址
            imageOffset: new AMap.Pixel(-28, 0)//相对于大图的取图位置
        })
    });
    //地图中添加地图操作ToolBar插件
    map.plugin(["AMap.ToolBar"], function() {
        toolBar = new AMap.ToolBar({locationMarker: customMarker}); //设置地位标记为自定义标记
        map.addControl(toolBar);
    });

//     //加载鹰眼
//     document.getElementById("local").onclick=function(){
//       // alert("鹰眼");
//     var mapObj = new AMap.Map("mapContainer");
//     mapObj.plugin(["AMap.OverView"],function(){
//       view = new AMap.OverView({
//         isOpen:true,
//         visible:true

//         });
//     mapObj.addControl(view)
//     })
//   };
//   //加载3D视图
//   document.getElementById("view").onclick=function(){
//     // alert("3D");
//     var map = new AMap.Map('mapContainer',{
//     pitch:75,//俯仰角,有效范围(0,83)
//     viewMode:'3D',//视图模型
//     zoom: 17,
//     expandZoomRange:true,
//     zooms:[3,20],
//     center:[115.869114,28.747864]
//   })
//   };
//    //加载街景
//      document.getElementById("heatmap").onclick=function(){
//      alert("热力图");
//   };
//   //加载卫星视图
//   document.getElementById("satellite").onclick=function(){
//   var satellLayer = new AMap.TileLayer.Satellite({zIndex:10}); //实例化卫星图
//   satellLayer.setMap(map);
// };

// //使用鼠标工具，在地图上画标记点标点
// map.plugin(["AMap.MouseTool"],function(){
//     var mouseTool = new AMap.MouseTool(map);
//     mousetooL.marker();
// });
// //地图主题
// function refresh(enName) {
//         map.setMapStyle('amap://styles/'+enName);
//     }

  </script>
</body>
</html>
