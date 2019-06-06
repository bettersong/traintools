<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>问题和建议</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/mui.min.css?1.0">
</head>
<body class="android" style="background:#f5f5f5">
<div class="scroll-content" >
  <div class="mui-content mui-scroll-wrapper"><!--下拉刷新容器,包含整个body内容-->
    <div class="scroll">
        <!-- <header class="mui-bar mui-bar-nav">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
        <h1 class="mui-title">问题和建议</h1>
        </header> -->

        <!-- 个人中心-->
        <div style="margin-bottom:80px;margin-top:50px;">
        
            <div class="aui-list-cells">
                
            <textarea style="width:100%;border:none;" id="note" onkeyup="this.value=this.value.substring(0, 100)" placeholder="请填写10个字以上的问题描述以便我们提供更好的帮助"></textarea>
            <p style="float:right;margin-right:5px"><span id="text-count">0</span>/100</p>
                
            </div>
        </div>
        <div class="devider b-line" style="height:40px;margin-top:-80px;">联系电话</div>
        <input id="tel" typt="text" style="width:100%"  placeholder="便于我们与你联系">
        <button value="" id="btn" class="btn1">提交</button>

    </div>
</div>
<script src="/public/js/jquery-1.8.3.min.js?v=0.101"></script>
<script src="/public/js/mui.min.js"></script>
<script>
mui.init();
mui('.mui-scroll-wrapper').scroll();
     //字数统计
    window.onload = function() {
        //（document）
        document.getElementById('note').onkeyup = function() {        
            document.getElementById('text-count').innerHTML=this.value.length;
            var num = $('#text-count').html();
            //console.log(num);
            //字数限制
            if(num>100){
                mui.alert("字数超过100");
                $('#note').css({"color":"red"});
            }
        }  
    }
    $('#btn').on('click',function(){
        var message = $('#note').val();//
        var telNumber = $('#tel').val();
        var userId = <?=$_SESSION['userInfo']['pManageId']?>;

        if(message.length == 0){
            mui.alert("问题和意见不能为空！");
            return false;
        }
        else if(telNumber.length != 11 || isNaN(telNumber)){
            mui.alert("请输入正确的联系方式！");
            return false;
        }
        $.ajax({
          url: '<?=CURRENT_DIR?>/inde_add.php?',
          type: 'POST',
          dataType: 'json',
          data: {
              'message': message,
              'telNumber':telNumber,
              "userId":userId
          },
          success: function (msg){
               mui.alert("提交成功！");
               console.log(msg)
          },
          error: function(msg){
                  mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
              }
     })
    })
   
</script>