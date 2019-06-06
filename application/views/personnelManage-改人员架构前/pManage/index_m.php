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
    <link href="/public/css/bootstrap.min_m.css?1.0" rel="stylesheet" />
    <link href="/public/css/style_m.css?1.0" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/bootstrap-multiselect.css?<?=rand(1,99999)?>" type="text/css"/>
    <style>
    .table th, .table td{padding:2px;}
    .widget{margin-bottom:10px;}
    .table th, .table td {
        padding: 8px 2px;
        text-align: center;
    }
    </style>
</head>
<body class="fixed-top">
    <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
    <ul class="breadcrumb">
                       <li>
                         人员信息
                       </li>
                   </ul>
               </div>
           </div>
       </div>
       
            <div class="row-fluid" style="margin-bottom:80px">
                <div class="span11">
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4>人员信息</h4>
                        </div>
                        <div class="widget-body other">
                            <div>
                                
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                    <thead>
                                    <tr>
                                        <th>编号</th>
                                        <th>姓名</th>
                                        <th>所属部门</th>
                                        <th>所属职位</th>
                                        <th>联系方式</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($personnerArr as $key => $value) { 
                                        if($value['pManageName']=="admin")continue;//不显示系统管理员
                                    ?>
                                    <tr class="">
                                        <td class="ids"><?=$value['pManageId']?></td>
                                        <td class="td_name"><?=$value['pManageName']?></td>
                                        
                                        <td class="td_lines" value="<?=$value['bManageId']?>"><?=$value['bManageBranch']?></td>
                                        <td class="td_position" value="<?=$value['zManageId']?>"><?=$value['zManagePosition']?></td>
                                       
                                        <td><?=$value['pManageContact']?></td>
                                       
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
    var personnerArray = <?=$bumenJson?>;
    var BumenArray = <?=$bumenJson?>;
    var ZhiweiArray = <?=$zhiweiJson?>;
</script>
<script src="/public/js/jquery.dataTables.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/DT_bootstrap.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>

<script>
     
   
//工具清单分页
var oTable = $('#editable-sample1').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'<'span8'f>r>t<'row-fluid'<'span8' i><'span8'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    
                    "oPaginate": {
                        "sPrevious": "",
                        "sNext": ""
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });
</script>
</body>
</html>
</body>