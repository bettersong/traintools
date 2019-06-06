<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <script src="/public/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <link href="/public/css/bootstrap.min_m.css" rel="stylesheet" />
    <link href="/public/css/style_m.css?1.0" rel="stylesheet" />
    
 
</head>
<body class="fixed-top">
    <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
    <ul class="breadcrumb">
                       <li>
                           <span class="divider">清点记录</span>
                       </li> 
                   </ul>
               </div>
           </div>
       </div>
       <div class="row-fluid">
                <div class="span11">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4>清点记录-仓库出入库</h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div>
                               
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" >
                                    <thead>
                                    <tr>
                                        <th>工单编号</th>
                                        <th>任务地点</th>
                                        <th>任务负责人</th>
                                        <th>上传时间</th>
                                        <th>执行时间</th>
                                        <th>职工人数</th>
                                        <th>工具种类数</th>
                                        <!-- <th>编辑</th>
                                        <th>删除</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($TworkOrder as $key => $value) { ?>
                                    <tr>
                                        <td class="ids small"><?=$value['twOrderId']?></td>
                                        <td class="small"><?=$value['DengJiCZ']?></td>
                                        <td class="small"><?=$value['ZhiJianY']?></td>
                                        <td class="small"><?=$value['JiHuaDate']?></td>
                                        <td class="small"><?=$value['QiQiSJ']?></td>
                                        <td class="small"><?=$value['ZhiGongZYRS']?></td>
                                        <td class="small"><?=$value['toolAmount']?></td>
                                        <!-- <td id="save"><a class="edit" href="#">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td> -->
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span11">
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4>清点记录-高铁安全门</h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                                
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                    <thead>
                                    <tr>
                                        <th>类别编号</th>
                                        <th>工具名称</th>
                                        <th>数量</th>
                                        <th>存放仓库</th>
                                        <th>所属RFID类型</th>
                                        <th>负责人</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($TworkOrder_toolInfoALL as $key => $value) { ?>
                                     <tr>
                                        <td class="ids small"><?php if($value['toListId']=='')echo '-';else echo $TworkOrder_toolInfoALL[$key]['toListId']; ?></td>
                                        <td class="small"><?=$value['DetailName']?></td>
                                        <td class="small"><?=$value['toolAmount']?></td>
                                        <td class="small"><?php if($value['waMessageName']=='')echo '<span style="color:#f30">暂无仓库</span>';else echo $TworkOrder_toolInfoALL[$key]['waMessageName']; ?></td>
                                        <td class="small"><?php if($value['RFIDClassType']=='')echo '-';else echo $TworkOrder_toolInfoALL[$key]['RFIDClassType'];?></td>
                                        <td class="small">出库扫描后获取</td>
                                        
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row-fluid" style="margin-bottom: 80px">
                <div class="span11">
                    <div class="widget red">
                        <div class="widget-title">
                            <h4>清点记录-作业地点</h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                               
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>编号</th>
                                        <th>姓名</th>
                                        <th>性别</th>
                                        <th>职位</th>
                                        <th>工作岗位</th>
                                        <th>联系方式</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach ($TworkOrder_administratorsInfoALL as $key => $value) { ?>   
                                    <tr>
                                        <td class="ids small"><?=$value['pManageId']?></td>
                                        <td class="small"><?=$value['pManageName']?></td>
                                        <td class="small"><?=$value['pManageSex']?></td>
                                        <td class="small"><?=$value['zManagePosition']?></td>
                                        <td class="small"><?=$value['userJobName']?></td>
                                        <td class="small"><?=$value['pManageContact']?></td>
                                        <td class="small"><?=$value['userOrtherInfo']?></td>
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
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
</script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/common-scripts.js?<?=rand(1,99999)?>"></script>
<script type="text/javascript">
//工具清单分页
var oTable = $('#editable-sample1').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'<'span8'l><'span8'f>r>t<'row-fluid'<'span8'i><'span8'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ 每页记录",
                    "oPaginate": {
                        "sPrevious": "上一页",
                        "sNext": "下一页"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
</body>