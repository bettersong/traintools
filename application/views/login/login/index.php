<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link href="/public/css/login.css?<?=rand(1,99999)?>" rel="stylesheet"  type="text/css"/>
<script src="/public/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="/plugins/layer/layer.js"></script>
  <link rel="stylesheet" href="/plugins/layer/layer.css?v=3.0.3303" id="layuicss-skinlayercss">
 
</head>
<body>
<div class="masked1" id="sx8">高铁检修综合管理平台</div>
<div id="tab">
  <ul class="tab_menu">
    <li class="selected">用户登录</li>
  </ul>
  <div class="tab_box">

    <div>

      <div action="" method="post" class="stu_login_error">
        <!--<div id="bumen">
          <label>部&nbsp;&nbsp;&nbsp;门：</label>
          <select class="bumen" id="select" nullmsg="请选择部门！" > 
                <option value="0">请选择</option>
          </select>
        </div>-->
        <div>
          <label>用户名：</label>
          <input type="text" id="userName" name="userName" placeholder="输入用户名" nullmsg="用户名不能为空！" datatype="s6-18" errormsg="用户名范围在6~18个字符之间！" sucmsg=" "/>
        </div>
        <div>
          <label>密&nbsp;&nbsp;&nbsp;码：</label>
          <input type="password" id="password" name="password" placeholder="输入密码" nullmsg="密码不能为空！" datatype="*6-16" errormsg="密码范围在6~16位之间！" sucmsg=""/>
        </div>
       <!-- <div id="code" style="display:none;">
          <label>验证码：</label>
          <input type="text" id="stu_code_hide" name="code"  value="输入验证码" nullmsg="验证码不能为空！" datatype="*4-4" errormsg="验证码有4位数！" sucmsg="验证码验证通过！"/>
          <img src="/public/images/captcha.jpg" title="点击更换" alt="验证码占位图"/> </div>-->
        <div id="remember">
          <input type="checkbox" name="remember">
          <label>记住密码</label>
        </div>
        <div id="login">
          <button id="submitLogin" type="submit">登录</button>
        </div>
      </div>
    </div>


  </div>
</div>
<div class="bottom"></div>
<div class="screenbg">
  <ul>
    <li><a href="javascript:;"><img src="/public/images/0.jpg"></a></li>
    <li><a href="javascript:;"><img src="/public/images/1.jpg"></a></li>
    <li><a href="javascript:;"><img src="/public/images/2.jpg"></a></li>
  </ul>
</div>
<script>

//enter 键 登录
document.onkeydown=function(event){
  var e = event || window.event || arguments.callee.caller.arguments[0];
  if(e && e.keyCode==13){ // enter 键
	$("#submitLogin").click();
  }
}; 
	
 //提交登陆
	 
$("#submitLogin").click(function() {
  var userName = $.trim( $("#userName").val() );
	var password = $.trim( $("#password").val() );
   // alert(member);
  // return false;
	if(userName == ""){
		alert("请输入用户名");//layer.alert("请输入用户名", {icon:0,title: '【提示】'});
		return false;
	}
	else if(password == ""){
		alert("请输入密码");//layer.alert("请输入密码", {icon:0,title: '【提示】'});

		return false;
	}
	//alert(userName+" "+password +"  "+"<,?=CURRENT_DIR?>/login_check.php");
	//return false;
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
			  window.location.href = '/index/index';
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
