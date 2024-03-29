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
                        清点记录
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="index.php">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">工器具管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            清点记录
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
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> 清点记录表</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-remove">
                                    <img src="/public/images/remove.png" width="30px" height="30px"/>
                                </a>
                            </span>
                        </div>
                        <div class="widget-body">
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
                                <tr class="odd gradeX">
                                    <td>0025</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0024</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0023</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0022</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0021</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0020</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0019</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0018</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0017</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0016</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0015</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0014</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0013</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0012</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0011</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0010</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0009</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0008</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0007</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0006</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0005</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0004</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0003</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0002</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>0001</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                    <td>XXXX</td>
                                </tr>
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
