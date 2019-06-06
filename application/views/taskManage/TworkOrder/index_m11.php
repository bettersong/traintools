
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    
    <style>
     *{padding:0; margin:0;}
    ul, ol, li, dl {
list-style-type: none;
}
.nav4 ul{
    position:fixed;
    z-index:200;
    bottom:0;
    left:0;
    width:100%
}
.nav4 li{
    border:1px solid #ccc;
    height:50px;
    border-bottom:0;
    border-right:0;
    border-top-color:#ddd;
    position:relative;
    -webkit-box-shadow:inset 0 0 3px #fff;
    float:left;
    width:25%;
}
.nav4 li:nth-of-type(1){border-left;0;}
.nav4 li>a{
    font-size:15px;
    -webkit-box-sizing:border-box;
    box-sizing:border-box;
    /*border:1px solid #f9f8f9;*/
    -webkit-tap-highlight-color:rgba(0,0,0,0);
    border-bottom:0;
    display:block;
    line-height:20px;
    text-align:center;
    background:-webkit-gradient(linear, 0 0, 0 100%, from(#f1f1f1), to(#dcdcdc), color-stop(35% ,#ededed), color-stop(50%, #e3e3e3) );
}
.nav4 li>a:only-child span{
    background:none;
    padding-left:0;
}
.nav4 li>a.on + dl{
    display: block;
}
.nav4 li>a span{
    color: #4f4d4f;
    display: inline-block;
    -webkit-background-size: 9px auto;
    text-shadow:0px 1px 0px #ffffff;
    font-weight:700;
}
/***********************/
.nav4 dl{
    display:none;
    position:absolute;
    z-index:220;
    bottom:53px;
    left:50%;
    width:100px;
    margin-left:-50px;
    background:red;
    /*min-height:100px;*/
    background:#e4e3e2;
    /*border:1px solid #afaeaf;*/
    border-radius:5px;
    -webkit-box-shadow:inset 0 0 3px #fff;
    background:url(/public/images/2.svg#3) no-repeat center center;
    -webkit-background-size:100%;
    background-size:100%;
}
/*, .nav4 dl:after*/
.nav4 dl:before{
    content:"";
    display:inline-block;
    position:absolute;
    z-index:240;
    bottom:0;
    left:50%;
    width:10px;
    height:8px;
    
    -webkit-background-size: 10px auto;
    bottom: -7px;
    margin-left: -5px;
}

.nav4 dl dd{
    line-height:45px;
    text-align:center;
    background:-webkit-gradient(linear, 0 0, 100% 0, from(rgba(194,194,194,0.8)), to(rgba(194,194,194,0.8)), color-stop(50%, rgba(194,194,194,0.8)));
    background-size:80% 1px;
    background-repeat:no-repeat;
    background-position: center bottom;
   
}
.nav4 dl dd:last-of-type{
    background:none;
}
.nav4 dl dd a{
    font-size: 15px;
    display:block;
    color:#4f4d4f;
    text-shadow:0px 1px 0px #ffffff;
    white-space: pre;
    overflow: hidden;
    text-overflow: ellipsis;
}
.nav4 .masklayer_div{
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 180;
    background: rgba(0,0,0,0);
}
.nav4 .masklayer_div.on{display: block;}
    </style>
</head>
<body class="android" style="overflow:auto">
<div class="view-container" style="overflow:auto">
            
            <div class="train-title">
                <div class="train-logo"><span class="train-v">高铁检修综合管理平台</span></div>
            </div>
            <div class="grids-contant3" >
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-s-15.png" alt=""></div>
                        <p class="grids-grid-label">今日工单</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-s-6.png" alt=""></div>
                        <p class="grids-grid-label">实时定位</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-n-5.png" alt=""></div>
                        <p class="grids-grid-label">清点记录</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-n-2.png" alt=""></div>
                        <p class="grids-grid-label">考勤管理</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-m.png" alt=""></div>
                        <p class="grids-grid-label">安全门</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="/public/images/icon-png/icon-x-1.png" alt=""></div>
                        <p class="grids-grid-label">消息/通知</p>
                        <p class="grids-grid-num">0条</p>
                    </div>
                </div>
            </div>
            <div class="devider b-line"></div>
            <div class="item-phone b-line">
        <a href="news-list.html" class="item-phone-lin ">
            <p class="item-phone-title">公司新闻</p>
            <p class="item-phone-sub">高铁检修综合管理平台正式上线！</p>
        </a>
    </div>
            <div class="item-lodge" style="padding-bottom:45px">
                <a href="#" class="item-lodge-click r-line">
                    <div class="item-lodge-title">
                        <p  class="item-lodge-yellow">作业管理</p>
                        <p class="item-lodge-nta">工单审核</p>
                    </div>
                    <div class="item-lodge-img"><img src="/public/images/icon-png/icon-ax-4.png"></div>
                </a>
                <a href="#" class="item-lodge-click r-line">
                    <div class="item-lodge-title">
                        <p  class="item-lodge-yellow">人员管理</p>
                        <p class="item-lodge-nta">人员信息管理</p>
                    </div>
                    <div class="item-lodge-img"><img src="/public/images/icon-png/icon-ax-5.png"></div>
                </a>
            </div>
    </div>

