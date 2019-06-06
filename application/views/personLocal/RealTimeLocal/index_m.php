<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>高铁检修综合管理平台</title>
	<link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/local.css"/>
	  <link rel="stylesheet" href="/public/css/mui.min.css">
    <link rel="stylesheet" href="/public/css/app.css"/>
    <link rel="stylesheet" href="/public/css/mui.picker.min.css" />
		<style>
			html,body{background-color:#efeff4}p{text-indent:22px}span.mui-icon{font-size:14px;color:#007aff;margin-left:-15px;padding-right:10px}.mui-off-canvas-left{color:#fff}.title{margin:35px 15px 10px}.title+.content{margin:10px 15px 35px;color:#bbb;text-indent:1em;font-size:14px;line-height:24px}input{color:#000}.f-tree{margin-top:30px;color:#000}.f-tree ul li{margin:10px;padding:3px}.f-tree ul li img{width:20px;height:20px;vertical-align:middle}#bo_text{display:block;width:100%;text-align:center;background:#ffac53}.topTitle{width:100%;height:50px;line-height:50px;text-align:center;margin:0 auto;color:#000;z-index:9999;display:block}.txtTip{color:#f30}.amap-marker-content{color:#f30;border-bottom:1px dashed #aaa}.left_firstLi{color:#fff;background:#cfe8a7}.clickAfter{color:blue}.locData{color:#000;}.noGPS{color:#999 !important;}.leftContent_title{position: fixed;z-index: 999;background: #fff;width:70%;}
		</style>
	</head>
	<body id="mui-body">  
		<div id="offCanvasWrapper" class="mui-off-canvas-wrap mui-draggable">
			<!--侧滑菜单部分-->
			<aside id="offCanvasSide" class="mui-off-canvas-left" style="background:#fff">
				<div id="offCanvasSideScroll" class="mui-scroll-wrapper"> 
          <div class="leftContent_title">
            <h4 class="topTitle">高铁检修综合管理平台</h4>
          </div>
          
					<div class="mui-scroll" style="margin-top: 20px">
          <div class="f-tree" style="z-index:999;margin-bottom: 80px" id="good_card_content">
               <ul id="leftContent">
               </ul>
					</div>	
					</div>
				</div>
        <div id="middlePopover" class="mui-popover" style="width:100px;height:80px">
      <div class="mui-popover-arrow"></div>
      <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
          <ul class="mui-table-view" style="color:#000">
            <li class="mui-table-view-cell" id="track" style="padding:0px">
            <div class="mui-content" style="width:100%;height:50%;margin:0px">
      <div class="mui-content-padded" style="margin:0px">
        <button id='demo4' data-options='{"type":"date"}' class="btn4" style="width: 100%;border: none;background:#f7f7f7;font-size:17px;">轨迹回放 </button>
      </div>
     </div>
            </li>
            <li class="mui-table-view-cell" id="showUserlocal"><a href="#">查看位置</a>
            </li> 
          </ul>
          
        </div>
      </div>
    </div>
			</aside>
			<!--主界面部分-->
			<div class="mui-inner-wrap">
				<header class="mui-bar mui-bar-nav" style="display: block;">
					<a href="#offCanvasSide" class="mui-icon mui-action-menu mui-icon-bars mui-pull-left"></a>
					<!-- <a class="mui-action-back mui-btn mui-btn-link mui-pull-right">关闭</a> -->
					<h1 class="mui-title"></h1>
				</header>
				<div id="offCanvasContentScroll" class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll" style="margin-top:40px;">
						<div class="mui-content-padded" style="margin:0px">
            <div class="map" id="mapContainer">
            <div style="position:absolute;bottom:45px;width:100%;z-index:999999;background:#ffac53" >
              <span id="bo_text"></span>
            </div>
            </div>
					</div>
				</div>
				<div class="mui-off-canvas-backdrop"></div>
			</div>
		</div>
  </div>
<script src="/public/js/mui.min.js"></script>
<script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.picker.min.js?v=0.101"></script>
<script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<script src="/public/js/GPSChange.js"></script>
<script>
var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
var localname = <?=$_GET['localname']?>;
var twId = <?php if ($_GET['twOrderId']!="") {echo $_GET['twOrderId'];}else echo $twOrderId_today;?>;

console.log(twId);
var APP_URL = "<?=APP_URL?>";
function remove2(arr){
        var result = [];
        for(var i=0;i<arr.length;i++){
                 if(arr[i]['loc_latitude'] != undefined){
                  result.push(arr[i]);
                 }
        }
        return result;
      }
//鼠标进入地图区域让滚轮只能缩放不能滚动页面
$('#gaodeMap').bind('mousewheel', function () { 
            return false;
   });
//
//
var local_All_worker = <?= $local_All_personJson?>;
var local_worker = <?= json_encode($local_All_person_gps)?>;
console.log(local_worker);//有定位器的人员
console.log(local_All_worker);//所有人员
var adminstratorsAll = <?=$local_All_person_onlyJson?>;
console.log(adminstratorsAll);
var local_worker1 = local_worker.concat(adminstratorsAll);
console.log(local_worker1);
var localArr =JSON.parse('<?php echo json_encode($local);?>');
var markerArr = [];//用来保存被选择用户的经纬度
$(document).ready(function(){
$('.tab3').addClass("active1");
    //显示初始人员
    var infoWindow = new AMap.InfoWindow();
    if(localname == 0){
      
      
      //console.log(local_All_person_onlyJson);//local_worker
      var personmarkerList = [];
      var markerToolsArr = [];
    $('.mui-title').html("实时定位"+'<span style="color:red">(综合定位)</span>');
    
    function complex(){
      var markerList_preObj = [];
      var markerList_preObj2 = [];

      $.ajax({
        url:"<?=CURRENT_DIR?>/index_app_m.php?",
        data:{
        "localname":localname,
        "twOrderId":twId,
        },
        type:"post",
        dataType:"json",
        success:function(msg){ 
        console.log(msg) 
        var local_worker = msg['sum1Json'][1];
        local_worker = remove2(local_worker);
        var personNum = local_worker.length;
        $.each(local_worker, function(i, item){     
        var localX=item['loc_longitude'];
        var localY=item['loc_latitude'];
        var username=item['twamName'];
        var userid=item['twamPersonId'];
        var create_time = item['create_time'];
        //人员定位信息
        var GPSArr = GPS.gcj_encrypt(parseFloat(localY),parseFloat(localX));
        var lng = GPSArr['lon'];
        var lat = GPSArr['lat'];
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(lng,lat),
            icon: '/public/images/z_green.svg',
            title: username
        });
        //人员定位动态圆圈gif图
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(lng,lat), 
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-3, -25) //相对于基点的偏移位置
        });
        //显示定位
        personmarkerList.push(marker1,marker2);//多个点实例组成的数组
        markerArr[userid] = new Array(marker1,marker2);//把改用户的经纬度保存到数组中
        var userInfo='<p>'+'<strong>'+'我是'+username+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>'+'<p> 工作状态：离线</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
        //map.add(personmarkerList); 
        map.remove(markerList_preObj);
        map.add(personmarkerList);
        //map.remove(personmarkerList)
        markerList_preObj = personmarkerList;
    });
       //大工具
    var local_All_big_onlyJson = msg['local_All_big_onlyJson'];
    var local_All_bigJson = msg['local_All_big'];
    var bigtoolsNum = '';
    if(typeof(local_All_big_onlyJson) == "object"){
    var arr = Object.keys(local_All_big_onlyJson);
    bigtoolsNum = arr.length; 
    }else{
    bigtoolsNum = local_All_big_onlyJson.length;
    }
    var bigtoolsmarkerList = [];
    $.each(local_All_big_onlyJson, function(i, item){   
        var localX=item['loc_longitude'];
        var localY=item['loc_latitude'];
        var twtlName=item['twtlName'];
        var twtlToolId=item['twtlToolId'];
        var create_time = item['create_time'];
        var GPSArr = GPS.gcj_encrypt(parseFloat(localY),parseFloat(localX));
        var lng = GPSArr['lon'];
        var lat = GPSArr['lat'];
        var marker3 = new AMap.Marker({
            position: new AMap.LngLat(lng, lat),
            icon: '/public/images/tools.png',
            title: twtlName
        });
        var marker4 = new AMap.Marker({
            position: new AMap.LngLat(lng, lat),
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-6, -25)
        });
        //显示定位
        bigtoolsmarkerList.push(marker3,marker4);
        markerArr[twtlToolId] = new Array(marker3,marker4);
        var userInfo='<p>'+'<strong>'+'大工具：'+twtlName+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>';
        marker3.content = marker4.content = userInfo;
        (marker3,marker4).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
        map.remove(markerList_preObj2);
        map.add(bigtoolsmarkerList);
        markerList_preObj2 = bigtoolsmarkerList;
    });
      
    var local_All_small = msg['local_All_smallJson'];
    var toolsbagNum = local_All_small.length;
    //console.log(local_All_small);
    $("#bo_text").html("该区域人数为:"+personNum+"人"+'<br>'+"大工具数为:"+bigtoolsNum+"个"+','+"工具包数为:"+toolsbagNum+"个");
      //工具包
    var toolsbagmarkerList = [];
    $.each(local_All_small, function(i, item){     
        var localX=item['loc_longitude'];
        var localY=item['loc_latitude'];
        var rfid_reader_code=item['rfid_reader_code'];
        var tbname = item['tb_name'];
        var userid=item['twamPersonId'];
        var create_time = item['create_time'];
        var GPSArr = GPS.gcj_encrypt(parseFloat(localY),parseFloat(localX));
        var lng = GPSArr['lon'];
        var lat = GPSArr['lat'];
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(lng, lat),
            icon: '/public/images/toolbag.png', 
            title: tbname
        });
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(lng, lat),
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-6, -25)
        });
        //显示定位
        toolsbagmarkerList.push(marker1,marker2);
        markerArr[userid] = new Array(marker1,marker2);
        var userInfo='<p>'+'<strong>'+'工具包：'+tbname+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
            //console.log(11);
        };
        map.add(toolsbagmarkerList);
        
    });
      var local_All_worker = msg['sum1Json'][1];
      var leftContent1 = '';
      var leftContent2 = '';
      var leftContent3 = '';
      $.each(local_All_worker,function(index,row){
        if(row['loc_latitude'] == undefined){
          leftContent1 += '<li class="locData bottomPopover noGPS" job="'+row['twamUserJobName']+'" type="person" name="'+row['twamName']+'" create_time="'+row['create_time']+'" personId="'+row['twamPersonId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/Tourist.png">'+'<a href="#middlePopover">'+row['twamName']+'('+row['twamUserJobName']
          +')'+'</a></li>';
        }else{
          leftContent1 += '<li class="bottomPopover locData" job="'+row['twamUserJobName']+'" type="person" name="'+row['twamName']+'" create_time="'+row['create_time']+'" personId="'+row['twamPersonId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/Tourist.png">'+'<a style="color:#000" href="#middlePopover">'+row['twamName']+'('+row['twamUserJobName']
          +')'+'</a></li>';
        }
      });
      $.each(local_All_bigJson,function(index,row){
        if(row['loc_longitude'] == undefined){
          leftContent2 += '<li class=" bottomPopover tool locData noGPS" type="bigtools" name="'+row['twtlName']+'" create_time="'+row['create_time']+'" twtlToolId="'+row['twtlToolId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/gongju.png">'+'<a style="color:#000" href="#middlePopover">'+row['twtlName']+'(无定位器)'+'</a></li>';
        }else{
          leftContent2 += '<li class="bottomPopover tool locData" type="bigtools" name="'+row['twtlName']+'" create_time="'+row['create_time']+'" twtlToolId="'+row['twtlToolId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/gongju.png">'+'<a style="color:#000" href="#middlePopover">'+row['twtlName']+'</a></li>';
        }
      });
      $.each(local_All_small,function(index,row){

        if(row['loc_longitude'] == undefined){
          leftContent3 += '<li class="bottomPopover locData noGPS" type="toolsbag" rfid_reader_code="'+row['rfid_reader_code']+'" name="'+row['rfid_reader_code']+'" create_time="'+row['create_time']+'" twtltToolBagId="'+row['twtltToolBagId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/icon-png/toolbag3.png">'+'<a style="color:#000" href="#middlePopover">'+row['tb_name']+'(无定位器)'+'</a></li>';
        }else{
          leftContent3 += '<li class="bottomPopover locData" type="toolsbag" name="'+row['tb_name']+'" create_time="'+row['create_time']+'" twtltToolBagId="'+row['twtltToolBagId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/icon-png/toolbag3.png">'+'<a style="color:#000" href="#middlePopover">'+row['tb_name']+'</a></li>';
        }
      });
    var personTitle = '<li class="left_firstLi">'+'人员'+'</li>';
    var bigtoolsTitle = '<li class="left_firstLi">'+'大工具'+'</li>';
    var toolsbagTitle = '<li class="left_firstLi">'+'工具包'+'</li>';
    $('#leftContent').html(personTitle+leftContent1+bigtoolsTitle+leftContent2+toolsbagTitle+leftContent3);
        },
        error:function(){
        console.log('err');
        }
      })
    
  }
  complex();
  setInterval(complex,2000);
    //console.log(leftContent1+leftContent2+leftContent3);
    }
    else if(localname == 1){
      
    let per = '';
    $('.mui-title').html("实时定位"+'<span style="color:red">(人员)</span>');
    //var personNum = local_worker.length;
    function personLocal(){
    var personmarkerList = [];
    var markerToolsArr = [];
     $.ajax({
        url:"<?=CURRENT_DIR?>/index_app_m.php?",
        data:{
        "localname":localname,
        "twOrderId":twId,
        },
        type:"post",
        dataType:"json",
        success:function(msg){
          console.log(msg);
        var local_All_worker = msg['sum1Json'][1];
        var local_worker = remove2(local_All_worker);
        var personNum = local_worker.length;
        $("#bo_text").html("该区域人数为:"+personNum+"人");
        //构造左侧
      var leftContent = '';
      $.each(local_All_worker,function(index,row){
        if(row['loc_longitude'] == undefined){
          leftContent += '<li class="locData noGPS" type="person" name="'+row['twamName']+'" create_time="'+row['create_time']+'" personId="'+row['twamPersonId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/Tourist.png">'+row['twamName']+'(无定位器)'+'</li>';
        }else{
          leftContent += '<li class="locData" type="person" name="'+row['twamName']+'" create_time="'+row['create_time']+'" personId="'+row['twamPersonId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/Tourist.png">'+row['twamName']+'</li>';
        }
      })
    $("#leftContent").html(leftContent);
        $.each(local_worker, function(i, item){     
        var localX=item['loc_longitude'];
        var localY=item['loc_latitude'];
        var username=item['twamName'];
        var userid=item['twamPersonId'];
        var create_time = item['create_time'];
        //人员定位信息
        var GPSArr = GPS.gcj_encrypt(parseFloat(localY),parseFloat(localX));
        var lng = GPSArr['lon'];
        var lat = GPSArr['lat'];
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(lng,lat),
            icon: '/public/images/z_green.svg',
            title: username
        });
        //人员定位动态圆圈gif图
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(lng,lat),
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-3, -25) //相对于基点的偏移位置
        });
        //显示定位
        personmarkerList.push(marker1,marker2);//多个点实例组成的数组
        markerArr[userid] = new Array(marker1,marker2);//把改用户的经纬度保存到数组中
        var userInfo='<p>'+'<strong>'+'我是'+username+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>'+'<p> 工作状态：离线</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
        map.remove(per)
        map.add(personmarkerList);
        per = personmarkerList;
    });
        },
        error:function(msg){
         alert('error'+msg);
        }
      });

    }
    personLocal();
    setInterval(personLocal,5000);
    
    }else if(localname == 2){
    //大工具
    var local_All_big_onlyJson = <?=$local_All_big_onlyJson?>;
    var local_All_bigJson = <?=$local_All_bigJson?>;
    var bigtoolsNum = '';
    if(typeof(local_All_big_onlyJson) == "object"){
    var arr = Object.keys(local_All_big_onlyJson);
    bigtoolsNum = arr.length; 
    }else{
    bigtoolsNum = local_All_big_onlyJson.length;
    }
    $('.mui-title').html("实时定位"+'<span style="color:red">(大工具)</span>');
    $("#bo_text").html("该区域大工具数为:"+bigtoolsNum+"个");
      //大工具
    //构造左侧
    var leftContent = '';
      $.each(local_All_bigJson,function(index,row){
        if(row['loc_longitude'] == undefined){
          leftContent += '<li class="locData noGPS" type="bigtools" name="'+row['twtlName']+'" create_time="'+row['create_time']+'" twtlToolId="'+row['twtlToolId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/gongju.png">'+row['twtlName']+'(无定位器)'+'</li>';
        }else{
          leftContent += '<li class="locData" type="bigtools" name="'+row['twtlName']+'" create_time="'+row['create_time']+'" twtlToolId="'+row['twtlToolId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/gongju.png">'+row['twtlName']+'</li>';
        }
      });
    $('#leftContent').html(leftContent);
    function devLocal(){
     $.ajax({
        url:"<?=CURRENT_DIR?>/index_app_m.php?",
        data:{
        "localname":localname,
        "twOrderId":twId,
        },
        type:"post",
        dataType:"json",
        success:function(msg){
          console.log(msg);
          var devData = msg['sum2Json'][0];
          console.log(devData);
          var bigtoolsmarkerList = [];
    $.each(devData, function(i, item){   
        var localX=item['loc_longitude'];
        var localY=item['loc_latitude'];
        var twtlName=item['twtlName'];
        var twtlToolId=item['twtlToolId'];
        var create_time = item['create_time'];
        var GPSArr = GPS.gcj_encrypt(parseFloat(localY),parseFloat(localX));
        var localX = GPSArr['lon'];
        var localY = GPSArr['lat'];
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),
            icon: '/public/images/tools.png',
            title: twtlName
        });        
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-6, -25)
        });
        //显示定位
        bigtoolsmarkerList.push(marker1,marker2);
        markerArr[twtlToolId] = new Array(marker1,marker2);
        var userInfo='<p>'+'<strong>'+'大工具：'+twtlName+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
    });
      map.add(bigtoolsmarkerList);
        },
        error:function(msg){
          console.log(msg);
        }
      });
   }
   devLocal();
   setInterval(devLocal,5000);
    
    }else if(localname == 3){
    var local_All_small = <?=$local_All_smallJson?>;
    var toolsbagNum = local_All_small.length;
    $('.mui-title').html("实时定位"+'<span style="color:red">(工具包)</span>');
    $("#bo_text").html("该区域工具包数为:"+toolsbagNum+"个");
    //构造左侧
    var leftContent = '';
      $.each(local_All_small,function(index,row){
        if(row['loc_longitude'] == undefined){
          leftContent += '<li class="locData noGPS" type="toolsbag" name="'+row['tb_name']+'" create_time="'+row['create_time']+'" twtltToolBagId="'+row['twtltToolBagId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/icon-png/toolbag3.png">'+row['tb_name']+'(无定位器)'+'</li>';
        }else{
          leftContent += '<li class="locData" type="toosbag" name="'+row['tb_name']+'" create_time="'+row['create_time']+'" twtltToolBagId="'+row['twtltToolBagId']+'" localX="'+row['loc_longitude']+'" localY="'+row['loc_latitude']+'">'+'<img src="/public/images/icon-png/toolbag3.png">'+row['tb_name']+'</li>';
        }
      });
    $('#leftContent').html(leftContent);
      //工具包
       function devBagLocal(){
     $.ajax({
        url:"<?=CURRENT_DIR?>/index_app_m.php?",
        data:{
        "localname":localname,
        "twOrderId":twId,
        },
        type:"post",
        dataType:"json",
        success:function(msg){
          console.log(msg);
          var devBagData = msg['sum2Json'][2];
          var toolsbagmarkerList = [];
    $.each(devBagData, function(i, item){     
        var localX=item['loc_longitude'];
        var localY=item['loc_latitude'];
        var tbname=item['tb_name'];
        var userid=item['twamPersonId'];
        var create_time = item['create_time'];
        var GPSArr = GPS.gcj_encrypt(parseFloat(localY),parseFloat(localX));
        var localX = GPSArr['lon'];
        var localY = GPSArr['lat'];
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),
            icon: '/public/images/toolbag.png', 
            title: tbname
        });
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-6, -25)
        });
        //显示定位
        toolsbagmarkerList.push(marker1,marker2);
        markerArr[userid] = new Array(marker1,marker2);
        var userInfo='<p>'+'<strong>'+'工具包：'+tbname+'</strong>'+'</p>'+'<p>定位时间：'+create_time+'</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
    });
      map.add(toolsbagmarkerList);
        },
        error:function(msg){
          console.log(msg);
        }
      });
   };
   devBagLocal();
    
    }
    //初始化标志性建筑
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
    //map.setFitView();  
    //定位

 var localx,localy,type,name,time,GPSArr;
