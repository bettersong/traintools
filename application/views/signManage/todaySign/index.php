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
    <link href="/public/css/style.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color"/>
</head>

<body class="fixed-top">
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                        今日签到
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
                            今日签到
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
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>今日签到</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <h6 style="color:#000">负责人：周军武</h6>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <h6 style="color:#000">关联工单号：3617</h6>
                                    </div>
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>ID编号</th>
                                        <th>应签人员</th>
                                        <th>是否签到</th>
                                        <th>签到时间</th>
                                        <th>签到地点</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($TodaySign as $key => $value) { ?>
                                    <tr class="">
                                        <td><?=$value['twamPersonId']?></td>
                                        <td><?php if($value['pManageName']!='') echo"$value[pManageName]";else echo"人员系统中暂无此人";?></td>
                                        <td><?php if($value['twamAttendance']==1) echo"是";else echo"否";?></td>
                                        <td class="center"><?=$value['twamDate']?></td>
                                        <td><?=$value['toSignPlace']?></td>
                                        <td><?=$value['toSignNotes']?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <h6 style="color:#000">应签人数：<?=$TodaySign_amount?></h6>
                                    </div>
                                    <div class="btn-group pull-center" style="margin:0 20px">
                                        <h6 style="color:#000">实签人数：<?=$attendance_amount?></h6>
                                    </div>
                                    <div class="btn-group pull-center">
                                        <h6 style="color:#000">缺签人数：<?=$NoSign_amount?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="/public/js/editable-tworkOrder.js"></script>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>

</body>
<!-- END BODY -->
</html>
