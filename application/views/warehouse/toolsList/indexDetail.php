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
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link href="/public/css/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/uniform.default.css" />
    <style>
    .toListRFIDCode{width: auto;}
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
   <!-- END header-left -->

  <!-- BEGIN CONTAINER -->
  <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">

                    <h3 class="page-title" style="color:#000">
                        工具详情
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">仓库管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            工具详情
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
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4>工具详情（<?php if($_GET['toolType']==1)echo '小工具'; else echo '大工具'; ?>）</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-remove">
                                    <img src="/public/images/remove.png" width="30px" height="30px"/>
                                </a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn green">
                                            添加 <i class="icon-plus"></i>
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>序号</th>
                                        
                                        <th>工具名称</th>
                                        <?php if($_GET['toolType']==2)echo '<th>大工具编号</th>';//大工具有该项?>
                                        <th><?php if($_GET['toolType']==1)echo 'RFID编号（按Ctrl可多选）'; else echo 'GPS定位器编号（单选）'; ?></th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead> 
                                    <tbody>
                                    <?php foreach ($Detail as $key => $value) { ?>
                                    <tr class="">
                                        <td class="ids"><?=$value['DetailId']?></td>
                                        <td class="ids"><?=$value['toListName']?></td>
                                        
                                        <?php if($_GET['toolType']==2)echo '<td class="DetailCode">'.$value['DetailCode'].'</td>';//大工具有该项?>
                                        <?php 
                                            if($_GET['toolType']==1) echo '<td>'.$value['toListRFIDCode'].'</td>';
                                            else                     echo '<td class="GPS" value="'.$value['GPSId'].'">'.$value['GPSCode'].'</td>';
                                        ?>

                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
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
    <!-- END PAGE -->
</div>

<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var DetailArray = <?=$pmanageJson?>;
    var Detailtool = <?=$detailtoolJson?>;
    var rfidtagArray = <?=$_GET['toolType']==1?$rfidtagJson:$gpslibJson?>;
    console.log(rfidtagArray);
    var detailArray = <?= json_encode($Detail)?>;
    var toolType = <?=$_GET['toolType']==''?1:$_GET['toolType']?>;
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/toastr.min.js"></script>
<script src="/public/js/editable-toolsListDetail_<?=$_GET['toolType']?>.js?<?=rand(1,99999)?>"></script>
<script>
toastr.options.positionClass = 'toast-top-center';
function editable_save(saveobj){
    //alert("ddd");
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var name = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
    var toolCode = $.trim( saveobj.parents("tr").eq(0).find(".code").eq(0).val() );
    var typel = $.trim( saveobj.parents("tr").eq(0).find(".type").eq(0).val() );
    var toListRFIDCode = $.trim( saveobj.parents("tr").eq(0).find(".toListRFIDCode option:selected").text() );//.text()
    var toListGPSId = 0;
    var toListOldGPSId = 0;
    if (toolType==2) {
        toListGPSId = $.trim( saveobj.parents("tr").eq(0).find(".toListRFIDCode option:selected").val() );
        toListOldGPSId = $.trim( saveobj.parents("tr").eq(0).find(".toListRFIDCode option").eq(0).val() );
    }
    if(toolType==1)toListRFIDCode = toListRFIDCode.substr(0,toListRFIDCode.length-1);//去除最后的逗号
    var deToolListId = <?=$deToolListId?>;
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
            "toolCode":toolCode,
            "deToolListId":deToolListId,
            "toListRFIDCode":toListRFIDCode,
            "toListOldGPSId":toListOldGPSId,
            "toListGPSId":toListGPSId,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/indexDetail_add.php?",
        success: function (msg) {
               console.log(msg);
              toastr.success('提交成功！');
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
    });
</script>


</body>
<!-- END BODY -->
</html>
