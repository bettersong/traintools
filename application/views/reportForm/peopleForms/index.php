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
    <link href="/public/css/toastr.min.css" rel="stylesheet">
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
                        人员清单
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">报表统计</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            人员清单
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
                    <div class="widget red">
                        <div class="widget-title">
                            <h4>人员清单</h4>

                        </div>
                        <div class="widget-body">
                            <div class="widget-body">
                                <div>
                                    <div class="clearfix">
                                        <div class="btn-group">
                                            <a class="btn btn-inverse btn-large hidden-print" onclick="javascript:window.print();">打印
                                            <img src="/public/images/print.png" width="30px" height="30px" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="space15"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                        <tr>
                                            <th>ID编号</th>
                                            <th>姓名</th>
                                            <th>负责工具</th>
                                            <th>小组负责人</th>
                                            <th>编辑</th>
                                            <th>删除</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($PeopleForms as $key => $value) { ?>
                                        <tr class="">
                                            <td class="ids"><?=$value['peFormsId']?></td>
                                            <td><?=$value['peFormsName']?></td>
                                            <td><?=$value['peFormsTool']?></td>
                                            <td><?=$value['peFormsMaster']?></td>
                                            <td><a class="edit auth_edit" href="javascript:;">编辑</a></td>
                                            <td><a class="delete auth_del" href="javascript:;">删除</a></td>
                                        </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END INLINE TABS PORTLET-->
                    </div>
                </div>
                <!-- END PAGE -->
            </div>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-reportForms.js?v=0.101"></script>
<script src="/public/js/toastr.min.js"></script>
<script>
toastr.options.positionClass = 'toast-top-center';
function editable_save(saveobj){
var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
var name = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
var tool = $.trim( saveobj.parents("tr").eq(0).find(".tool").eq(0).val() );
var master = $.trim( saveobj.parents("tr").eq(0).find(".note").eq(0).val() );
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
            "name":name,
            "id":id,
            "tool":tool,
            "master":master,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {

              if(msg != "error")toastr.success("提交成功！");
              if(type=="add"){
                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
              }
        },
        error: function (msg) {
            toastr.warning(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });

    //return false;
};
                jQuery(document).ready(function() {
                    EditableTable.init();
                });
            </script>
            <!-- END JAVASCRIPTS -->