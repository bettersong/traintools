<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/mui.min.css?1.0">
        <style type="text/css">
            .mui-content>.mui-table-view:first-child {
                margin-top: -1px;
            }
        </style>
    </head>

    <body>
    <div class="train-title" >
                <div class="train-logo"><span class="train-v">安全揭示</span></div>
            </div>
        <!--下拉刷新容器-->
        <div id="pullrefresh" class="mui-content mui-scroll-wrapper" style="top:40px">
            <div class="mui-scroll">
                <!--数据列表-->
                <ul class="mui-table-view mui-table-view-chevron"></ul>
            </div>
        </div>
        <script src="/public/js/mui.min.js" type="text/javascript" charset="utf-8"></script>
        <script>
            
            mui.init({
                pullRefresh: {
                    container: '#pullrefresh',
                    down: {
                        style:'circle',
                        callback: pulldownRefresh
                    },
                    up: {
                        auto:true,
                        contentrefresh: '正在加载...',
                        callback: pullupRefresh
                    }
                }
            });
            console.log('<?=json_encode($safe_report)?>');
            var safe_reportArr = <?=json_encode($safe_report)?>;
            
            var count = 0;
            function pullupRefresh() {
                setTimeout(function() {
                    mui('#pullrefresh').pullRefresh().endPullupToRefresh((++count > 2)); //参数为true代表没有更多数据了。
                    var table = document.body.querySelector('.mui-table-view');
                    var cells = document.body.querySelectorAll('.mui-table-view-cell');
                    var newCount = cells.length>0?5:10;//首次加载10条，满屏
                    console.log(newCount);
                    for (var i = cells.length, len = i + newCount; i < len; i++) {
                        var li = document.createElement('li');
                        li.className = 'mui-table-view-cell';
                       li.innerHTML = '<a class="mui-navigate-right" href="index_detail_m&safetyId='+safe_reportArr[i]["safetyId"]+'">' +'<h4 style="font-size: 16px">'+ safe_reportArr[i]["safetyTitle"]+'</h4>' +'<span style="font-size: 14px;color: #666;"><i class="news-in-time"></i>'+safe_reportArr[i]["safetyPublishTime"] +'</span>'+ '</a>';
                        table.appendChild(li);
                         console.log(safe_reportArr[i]["informId"]);
                    }

                }, 1500);
            }

            function addData() {
                var table = document.body.querySelector('.mui-table-view');
                var cells = document.body.querySelectorAll('.mui-table-view-cell');
                for(var i = cells.length, len = i + 5; i < safe_reportArr.length; i++) {
                    var li = document.createElement('li');
                    li.className = 'mui-table-view-cell';
                    li.innerHTML = '<a class="mui-navigate-right" href="index_detail_m&safetyId='+safe_reportArr[i]["safetyId"]+'">' +'<h4 style="font-size: 16px">'+ safe_reportArr[i]["safetyTitle"]+'</h4>' +'<span style="font-size: 14px;color: #666;"><i class="news-in-time"></i>'+safe_reportArr[i]["safetyPublishTime"] +'</span>'+ '</a>';
                    table.insertBefore(li, table.firstChild);
                }
            }
            /**
             * 下拉刷新具体业务实现
             */
            function pulldownRefresh() {
                setTimeout(function() {
                    addData();
                    mui('#pullrefresh').pullRefresh().endPulldownToRefresh();
                    mui.toast("刷新成功");
                }, 1500);
            }
            //
            mui('body').on('tap', 'a', function() {
               window.top.location.href = this.href;
            });

        </script>