mui("#leftContent").on('tap', '.locData', function(event){
  //console.log(this);
  localx = $(this).attr('localx');
  localy = $(this).attr('localy');
  userId = $(this).attr('personid');
  type = $(this).attr('type');//person,bigtools,toolsbag;
  name = $(this).attr('name');
  job = $(this).attr('job');
  time = $(this).attr('create_time');
  console.log(userId);
  var userInfo='';
  var marker1Icon = '';
   GPSArr = GPS.gcj_encrypt(parseFloat(localy),parseFloat(localx));
   localx = GPSArr['lon'];
   localy = GPSArr['lat'];
  console.log(localx,localy);
}); 


mui("#offCanvasSide").on('tap','#showUserlocal',function(){
$('#middlePopover').hide();
console.log(isNaN(localx));
  // if($(this).hasClass('clickAfter')){
  //   mui.toast("已经点过啦！");
  //   return false;
  // }else
   if(isNaN(localx)){
    mui.toast("未绑定定位器！");
    return false;
  }
  var zoom = 18;
  var lng = localx;
  var lat = localy;
  //$(this).addClass('clickAfter');
  if(type == 'person'){
    marker1Icon = '/public/images/z_green.svg';
    userInfo = '<p>'+'<strong>'+'我是'+name+'</strong>'+'</p>'+'<p>定位时间：'+time+'</p>'+'<p> 工作状态：离线</p>';
  }else if(type == 'bigtools'){
    marker1Icon = '/public/images/tools.png';
    userInfo = '<p>'+'<strong>'+'大工具：'+name+'</strong>'+'</p>'+'<p>定位时间：'+time+'</p>';
  }else{
    marker1Icon = '/public/images/toolbag.png';
    userInfo = '<p>'+'<strong>'+'工具包：'+name+'</strong>'+'</p>'+'<p>定位时间：'+time+'</p>'
    //console.log('tools');
  }
  //console.log(localX,localY);
  var markerList = [];
  //显示定位
        var infoWindow = new AMap.InfoWindow();
        //
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(localx, localy),
            icon: marker1Icon, 
            //title: username
        });
        //
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(localx, localy),
            icon: '/public/images/centerPt.gif',
            offset: new AMap.Pixel(-5, -25)
        });
        //
        var marker3 = new AMap.Marker({
          position:new AMap.LngLat(localx,localy),
          content:name,
          offset:new AMap.Pixel(-10,-50)
        })
        //显示定位
        markerList.push(marker1,marker2,marker3);
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
        map.add(markerList);
        $('.mui-inner-wrap').css({'transform': "translate3d(0px, 0px, 0px)"});
        $('.mui-off-canvas-backdrop').hide();
        map.setZoomAndCenter(zoom, [lng, lat]); //同时设置地图层级与中心点
});
});
</script>
<script type="text/javascript">
var AMapUIProtocol = 'https:';
</script>
<!-- https 方式引入入口文件 -->
<script src="https://webapi.amap.com/ui/1.0/main.js"></script>
  <script>
  $(function(){
    //解决页面重定向失效问题
    $('.tab1').on('click',function(){
        window.location.href="/index/index_m";
       }); 
    $('.tab2').on('click',function(){
        window.location.href="/taskManage/HworkOrder/index_m";
       }); 
     $('.tab3').on('click',function(){
        window.location.href="/personLocal/RealTimeLocal/index_m&localname=0&twOrderId=<?=$twOrderId_today?>";
       }); 
       $('.tab4').on('click',function(){
        window.location.href="/my/mine/index_m";
       });  
    })
    //初始化地图
    var adminArr = <?= json_encode($adminArr)?>;
    var localX = 115.869114;
    var localY = 28.747864;
    if(adminArr['loc_latitude'] == undefined){
      console.log('wu');
    }else{
      localX = parseFloat(adminArr['loc_longitude']);
      localY = parseFloat(adminArr['loc_latitude']);
      var GPSArr = GPS.gcj_encrypt(localY,localX);
      var localX = GPSArr['lon'];
      var localY = GPSArr['lat'];
    }
      var map=new AMap.Map("mapContainer",{
        zoom:16,//缩放级别
        center:[localX,localY],
        resizeEnable: true
      });
