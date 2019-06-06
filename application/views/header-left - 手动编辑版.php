<?php 
//未登陆 跳转到登录页。登陆后设置登陆session
// if(strpos($_GET['url'],'login')===false && $_GET['login'] !=''){
// 	$_SESSION['login'] = "loged";
// }
// else if($_SESSION['login'] == ""){
// 	header("Location: ".APP_URL."/login/login/index"); 
// 	exit;
// }

//print_r($auths);

//if(in_array('add',$auths)) echo ' 可以执行add添加操作 ';		 
?>
<!-- 载入公共js -->
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.nicescroll.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/jquery.blockui.js"></script>
<script type="text/javascript" src="/plugins/layer/layer.js"></script>
<link rel="stylesheet" href="/plugins/layer/layer.css?v=3.0.3303" id="layuicss-skinlayercss">

<div id="header" class="navbar navbar-inverse navbar-fixed-top" style="position:fixed">
  <!-- BEGIN TOP NAVIGATION BAR 头部开始-->
  <div class="navbar-inner">
    <div class="container-fluid">
      <!--BEGIN SIDEBAR TOGGLE-->
      <div class="sidebar-toggle-box hidden-phone">
        <div class="icon-reorder tooltips" data-placement="right"      data-original-title="切换导航"> <img class="img-responsive" src="/public/images/lingx.png" alt="Metro Lab"  width="30px" height="30px"/> </div>
      </div>
      <!--END SIDEBAR TOGGLE-->
      <!-- BEGIN LOGO -->
      <!-- <a class="brand" href="index.html">
                   <img class="img-responsive" src="/public/images/logo.png" alt="Metro Lab"  width="30px" height="30px"/>
               </a> -->
      <h4>高铁检修综合管理平台</h4>
      <!-- <span>2018-7-26</span> -->
      <!-- END LOGO -->
      <!-- BEGIN RESPONSIVE MENU TOGGLER -->
      <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="arrow"></span> </a>
      <!-- END RESPONSIVE MENU TOGGLER -->

      <div class="top-nav ">
        <ul class="nav pull-right top-menu" >
          <!-- BEGIN USER LOGIN DROPDOWN -->
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img class="img-responsive" src="/public/images/user.png" alt="" width="25px" height="25px" /> <span class="username"><?=$_SESSION['userInfo']['pManageName']?></span> <b class="caret"></b> </a>
            <ul class="dropdown-menu extended logout">
              <!--<li><a href="#"><i class="icon-user"></i>我的资料</a></li>
              <li><a href="#"><i class="icon-cog"></i>我的设置</a></li>-->
              <li><a href="/login/logout"><i class="icon-key"></i>退出</a></li>
            </ul>
          </li>
          <!-- END USER LOGIN DROPDOWN -->
        </ul>
        <!-- END TOP NAVIGATION MENU -->
      </div>
    </div>
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>

