<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/mui.min.css">
    <style>
        .news-detail{margin-top: 50px}
    </style>
</head>
<body>
<header class="mui-bar mui-bar-nav">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
        <h1 class="mui-title">消息通知</h1>
</header>
<div class="news-detail news-detail-page">
                <div class="train-logo"><span class="train-v"><?=$News_detail['informTitle']?></span></div>
                <div class="news-info b-line">
        <span class="data"><?=$News_detail['informPublishTime']?></span>
        <span class="publi"><?=$News_detail['pManageName']?></span>
    </div>
</div>
<div class="news-page-text" style="margin-bottom: 50px">
    <p><?=$News_detail['informContent']?></p>
    <p><img src="/public/images/1.jpg" class="hero-pic"></p>
</div>
<script src="/public/js/mui.min.js"></script>
<script>
    mui.init();
    var news = <?=$News_detail?>;
</script>