<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <script src="/public/js/bootstrap.min.js"></script>
    <link href="/public/css/bootstrap.min_m.css?1.0" rel="stylesheet" />
    <link href="/public/css/style_m.css?1.0" rel="stylesheet" />
    <style>
     .icon-chevron-down:before {
      content: "∨";
      }
      .icon-chevron-up:before {
     content: "∧";
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
                           
                           <span class="divider">历史工单 </span>
                       </li>
                       
                       
                   </ul>
               </div>
           </div>
      
        <div class="row-fluid" style="margin-bottom:50px">
            <div class="span11">
                <div class="widget red">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> 工单表</h4>
                    </div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered" id="editable-sample1">
                            <thead>
                            <tr>
                                <th>作业内容</th>
                                <th>日期</th>
                            </tr>
                            </thead>
                            <tbody>
                             <?php foreach ($AllOrder as $key => $value) { ?>
                                    <tr>
                                        <td class="id small"><a id="link" href="/taskManage/TworkOrder/index&JiHuaDate=<?=$value['JiHuaDate']?>"><?=$value['ZuoYeNR']?></a></td>
                                        <td class="small"><?=$value['JiHuaDate']?></td>
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
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    
</script>

<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/common-scripts.js?<?=rand(1,99999)?>"></script>
<script type="text/javascript">
    window.onload = function(){
        $('.tab2').addClass('active1');
        $('#editable-sample1_length').hide();
    }
//分页
var oTable = $('#editable-sample1').dataTable({
                "aLengthMenu": [
                    
                    [5, 15, 20, "All"] 
                ],
                "iDisplayLength": 10,
                "sDom": "<'row-fluid'<'span8'l><'span8'f>r>t<'row-fluid'<'span8'i><'span8'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    
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
</body>
</html>
</body>