<?php  session_start(); //开启session
//手机访问，则跳转到手机页面
if($ism){
    //echo $_SERVER["SERVER_NAME"];
    header("Location: http://".$_SERVER["SERVER_NAME"].":8081/taskManage/TworkOrder/index_m");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>高铁检修综合管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <link href="/public/css/bootstrap.min<?=$_m?>.css?v=0.101" rel="stylesheet" />
    <link href="/public/css/bootstrap-responsive.min<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/style<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color" />
    <link rel="stylesheet" href="/public/css/jquery-pie-loader.css">
    <link rel="stylesheet" href="/public/css/uniform.default<?=$_m?>.css" />
    <style>
      #right2_main_content label{
        display: inline-block;
        width: 70px;
        height: 20px;
        /*border:1px solid red;*/
        text-align: right;
      }
      #right2_main_content{
        border: 1px dashed #ccc;
        padding: 20px;
        width: 500px;
      }
      .tip{
        display: none;
        color: red;
      }
      #tip{
        display: block;
        margin-top: 20px;
      }
      #confirmChange{
        border-bottom: 10px;
        margin: 10px 0 0 0;
        background-color: #1E9FFF;
        border: none;
        width: 100px;
        height: 30px;
        color: #fff;
        padding: 3px 10px;
        text-align: center;
        border-radius: 2px !important;
      }
    </style>
</head>
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
               <div class="span12">
                   <h3 class="page-title" style="color:#000">
                     修改密码
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">首页</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                           修改密码
                       </li>
                       <li class="pull-right search-wrap">
                           <form action="search_result.html" class="hidden-phone">
                               <div class="input-append search-input-area">
                                   <input class="" id="appendedInputButton" type="text">
                                   <button class="btn" type="button"><img src="/public/images/search.png" width="40px" height="40px"></button>
                               </div>
                           </form>
                       </li>
                   </ul>
               </div>
            </div>
            
              <div class="row-fluid">
                <div id="right2_main_content">
                  <div class="oldPassword">
                    <label>原始密码： </label>
                    <input type="password"  name="oldPassword" id="oldPassword">
                    <span id="oldPasswordTip" class="tip">密码错误</span>
                  </div>
                  <div class="newPassword">
                    <label>新&nbsp;&nbsp;密&nbsp;&nbsp;码：</label>
                    <input type="password" name="newPassword" id="newPassword">
                    <span id="newPasswordTip1" class="tip">密码不能为空</span>
                    <span id="newPasswordTip2" class="tip">密码至少6位</span>
                  </div>
                  <div class="confirmPassword">
                    <label>确认密码：</label>
                    <input type="password" name="confirmPassword" id="confirmPassword">
                    <span id="confirmPasswordTip" class="tip">新密码与旧密码不一致</span>
                  </div>
                  <div class="confirmChange">
                    <label></label>
                    <input type="button" name="confirmChange" id="confirmChange" value="确认修改">
                  </div>
                  <div id="tip">
                    <span>提示：如忘记密码，可以联系本单位管理员重置密码</span>
                  </div>
                </div>
              </div>
     
   </div>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/pie.js"></script>
<script type="text/javascript">
  //新密码不能少于6位数
  $("#newPassword").blur(function () {
    var newPassword = $.trim($("#newPassword").val());
    var length = newPassword.length;
    if (length == 0 ) {
      $("#newPasswordTip1").css("display","inline-block");
      return false;
    }
    else if (length < 6) {
      $("#newPasswordTip1").css("display","none");
      $("#newPasswordTip2").css("display","inline-block");
      return false;
    }
    else{
      $("#newPasswordTip1").css("display","none");
      $("#newPasswordTip2").css("display","none");
    }
  });

  //新旧密码要一致
  $("#confirmPassword").blur(function () {
    var newPassword = $.trim($("#newPassword").val());
    var confirmPassword = $.trim($("#confirmPassword").val());
    if (newPassword != confirmPassword ) {
      $("#confirmPasswordTip").css("display","inline-block");
      return false;
    }
    else{
      $("#confirmPasswordTip").css("display","none");
    }


  });


  // 确认修改密码
  $("#confirmChange").click(function () {
    var url = "/application/views/userCenter/baseInfo/user_action.php?act=updatePwd";
    var id = "";
    id = '<?=$_SESSION['userInfo']["pManageId"]?>';
    var oldPassword = $.trim($("#oldPassword").val())
    var newPassword = $.trim($("#newPassword").val());
    if(oldPassword=="" || newPassword==""){
      layer.alert("原始密码和新密码都不能为空。", {icon:0,title: '【提示】'});
      return false;
    }
    // 判断右边是否有错误提示信息
    var newPasswordTip1 = $("#newPasswordTip1").css("display");
    var newPasswordTip2 = $("#newPasswordTip2").css("display");
    var confirmPasswordTip = $("#confirmPasswordTip").css("display");

    if (newPasswordTip1 != "none" || newPasswordTip2 != "none" || confirmPasswordTip != "none") {
      return false;
    }
    $.ajax({
      async: false,
      data: {
        "oldPassword": oldPassword,
        "newPassword": newPassword,
        "id": id
      },
      type: "POST",
      dataType: 'json',
      url: url,
      success: function(msg) {
        if(msg =="nomatch"){
          layer.alert("密码不正确", {icon:0,title: '【提示】'});

        }else if(msg =="success"){
          layer.alert("修改密码成功。", {icon:1,title: '【提示】'});
          setTimeout("window.location.href = '/login/login/index'",1500);
        }
        else{
          layer.alert("未知错误！", {icon:0,title: '【提示】'});
        }
      },
      error:function (data) {
        layer.alert("更新失败！", {icon:0,title: '【提示】'});
      }
    });




  });


</script>
</body>
<!-- END BODY -->
</html>
