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
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">

                <h3 class="page-title" style="color:#000">
                    作业计划汇总<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span>
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
                        历史工单
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
                        <h4><i class="icon-reorder"></i> 工单表</h4>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th class="num">编号</th>
                                <th style="padding: 8px 0;text-align: center;width:68px;">主管单位</th>
                                <th>作业内容</th>
                                <th style="padding: 8px 0;text-align: center;width:68px;">日期</th>
                            </tr>
                            </thead>
                            <tbody>
                             <?php $i=1;foreach ($AllOrder as $key => $value) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?=$i?></td>
                                        <td style="padding: 8px 1px;text-align: center;" class="small"><?=$value['bumenName']?></td>
                                        <td class="id small"><a id="link" href="/taskManage/TworkOrder/index&JiHuaDate=<?=$value['JiHuaDate']?>"><?=$value['ZuoYeNR']?></a></td>
                                        <td style="padding: 8px 1px;text-align: center;" class="small"><?=$value['JiHuaDate']?></td>
                                    </tr>
                                    <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/dynamic-table.js?v=0.101"></script>
<script>
</script>
</body>
<!-- END BODY -->
</html>
