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
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link href="/public/css/bootstrap-responsive.min<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/style<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-responsive<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet"/>
    <link rel="stylesheet" href="/public/css/mui.min.css?1.0">
    
    <style>
	.bold{font-weight:600;}
	.noname{color:#4a8bc2;}
    a.ordernum{color:#999 !important;}
    a.currenOrdernum,a.ordernum:hover{color:#4A8BC2 !important;}
    #addForm{margin-bottom: 0 !important;}
    #lockPlayBox tr{
    }
    #lockPlayBox tr th{
        background: #74B749;
        color:#fff;
    }
    #lockPlayBox tr td,#lockPlayBox tr th{
        border: 1px solid #ddd;
        padding: 5px 8px;
    }
    #lockPlayBox tr td{
        color:#555;
    }
    h4{line-height: 60px !important}
    .level1a{width:100% !important;}
    .mui-switch{border-radius: 20px !important}
    .mui-switch:before{top:4px !important;}
    .mui-switch .mui-switch-handle{border-radius: 16px !important}
    <?php if($_GET['pManage']==1){//施工上线人员管理=工单中隐藏与人员管理无关的内容?>
      .notPmanage{display: none;}
    <?php }?>
	</style>
</head>
<body class="fixed-top">
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                       作业开锁计划
                            <span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">作业管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                           作业开锁计划
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
<div class="notPmanage" id="lockPlayBox" style=" ">
    <div style="margin:0 0 5px;color:#555;">作业开锁计划（列表）：</div>
    <table>
    <tr>
        <th>工单编号</th>
        <th>作业日期</th>
        <th>作业时间</th>
        <th>作业地点</th>
        <th>作业内容</th>
        <th>工单负责人</th>
        <th>进作业门编号</th>
        <th>进关锁</th>
        <th>出作业门编号</th>
        <th>出门开锁</th>
    </tr>
    <?php foreach ($TworkOrderALL as $key => $value) {?>
        <tr style="">
         
        <td><?=$value['twOrderId']?></td>
        <td><?=$value['JiHuaDate']?></td>
        <td><?=$value['QiQiSJ']?></td>
        <td><?=$value['DengJiCZ']?></td>
        <td><?=$value['ZuoYeXM']?></td>
        <td><?=$value['ZhuTiZYFZR']?></td>
        <td>作业门A00<?=rand(1,9)?></td>
        <td> 
            <div class="mui-switch mui-active switch">
                <div class="mui-switch-handle"></div>
            </div>
        </td>
        <td>作业门A00<?=rand(1,9)?></td>
        <td>  
            <div class="mui-switch mui-active switch">
                <div class="mui-switch-handle"></div>
            </div>
        </td>
        </tr>
    <?php } ?>
     </table>
     <?php   if(count($TworkOrderALL)<1)echo '<div style="color: #f30; margin: 10px 0 0 363px;">今日无开锁计划</div>';?>
</div>
<br><br>          
</div>
</div>
<script>
  
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var TworkOrderArray = <?=$TworkOrderJson?>;
    var TworkOrdertoolArray = <?= json_encode($TworkOrder_toolInfoALL)?>;
    var pmanageArray = <?= json_encode($pmanage)?>;
    var JiHuaDate1 = "<?=$date?>";
    console.log(TworkOrdertoolArray);
    //获取当前时间
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    if (month < 10) {
        month = "0" + month;
    }
    if (day < 10) {
        day = "0" + day;
    }
    var nowDate = year + "-" + month + "-" + day;
    console.log(nowDate);
    if(JiHuaDate1==nowDate){
     $("#onload").show();
    }
    else{
       $("#onload").hide(); 
    }
</script>
<script src="/public/js/jquery.form.js"></script>
<script src="/public/js/select.js"></script>
<script src="/public/js/toastr.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script type="text/javascript">
    mui.init();
    //开关状态
    mui('.mui-switch').each(function() { //循环所有toggle
                //toggle.classList.contains('mui-active') 可识别该toggle的开关状态
                console.log('状态：' + (this.classList.contains('mui-active') ? 'true' : 'false')) ;
               
                 // toggle 事件监听
                this.addEventListener('toggle', function(event) {
                    //event.detail.isActive 可直接获取当前状态
                    console.log('状态：' + (this.classList.contains('mui-active') ? 'true' : 'false')) ;
                });
            });
 toastr.options.positionClass = 'toast-top-center';
