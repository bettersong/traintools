<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁线路施工人员和工器具上线管理系统</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/mui.min.css?1.0">
    <script src="/public/js/mui.min.js "></script>
</head>
<body>
<div class="mui-navbar-inner mui-bar mui-bar-nav">
                <button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
                    <span class="mui-icon mui-icon-left-nav"></span>
                </button>
                <h1 class="mui-center mui-title">我的消息</h1>
            </div>
<div class="news-detail" style="margin-bottom: 50px">
    <?php foreach ($myNews as $key => $value) { ?>
    <a href="index_detail_m&safetyId=<?=$value['safetyId']?>">
        <h1 class="title"><?=$value['safetyTitle']?></h1>
        <div class="news-info b-line">
            <span class="data"><i class="news-in-time"></i><?=$value['safetyPublishTime']?></span>
            
        </div>
    </a>
    <?php } ?>
</div>
