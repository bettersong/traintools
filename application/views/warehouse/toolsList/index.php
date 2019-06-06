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
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link href="/public/css/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/uniform.default.css" />
    <style>
    .linka{text-decoration: underline !important}
</style>
</head>
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
   <!-- END header-left -->

  <!-- BEGIN CONTAINER -->
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                        工器具信息管理<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span>
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
                            工器具信息
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
                            <h4><i class="icon-reorder"></i>工器具信息列表</h4>
                        </div>
                        <div class="widget-body">
                            <div style="position: absolute;left: 333px;top: 57px;height: 28px;line-height:30px;">
                                <span style="color:#555;">按大小分类管理</span>
                                <select style="vertical-align: top;" class="type" id="selectSize">
                                <option value="0">请选择类型</option>
                                <option value="1" <?php if($_GET['selectSize']==1)echo 'selected' ;?> >小工具</option>
                                <option value="2" <?php if($_GET['selectSize']==2)echo 'selected' ;?> >大工具</option>
                                </select>
                            </div>
                            <div>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn green auth_add">
                                            添加 <i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr> 
                                        <th>ID编号</th>
                                        <th>工具名称</th>
                                        <th>数量</th>
                                        <th>大小分类</th>
                                        <th>所属仓库</th>
                                        <th>负责人</th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody class="t_body">
                                    <?php foreach ($ToolsList as $key => $value) { ?>
                                    <tr class="">
                                        <td class="ids"><?=$value['toListId']?></td>
                                        <td><?=$value['toListName']?></td>
                                        <td class="nums"><a class="link" style="color:;margin:0 10px 0 0;text-decoration: underline;" href="indexDetail&toolsListId=<?=$value['toListId']?>&toolType=<?=$value['RFIDClassId']?>&waMessageId=<?=$value['waMessageId']?>" target="_blank"><?=$amount[$key]?></a></td>
                                        <td class="td_class" value="<?=$value['RFIDClassId']?>"><?=$value['RFIDClassType']?></td>
                                        <td class="td_warehouse" value="<?=$value['waMessageId']?>"><?=$value['waMessageName']?></td>
                                        <td class="td_master" value="<?=$value['pManageId']?>"><?=$value['pManageName']?></td>
                                        <td><a class="edit auth_edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete auth_del" href="javascript:;">删除</a></td>
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
    <!-- END PAGE -->
</div>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径 
    var rfidclassArray = <?=$rfidclassJson?>;
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-toolsList.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/toastr.min.js"></script>
<script>
var DetailHomeArray = <?=$warehousemessageJson?>;
var pmanage_builders = <?=$pmanage_buildersJson?>;
//选择大小分别管理
$("#selectSize").change(function(e) {
    var sizeVal = $(this).children('option:selected').val();  
	location.href="/warehouse/toolsList/index&selectSize="+sizeVal;
});
toastr.options.positionClass = 'toast-top-center'; 
function editable_save(saveobj){
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var name = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
    var amount = $.trim( saveobj.parents("tr").eq(0).find(".amount").eq(0).val() );
    var typel = $.trim( saveobj.parents("tr").eq(0).find(".type").eq(0).val() );
    var warehouseId = $.trim( saveobj.parents("tr").eq(0).find(".selectWareHouse").eq(0).val());
    var MasterId = $.trim( saveobj.parents("tr").eq(0).find(".selectMaster").eq(0).val());
    var type = "add";
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    saveobj.parents("tr").find("input").each(function(index, element) {
        if($(this).val()==""){
            toastr.warning("数据全部不能为空，请填写！");
            dataIsNull = true;
            return false;
        }
    });
    if(dataIsNull) return "null"; //editable-table.js用到
    $.ajax({
        async:false,
        type: "post",
        data: {
            "type":type,
            "id":id,
            "name":name,
            "amount":amount,
            "warehouseId":warehouseId,
            "MasterId":MasterId,
            "typel":typel,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
              if(msg != "error")toastr.success("提交成功！");
              if(type=="add"){
                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
              }
        },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });
};
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>
</body>
</html>
