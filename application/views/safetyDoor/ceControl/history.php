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
    <link href="/public/css/style.css" rel="stylesheet" />
    <link href="/public/css/style-responsive.css" rel="stylesheet" />
    <link href="/public/css/style-default.css" rel="stylesheet" id="style_color" />
    <link href="/public/css/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="/public/css/jquery.fancybox.css" rel="stylesheet" />
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/uniform.default.css" />
</head>
<body class="fixed-top">
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
 作业门开锁情况查询<img style="width:40px; vertical-align: bottom;" src="/public/images/zym_pc4.png" />
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">安全门管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            作业门开锁情况
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
<div class="span12">
<div class="widget green">
<div class="widget-title">
<h4>作业门基本信息</h4>
</div>
<div class="widget-body">
<div class="bs-docs-example">
<ul class="nav nav-tabs" id="myTab">
<li class="active"><a data-toggle="tab" href="#home">作业安全门</a></li>
<!-- <li><a data-toggle="tab" href="#profile">监控摄像机</a></li>
 --></ul>
<div class="tab-content" id="myTabContent">
<div id="home" class="tab-pane fade in active">
    <div class="widget-body">
        <div>
            <div class="space15"></div>
            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <th>作业门编号</th>
                    <th>位置</th>
                    <th>负责人</th> 
                    <th>动作</th>
                    <th>操作时间</th>   
                </tr>
                </thead>
        <tbody>
        <?php foreach ($Cecontrol as $key => $value) { ?>
        <tr class="">
            <td class="ids"><?=$value['ceControlId']?></td>
            <td><?=$value['ceControlPosition']?></td>
            <td><?=$value['pManageName']?></td>
            <td><?php if(rand(1,2)==1)echo '<span style="color:#f30;">关</span>';else echo '<span style="color:#094;">开</span>';?></td>
            <td>2019-01-05 01:<?=rand(10,50)?>-04:<?=rand(10,50)?></td>
        </tr>
        <?php } ?>
        </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<div id="profile" class="tab-pane fade">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var $Cecontrol = <?= json_encode($Cecontrol)?>;
    console.log($Cecontrol);
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/toastr.min.js"></script>
<script src="/public/js/editable-ceControl.js?<?=rand(1,9999)?>"></script>
<script>
toastr.options.positionClass = 'toast-top-center';
function editable_save(saveobj){
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var master = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
    var position = $.trim( saveobj.parents("tr").eq(0).find(".tool").eq(0).val() );
    var note = $.trim( saveobj.parents("tr").eq(0).find(".note").eq(0).val() );
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
            "master":master,
            "position":position,
            "note":note,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
              if(msg != "error")toastr.success("msg: success");
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
</html>
