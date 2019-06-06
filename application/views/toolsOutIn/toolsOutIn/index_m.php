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
    <link rel="stylesheet" href="/public/css/mui.min.css?<?=rand(1,99999)?>">
    
    <style>
	.table th, .table td{padding:2px;}
	.widget{margin-bottom:10px;}
	.table th, .table td {
		padding: 8px 2px;
		text-align: center;
	}
    .active{
        display:block;
    }
	.dataTables_length{display:none !important;}
	.widget-body .dataTables_info, .widget-body .dataTables_paginate{
		width: 250px !important;
    	margin-right: -35px !important;
	}
	</style>
</head>
<body class="fixed-top" style="background:#fff !important">
    <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
    <ul class="breadcrumb">
                       <li>
                          工具出入库
                       </li>
                   </ul>
               </div>
           </div>
       </div>

            <div class="row-fluid">
                <div class="span11">
                    <div class="widget orange">
                        <div class="widget-title upDown">
                            <h4>工具出库</h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                                
                                 <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                    <thead>
                                    <tr>
                                       <!--<th>编号</th>-->
                                        <th>工具名称</th>
                                        <th>数量</th>
                                        <th>仓库号</th>
                                        <th>是否出库</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                       <?php foreach($toolsArr as $index=>$value){  ?>
                                          <tr>
                                            <td class="small"><?=$value['twdevId']?></td>
                                            <td class="small"><?=$value['twdev_name']?></td>
                                            <td class="small">仓库一</td>
                                           <td class="small mui-checkbox mui-right out">
                                               <?php if($value['twdevStatus_out']==1) 
											   echo '<img src="/public/images/dagou2.png " style="height:20px;" />';
											   else echo '未出库';?>
                                               
                                                
                                             </td> 
                                            </tr>
                                       <?php }  ?>
                                        
                                    
                                       <?php foreach($toolsArr as $index=>$value){  ?>
                                          <tr>
                                            <td class="small"><?=$value['twdev_name']?></td>
                                            <td class="small">仓库一</td>
                                           <td class="small mui-checkbox mui-right out">
                                               <?php if($value['twdevStatus_out']==1) 
											   echo '<img src="/public/images/dagou2.png " style="height:20px;" />';
											   else echo '未出库';?>
                                               
                                                
                                             </td> 
                                            </tr>
                                       <?php }  ?>
                                        
 
										
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

                        <div class="row-fluid" style="margin-bottom:80px">
                <div class="span11">
                    <div class="widget green">
                        <div class="widget-title upDown">
                            <h4>工具入库</h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                                
                                 <table class="table table-striped table-hover table-bordered" id="editable-sample2">
                                    <thead>
                                    <tr>
                                       <!--<th>编号</th>-->
                                        <th>工具名称</th>
                                        <th>数量</th>
                                        <th>仓库号</th>
                                        <th>是否出库</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                         <?php foreach($toolsArr as $index=>$value){  ?>
                                          <tr>
                                            <td class="small"><?=$value['twdevId']?></td>
                                            <td class="small"><?=$value['twdev_name']?></td>
                                            <td class="small">仓库一</td>
                                            <td class="small mui-checkbox mui-right out">
                                               <?php if($value['twdevStatus_in']==1) 
											   echo '<img src="/public/images/dagou2.png " style="height:20px;" />';
											   else echo '未出库';?>
                                               
                                                
                                             </td> 
                                            </tr>
                                       <?php }  ?>
 
                                         <?php foreach ($TworkOrder_toolInfoALL as $key => $value) { ?>
                                     <tr>
                                        
                                        <td class="small"><?=$value['DetailName']?></td>
                                        <td class="small"><?=$value['toolAmount']?></td>
                                        <td class="small"><?php if($value['waMessageName']=='')echo '<span style="color:#f30">暂无仓库</span>';else echo $TworkOrder_toolInfoALL[$key]['waMessageName']; ?></td>
                                        <td class="small"><label><input class="auth_edit toolIn" name="toolbag" type="checkbox" value="0" /></label> </td>
                                        
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
<script src="/public/js/jquery.dataTables.js?<?=rand(1,9999)?>"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<!-- <script src="/public/js/bootstrap-multiselect.js?<?=rand(1,99999)?>"></script> -->
<script type="text/javascript">
    var groupCheckbox=$(".out");
    groupCheckbox
    for(i=0;i<groupCheckbox.length;i++){
        if(groupCheckbox[i].checked){
            var val =groupCheckbox[i].value;
            alert(val );
        }
    }

    //console.log(outValue);
//         $.ajax({
//         async:false,
//         type: "post",
//         data: {
//             "userName":userName,
//             "contact":contact,
//         },
//         dataType: 'json',
//         url: "<?=CURRENT_DIR?>/index_add.php?",
//         success: function (msg) {
//         if(contact==''){mui.alert('电话号码不能为空！'); return false;}
//           else if(contact.length!=11){mui.alert('电话号码格式不正确！'); return false;}
//               else mui.alert("修改成功！");
//            console.log(msg);
//             $('.phoneNumber').html(contact);
//           },
//         error: function(msg){
//             mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
//         }
    
// });

</script>
<script>
   
//出库分页
$('#editable-sample1').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'r>t<'row-fluid'<'span8'i><'span8'p>>",
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
$('#editable-sample2').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'r>t<'row-fluid'<'span8'i><'span8'p>>",
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