<div id="container" class="row-fluid">
<!-- BEGIN SIDEBAR 左侧开始-->
<div class="sidebar-scroll">
  <div id="sidebar" class="nav-collapse collapse">


    <div class="navbar-inverse">
      <form class="navbar-search visible-phone">
        <input type="text" class="search-query" placeholder="Search" />
      </form>
    </div>

    <ul class="sidebar-menu" id="leftSidebar">
      <li class="sub-menu"> <a class="" href="/index/index"> <i class="icon-dashboard"></i> <span>工作面板</span> </a> </li>
      <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-book"></i> <span>工单管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li class=""><a href="/taskManage/TworkOrder/index">今日工单</a></li>
          <li><a class="" href="/taskManage/HworkOrder/index">历史工单</a></li>
          <!--<li><a class="" href="/taskManage/review/index">工单审核</a></li>-->
        </ul>
      </li>
      <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-cogs"></i> <span>仓库/工具管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="/warehouse/toolsList/index">工具列表</a></li>
          <!-- <li><a class="" href="/warehouse/toolsClass/index">工具类别</a></li> -->
          <li><a class="" href="/warehouse/waMessage/index">仓库基本信息</a></li>
          <li><a class="" href="/warehouse/RFIDLibs/index">RFID标签库</a></li>
          <li><a class="" href="/warehouse/RFIDClass/index">RFID类别</a></li>
        </ul>
      </li>
       <li class="sub-menu"> <a class="" href="javascript:;"> <i class="icon-trophy"></i> <span>其他设备管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a href="/deviceManage/devicList/index" class="">设备列表</a></li>
          <li><a href="/deviceManage/devicClass/index" class="">设备类别</a></li>
        </ul>
      </li>
      <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-tasks"></i> <span>工具清点管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="/toolsManage/clearRecord/index">出入库清点记录</a></li>
        </ul>
      </li>
      <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-th"></i> <span>人员管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="/personnelManage/bManage/index">部门信息管理</a></li>
          <li><a class="" href="/personnelManage/zManage/index">职位信息管理</a></li>
          <li><a class="" href="/personnelManage/pManage/index">人员信息管理</a></li>
        </ul>
      </li>
      <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-th"></i> <span>考勤管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="/signManage/todaySign/index">今日签到</a></li>
          <li><a class="" href="/signManage/hSign/index">历史签到</a></li>

        </ul>
      </li>
      <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-th"></i> <span>人员定位管理</span> <span class="arrow"></span> </a>
        <ul class="sub">

          <li><a class="" href="/personLocal/RealTimeLocal/index">人员定位</a></li>
          <li><a class="" href="/personLocal/RealTimeLocal/index_orther">人员定位-第三方演示版</a></li>
          <li><a class="" href="/personLocal/TrackReplay/index">轨迹回放</a></li>
        </ul>
      </li>

      <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-fire"></i> <span>安全门管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="/safetyDoor/ceControl/index">监控设备控制</a></li>
          <li><a class="" href="/safetyDoor/ceManage/index">监控信息管理</a></li>
        </ul>
      </li>

      <li class="sub-menu"> <a class="" href="javascript:;"> <i class="icon-map-marker"></i> <span>报表统计</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a href="/reportForm/reportForms/index" class="">工单</a></li>
          <li><a href="/reportForm/peopleForms/index" class="">人员清单</a></li>
          <li><a href="/reportForm/equipmentForms/index" class="">工器具清单</a></li>
          <li><a href="/reportForm/equipmentDetails/index" class="">工器具明细</a></li>
        </ul>
      </li>
      
      
      
       <li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-glass"></i> <span>信息发布与管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="/dealInfo/pushInfo">信息发布</a></li>
          <li><a class="" href="/dealInfo/adminInfo">信息管理</a></li>
    
        </ul>
      </li>
     
     
     
      
      <!--<li class="sub-menu"> <a href="javascript:;" class=""> <i class="icon-file-alt"></i> <span>系统设置</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <li><a class="" href="blank.html">空白页面</a></li>
        </ul>
      </li>-->
      
      
      <li class="sub-menu"> <a class="" href="javascript:;"> <i class="icon-map-marker"></i> <span>权限管理</span> <span class="arrow"></span> </a>
        <ul class="sub">
          <?php if($_GET['roleId'] !="" ){?><li><a href="/authManage/auth/index&roleId=<?=$_GET['roleId']?>" class="">权限分配列表</a></li><?php }?>
          <li><a href="/authManage/role/index" class="">设置角色权限</a></li>


        </ul>
      </li>
      
      <li> <a class="" href="/login/login/index"> <i class="icon-user"></i> <span>登录页面</span> </a> </li>
    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
<script>
//自动高亮左侧当前的菜单
var action = "/<?=$controller.'/'.$action?>".toLowerCase();
//alert(action);
var subActive = false;
$("#leftSidebar .sub-menu .sub li a").each(function(index, element) {
    href = $(this).attr("href").toLowerCase();
	//alert("href"+href+"  action="+action);
	if( href.indexOf(action) >= 0 ){
		  $(this).parent("li").addClass("active");
		  $(this).parents("li.sub-menu").addClass("active");
		  subActive=true;
		  return false;
	}
});
//如果没有匹配的子菜单，则默认高亮第一个
if(!subActive)$("#leftSidebar").children("li").eq(0).addClass("active");
</script>