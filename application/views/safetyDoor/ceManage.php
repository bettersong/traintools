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
                    <!-- BEGIN THEME CUSTOMIZER-->
                    <div id="theme-change" class="hidden-phone">
                        <img src="/public/images/setting.png" width="20px" height="20px">
                        <span class="settings">
                            <span class="text">主题颜色:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-gray" data-style="gray"></span>
                            </span>
                        </span>
                    </div>
                    <!-- END THEME CUSTOMIZER-->
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title" style="color:#000">
                        监控信息管理
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="index.php">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">安全门管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            监控信息管理
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
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget drake">
                        <div class="widget-title">
                            <h4>监控信息管理</h4>
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
                                            添加设备类别 <i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>类别编号</th>
                                        <th>类别名称</th>
                                        <th>总数量</th>
                                        <th>时间</th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="">
                                        <td>00A1</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A2</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A3</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A4</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A5</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A6</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A7</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A8</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00A9</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00B1</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00B2</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00B3</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00B4</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <tr class="">
                                        <td>00B5</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE widget-->
                </div>
            </div>

            <!-- END EDITABLE TABLE widget-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
</div>



<!-- BEGIN JAVASCRIPTS -->

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<!--<script src="/public/js/respond.js"></script>-->
<![endif]-->
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>


<!--common script for all pages-->
<script src="/public/js/common-scripts.js?v=0.101"></script>

<!--script for this page only-->
<script src="/public/js/editable-table.js"></script>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
