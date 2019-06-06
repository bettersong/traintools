<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>我的资料</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <link rel="stylesheet" href="/public/css/mui.min.css">
</head>
<body class="android">
<div class="scroll-content" >
    <div class="scroll">
    <!-- <header class="mui-bar mui-bar-nav">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
        <h1 class="mui-title">我的资料</h1>
    </header> -->
        <!-- 个人资料-->
        <div class="mui-content mui-scroll-wrapper"><!--下拉刷新容器,包含整个body内容-->
        <div style="margin-bottom: 80px">
            <div class="aui-list-cells">
            <span class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/name.png"></div>
                    <div class="aui-list-cell-cn">姓名</div>
                    <div class="aui-list-cell-fr"><?=$myinformation['pManageName']?></div>
                </span>
                
                <span class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/bumen.png"></div>
                    <div class="aui-list-cell-cn">部门</div>
                    <div class="aui-list-cell-fr"><?=$myinformation['adminBumenName']?></div>
                </span>
                <span class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/zhiwei.png"></div>
                    <div class="aui-list-cell-cn">职位</div>
                    <div class="aui-list-cell-fr"><?=$myinformation['bManageName']?></div>
                </span>
                <span class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/sex.png"></div>
                    <div class="aui-list-cell-cn">性别</div>
                    <div class="aui-list-cell-fr"><?php if($myinformation['pManageSex']==1)echo"女";else echo"男";?></div>
                </span>
                <span class="aui-list-cell phone">
                    <div class="aui-list-cell-fl"><img src="/public/images/phone.png"></div>
                    <div class="aui-list-cell-cn">手机号</div>
                    <div class="aui-list-cell-fr phoneNumber"><?=$myinformation['pManageContact']?></div><span style="color:red;">(可修改)</span>
                </span>
                <div class="devider b-line"></div>
                <span  class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/adress.png"></div>
                    <div class="aui-list-cell-cn">我的地址</div>
                    <div class="aui-list-cell-fr">暂无</div>
                </span>
                
            </div>
        </div>
    </div>
</div>
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script>
    var information = <?= json_encode($myinformation)?>;
    console.log(information);
    $('.phone').on('click',function(){
        var phoneNumber = $('.phoneNumber').html();
        var userName = '<?=$myinformation['pManageName']?>';
        console.log(userName);
        console.log(phoneNumber);
        mui.prompt('修改您的手机号',phoneNumber,function(e){
            if(e.index == 1){
        var contact = e.value;
        console.log(contact);
        $.ajax({
        async:false,
        type: "post",
        data: {
            "userName":userName,
            "contact":contact,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
        if(contact==''){mui.alert('电话号码不能为空！'); return false;}
          else if(contact.length!=11){mui.alert('电话号码格式不正确！'); return false;}
              else mui.alert("修改成功！");
           console.log(msg);
            $('.phoneNumber').html(contact);
          },
        error: function(msg){
            mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    
});
        }
})
})    
</script>