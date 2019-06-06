<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?=$myNews_detail['safetyTitle']?></title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
</head>
<body>
<div class="news-detail news-detail-page">
                <div class="train-logo"><span class="train-v"><?=$myNews_detail['safetySubheading']?></span></div>
                <div class="news-info b-line">
        <span class="data"><?=$myNews_detail['safetyPublishTime']?></span>
        <span class="publi"><?=$myNews_detail['safetyPublisher']?></span>
    </div>
</div>
<div class="news-page-text" style="margin-bottom: 50px">
    <p><?=$myNews_detail['safetyContent']?></p>
    <p><img src="/public/images/1.jpg" class="hero-pic"></p>
</div>