<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>高铁检修综合管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <link href="/public/css/bootstrap.min.css>" rel="stylesheet" />
    <link href="/public/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="/public/css/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="/public/css/style.css>" rel="stylesheet" />
    <link href="/public/css/style-responsive.css>" rel="stylesheet" />
    <link href="/public/css/style-default.css>" rel="stylesheet" id="style_color" />
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link href="/public/css/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="/public/css/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/uniform.default.css" />
    <link rel="stylesheet" href="/public/css/local.css>" />
    <link rel="stylesheet" href="/public/css/tree.css>" />
<style>
.txtTip{
    color:#f30;
}
.amap-marker-content{
    color:#f30;
    border-bottom: 1px dashed #aaa;
}
</style>
</head>

<body class="fixed-top">

   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>

  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                        人员定位<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span>

                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">人员定位管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            人员定位
                        </li>
                        <li class="pull-right search-wrap">
                            <form action="search_result.html" class="hidden-phone">
                                <div class="input-append search-input-area">
                                    <input class="" id="appendedInputButton" type="text">
                                    <button class="btn" type="button"><img src="/public/images/search.png" width="40px" height="40px"></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
<div class="row-fluid" id ="gaodeMap">
                <div class="span12">
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4>人员定位</h4>
                        </div>
                        <div class="widget-body">
    <div class="head">
      <div class="h-center" style="background:#3f4b59">
       <div class="box_left_head" style="width:280px">
      <ul>
        <li class="active">工单&nbsp;<?php echo date('Y-m-d');?></li>
        <li></li>
      </ul>
    </div>
       <div class="h-mid">
       <ul class="color" id="col">
         <li style="border-bottom:none;">地图主题</li>
         <li><input type='radio' onclick='refresh(this.value)' checked name='mapStyle' value='normal'>标&nbsp;&nbsp;&nbsp;准</li>
         <li><input type='radio' onclick='refresh(this.value)' name='mapStyle' value='dark'>幻影黑</li>
         <li><input type='radio' onclick='refresh(this.value)' name='mapStyle' value='light'>月光银</li>
         <li><input type='radio' onclick='refresh(this.value)' name='mapStyle' value='fresh'>草色青</li>
         <li><input type='radio' onclick='refresh(this.value)' name='mapStyle' value='darkblue'>极夜蓝<br></li>
         <li><input type='radio' onclick='refresh(this.value)' name='mapStyle' value='whitesmoke'>远山黛</li>
         <li><input type='radio' onclick='refresh(this.value)' name='mapStyle' value='macaron'>马卡龙</li>
         <li><input type='radio' onclick='refresh(this.value)' name='mapStyle' value='wine'>酱&nbsp;&nbsp;&nbsp;籽</li>
       </ul>
         <ul class="banner" id="change">
           <li style="border-bottom:none;">视图选择</li>
           <li id="local">鹰眼</li>
           <li id="view">3D视图</li>
           <li id="heatmap">热力图</li>
           <li id="satellite">卫星图</li>
         </ul>
       </div>
      </div>
  </div>
  <div class="map" id="mapContainer">

  <div class="box_left">
    
    <div class="box_left_main" id="textbox" style="overflow:hidden;">
      <div class="one box active">
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
          <!--  -->

          <?php foreach($local as $index=>$userInfo){
            if($userInfo['bManageId'] ==$catlog1['bManageId']){?>
          <div class="f-treeListWrapper">
            <div class="f-treeList-lineShuEnd"></div>
            <div class="f-treeList" userid="<?=$userInfo['pManageId']?>" localX="<?=$userInfo['loc_latitude']?>" localY="<?=$userInfo['loc_longitude']?>" username="<?=$userInfo['pManageName']?>" time="<?=$userInfo['create_time'] ?>">
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
        </div>
       <!-- <div class="two box">2</div> -->
      
    </div>
    
  </div>
  </div>
</div></div></div></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
 <div style="position:absolute;bottom:-170px;left:695px;z-index:999999;background:#ffac53" id="bo_text"><?php echo "该区域人数为：".count($local).",工具数量为：".count($localDevice); ?></div>


<script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>
<script src="/public/js/laydate/laydate.js?1.0"></script>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var localDevice =JSON.parse('<?php echo json_encode($localDevice);?>');
    console.log(localDevice);
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/toastr.min.js"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-zManage.js?v=0.101"></script>
<script src="http://webapi.amap.com/maps?v=1.4.3&key=28055c1bc57defef57ccca6411ba31ca&plugin=AMap.Driving"></script>


<script>
console.log(JSON.parse('<?php echo json_encode($local);?>'));
toastr.options.positionClass = 'toast-top-center';
var APP_URL = "<?=APP_URL?>";
//鼠标进入地图区域让滚轮只能缩放不能滚动页面
$('#gaodeMap').bind('mousewheel', function (){
            return false;
   });

// var aaa =1 ;
// function go(){
//   aaa+=1;
//   console.log(aaa);

// }
// go();
// console.log(aaa);

var markerArr = [];//用来保存被选择用户的经纬度
var markerToolsArr = [];

$(document).ready(function(){

     /** 显示初始人员**/
     var markerList_preObj = [];
     function getData(){
     $.ajax({
        async:false,
        type: "post",
        data: {},
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_app.php?",
        success: function (msg) {

          //alert("success");
          //console.log(msg);
          localArr = msg ;
          console.log(localArr);
          var markerList = [];
          var infoWindow = new AMap.InfoWindow();
          $.each(localArr, function(i, item){
          var t = item['loc_latitude']; //(DDDMM.MMMM) 
          var g = item['loc_longitude']; // (DDMM.MMMM)
         //console.log(g,t); 
         // function lng(g){ 
         //     return (Number(g.slice(0,3)) + (Number(g.slice(3,6))/60));
         // }
         // function lat(t){ 
         //     return (Number(t.slice(0,2)) + (Number(t.slice(2,6))/60));
         // }
        //alert(item['username']);
        //var localX=lng(g);
        //var localY=lat(t);
        var gps = [g, t];
        AMap.convertFrom(gps, 'gps', function (status, result){
        if (result.info === 'ok'){
        var lnglat = result.locations; // Array.<LngLat>
        //console.log(lnglat);
        //console.log(lnglat);
        console.log(lnglat[0]['lng'],lnglat[0]['lat']);
        var username=item['pManageName'];
        var userid=item['localUserId'];
        var time = item['create_time'];
        //console.log(localX,localY);
        //console.log(1,2);
        //人员定位信息
        var marker1 = new AMap.Marker({
            position: new AMap.LngLat(lnglat[0]['lng'], lnglat[0]['lat']),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/z_green.svg', // 添加 Icon 图标 URL:z_green.svg表示在线，z_gray.svg表示离线中，
            title: time,
        });
        //人员定位动态圆圈gif图
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(lnglat[0]['lng'], lnglat[0]['lat']),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/centerPt.gif', // 添加 Icon 图标 URL
            offset: new AMap.Pixel(-3, -25) // 相对于基点的偏移位置
        });
        //人员姓名
        var marker3 = new AMap.Marker({
            position: new AMap.LngLat(lnglat[0]['lng'], lnglat[0]['lat']),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            content: username,
            offset: new AMap.Pixel(0, -55) // 相对于基点的偏移位置
        });
        //显示定位
        markerList.push(marker1,marker2,marker3);//多个点实例组成的数组
        markerArr[userid] = new Array(marker1,marker2,marker3);//把改用户的经纬度保存到数组中
        var userInfo='<p>'+'<strong>'+'我是'+username+'</strong>'+'</p>'+'<p>定位时间：'+time+'</p>'+'<p> 工作状态：离线</p>' +
        '<p>考勤状态：迟到</p>'+'<p>'+'经纬度:'+lnglat[0]['lng']+','+lnglat[0]['lat']+'</p>';
        marker1.content = marker2.content = userInfo;
        (marker1,marker2).on('click', markerClick);
        function markerClick(e){
            infoWindow.setContent(e.target.content); 
            infoWindow.open(map, e.target.getPosition());
        };
         map.remove(markerList_preObj);
         map.add(markerList);
         markerList_preObj = markerList;
         //console.log(markerList);
         //
        }
        });

    });
          //console.log(markList);   
         },
        error: function (msg){
          alert('error');
          //console.log(msg);
        }
          })
}
   //getData();
setInterval(getData,2000); 

    
    //console.log(localArr);
    
   
//var localAAA = <?=json_encode($localP)?>;
//console.log(localAAA);
    /** 工具* */
    var DeviceArr=[];
    $.each(localDevice, function(i, item){
        var g = item['loc_latitude']; //(DDDMM.MMMM) 
        var t = item['loc_longitude']; // (DDMM.MMMM)
        console.log(g,t); 
        function lng(g) { 
             return (Number(g.slice(0,3)) + (Number(g.slice(3,6))/60)) ;
         }
         function lat(t){ 
             return (Number(t.slice(0,2)) + (Number(t.slice(2,6))/60)) ;
         } 
        var localX=lng(g);
        var localY=lat(t);
        var username=item['toListName'];
        var userid=item['localUserId'];
        var localTime=item['localTime'];
        console.log(localX,localY);
        //工具定位
        var tools = new AMap.Marker({
            position: new AMap.LngLat(localX, localY),
            icon: '/public/images/tools.png', 
            
        });
        
        //显示定位
        DeviceArr.push(tools);//多个点实例组成的数组
        markerToolsArr[userid] = new Array(tools);
        var userInfo='<p>'+'<strong>'+username+'</strong>'+'</p>'+'<p>定位时间：'+localTime+'</p>';
        tools.content =userInfo;
        (tools).on('click', markerClick);markerToolsArr
       
        function markerClick(e){
            infoWindow.setContent(e.target.content);
            infoWindow.open(map, e.target.getPosition());
        };
    });
    map.add(DeviceArr);
    
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
    var time = $(this).parents(".f-treeList").attr("time");
    //alert(username+" "+localX+" "+localY);
         function lng(localX) { 
             return (Number(localX.slice(0,3)) + (Number(localX.slice(3,6))/60));
         }
         function lat(localY){ 
             return (Number(localY.slice(0,2)) + (Number(localY.slice(2,6))/60));
         }
         var gps = [lng(localX), lat(localY)];
        AMap.convertFrom(gps, 'gps', function (status, result) {
        if (result.info === 'ok') {
        var lnglat = result.locations; // Array.<LngLat>
        console.log(lnglat);

        }
        });
        //alert(item['username']);
        var loc_latitude=lng(localX);
        var loc_longitude=lat(localY);
        
        console.log(loc_latitude,loc_longitude);
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
            position: new AMap.LngLat(lnglat[0]['lng'], lnglat[0]['lat']),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/z_green.svg', // 添加 Icon 图标 URL:z_green.svg表示在线，z_gray.svg表示离线中，
            title: username
        });
        //人员定位动态圆圈gif图
        var marker2 = new AMap.Marker({
            position: new AMap.LngLat(loc_latitude, loc_longitude),   // 经纬度对象，也可以是经纬度构成的一维数组[116.39, 39.9]
            icon: '/public/images/centerPt.gif', // 添加 Icon 图标 URL
            offset: new AMap.Pixel(-3, -25) // 相对于基点的偏移位置
        });
        
        //显示定位
        markerList.push(marker1,marker2);//多个点实例组成的数组;//var markerList = [marker1, marker2];//多个点实例组成的数组
        
        map.add(markerList);
        markerArr[userid] = markerList;//把改用户的经纬度保存到数组中
        var userInfo='<p>'+'<strong>'+'我是'+username+'</strong>'+'</p>'+'<p>定位时间：'+time+'</p>'+'<p> 工作状态：离线</p>' +
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
        
        //console.log(" 666666666: ");
       console.log(markerArr[userid]);

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
    $('#myMenu').hide();
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

    //加载鹰眼
    document.getElementById("local").onclick=function(){
      // alert("鹰眼");
    var mapObj = new AMap.Map("mapContainer");
    mapObj.plugin(["AMap.OverView"],function(){
      view = new AMap.OverView({
        isOpen:true,
        visible:true

        });
    mapObj.addControl(view)
    })
  };
  //加载3D视图
  document.getElementById("view").onclick=function(){
    // alert("3D");
    var map = new AMap.Map('mapContainer',{
    pitch:75,//俯仰角,有效范围(0,83)
    viewMode:'3D',//视图模型
    zoom: 17,
    expandZoomRange:true,
    zooms:[3,20],
    center:[115.869114,28.747864]
  })
  };
   //加载街景
     document.getElementById("heatmap").onclick=function(){
     alert("热力图");
  };
  //加载卫星视图
  document.getElementById("satellite").onclick=function(){
  var satellLayer = new AMap.TileLayer.Satellite({zIndex:10}); //实例化卫星图
  satellLayer.setMap(map);
};

//地图主题
function refresh(enName) {
        map.setMapStyle('amap://styles/'+enName);
    }
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
<!-- END JAVASCRIPTS -->


