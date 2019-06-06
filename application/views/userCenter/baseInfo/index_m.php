<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <script src="/public/js/mui.min.js"></script>
    <link rel="stylesheet" href="/public/css/mui.min.css?<?=rand(1,99999)?>">
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <style>
     
    </style>
</head>
<body class="android" style="overflow:auto;background:#fff !important">
<div class="view-container" style="overflow:auto">
            
            <div class="train-title">
                <div class="train-logo"><span class="train-v">高铁检修综合管理平台</span></div>
            </div>
            <div class="grids-contant3" >
                <a class="<?php if(!checkAuthByAction("show","taskManage","TworkOrder","index"))echo 'noauth';?>" href="/taskManage/TworkOrder/index_m">
                <div class="grids-grid3">                   
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-s-15.png" alt=""></div>
                        <p class="grids-grid-label">今日工单</p>
                        <p class="grids-grid-num"><?=$Tworkorder_mount?>条</p>
                    </div>
                </div>
                 </a>
                 <a class="<?php if(!checkAuthByAction("show","personLocal","RealTimeLocal","index"))echo 'noauth';?>" href="/personLocal/RealTimeLocal/index_m">
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-s-6.png" alt=""></div>
                        <p class="grids-grid-label">实时定位</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                </a>
               <?php /*?> <a class="<?php if(!checkAuthByAction("show","toolsManage","clearRecord","index"))echo 'noauth';?>" href="/toolsManage/clearRecord/index_m">
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/jilu.png" alt=""></div>
                        <p class="grids-grid-label">清点记录</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                </a><?php */?>
                 <a class="<?php if(!checkAuthByAction("show","toolsManage","clearRecord","index"))echo 'noauth';?>" href="/toolsOutIn/toolsOutIn/index_m">
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/cangku3.png" alt=""></div>
                        <p class="grids-grid-label">工具出入库</p>
                        <p class="grids-grid-num"><?=$tworkorderDev_in_mount?>/<?=$tworkorderDev_mount?>条</p>
                    </div>
                </div>
                </a>
                <a class="<?php if(!checkAuthByAction("show","toolsManage","clearRecord","index"))echo 'noauth';?>" href="/toolsToolbag/toolsToolbag/index_m">
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/toolbag3.png" alt=""></div>
                        <p class="grids-grid-label">工具包详情</p>
                        <p class="grids-grid-num"><?=$tworkorderToolbag_in_mount?>/<?=$tworkorderToolbag_mount?>条</p>
                    </div>
                </div>
                </a>
                <a class="<?php if(!checkAuthByAction("show","signManage","todaySign","index"))echo 'noauth';?>" href="/signManage/todaySign/index_m">
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-n-2.png" alt=""></div>
                        <p class="grids-grid-label">考勤管理</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                </a>
                <a class="<?php if(!checkAuthByAction("show","safetyDoor","ceControl","index"))echo 'noauth';?>" href="/safetyDoor/ceControl/index_m">
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-m.png" alt=""></div>
                        <p class="grids-grid-label">安全门</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                </a>
               <?php /*?> <a href="/my/news/index_m">
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-x-1.png" alt=""></div>
                        <p class="grids-grid-label">通知/公告</p>
                        <p class="grids-grid-num"><?=$news_mount?>条</p>
                    </div>
                </div>
                </a><?php */?>
            </div>
            <div class="devider b-line"></div>
            <div class="item-phone b-line">
                <div><img src="/public/images/safetylogo.png" style="width:50px"/></div>
            <a href="/my/safety/index_m" class="item-phone-lin " style="">
            <p class="item-phone-title">安全揭示</p>
            <p class="item-phone-sub">铁路局安全措施发布！</p>
        </a>
    </div>
            <div class="item-lodge" style="padding-bottom:60px">
                <a href="#" class="item-lodge-click r-line">
                    <div class="item-lodge-title">
                        <p  class="item-lodge-yellow">仓库/工具管理</p>
                        <p class="item-lodge-nta">工具列表</p>
                    </div>
                    <div class="item-lodge-img"><img src="/public/images/icon-png/icon-ax-4.png"></div>
                </a>
                <a href="/personnelManage/pManage/index_m" class="item-lodge-click r-line">
                    <div class="item-lodge-title">
                        <p  class="item-lodge-yellow">人员管理</p>
                        <p class="item-lodge-nta">人员信息管理</p>
                    </div>
                    <div class="item-lodge-img"><img src="/public/images/icon-png/icon-ax-5.png"></div>
                </a>
            </div>
    </div>
    
<script>
    window.onload = function(){
        $('.tab1').addClass('active1');
    }
   
</script>
