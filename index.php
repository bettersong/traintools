<?php session_start();
/** 
  *入口文件
  *
  *功能：初始化与启动框架
  * @author zhouhuixiang
  * @version 1.0
*/
//检查移动设备
include $_SERVER['DOCUMENT_ROOT']."/application/views/Mobile_Detect.php";
$ism=false; //是否为移动端
$detect = new Mobile_Detect();
if($detect->isMobile()&&!$detect->isTablet()){
  $ism=true;
}

//echo 'userInfo: ';print_r($_SESSION['userInfo']);
//当用户未登录的时候，直接跳转到前端页面
//echo $_GET['url'];
if ( !isset($_SESSION['userInfo']) && strpos($_GET['url'],'login')===false ) {
   header('Location: /application/views/login/login/index_m');
}

//初始化常量
defined('APP_PATH') or define('APP_PATH', $_SERVER['DOCUMENT_ROOT'].'/'); //项目根目录
defined('FRAME_PATH') or define('FRAME_PATH', APP_PATH.'core/'); //框架核心目录
defined('CONFIG_PATH') or define('CONFIG_PATH', APP_PATH.'conf/'); //配置文件目录
defined('RUNTIME_PATH') or define('RUNTIME_PATH', APP_PATH.'runtime/'); //临时文件目录


//是否开启调试模式
defined('APP_DEBUG') or define('APP_DEBUG', false);

//包含配置文件
require CONFIG_PATH . 'config.php';
require FRAME_PATH . 'functions.php';
//包含核心框架类
require FRAME_PATH . 'Core.php'; 

//实例化核心类
$fast = new Core;
$fast->run();