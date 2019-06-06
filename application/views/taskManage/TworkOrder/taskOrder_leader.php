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
    </style>
</head>
<body class="fixed-top">
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                       作业计划查询结果
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
            <div class="row-fluid notPmanage" id="onload">
                <div class="span5">
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4>导入天窗作业计划</h4>
                        </div>
                        <div class="widget-body">
            <form enctype="multipart/form-data" method="post" id='addForm'>
            <span id="fileNameOrFileFormat" style="color:red">支持文件格式：xls，xlsx</span>
            <div id="filePanel">
                <span class="selectFileDiv" href="javascript:;" style="width:320px">
                     选择文件
                    <input type="file" name="file" id="selectFile">
                </span>
                <input type='button' id="upLoad" class="btn customButton btn-primary auth_add" value='上传' name="上传" style="float:right" />
            </div>
            
        </form>
          </div>
      </div>
  </div>
</div>      
<style type="text/css">
a.ordernum{color:#999 !important;}

a.currenOrdernum,a.ordernum:hover{color:#4A8BC2 !important;}
#addForm{margin-bottom: 0 !important;}
</style>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4 style="float:right;margin-right:20px;"><a style="color:#fff; font-weight:600;" href="/personLocal/RealTimeLocal/index" target="_blank">
                            <img style="height:22px;width:24px; vertical-align:middle;" src="/public/images/dingwei3.png" />定位查询</a></h4>
                            <h4>工单表</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                
                                <div class="space15"></div>
                                <table class="editable-sample table table-striped table-hover table-bordered" id="editable-sample_order">
                                    <thead>
                                    <tr>
                                        <th>工单编号</th>
                                        <th>任务地点</th>
                                        <th>任务负责人（点击修改）</th>
                                        <th>上传时间</th>
                                        <th>执行时间</th>
                                     </tr>
                                    </thead>
                                    <tbody>    
                                    <tr>
                                        <td class="ids small"><?=$TworkOrder['twOrderId']?></td>
                                        <td class="small"><?=$TworkOrder['DengJiCZ']?></td>
                                        <td class="small" id="order_charge"><?=$TworkOrder['ZhuTiZYFZR']?></td>
                                        <td class="small"><?=$TworkOrder['JiHuaDate']?></td>
                                        <td class="small"><?=$TworkOrder['QiQiSJ']?></td>
                                     </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row-fluid notPmanage">
                <div class="span12">
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4>工具清单（数量：<?=count($TworkOrder_toolInfoALL)?>种）</h4>
                        </div>
<div class="widget-body">
<div>

<div class="space15"></div>
<table class="table table-striped table-hover table-bordered" id="editable-sample">
    <thead>
    <tr>
        <th>类别编号</th>
        <th>工具名称</th>
        <th>数量</th>
        <th>存放仓库<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span></th>
        
        <th>负责人<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span></th>
         
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
                                
                                <div class="space15"></div>
                                <table class="editable-sample table table-striped table-hover table-bordered" id="editable-sample_corePerson">
                                    <thead>
                                    <tr>
                                        <th>工作岗位</th>
                                        <th>姓名</th>
                                        <th>性别</th>
                                        <th>编号</th>
                                        <th>职位</th>
                                        <th>联系方式</th>
                                        <th>考勤情况</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach ($TworkOrder_administratorsInfoALL as $adm_key => $adm_value) {?>
                                    <tr>
                                        <td class="small bold"><?=$adm_value['twamUserJobName']?></td>
                                        <td class="small <?php if($adm_value['pManageSex']=='')echo "noname"; ?>"><?php if($adm_value['twamName']=='') echo '<span style="color:#f30">- 无 -</span>' ;else echo $adm_value['twamName']?></td>
                                        <td class="small"><?php if($adm_value['pManageSex']==1)echo "男";else if($adm_value['pManageSex']==2) echo "女"; ?></td>
                                        <td class="ids small"><?=$adm_value['pManageId']?></td>
                                        <td class="small"><?=$adm_value['zManagePosition']?></td>
                                        <td class="small"><?=$adm_value['pManageContact']?></td>

                                        <td class="small">0</td>
                                        <!-- <td class="small"><?=$value['userOrtherInfo']?></td> -->
                                        <!-- <td class="small">
                                           <select>
                                            <?php foreach ($pmanage as $key2 => $value2) { ?>
                                             
                                              <option value="<?=$value2['pManageId']?>"><?=$value2['pManageName']?></option>  
                                            <?php } ?>
                                          </select>
                                        </td> -->
                                         
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid" style="padding-bottom: 500px;">
                <div class="span12">
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4>施工人员<span style="text-decoration: ;color:#eee;">（工单额定人数：<?=$TworkOrder[0]['ZhiGongZYRS']?>人）</span></h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <div class="space15"></div>
                                <table class="editable-sampl table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:10px">
                                    
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
</div>
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
<script type="text/javascript">
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
        
    //  toastr.warning("人数不符，请选择今日工单的施工人数。");
    //  return false;
        
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
