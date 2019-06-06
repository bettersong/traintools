<?php
    //不同角色跳转到不同页面
    $toUrl = "";
    //是否具有编辑权限的用户，进入到不同页面。

    if ($_SESSION['userInfo']['canEdit']==1){ //$_SESSION['userInfo']['canEdit'] 在登录检查页面login_check.php中进行了定义。
        //$toUrl = "/taskPlan/taskPlan/index_m";
    }
    else if ($_SESSION['userInfo']['roleEnName']=="diaoduyuan"){
        $toUrl = "/taskPlan/unlockingPlan/index_m";
        header("Location: ".$toUrl); exit;
    }
    else {
        $toUrl = "/taskManage/HworkOrder/index_m";
        header("Location: ".$toUrl); exit;
    }

    
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <script src="/public/js/mui.min.js"></script>
    <link rel="stylesheet" href="/public/css/mui.min.css">
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <style>
    .grids-contant3 .grids-grid3{width:25%;}
    </style>
</head>
<body class="android" style="overflow:auto;background:#fff !important">

<div class="mui-content mui-scroll-wrapper"> 

<div class="view-container" style="overflow:auto">
<div class="train-title" style="display:none;">
    <div class="train-logo"><span class="train-v">高铁检修综合管理平台</span></div>
</div>
<div class="grids-contant3">
    <a class="<?php if(!checkAuthByAction("show","taskManage","TworkOrder","index"))echo 'noauth';?>" href="/taskPlan/taskPlan/index_m">
        <div class="grids-grid3">                   
            <div class="grids-grid3-cont">
                <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-s-15.png" alt=""></div>
                <p class="grids-grid-label">今日工单</p>
                <!--<p class="grids-grid-num"> <?=$Tworkorder_mount?> 0条</p>-->
            </div>
        </div>
    </a>

    <a href="/toolsToolbag/toolsToolbag/index_m">
        <div class="grids-grid3">                   
            <div class="grids-grid3-cont">
                <div class="grids-grid-icon"><img style="width: 34px; height: 32px;margin: 10px 0 0;" src="/public/images/icon-png/gjb3.png" alt=""></div>
                <p class="grids-grid-label">工具包详情</p>
                <!--<p class="grids-grid-num"> <?=$Tworkorder_mount?> 0条</p>-->
            </div>
        </div>
    </a>
                    
<script>
    window.onload = function(){
        $('.tab1').addClass('active1');
    }
    var userId = <?=$_SESSION['userInfo']['adminBumenId']?>

    if(userId==12){
        //alert(1);
        navigator.vibrate([500, 300, 400,300]);
    }

//Vibration接口用于在浏览器中发出命令，使得设备振动。
   function vibration(){
       navigator.vibrate = navigator.vibrate
               || navigator.webkitVibrate
               || navigator.mozVibrate
               || navigator.msVibrate;

       if (navigator.vibrate) {
           // 支持
           console.log("支持设备震动！");
       }
   }
   
</script>



