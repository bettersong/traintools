
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>高铁检修综合管理平台</title>
        <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
        <meta content="yes" name="apple-mobile-web-app-capable"/>
        <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
        <meta content="telephone=no" name="format-detection"/>
        <script src="/public/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/plugins/layer/layer.js"></script>
  		<link rel="stylesheet" href="/plugins/layer/layer.css?v=3.0.3303" id="layuicss-skinlayercss">
        <link rel="stylesheet" href="/public/css/login_m.css">
    </head>
    <body>
        <section class="aui-flexView">
            <div style="margin:20px auto 20px; text-align: center;font-weight:600;">
            	<img style="height:22px;vertical-align: baseline;margin:0 0 10px;" src="/public/images/logo2.png" /><br>
                高铁线路施工人员和工器具上线管理系统
            </div>
            <section class="aui-scrollView">
                <div class="aui-code-box">
                    
                        <p class="aui-code-line">
                            <input type="text" class="aui-code-line-input" name="search" value="" id="userName" autocomplete="off" placeholder="输入用户名："/>
                        </p>
                        <p class="aui-code-line aui-code-line-clear">
                            
                            <input style="border-top:0;" id="password" type="password" class="aui-code-line-input password" placeholder="输入登陆密码：" value="">
                        </p>
                        <div class="aui-code-btn">
                            <button id="btn">登录</button>
                        </div>
                        <div class="aui-flex-links">
                            <a style="margin-left:-8px;color:#999;" href='javascript:layer.alert("忘记密码请联系管理员！", {icon:6,title: "【提示】"});'>（初始密码:123456）忘记密码?</a>
                            
                        </div>
                   
                </div>
            </section>
        </section>
        <script type="text/javascript">
           //隐藏加载进来的底部
            window.onload=function(){
                var footer = $('#nav4_ul');
                footer.hide();
            }
     //提交登陆
	 
	$("#btn").click(function() {
      var userName = $.trim( $("#userName").val() );
    	var password = $.trim( $("#password").val() );
     	if(userName == ""){
        layer.alert("请输入用户名", {icon:0,title: '【提示】'});
    		return false;
    	}
    	else if(password == ""){
        layer.alert("请输入密码", {icon:0,title: '【提示】'});

    		return false;
    	}
    	$.ajax({
    	  async:false,
    	  type: "post",
    	  data: {
          	  "userName":userName,
    		  "password":password
     	  },
    	  dataType: 'json',
    	  url: "/application/views/login/login/login_check.php",
    	  success: function (msg) {

     		  if(msg == "success"){
    			  window.location.href = '/index/index';// /taskPlan/taskPlan/index
    		  }
    		  else{
                layer.alert("登陆失败,账户或密码错误", {icon:0,title: '【提示】'});
    		  }
          // alert(msg);
    	  },
    	  error: function (msg) {
          layer.alert(msg.status + "服务繁忙，请刷新或稍后再试。", {icon:0,title: '【提示】'});

    	  }
      });
    });
        </script>
    </body>
</html>