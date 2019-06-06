<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
</head>
<body class="android">
<div class="scroll-content" >
    <div class="scroll">
        
        
        
    <div class="devider b-line" style="height:40px">我的考勤</div>
        <!-- 个人中心-->
        <div style="margin-bottom: 80px">
            <div class="aui-list-cells">
            <a href="javascript:;" class="aui-list-cell">
                    
                    <div class="aui-list-cell-cn">出勤天数</div>
                    <div class="aui-list-cell-fr"><?php if($my_attendance['COUNT(twamAttendance)']=='')echo 0;else echo($my_attendance['COUNT(twamAttendance)']);?>天</div> 
                </a>
                
                <a href="javascript:;" class="aui-list-cell">
                    
                    <div class="aui-list-cell-cn">休息天数</div>
                    <div class="aui-list-cell-fr">0天</div>
                </a>
                <a href="javascript:;" class="aui-list-cell">
                    
                    <div class="aui-list-cell-cn">迟到</div>
                    <div class="aui-list-cell-fr">0次</div>
                </a>
                <a href="javascript:;" class="aui-list-cell">
                    
                    <div class="aui-list-cell-cn">早退</div>
                    <div class="aui-list-cell-fr">0次</div>
                </a>
                <a href="javascript:;" class="aui-list-cell">
                    
                    <div class="aui-list-cell-cn">旷工</div>
                    <div class="aui-list-cell-fr">0次</div>
                </a>
                
                <a href="javascript:;" class="aui-list-cell">
                    
                    <div class="aui-list-cell-cn">加班</div>
                    <div class="aui-list-cell-fr">0天</div>
                </a>
                
            </div>
        </div>


    </div>
</div>

<script>

</script>