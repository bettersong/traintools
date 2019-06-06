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
    .active{
        display:block;
    }
	.dataTables_length{display:none !important;}
	</style>
</head>
<body class="fixed-top">
    <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
    <ul class="breadcrumb">
                       <li>
                          <?php  if($date==date('Y-m-d')) echo "今日工单"; 
                               else echo "历史工单";
                            ?>
                       </li>
                   </ul>
               </div>
           </div>
       </div>
       <div class="row-fluid">
                <div class="span11">
                    <div class="widget green">
                        <div class="widget-title upDown">
                            <h4>工单表</h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                                <!--<div class="space15"></div>-->
                                <table class="table table-striped table-hover table-bordered" >
                                    <thead>
                                    <tr>
                                        <!-- <th>编号</th> -->
                                        <th>地点</th>
                                        <th>负责人</th>
                                        <th>上传时间</th>
                                        <th>实施时间</th>
                                        <th>职工人数</th>
                                        <th>工具种数<!--种类数--></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($TworkOrder as $key => $value) { ?>
                                    <tr style="text-align:center;">
                                        <td class="small"><?=$value['DengJiCZ']?></td>
                                        <td class="small"><?=$value['ZhuTiZYFZR']?></td>
                                        <td class="small"><?=$value['JiHuaDate']?></td>
                                        <td class="small"><?=$value['QiQiSJ']?></td>
                                        <td class="small"><?=$value['ZhiGongZYRS']?>人</td>
                                        <td class="small"><?=$value['toolAmount']?>种</td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <div style="background:;padding: 5px 2px 2px;margin-top: 5px;color: #555;border-bottom: 1px solid #ddd;">
                                	<span style="color:#f30;margin-top: 10px;">今日任务：</span><?=$TworkOrder[0]['ZuoYeXM']?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span11">
                    <div class="widget orange">
                        <div class="widget-title upDown">
                            <h4>工具清单</h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                                
                                 <table class="table table-striped table-hover table-bordered" id="editable-sample1">
                                    <thead>
                                    <tr>
                                       <!-- <th>类别编号</th>-->
                                        <th>工具名称</th>
                                        <th>数量</th>
                                        <th>仓库</th>
                                        <th>存工具包</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($TworkOrder_toolInfoALL as $key => $value) { ?>
                                     <tr>
                                        <?php /*?><td class="ids small"><?php if($value['toListId']=='')echo '-';else echo $TworkOrder_toolInfoALL[$key]['toListId']; ?></td><?php */?>
                                        <td class="small"><?=$value['DetailName']?></td>
                                        <td class="small"><?=$value['toolAmount']?></td>
                                        <td class="small"><?php if($value['waMessageName']=='')echo '<span style="color:#f30">暂无仓库</span>';else echo $TworkOrder_toolInfoALL[$key]['waMessageName']; ?></td>
                                        <td class="small"><label><input <?php foreach($toolbagArr as $index2=>$value2){
											//echo $value['DetailName'].'  '.$value2['twdev_name'];
											if($value['DetailName']==$value2['twdev_name'])echo '  checked  initcheck="1"';
											
										}?>class="selectToToolbag auth_edit" name="<?=$value['DetailName']?>" type="checkbox" value="<?=$value['twdevId']?>" /></label> </td>
										<?php /*?><td class="small"><?php if($value['RFIDClassType']=='')echo '-';else echo $TworkOrder_toolInfoALL[$key]['RFIDClassType'];?></td><?php */?>
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
                    <div class="widget red">
                        <div class="widget-title upDown">
                            <h4>核心人员<span style="text-decoration: ;color:#ccc;;"><!--（工单表中已列出）--></span></h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>岗位</th>
                                        <th>姓名</th>
                                        <th>联系方式</th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php foreach ($TworkOrder_administratorsInfoALL as $key => $value) { ?>   
                                    <tr>
                                        <td class="small"><?=$value['userJobName']?></td>
                                        <td class="small"><?php if($value['pManageName']=='') echo '<span style="color:#f30">- 无 -</span>' ;else echo $value['pManageName']?></td>
                                        <td class="small"><?=$value['pManageContact']?></td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="row-fluid" style="margin-bottom:50px">
                <div class="span11">
                    <div class="widget yellow">
                        <div class="widget-title upDown">
                            <h4>施工人员<span style="text-decoration: ;color:#eee;">（工单要求<?=$TworkOrder[0]['ZhiGongZYRS']?>人）</span></h4>
                            <span class="tools">
                                    <a href="javascript:;" class="icon-chevron-up"></a>
                            </span>
                        </div>
                        <div class="widget-body other" style="display:none">
                            <div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:10px">
                                    <select class="example-getting-started" multiple="multiple" id="select">
                                     
									  <?php foreach ($pmanage as $key => $value) { ?>
                                        <option value="<?=$value['pManageName']?>" <?php if(array_multi_search($value['pManageName'], $workers))echo 'selected'?>><?=$value['pManageName']?></option>
                                      <?php } ?>
                                    </select>
                                    <input type="button" id="sure" class="btn customButton btn-primary" value="确定" name="确定" style="margin-left:20px">
                                    <thead>
                                    <tr>
                                        <th>编号</th><!-- ZhiGongZYRS -->
                                        <th>姓名</th>
                                        <th>联系方式</th>
                                        <!--<th>日期</th>
                                        <th>考勤情况</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($workers as $key => $value) { ?>    
                                    <tr>
                                        <td class="ids small" id="ids"><?=$value['twkeId']?></td>
                                        <td class="small" id="name"><?=$value['pManageName']?></td>
                                        <td class="small" id="date"><?=$value['pManageContact']?></td>
                                       <?php /*?> <td class="small" id="kao"><?=$value['twkeAttendance']?></td><?php */?>
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
    var TworkOrderArray = <?=$TworkOrderJson?>;
    var TworkOrdertoolArray = <?=$TworkOrder_toolInfoALL?>;
    var pmanage1Array = <?=$pmanage1Json?>;
    var JiHuaDate1 = "<?=$date?>";
    //console.log(JiHuaDate1);
    //获取当前时间
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    if (month < 10) {
        month = "0" + month;
    }
    if (day < 10) {
        day = "0" + day;
    }
    var nowDate = year + "-" + month + "-" + day;
    //console.log(nowDate);
    if(JiHuaDate1==nowDate){
     $("#onload").show();
    }
    else{
       $("#onload").hide(); 
    }
</script>
<script src="/public/js/jquery.dataTables.js?<?=rand(1,9999)?>"></script> 
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-hexinrenyuan-m.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/bootstrap-multiselect.js?<?=rand(1,99999)?>"></script>
<script type="text/javascript">
    window.onload = function(){
        $('.tab2').addClass('active1');
        // $('.example-getting-started').multiselect();
        $('.dataTables_length').hide();
        
        
    }
</script>
<script>
$(".selectToToolbag").click(function(e) {
    var twdev_name = $(this).attr("name");
	 var initcheck = $(this).attr("initcheck");
	 if(initcheck!=1)initcheck=0;
	 //alert(" 11:"+initcheck);
	 //if(initcheck=="")alert(initcheck);
	//return false;
	var checkedTab = 1;
	if($(this).is(':checked'))checkedTab = 1;
	else checkedTab = 0;
 		$.ajax({
			async:false,
			type: "post",
			data: {
				"initcheck":initcheck,
				"checkedTab":checkedTab,
				"twdev_name":twdev_name,
				"type":"selectToToolbag"
			},
			dataType: 'json',
			url: "<?=CURRENT_DIR?>/index_add.php?",
			success: function (msg) {
				 
					 //alert('成功！');
					 //location.reload();
				  },
			error: function (msg) {
				alert(msg.status + "服务繁忙，请刷新或稍后再试。");
				console.log(name);
			}
		});
	
});
    //施工人员
$("#sure").click(function(){
    var name = [];
    $("#select option:selected").each(function(i){
            name[i] = $(this).val();
    });
    $.ajax({
        async:false,
        type: "post",
        data: {
            "name":name,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
                 alert('成功！');
                 location.reload();
              },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
            console.log(name);
        }
    });
});
//工具清单分页
var oTable = $('#editable-sample1').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'r>t<'row-fluid'<'span6'i><'span8'p>>",
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
jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
</body>
</html>
</body>