//轨迹回放
var flag=true;
//轨迹回放收起左边
      mui("#mui-body").on('tap','.mui-btn',function(){
              $('.mui-inner-wrap').css({'transform': "translate3d(0px, 0px, 0px)"});
              $('.mui-off-canvas-backdrop').hide();
              $('#middlePopover').hide();
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
				if (this.checked){
					offCanvasSide.classList.remove('mui-transitioning');
					offCanvasSide.setAttribute('style', '');
					classList.remove('mui-slide-in');
					classList.remove('mui-scalable');
					switch (this.value){
						case 'main-move':
							if (moveTogether){
								//仅主内容滑动时，侧滑菜单在off-canvas-wrap内，和主界面并列
								offCanvasWrapper[0].insertBefore(offCanvasSide, offCanvasWrapper[0].firstElementChild);
							}
							break;
						case 'main-move-scalable':
							if (moveTogether){
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
        var type;
        var result = $('#result')[0];
        var btns = $('.btn4');
        //btns.each(function(i, btn) {
          mui(".mui-content-padded").on('tap', '.btn4', function(event){
            //console.log(1111);
          // btns.addEventListener('tap', function() {
         
            var _self = this;
            console.log(_self);
            if(_self.picker) {
              
              _self.picker.show(function (rs) {
                //result.innerText = '选择结果: ' + rs.text;
                _self.picker.dispose();
                _self.picker = null;
                
              });
            } else {
              var optionsJson = this.getAttribute('data-options') || '{}';
              var options = JSON.parse(optionsJson);
              var id = this.getAttribute('id');
             
              _self.picker = new $.DtPicker(options);
              
              _self.picker.show(function(rs) {
            
                //result.innerText = '选择结果: ' + rs.text;
                oData=rs.text
                console.log(oData);
                console.log(userId);
                console.log(job);
                if(job == "施工人员"){
                  type = 0;
                }else{
                  type = 1;
                }

        $.ajax({
        async:false,
        type: "post",
        data: {
            "type":type,
            "date":oData,
            "userId":userId
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
          console.log(msg);
          if(msg==""){mui.alert('暂无数据');}
            else{
              mui.toast('提交数据成功');
              
              datas = msg;
          var localArray = [];
         datas.forEach(function(item){
          if(item.loc_longitude.slice(0, 3) != 114){
          localArray.push([item.loc_longitude,item.loc_latitude])
          }
         
    });
    //console.log(localArray);
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
        //name: datas[0].twamName,
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