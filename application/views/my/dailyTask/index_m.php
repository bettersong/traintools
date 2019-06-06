<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>每日任务</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/mui.min.css">
    <style>
    .text_right{width:240px;height:60px;text-align:left;padding:5px;line-height:30px;}
    </style>
</head>
<body class="android">
<div class="scroll-content" >
    <div class="scroll">   
    <!-- <header class="mui-bar mui-bar-nav">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
        <h1 class="mui-title">每日任务</h1>
    </header> -->
    <div class="mui-content mui-scroll-wrapper"><!--下拉刷新容器,包含整个body内容-->
        <!-- 每日任务 -->
          <div style="margin-top: 35px">
            <div class="aui-list-cells">
            <span class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/assign.png"></div>
                    <div class="aui-list-cell-cn">作业项目</div>
                    <div class="aui-list-cell-fr text_right"><?=$dailyTask['ZuoYeXM']?></div>
            </span>
                <span class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/why.png"></div>
                    <div class="aui-list-cell-cn">作业原因</div>
                    <div class="aui-list-cell-fr text_right"><?=$dailyTask['ZuoYeYY']?></div>
                </span>
                <span class="aui-list-cell">
                    <div class="aui-list-cell-fl" ><img src="/public/images/content.png"></div>
                    <div class="aui-list-cell-cn">作业内容</div>
                    <div class="aui-list-cell-fr text_right"><?=$dailyTask['ZuoYeNR']?></div>
                </span>
                
            </div>
        </div>
    </div>
</div>
<script src="/public/js/mui.min.js"></script>
<script>
    mui.init();
</script>