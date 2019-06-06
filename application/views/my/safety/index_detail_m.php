<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
</head>
<body>
<div class="news-detail news-detail-page">
                <div class="train-logo"><span class="train-v"><?=$safe_detail[0]['safetyTitle']?></span></div>
                <div class="news-info b-line">
        <span class="data"><?=$safe_detail[0]['safetyPublishTime']?></span>
        <span class="publi"><?=$safe_detail[0]['pManageName']?></span>
    </div>
</div>
<div class="news-page-text" style="margin-bottom: 50px">
    <p><?=$safe_detail[0]['safetyContent']?></p>
    <p><img src="/public/images/1.jpg" class="hero-pic"></p>
</div>
<?php echo $safe_detail['safetyTitle']?>
<script>
    var news = <?=json_encode($safe_detail)?>;
    
        console.log(news);
        console.log(111);
</script>