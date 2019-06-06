<?php  session_start(); //开启session


//手机访问，则跳转到手机页面
if($ism){
    //echo $_SERVER["SERVER_NAME"];
    header("Location: http://".$_SERVER["SERVER_NAME"].":8081/taskManage/TworkOrder/index_m");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>高铁检修综合管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="Mosaddek" name="author" />
    <link href="/public/css/bootstrap.min<?=$_m?>.css?v=0.101" rel="stylesheet" />
    <link href="/public/css/bootstrap-responsive.min<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/bootstrap-fileupload<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/style<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-responsive<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color" />
    <link href="/public/css/bootstrap-fullcalendar<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/jquery.fancybox<?=$_m?>.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/uniform.default<?=$_m?>.css" />
    <link rel="stylesheet" href="/public/css/bootstrap-multiselect<?=$_m?>.css?<?=rand(1,99999)?>" type="text/css"/>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">

   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>


  <!-- BEGIN CONTAINER -->
  <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                        今日工单
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
                            今日工单
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
                <div class="span5">
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4>上传工单</h4>
                        </div>
                        <div class="widget-body">
            <form enctype="multipart/form-data" method="post" id='addForm'>
            <span id="fileNameOrFileFormat" style="color:red">支持文件格式：xls，xlsx</span>
            <div id="filePanel">
                <span class="selectFileDiv" href="javascript:;" style="width:320px">
                     选择文件
                    <input type="file" name="file" id="selectFile">
                </span>
                <input type='button' id="upLoad" class="btn customButton btn-primary" value='上传' name="上传" style="float:right" />
            </div>
            
        </form>
          </div>
      </div>
  </div>
</div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4>工单表</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <!-- <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn">
                                            添加工单<i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div> -->
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
                <div class="span12">
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4>工具清单</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <!-- <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn">
                                            添加工单<i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div> -->
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
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget red">
                        <div class="widget-title">
                            <h4>核心人员</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <!-- <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn">
                                            添加工单<i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div> -->
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
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget yellow">
                        <div class="widget-title">
                            <h4>施工人员</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample" style="margin-top:10px">
                                    <select class="example-getting-started" multiple="multiple" id="select">
                                      <?php foreach ($pmanage as $key => $value) { ?>
                                        <option value="<?=$value['pManageName']?>"><?=$value['pManageName']?></option>
                                      <?php } ?>
                                    </select>
                                    <input type="button" id="sure" class="btn customButton btn-primary" value="确定" name="确定" style="margin-left:20px">
                                    <thead>
                                    <tr>
                                        <th>姓名</th><!-- ZhiGongZYRS -->
                                        <th>性别</th>
                                        <th>所属部门</th>
                                        <th>所属职位</th>
                                        <th>联系方式</th>
                                        <!-- <th>编辑</th>
                                        <th>删除</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($Shigongperson as $key => $value) { ?>     
                                    <tr>
                                        <td class="ids small"><?=$value['shigongName']?></td>
                                        <td class="small"><?=$value['shigongSex']?></td>
                                        <td class="small"><?=$value['shigongBranch']?></td>
                                        <td class="small"><?=$value['shigongPosition']?></td>
                                        <td class="small"><?=$value['shigongContact']?></td> 
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
    </div>
</div>
</div>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var TworkOrderArray = <?=$TworkOrderJson?>;
    var TworkOrdertoolArray = <?=$TworkOrder_toolInfoALL?>;
    var pmanage1Array = <?=$pmanage1Json?>;
</script>
<script src="/public/js/jquery.form.js"></script>
<script src="/public/js/select.js"></script>
<script type="text/javascript">
$(function(){
    //console.log(sTworkOrderArray);

    var activity_id = sessionStorage.getItem('activity_id');
  
    // 点击上传按钮
    $('#upLoad').click(function(){
        $('#addForm').ajaxSubmit({
            forceSync: false,  
            url:  "<?=CURRENT_DIR?>/index_upload.php",
            type: 'post',
            dataType: 'text',
            success: function(response){
                alert('上传成功！');
            },
            error: function(response){
                alert('上传失败！');
            }
        });
    });
    $("#selectFile").on("change",function(){
        var file = document.getElementById('selectFile').files;    //获取上传的文件
        var fileName = file[0].name;
        // 获取文件的格式为.xsl、.xslx
        var fileFormat = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
        if( checkFileFormat(fileFormat) == false){
            alert("上传的文件类型有误！");
            return;
        }  
    });
    // 校验文件格式
    function checkFileFormat(format) {
        if (format.match(/.xls|.xlsx/)) {
            return true;
        }
        return false;
    }
});
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-tworkOrder.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/bootstrap-multiselect.js?<?=rand(1,99999)?>"></script>
<script>
//function editable_save(saveobj){
    
    //施工人员
$("#sure").click(function(){
    var name = [];
    $("#select option:selected").each(function(i){
            //name = new Array();
            name[i] = $(this).val();
            //console.log(name);
    });
    //console.log(name);
    $.ajax({
        async:false,
        type: "post",
        data: {
            "name":name,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
                 alert('success');
                 console.log(name);
              },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
            console.log(name);
        }
    });
});

    //return false;
//}
//});
 // };*/
 jQuery(document).ready(function() {
        EditableTable.init();
    });

//工具清单分页
var oTable = $('#editable-sample1').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
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
