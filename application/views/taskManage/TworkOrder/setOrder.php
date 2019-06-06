<?php  session_start(); //开启session
//手机访问，则跳转到手机页面
if($ism){
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
    <link href="/public/css/bootstrap-fileupload<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/style<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-responsive<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color" />
    <link href="/public/css/bootstrap-fullcalendar<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/jquery.fancybox<?=$_m?>.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/uniform.default<?=$_m?>.css" />
    <link rel="stylesheet" href="/public/css/bootstrap-multiselect<?=$_m?>.css?<?=rand(1,99999)?>" type="text/css"/>
    <style>
	.bold{font-weight:600;}
	.noname{color:#4a8bc2;}
    <?php if($_GET['pManage']==1){//施工上线人员管理=工单中隐藏与人员管理无关的内容?>
      .notPmanage{display: none;}
    <?php }?>
    .currenOrdernum{background: url(/public/images/dagou-blue.png) 0px -5px no-repeat;
    width: 26px;display: inline-block;background-size: 24px;}
    .mainper input{width:100px !important;}
    .sex{width:20px !important;}
    .name{width:100px !important;}
	</style>
</head>
<body class="fixed-top">
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                        作业计划整理
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
                            <?php  if($date==date('Y-m-d')) echo "今日工单"; 
                               else echo "历史工单";
                            ?>
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
 
<?php //先判断今日是否有工单
if( count($TworkOrderALL)==0 ){
    echo '<div style="text-align: center;color:#f30;">今日暂无作业计划</div>';
}
else{
?>
<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>今日工单列表</th>
      <th>作业日期</th>
      <th>作业时间</th>
      <th>作业地点</th>
      <th>作业内容</th>
      <th>负责人</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
     <?php 
     $currenOrdernum = array();
     foreach ($TworkOrderALL as $key => $value) {?>
    <tr>
 
      <td>工单<?=$value['twOrderId']?> <span class="<?php 
        if($_GET['ordernum']==$key){ $currenOrdernum = $value; echo 'currenOrdernum'; }else echo 'ordernum';?>">&nbsp;</span></td>
      <td><?=$value['JiHuaDate']?></td>
      <td><?=$value['QiQiSJ']?></td>
      <td><?=$value['DengJiCZ']?></td>
      <td><?=$value['ZuoYeXM']?></td>
      <td><?=$value['ZhuTiZYFZR']?></td>
      <td><a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail"  href="/taskManage/TworkOrder/setOrder&ordernum=<?=$key?>" >查看</a></td>
    </tr>
    <?php } ?>  
  </tbody>
</table>

<div style="margin:15px 0 8px;">
    <span style="color:#1E9FFF">作业门选择：</span>
    <span>进门</span>
    <select class="master" id="safeDoorIn">
         <option value="">请选择进门</option>
        <?php foreach($safeDoorListArr as $key2=>$safeDoor){ //twSafeDoor_in?>
         <option <?php if($currenOrdernum['twSafeDoor_in']==$safeDoor['ceControlId']) echo 'selected="true"';?> value="<?=$safeDoor['ceControlId']?>"><?=$safeDoor['ceName']?></option>
        <?php }?>
    </select>
    <span>出门</span>
    <select class="master" id="safeDoorOut">
         <option value="">请选择出门</option>
        <?php foreach($safeDoorListArr as $key2=>$safeDoor){ //twSafeDoor_in?>
         <option <?php if($currenOrdernum['twSafeDoor_out']==$safeDoor['ceControlId']) echo 'selected="true"';?> value="<?=$safeDoor['ceControlId']?>"><?=$safeDoor['ceName']?></option>
        <?php }?>
    </select>
    <button style="height: 28px;padding: 0px 8px;margin:0 0 8px 5px;" id="safeDoorSubmit" class="layui-btn layui-btn-normal">确认提交</button>
</div>


<div class="row-fluid notPmanage">
    <div class="span12">
        <div class="widget orange">
            <div class="widget-title">
                <h4>工具清单（数量：<?=count($TworkOrder_toolInfoALL)?>件）</h4>
            </div>
<div class="widget-body">
<div>
<div class="clearfix">
    <div class="btn-group">
        <button id="editable-sample_new" class="btn green auth_add">
            添加<i class="icon-plus"></i>
        </button>
    </div>
</div>
<div class="space15"></div>
<table class="table table-striped table-hover table-bordered" id="editable-sample">
    <thead>
    <tr>
        <th>类别编号</th>
        <th>工具名称</th>
        <th>数量</th>
        <th>存放仓库<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span></th>
        
        <th>负责人<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span></th>
        <th>编辑</th>
        <th>删除</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($TworkOrder_toolInfoALL as $key => $value) { ?>
     <tr>
        <td class="ids small"><?php if($value['twtlId']=='')echo '-';else echo $TworkOrder_toolInfoALL[$key]['twtlId']; ?></td>
        <td class="small"><?=$value['twtlName']?></td>
        <td class="small"><?=$value['twtlAmount']?></td>
        <td class="small"><?php if($value['waMessageName']=='')echo '<span style="color:#f30">暂无仓库</span>';else echo $TworkOrder_toolInfoALL[$key]['waMessageName']; ?></td>
        <td class="small"><?=$value['pManageName']?></td>
        <td><a class="edit auth_edit" href="javascript:;">编辑</a></td>
        <td><a class="delete auth_del" href="javascript:;">删除</a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
            </div>
        </div>
    </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget red">
                        <div class="widget-title">
                            <h4>核心人员<span style="text-decoration: ;color:#ccc;;">（工单表中已列出）</span></h4>
                        </div>
                        <div class="widget-body">
                            <div>
                               <!--  <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new_corePerson" class="btn green auth_add">
                                            添加<i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div> -->
                                <div class="space15"></div>
                                <table class="editable-sample table table-striped table-hover table-bordered mainper" id="editable-sample_corePerson">
                                    <thead>
                                    <tr>
                                        <th>工作岗位</th>
                                        <th>姓名</th>
                                        <th>性别</th>
                                        <th>编号</th>
                                        <th>职位</th>
                                        <th>联系方式</th>
                                        <th>考勤情况</th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach ($TworkOrder_administratorsInfoALL as $adm_key => $adm_value) {?>
                                    <tr>
                                        <td class="small bold" tid=<?=$adm_value['twamId']?>><?=$adm_value['twamUserJobName']?></td>
                                        <td class="small <?php if($adm_value['pManageSex']=='')echo "noname"; ?>"><?php if($adm_value['twamName']=='') echo '<span style="color:#f30">- 无 -</span>' ;else echo $adm_value['twamName']?></td>
                                        <td class="small"><?php if($adm_value['pManageSex']==1)echo "男";else if($adm_value['pManageSex']==2) echo "女"; ?></td>
                                        <td class="ids small"><?=$adm_value['pManageId']?></td>
                                        <td class="small"><?=$adm_value['bManageName']?></td>
                                        <td class="small"><?=$adm_value['pManageContact']?></td>

                                        <td class="small">0</td>
                                        
                                        <td><a class="edit auth_edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete auth_del" href="javascript:;">删除</a></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid" style="padding-bottom:  ;">
                <div class="span12">
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4>施工人员<span style="text-decoration: ;color:#eee;">（工单额定人数：<?=$TworkOrder['ZhiGongZYRS']?>人）</span></h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <div class="space15"></div>
                                <table  class="editable-sampl table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:10px">
                                    <select title="下拉施工人员" class="example-getting-started" multiple="multiple" id="select">
                                      <?php foreach ($pmanage_builders as $key => $value) { ?>
                                        <option value="<?=$value['pManageId']?>"><?=$value['pManageName']?></option>
                                      <?php } ?>
                                    </select>
                                    <input type="button" id="sure" class="btn customButton btn-primary" value="确定" name="确定" style="margin-left:20px">
                                    <thead>
                                    <tr>
                                        <th>编号</th>
                                        <th>姓名</th>
                                        <th>性别</th>
                                        <th>联系方式</th>
                                        <th>考勤情况</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($workers as $key => $value) { ?>    
                                    <tr>
                                        <td class="ids small" id="ids"><?=$value['twkeId']?></td>
                                        <td class="small" id="name"><?=$value['pManageName']?></td>
                                        <td class="small" id="name"><?php if($value['pManageSex']==1) echo "男";else echo "女"; ?></td>
                                        <td class="small" id="date"><?=$value['pManageContact']?></td>
                                        <td class="small" id="kao"><?=$value['twkeAttendance']?></td>
                                        <td></td>
                                    </tr>
                                    <?php } ?>                          
                                 </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid" style="padding-bottom: 200px;">
                <!-- <div class="span12">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4>填写安全揭示<span style="text-decoration: ;color:#eee;">（可不填）</span></h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                  <div>安全揭示内容：</div>
                                  <div style="margin:0 0 5px;">
                                     <textarea id="safeCon"   style="width:470px;height:120px;padding: 5px;"><?=$TworkOrder['twSafecon']?></textarea>   
                                  </div>
                                  <button style="padding: 0px 8px;" id="safeConBtn" class="layui-btn layui-btn-normal">提交</button>
                            </div>
                        </div>
                    </div>

                    <button style=" display:none;padding: 0px 8px;border-color: #4a8bc2;" id="submitOrderOk" class="layui-btn layui-btn-normal">确认工单整理完毕</button>

                </div> -->
            </div>




        </div>
     
     <?php }//end今日有工单情况：end>if( count($TworkOrderALL)==0 ) ?>

    </div>




</div>



</div>
<script>
   var twOrderId = <?=$TworkOrder['twOrderId']?>;//工单ID
   
   //提交安全揭示
   //  $("#safeConBtn").click(function(e){
   //     var safecon = $.trim( $("#safeCon").val() );
   //     if(safecon==""){
   //         layer.alert("内容不能为空！", {icon:0,title: '【提示】'});
   //         return false;
   //     }
   //     //alert(twOrderId+"  "+safecon);
   //     $.ajax({
   //          async:false,
   //          type: "post",
   //          data: {
   //              "safecon":safecon,
   //              "twOrderId":twOrderId

   //          },
   //          url: "<?=CURRENT_DIR?>/setOrder_addSafeCon.php?",
   //          success: function (msg) {
   //              //alert(msg);
   //              toastr.success("提交成功");
   //              //location.reload();
   //              },
   //          error: function (msg) {
   //              toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
   //          }
   //      });
        
   // });

   //确认工单
   $("#submitOrderOk").click(function(e){
       
       return false;
       $.ajax({
            async:false,
            type: "post",
            data: {
                

            },
            url: "<?=CURRENT_DIR?>/setOrder_addSafeCon.php?",
            success: function (msg) {
                //alert(msg);
                toastr.success("提交成功");
                //location.reload();
                },
            error: function (msg) {
                toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
            }
        });
        
   });
   //提交作业门选择
   $("#safeDoorSubmit").click(function(e) {
      var safeDoorInId = $("#safeDoorIn option:selected").val();
	  var safeDoorOutId = $("#safeDoorOut option:selected").val(); 
	  if(safeDoorInId=="" || safeDoorOutId==""){
		  layer.alert("进/出门都须选择！", {icon:0,title: '【提示】'});
		  return false;
	  }
	  $.ajax({
            async:false,
            type: "post",
            data: {
                "safeDoorInId":safeDoorInId,
                "safeDoorOutId":safeDoorOutId,
				"twOrderId":twOrderId

            },
            url: "<?=CURRENT_DIR?>/setOrder_addSafeDoor.php?",
            success: function (msg) {
                //alert(msg);
                toastr.success("提交成功");
                //location.reload();
                },
            error: function (msg) {
                toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
            }
        });
   });
   
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var TworkOrderArray = <?=$TworkOrderJson?>;
    var TworkOrdertoolArray = <?= json_encode($TworkOrder_toolInfoALL)?>;
    var pmanageArray = <?= json_encode($pmanage_builders)?>;
    var JiHuaDate1 = "<?=$date?>";
    var toolList = <?=$toolListJson?>;
    var pmanage_admin = <?=$pmanageAllJson?>;
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
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script> 
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-tworkOrder_tools.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/editable-tworkOrder_corePerson.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/bootstrap-multiselect.js?<?=rand(1,99999)?>"></script>
<script>
 toastr.options.positionClass = 'toast-top-center';
 var TworkOrder = <?=$TworkOrderJson?>;
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
	$("#order_charge").html(txt);
    $.ajax({
        async:false,
        type: "post",
        data: {
            "txt":txt,
            "TworkOrder":TworkOrder,
        },
        url: "<?=CURRENT_DIR?>/index_save.php?",
        success: function (msg) {
            toastr.success("提交成功");
                  location.reload();
              },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });
	chareClicked = false;
    return false;	
});
   
//施工人员
$("#sure").click(function(){
    var TwOrderId = <?=$TworkOrder['twOrderId']?>;
    var name = [];
    var pManageIds = [];
	var selectedNum=0;
    $("#select option:selected").each(function(i){
			
            name[i] = $(this).text();
            pManageIds[i] = $(this).val();
			selectedNum++;
    });
    
    //console.log(name+"  "+pManageIds); 

    $.ajax({
        async:false,
        type: "post",
        data: {
            "TwOrderId":TwOrderId,
            "name":name,
            "pManageIds":pManageIds,
        },
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
            console.log(msg);
            toastr.success("提交成功");
                  location.reload();
              },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });
});
//工具清单
function editable_save1(saveobj){
    var twtltWorkOrderId = <?=$TworkOrder['twOrderId']?>;
    var twtlId = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var twtlName = $.trim( saveobj.parents("tr").eq(0).find(".name option:selected").eq(0).text() );
    var twtlToolId = $.trim( saveobj.parents("tr").eq(0).find(".name option:selected").eq(0).val() );
    console.log(name);
    var amount = $.trim( saveobj.parents("tr").eq(0).find(".amount").eq(0).val() );
    var master = $.trim( saveobj.parents("tr").eq(0).find(".master").eq(0).val() );
    var type = "add";
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    
    if(dataIsNull) return "null"; //editable-table.js用到
    $.ajax({
        async:false,
        type: "post",
        data: {
            "type":type,
            "twtlId":twtlId,
            "twtlName":twtlName,
            "twtlToolId":twtlToolId,
            "amount":amount,
            "master":master,
            "twtltWorkOrderId":twtltWorkOrderId,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_toolMaster.php?",
        success: function (msg) {
              toastr.success("提交成功！");
              console.log(msg);
              if(type=="add"){
                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
              }
        },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });
};
//核心人员
//twamId
// twamPersonId
// twamName
// twamAttendance

function editable_save(saveobj){ 
    var twtltWorkOrderId = <?=$TworkOrder['twOrderId']?>;
    var twamId = $.trim( saveobj.parents("tr").eq(0).find(".position").eq(0).attr('tid'));
    var twamPersonId = $.trim( saveobj.parents("tr").eq(0).find(".name option:selected").eq(0).val() );
    var twamName = $.trim( saveobj.parents("tr").eq(0).find(".name option:selected").eq(0).text() );
    //console.log(name);
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var zhiwei = $.trim( saveobj.parents("tr").eq(0).find(".zhiwei").eq(0).val() );
    var contect = $.trim( saveobj.parents("tr").eq(0).find(".contect").eq(0).val() );
    var twamAttendance = $.trim( saveobj.parents("tr").eq(0).find(".kaoqin").eq(0).val() );
    console.log(twamId,twamPersonId,twamName,twamAttendance);
    var type = "add";
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    
    if(dataIsNull) return "null"; //editable-table.js用到
    $.ajax({
        async:false,
        type: "post",
        data: {
            "twamId":twamId,
            "twamPersonId":twamPersonId,
            "twamName":twamName,
            "twamAttendance":twamAttendance,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/setOrder_ChangeLeader.php?",
        success: function (msg) {
              toastr.success("提交成功！");
              console.log(msg);
              if(type=="add"){
                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
              }
        },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });
};
jQuery(document).ready(function() {
        EditableTable.init();
        EditableTable1.init();
    });
//工具清单分页

</script>


</body>
<!-- END BODY -->
</html>
