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
                        工器具清单
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
                            工器具清单
                        </li>
                        <li class="pull-right search-wrap">
                            <form action="" class="hidden-phone">
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
                    <div class="widget green">
                        <div class="widget-title">
                            <h4>工器具清单</h4>

                        </div>
                        <div class="widget-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a class="btn btn-inverse btn-large hidden-print" onclick="javascript:window.print();">打印
                                        <img src="/public/images/print.png" width="30px" height="30px" />
                                    </a>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-bordered" id="sample_1">
                                <thead>
                                <tr>
                                    <th>工单编号</th>
                                    <th>任务负责人</th>
                                    <th>下发日期</th>
                                    <th>完成状态</th>
                                    <th>备注</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($equipmentForms as $key => $value) { ?>
                                <tr class="odd gradeX">
                                    <td><?=$value['eqformsId']?></td>
                                    <td><?=$value['eqformsMaster']?></td>
                                    <td><?=$value['eqformsDate']?></td>
                                    <td><?=$value['eqformsStatus']?></td>
                                    <td><?=$value['eqformsNote']?></td>
                                </tr>
                                <?php } ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE widget-->
                </div>
            </div>

            <!-- END ADVANCED TABLE widget-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>



<!-- BEGIN JAVASCRIPTS -->

<!-- ie8 fixes -->
<!--[if lt IE 9]>

<script src="/public/js/respond.js"></script>
<![endif]-->
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>


<!--common script for all pages-->
<script src="/public/js/common-scripts.js?v=0.101"></script>

<!--script for this page only-->
<script src="/public/js/dynamic-table.js?v=0.101"></script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
