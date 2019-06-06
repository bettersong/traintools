<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>高铁检修综合管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="Mosaddek" name="author" />
    <link href="/public/css/bootstrap.min.css?v=0.101" rel="stylesheet" />
    <link href="/public/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="/public/css/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="/public/css/style.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-responsive.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color" />
    <link href="/public/css/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="/public/css/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/uniform.default.css" />

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">

   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>


  <!-- BEGIN CONTAINER -->
  <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                        今日工单
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
                            今日工单
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
                <div class="span5">
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4>上传工单</h4>
                        </div>
                        <div class="widget-body">
            <form enctype="multipart/form-data" method="post" id='addForm'>
            <span id="fileNameOrFileFormat" style="color:red">支持文件格式：xls，xlsx</span>
            <div id="filePanel">
                <span class="selectFileDiv" href="javascript:;" style="width:320px">
                     选择文件
                    <input type="file" name="file" id="selectFile">
                </span>
                <input type='button' id="upLoad" class="btn customButton" value='上传' name="上传" style="float:right" />
            </div>
            
        </form>
          </div>
      </div>
  </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4>工单表</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn">
                                            添加工单<i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>工单编号</th>
                                        <th>任务地点</th>
                                        <th>任务负责人</th>
                                        <th>上传时间</th>
                                        <th>执行时间</th>
                                        <th>人员列表</th>
                                        <th>工具列表</th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                 <?php //foreach ($TworkOrder as $key => $value) { ?>
                                    <tr class="">
                                        <td class="ids small"><?=$value['twOrderId']?></td>
                                        <td class="small"><?=$value['twOrderLocation']?></td>
                                        <td class="small"><?=$value['twOrderLeader']?></td>
                                        <td class="small"><?=$value['twOrderTime']?></td>
                                        <td class="small"><?=$value['twOrderExTime']?></td>
                                        <td class="small"><a>人员清单</a></td>
                                        <td class="small"><a>工具清单</a></td>
                                        <td id="save"><a class="edit" href="#">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                 <?php //} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN gongju-->
                        <div class="widget orange">
                            <div class="widget-title">
                                <h4> 工具表</h4>
                                <span class="tools">
                                <a href="javascript:;" class="icon-remove">
                                    <img src="/public/images/remove.png" width="30px" height="30px"/>
                                </a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>工具编号</th>
                                        <th>工具名称</th>
                                        <th>工具负责人</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($TworkOrder_tool as $key => $value) { ?>
                                    <tr>
                                        <td class="id small"><?=$value['toFormId']?></td>
                                        <td class="small"><?=$value['toFormName']?></td>
                                        <td class="small"><?=$value['toFormMaster']?></td>
                                        <td class="small"><?=$value['toFormNotes']?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="2">XXXXXXX</td>
                                        <td colspan="2">XXXXXXX</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END gongju-->
                    </div>
        </div>
    </div>
</div>

</div>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
</script>
<script src="/public/js/jquery.form.js"></script>
<script type="text/javascript">
$(function(){
    var activity_id = sessionStorage.getItem('activity_id');
  
    // 点击上传按钮
    $('#upLoad').click(function(){
        $('#addForm').ajaxSubmit({
            forceSync: false,  
            url:  "<?=CURRENT_DIR?>/index_upload.php",
            type: 'post',
            dataType: 'text',
<<<<<<< .mine
            success: function(response){
                alert('上传成功！');
||||||| .r169
            success: function(msg){
                alert('success');
=======
            success: function(response){
				alert(response);
                //alert('success');
>>>>>>> .r174
            },
<<<<<<< .mine
            error: function(response){
                alert('上传失败！');
||||||| .r169
            error: function(msg){
                alert('error');
=======
            error: function(response){
                alert('error');
>>>>>>> .r174
            }
        });
    });
 
    
    $("#selectFile").on("change",function(){
        
        var file = document.getElementById('selectFile').files;    //获取上传的文件
        var fileName = file[0].name;
        
        // 获取文件的格式为.xsl、.xslx
        var fileFormat = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
        if( checkFileFormat(fileFormat) == false){
            alert("上传的文件类型有误！");
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
<script src="/public/js/editable-tworkOrder.js"></script>
<script>

//alert(<?php echo "$taskTworkOrders"; ?>);
//$(".save").live('click',function(e) {
function editable_save(saveobj){
    //alert("ddd");
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var location = $.trim( saveobj.parents("tr").eq(0).find(".location").eq(0).val() );
    var leader = $.trim( saveobj.parents("tr").eq(0).find(".leader").eq(0).val() );
    var down = $.trim( saveobj.parents("tr").eq(0).find(".down").eq(0).val() );
    var execution = $.trim( saveobj.parents("tr").eq(0).find(".execution").eq(0).val() );
    var type = "add";
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    saveobj.parents("tr").find("input").each(function(index, element) {
        if($(this).val()==""){
            alert("数据全部不能为空，请填写！");
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
            "location":location,
            "leader":leader,
            "down":down,
            "execution":execution,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {

              if(msg != "error")alert("msg: success");
              if(type=="add"){

                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
                 alert(msg);
              }
        },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });

    //return false;
}
//});



 // };*/
 jQuery(document).ready(function() {
        EditableTable.init();
    });

</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
