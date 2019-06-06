<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?=$_GET['orderType']=='history'?'历史工单':'作业计划'?>详情（<?=$orderInfoArr['JiHuaDate']?>）</title>
    <script src="/public/js/mui.min.js"></script>
     <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link href="/public/css/style_m.css?a2" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/mui.min.css">
     <style>
	a,a:hover{text-decoration:none}.table th,.table td{padding:2px}.widget{margin-bottom:10px}.table th,.table td{padding:8px 2px;text-align:;}.active{display:block}.dataTables_length{display:none!important}
    .title{margin-top:15px;text-align:left;}
    .widget{border:0;border-radius:3px!important}
    .widget-title{background:#404040 url(/public/images/arrow-r2.png) no-repeat;background-position:right;background-size:16px;padding-left:25%;}
	.row-fluid .span11 {
    width: 91.48936170212765%;
    margin:0  auto;
}
    </style> 
</head>
<body>

    <header class="mui-bar mui-bar-nav">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
        <h1 class="mui-title"><?=$_GET['orderType']=='history'?'历史工单':'作业计划'?>详情（<?=$orderInfoArr['JiHuaDate']?>）</h1>
    </header>
 
       <div class="mui-page-content" style="margin-top:100px;margin-bottom:100px">
       <a href="/safetyInform/index_m&twOrderId=<?=$twOrderId?>">
       <div class="row-fluid title">
                <div class="span11">
                    <div class="widget purple">
                        <div class="widget-title">安全揭示</div>
                    </div>
                </div>
            </div>
        </a>
       <a id="prepareBox" href="/taskPlan/prepare/index_m&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>">
       <div class="row-fluid title">
                <div class="span11">
                    <div class="widget green">
                        <div class="widget-title">班前准备（<?php 
                        if( $orderInfoArr['twOrderConfirmed_tools']==1 && $orderInfoArr['twOrderConfirmed_persons']==1 ) echo '<span class="prepared">已准备</span>';
                        else echo '<span class="unPrepared">未准备</span>';?>）
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <!-- if($("#prepareBox").find(".unPrepared").length>0){mui.alert("抱歉，请先完成班前准备！");return false;} -->
        <a id="personToolsCheckInBox" onclick='return false;'  href="/taskPlan/personToolsCheckIn/index_m&direction=in&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>">
            <div class="row-fluid title">
                <div class="span11">
                    <div class="widget orange">
                        <div class="widget-title">进作业门清点（<?php if( $orderInfoArr['twOrderCheck_doorIn']==1 ) echo '<span class="prepared">已清点</span>';
                        else echo '<span class="unPrepared">未清点</span>';?>）</div>
                    </div>
                </div>
            </div>
        </a>
        <a id="taskManageBox" onClick='if($("#personToolsCheckInBox").find(".unPrepared").length>0){mui.alert("抱歉，请先完成进门清点！");return false;}' href="/taskPlan/taskManage/index_m&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>">
            <div class="row-fluid title">
                <div class="span11">
                    <div class="widget yellow">
                        <div class="widget-title">作业现场管理</div>
                    </div>
                </div>
            </div>
        </a>
        <a id="personToolsCheckOutBox"  href="/taskPlan/personToolsCheckIn/index_m&direction=out&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>">
            <div class="row-fluid title">
                <div class="span11">
                    <div class="widget blue">
                        <div class="widget-title">出作业门清点（<?php if( $orderInfoArr['twOrderCheck_doorOut']==1 ) echo '<span class="prepared">已清点</span>';
                        else echo '<span class="unPrepared">未清点</span>';?>）</div>
                    </div>
                </div>
            </div>
        </a>
        <a id="taskSummaryBox" onClick='if($("#personToolsCheckOutBox").find(".unPrepared").length>0){mui.alert("抱歉，请先完成出门清点！");return false;}' href="/taskPlan/taskSummary/index_m&twOrderId=<?=$twOrderId?>&orderType=<?=$_GET['orderType']?>">
            <div class="row-fluid title">
                <div class="span11">
                    <div class="widget pink">
                        <div class="widget-title">工作总结（<?php if( $orderInfoArr['twOrderConfirmed_summary']==1 ) echo '<span class="prepared">已总结</span>';
                        else echo '<span class="unPrepared">未总结</span>';?>）</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
</div>
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script>

    $(function(){
        mui(".mui-page-content").on('tap','#personToolsCheckInBox',function(){
             if($("#prepareBox").find(".unPrepared").length>0){
                mui.alert("抱歉，请先完成班前准备！");
                return false;
            }
        });
        mui(".mui-page-content").on('tap','#personToolsCheckOutBox',function(){
               if($("#personToolsCheckInBox").find(".unPrepared").length>0){
                        mui.alert("抱歉，请先完成进门清点！");
                        return false;
                    }
        })
    })
function toAction(obj){
	//alert("111");
	$(this).prev("a").find(".unPrepared").length
	return false;
	return false;
}
 
</script>
</body>
</html>
</body>