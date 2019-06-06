<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <script src="/public/js/mui.min.js"></script>
    <link rel="stylesheet" href="/public/css/mui.min.css?1.0">
</head>
<body class="android">
<?php //print_r($_SESSION['userInfo']);?>
<div class="scroll-content" >
    <div class="scroll">
        <div class="my-info">
            <div class="my-info-background" style="background-color:#4a8bc2;color:#fff; -webkit-filter:blur(0px)">
            <!-- <img class="my-avatar" src="/public/images/touxiang.jpeg"> -->
            <span class="name">高铁检修综合管理平台</span>
            <div style="position:absolute;top:70px;left:50%;width:100px;text-align:center;margin:000-50px;"><?=$_SESSION['userInfo']['pManageName']?></div>
            <span class="my-vip" style="background:none;top:50px;">角色：<?=$_SESSION['userInfo']['bManageName']?></span>
            </div>
        </div>
        <div class="my-car-shortcut">
            <div class="layout-column">
                <!--<a class="col"  rel="test" href="/my/mySign/index_m">
							<span class="img-icon ">
								<img src="/public/images/icon-png/icon-ax-6.png" alt="">
							</span>
                    <span class="img-icon-name">我的考勤</span>
                </a>-->
                <a class="col"  rel="test" href="/my/myinformation/index_m">
							<span class="img-icon ">
								<img class="img-icon-home" src="/public/images/icon-png/icon-ax-7.png" />
							</span>
                    <span class="img-icon-name">我的资料</span>
                </a>
                <a class="col" href="/my/news/index_m" rel="test">
							<span class="img-icon ">
								<img class="img-icon-home" src="/public/images/icon-png/icon-ax-8.png" />
							</span>
                    <span class="img-icon-name">消息通知</span>
                </a>
            </div>

        </div>
        <div class="devider b-line"></div>
        <!-- 个人中心-->
        <div style="margin-bottom: 80px">
            <div class="aui-list-cells">
                
                <!--<a href="javascript:;" class="aui-list-cell">
                    <div class="aui-list-cell-fl"><img src="/public/images/icon-png/renzheng.png"></div>
                    <div class="aui-list-cell-cn">申请认证</div>
                    <div class="aui-list-cell-fr">未认证</div>
                </a>-->
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
<!-- <?php print_r($_SESSION['userInfo']);?> -->
<script>
    mui.init();
	var btnArray = ['取消', '确认'];
	
    window.onload=function(){
         
         $('.tab4').addClass("active1");
    }
	
$("#updatePwd").click(function(e) {
         var tooslbag1 = '<div class="updateInputBox">原始密码：<input  type="password" id="input_oldPwd" style="width:60%;padding: 5px;margin:0 0 5px;" /></div><div class="updateInputBox">更新密码：<input id="input_newPwd" type="password" placeholder="" style="width:60%;padding: 5px;" /></div>';
		  mui.confirm(tooslbag1, '修改密码', btnArray, function(e) {
			  if(e.index==1){
				  var input_oldPwd = $.trim( $("#input_oldPwd").val() );
				  var input_newPwd = $.trim( $("#input_newPwd").val() );
				  ///alert(input_oldPwd+"  "+input_newPwd);
				  if(input_oldPwd=="" || input_newPwd==""){
					mui.toast("新旧密码都不能为空！");
				  	return false;
				  }
				  //alert('<?=CURRENT_DIR?>/index_updatePwd.php');
				  $.ajax({
					  url: '<?=CURRENT_DIR?>/index_updatePwd.php',
					  type: 'POST',
					  dataType: 'json',
					  data: {
						  'input_oldPwd': input_oldPwd,
						  'input_newPwd': input_newPwd
					  },
					  success: function (msg){
 		                   if( msg=="oldPwdError"){
							   mui.toast("原始密码错误！");
						   }
						   else{
							   mui.toast("修改密码成功！");
						   }
					  },
					  error: function(msg){
						  console.log(msg);
							  mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
						  }
				 })

	       }
	   });
 });

</script>