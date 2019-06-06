<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <script src="/public/js/mui.min.js"></script>
    <link rel="stylesheet" href="/public/css/mui.min.css">
    <style>
    .mui-popup-inner input{width:70% !important;}
    </style>
</head>
<body class="android">
<div class="scroll-content">
    <div class="scroll">
        <div class="my-info">
            <div class="my-info-background" style="background-color:#4a8bc2;color:#fff; -webkit-filter:blur(0px)">
            <!-- <img class="my-avatar" src="/public/images/touxiang.jpeg"> -->
            <span class="name">高铁检修综合管理平台</span>
            <div style="position:absolute;top:70px;left:50%;width:100px;text-align:center;margin:000-50px;"><?=$_SESSION['userInfo']['pManageName']?></div>
            <span class="my-vip" style="background:none;top:50px;width: 400px;    margin: 70px 0 0 -200px;">部门：<?=$_SESSION['userInfo']['adminBumenName']?>&nbsp;|&nbsp;职位：<?=$_SESSION['userInfo']['bManageName']?></span>
            </div>
        </div>
         
        <div class="devider b-line"></div>
        <!-- 个人中心-->
        <div style="margin-bottom: 80px">
            <div class="aui-list-cells">
             <a href="/my/myinformation/index_m" class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/icon-png/icon-ax-7.png"></div>
                    <div class="aui-list-cell-cn">我的资料</div>
                    <div class="aui-list-cell-fr"></div>
                </a>
                <a href="javascript:;" class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/icon-png/xiugai.png"></div>
                    <div class="aui-list-cell-cn" id="updatePwd">修改密码</div>
                    <div class="aui-list-cell-fr"></div>
                </a>
                <a href="/my/dailyTask/index_m" class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/icon-png/renwu.png"></div>
                    <div class="aui-list-cell-cn">每日任务</div>
                    <div class="aui-list-cell-fr"></div>
                </a>
                <a href="/my/sugestion/index_m" class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/icon-png/icon-n-5.png"></div>
                    <div class="aui-list-cell-cn">意见反馈</div>
                    <div class="aui-list-cell-fr"></div>
                </a>
                <div class="devider b-line"></div>
                <a href="/my/setting/index_m" class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/set.png"></div>
                    <div class="aui-list-cell-cn">设置</div>
                    <div class="aui-list-cell-fr"></div>
                </a>
                <a style="display:block; text-align:center; margin:10px auto 0; color:#fff;font-size:1.2em;font-weight: 600; padding:6px 0; background:#4a8bc2;" href="/application/views/login/logout.php" >退出</a>    
            </div>
        </div>
    </div>
</div>

<script>

    $(function(){
       $('.tab4').addClass("active1");  
    })
    mui.init();
	var btnArray = ['取消', '确认'];
	var userInfo = <?= json_encode($_SESSION['userInfo'])?>;
    var pManagePassword = userInfo['pManagePassword'];
    var pManageId = userInfo['pManageId'];
    //console.log(pManagePassword);
    mui(".android").on('tap','#updatePwd',function(e){
        //$('.android').on('click','#updatePwd',function(){

       // })
    //$("#updatePwd").click(function(e) {
        console.log(55);
         var passwordBox = '<div class="oldPassword">'+
                    '<label>原始密码：</label>'+
                    '<input type="password"  name="oldPassword" id="oldPassword">'+'</div>'+
                  '<div class="newPassword">'+
                    '<label>新&nbsp;密&nbsp;码：</label>'+
                    '&nbsp;<input type="password" name="newPassword" id="newPassword">'+
                    '</div>'+
                  '<div class="confirmPassword">'+
                    '<label>确认密码：</label>'+
                    '<input type="password" name="confirmPassword" id="confirmPassword">'+
                  '</div>'+
                  '<div id="tip">'+
                    '<span>提示：如忘记密码，可以联系本单位管理员重置密码</span>'+
                  '</div>';
		      mui.confirm(passwordBox, '修改密码', btnArray, function(e){
			  if(e.index==1){
                //判断新旧密码
                var newPassword = $.trim($("#newPassword").val());
                var oldPassword = $.trim($("#oldPassword").val());
                var length = newPassword.length;
                var confirmPassword = $.trim($("#confirmPassword").val());
                console.log(length);
                if(oldPassword != pManagePassword){
                    mui.alert("旧密码输入错误！");
                    return false;
                }
                else if(newPassword == '' || oldPassword == '' ){
                  mui.alert("新旧密码都不能为空！");
                  return false;
                }else if (length < 6) {
                  mui.alert("新密码不能少于6位数！");
                  return false;
                }else if (newPassword != confirmPassword ){
                  mui.alert("新旧密码要一致！");
                  return false;
                }
				  $.ajax({
					  url: '<?=CURRENT_DIR?>/index_add.php?',
					  type: 'POST',
					  dataType: 'json',
					  data: {
						  'pManageId': pManageId,
                          'newPassword':newPassword,
					  },
					  success: function (msg){
		                 mui.alert("修改成功！");
					  },
					  error: function(msg){
							  mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
						  }
				 })
	       }
	   });
 });
</script>