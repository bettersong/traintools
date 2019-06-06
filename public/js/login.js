$(function(){
/*用户登录信息验证*/
// $("#select").focus(function(){
//  var bumen = $('.bumen option:selected').text();
//  if(bumen=='请选择'){
//  $('.bumen option:selected').text('请选择部门');
//  }
// });
 
// $("#selsct").focusout(function(){
//  var bumen = $('.bumen option:selected').text();
//  if(bumen=='请选择'){
//  $('.bumen option:selected').text('请选择部门');
//  }
// });
$("#stu_username_hide").focus(function(){
 var username = $(this).val();
 if(username=='输入用户名'){
 $(this).val('');
 }
});
$("#stu_username_hide").focusout(function(){
 var username = $(this).val();
 if(username==''){
 $(this).val('输入用户名');
 }
});
$("#stu_password_hide").focus(function(){
 var username = $(this).val();
 if(username=='输入密码'){
 $(this).val('');
 }
});
$("#stu_password_hide").focusout(function(){
 var username = $(this).val();
 if(username==''){
 $(this).val('输入密码');
 }
});
$("#stu_code_hide").focus(function(){
 var username = $(this).val();
 if(username=='输入验证码'){
 $(this).val('');
 }
});
$("#stu_code_hide").focusout(function(){
 var username = $(this).val();
 if(username==''){
 $(this).val('输入验证码');
 }
});
$(".stu_login_error").Validform({
    tiptype:function(msg,o,cssctl){
        var objtip=$(".stu_error_box");
        cssctl(objtip,o.type);
        objtip.text(msg);
    },
    ajaxPost:true,
});
});
$(function(){
    $(".screenbg ul li").each(function(){
        $(this).css("opacity","0");
    });
    $(".screenbg ul li:first").css("opacity","1");
    var index = 0;
    var t;
    var li = $(".screenbg ul li");
    var number = li.size();
    function change(index){
        li.css("visibility","visible");
        li.eq(index).siblings().animate({opacity:0},3000);
        li.eq(index).animate({opacity:1},3000);
    }
    function show(){
        index = index + 1;
        if(index<=number-1){
            change(index);
        }else{
            index = 0;
            change(index);
        }
    }
    t = setInterval(show,8000);
    //根据窗口宽度生成图片宽度
    var width = $(window).width();
    $(".screenbg ul img").css("width",width+"px");
});