$(function(){
    var activity_id = sessionStorage.getItem('activity_id');
    // 点击上传按钮
    $('#upLoad').click(function(){
        $('#addForm').ajaxSubmit({
            forceSync: false,  
            url:  "<?=CURRENT_DIR?>/index_upload.php",
            type: 'post',
            dataType: 'text',
            success: function(response){
                toastr.success('上传成功！');
                location.reload();
               
            },
            error: function(response){
                toastr.error('上传失败！');
            }
        });
    });
    $("#selectFile").on("change",function(){
        var file = document.getElementById('selectFile').files;    //获取上传的文件
        var fileName = file[0].name;
        // 获取文件的格式为.xsl、.xslx
        var fileFormat = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
        if( checkFileFormat(fileFormat) == false){
            toastr.warning("上传的文件类型有误！");
            return;
        }  
    });
    // 校验文件格式
    function checkFileFormat(format) {
        if (format.match(/.xls|.xlsx/)) {
            return true;
        }
        return false;
    }
});
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-tworkOrder_tools.js?<?=rand(1,99999)?>"></script>
<!-- <script src="/public/js/editable-tworkOrder_corePerson.js?<?=rand(1,99999)?>"></script> -->
<script src="/public/js/bootstrap-multiselect.js?<?=rand(1,99999)?>"></script>
<script>
//function editable_save(saveobj){
 //编辑工单负责人
 var chareClicked = false;
 $('#order_charge').live('click',function(e) {
 	if(!chareClicked){
	chareClicked = true;
	var txt = $(this).html();
    $(this).html('<input id="chareVal" value="'+txt+'" /><button type="button" id="saveCharge" style="margin-left:5px;">保存</button>');
	}
	
 	
});
$('#saveCharge').live('click',function(e) {
	var txt  = $("#chareVal").val();
    console.log($("#order_charge").attr('id'));
    //$('#chareVal').remove();
    // $(this).remove();
    // $("#order_charge").html('');
	$("#order_charge").html(txt);
	// alert(1);
	chareClicked = false;
    return false;
 	
});
   
    //施工人员
$("#sure").click(function(){
    var name = [];
	var selectedNum=0;
    $("#select option:selected").each(function(i){
            //name = new Array();
			
            name[i] = $(this).val();
			selectedNum++;
            //console.log(name);
    });
	// if(selectedNum !=<?=$TworkOrder[0]['ZhiGongZYRS']?>){
		
	// 	toastr.warning("人数不符，请选择今日工单的施工人数。");
	// 	return false;
		
	// }
    //console.log(name);
    $.ajax({
        async:false,
        type: "post",
        data: {
            "name":name,
        },
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
            toastr.success("提交成功");
                  location.reload();
              },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
            console.log(name);
        }
    });
});
    //return false;
//}
//});
 // };*/
//工具清单
function editable_save(saveobj){ 
    //alert("ddd");
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var name = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
    var amount = $.trim( saveobj.parents("tr").eq(0).find(".amount").eq(0).val() );
    var warehouse = $.trim( saveobj.parents("tr").eq(0).find(".warehouse").eq(0).val() );
    var master = $.trim( saveobj.parents("tr").eq(0).find(".master").eq(0).val() );
    var type = "add";
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    saveobj.parents("tr").find("input").each(function(index, element) {
        if($(this).val()==""){
            toastr.warning("数据全部不能为空，请填写！");
            dataIsNull = true;
            return false;
        }
    });
    if(dataIsNull) return "null"; //editable-table.js用到
    $.ajax({
        async:false,
        type: "post",
        data: {
            "type":type,
            "id":id,
            "name":name,
            "amount":amount,
            "typel":typel,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {

              if(msg != "error")toastr.success("提交成功！");
              if(type=="add"){
                
                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
                 //alert(msg);
              }
        },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });
};
 
jQuery(document).ready(function() {
        EditableTable.init();
        //EditableTable2.init();
    });
//工具清单分页

</script>


</body>
<!-- END BODY -->
</html>
