<?php 
// print_r($_SESSION['myAdminBumen_subArr']);echo '<br>22<br>';

//$_SESSION['myAdminBumen_subArr']
 print_r($_SESSION['userInfo']);
  
?>
<!-- 载入公共js -->
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.nicescroll.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/jquery.blockui.js"></script>
<script type="text/javascript" src="/plugins/layer/layer.js"></script>
<link rel="stylesheet" href="/plugins/layer/layer.css?v=3.0.3303" id="layuicss-skinlayercss">
<style>
.noauth{display:none !important;}
<?php if($_SESSION['userInfo']['pManageName']=='admin'){?>.adminBumenName{display:none;}<?php } ?>

</style>
<div id="header" class="navbar navbar-inverse navbar-fixed-top" style="position:fixed">
  <!-- BEGIN TOP NAVIGATION BAR 头部开始-->
  <div class="navbar-inner">
    <div class="container-fluid">
      <!--BEGIN SIDEBAR TOGGLE-->
      <div class="sidebar-toggle-box hidden-phone">
        <div class="icon-reorder tooltips" data-placement="right"      data-original-title="切换导航"> <img class="img-responsive" src="/public/images/lingx.png" alt="Metro Lab"  width="30px" height="30px"/> </div>
      </div>
      <h4>高铁检修综合管理平台 <span style="font-size:14px;color:#FFFF00;">（&nbsp;<?=$_SESSION['userInfo']['pManageName']?>: <?=$_SESSION['userInfo']['bumenTree']?>&nbsp;）</span></h4> 
      <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="arrow"></span> </a>
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
      
      <?php foreach ($catlogForLeft as $key => $value) { //遍历输出左侧导航?>
            <li class="sub-menu <?php if(!checkAuthByAction("show",$key,"",""))echo 'noauth';?>"> <a href="javascript:;" class=""> <i class="icon-book"></i> <span><?=$value['name']?></span> <span class="arrow"></span> </a>
            <ul class="sub">
              <?php //遍历输出二级导航
			   if($value['subnav'] != ""){
				   foreach ($value['subnav'] as $keySub => $valueSub) { 
				    if($keySub == "auth"){//权限列表，仅url参数中含有roleId时显示。
						if($_GET['roleId']=="")continue ;
						else $subNavUrl = $valueSub['url']."&roleId=".$_GET['roleId'];
					}
					else $subNavUrl = $valueSub['url'];
				   ?>
              <li class="<?php if(!checkAuthByAction("show",$key,$keySub,$valueSub['action']))echo 'noauth';?>"><a href="<?=$subNavUrl?>"><?=$valueSub['name']?></a></li>
             <?php 
			 	 }//end for sub
			   }// end if
			  ?>
            </ul>
          </li>
      
      <?php }//end for ?>
      
      <li> <a class="" href="/login/login/index"> <i class="icon-user"></i> <span>登录页面</span> </a> </li>
      <li> <a class="" href="/deviceTest/deviceSimulation/index_m"> <i class="icon-user"></i> <span>硬件信息设置</span> </a> </li>
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
var myAdminBumenId = "<?=$_SESSION['userInfo']['adminBumenId']?>";
//是否为超级管理员
var isSuperAdmin = false;
<?php if($_SESSION['userInfo']['isSuperAdmin']==1)echo 'isSuperAdmin = true;';?>
</script>