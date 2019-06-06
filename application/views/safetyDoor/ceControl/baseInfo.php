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
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/uniform.default.css" />
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
 作业门基本信息管理<img style="width:40px; vertical-align: bottom;" src="/public/images/zym_pc3.png" />
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
                            作业门基本信息
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
                    <th>作业门编号</th>
                    <th>作业门</th>
                    <th>绑定锁码</th>
                    <th>GPS（格式: 经度,纬度）</th>
                    <th>地点</th>
                    <th>负责人</th>
                    <th>备注</th>
                    <th>状态</th>
                    <th>编辑</th>
                    <th>删除</th>
                </tr>
                </thead>
        <tbody>
        <?php foreach ($Cecontrol as $key => $value) { ?>
        <tr>
        <td class="ids"><?=$value['ceControlId']?></td>
        <td><?=$value['ceName']?></td>
        <td><?=$value['ceControlLockNum']?></td>
        <td style="text-align:center;"><a style="color:blue;" href="/application/views/personLocal/RealTimeLocal/localmap&x=<?=$value['ceGPS_x']?>,y=<?=$value['ceGPS_y']?>"><img class='mapPosition' style="height: 22px;" x=<?=$value['ceGPS_x']?> y=<?=$value['ceGPS_y']?> src="/public/images/icon-png/local2.png" /><?=$value['ceGPS_x']?>,<?=$value['ceGPS_y']?></a></td>
        <td><?=$value['ceControlPosition']?></td>
        <td><?=$value['pManageName']?></td>
        <td><?=$value['ceControlNote']?></td>
        <td>关</td>
        <td><a class="edit auth_edit" href="javascript:;">编辑</a></td>
        <td><a class="delete auth_del" href="javascript:;">删除</a></td>
        </tr>
        <?php } ?>

        </tbody>
            </table>
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
</div>
</div>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var CecontrollockArray = <?=$CecontrollockJson?>;
    var PersonArray = <?=$personJson?>;
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
    var door = $.trim( saveobj.parents("tr").eq(0).find(".door").eq(0).val() );
    //console.log(door);
    var code = $.trim( saveobj.parents("tr").eq(0).find(".code option:selected").eq(0).val() );
    var position =$.trim( saveobj.parents("tr").eq(0).find(".position").eq(0).val() );
    var master = $.trim( saveobj.parents("tr").eq(0).find(".master").eq(0).val() );
    var note = $.trim( saveobj.parents("tr").eq(0).find(".note").eq(0).val() );
    var state = $.trim( saveobj.parents("tr").eq(0).find(".state").eq(0).val() );
    var type = "add";
     //获取经纬度，及检查经纬度格式
    var gps = $.trim( saveobj.parents("tr").eq(0).find(".gps").eq(0).val() );
     
    var ceGPS = gps.split(/[,，]/);//防止中英文符号匹配出错
    var ceGPS_x = ceGPS[0];
    var ceGPS_y = ceGPS[1];
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    saveobj.parents("tr").find("input").not(".note,.state").each(function(index, element) {
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
            "code":code,
            "door":door,
            "ceGPS_x":ceGPS_x,
            "ceGPS_y":ceGPS_y,
            "position":position,
            "master":master,
            "note":note,
            "state":state,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/baseInfo_add.php?",
        success: function (msg) {
            console.log(msg);
            toastr.success("提交成功");
            if(type=="add"){
                saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
            }
        },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
            //console.log(data);
        }
    });

    //return false;
};
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
