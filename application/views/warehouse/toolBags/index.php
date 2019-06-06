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
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/uniform.default.css" />
    <style>
    .id{width:30px !important;}
    .GPS{width:155px !important;}
    .state{width:100px !important;}
    </style>
</head> 
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
   <!-- END header-left -->
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12"> 

                    <h3 class="page-title" style="color:#000">
 工具包管理<img style="width:40px; vertical-align: bottom;" src="/public/images/zym_pc3.png" />
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">工具包管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            工具包信息
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
<div class="widget orange">
<div class="widget-title">
<h4>工具包信息</h4>
</div>
<div class="widget-body">
<div class="bs-docs-example">
<ul class="nav nav-tabs" id="myTab">
<li class="active"><a data-toggle="tab" href="#home">工具包</a></li></ul>
<div class="tab-content" id="myTabContent">
<div id="home" class="tab-pane fade in active">
    <div class="widget-body">
        <div>
            <div class="clearfix">
                <div class="btn-group">
                    <button id="editable-sample_new" class="btn green auth_add">
                        添加<i class="icon-plus"></i>
                    </button>
                </div>
            </div>
            <div class="space15"></div>
            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                    <tr>
                        <th>工具包编号</th>
                        <th>工器具名称</th>
                        <th>读取器机器码</th>
                        <th>定位器</th>
                        <th>工具包类型大小</th>
                        <th>所属库房</th>
                        <th>工具包状态</th>
                        <th>编辑</th>
                        <th>删除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ToolBags as $key => $value) { ?>
                    <tr class="">
                        <td class="ids"><?=$value['tb_id']?></td>
                        <td><?=$value['tb_name']?></td>
                        <td><?=$value['rfid_reader_code']?></td>
                        <?php 
                            echo '<td class="GPS" value="'.$value['GPSId'].'">'.$value['GPSCode'].'</td>';
                        ?>
                        <td><?php
                                switch ($value['type']) {
                                    case SMALL: echo "小型"; break;
                                    case MEDIUM: echo "中型"; break;
                                    case BIG: echo "大型"; break;
                                    default:echo "工具包信息出错";break;
                            }
                        ?></td>
                        <td><?=$value['waMessageName']?></td>
                        <td><?php
                                switch ($value['state']) {
                                    case 0: echo "报废"; break;
                                    case 1: echo "维修中"; break;
                                    case 2: echo "待使用"; break;
                                    case 3: echo "使用中"; break;
                                    default:echo "工具包信息出错";break;
                            }
                        ?></td>
                        <td><a class="edit auth_edit" href="javascript:;" >编辑</a></td>
                        <td><a class="delete auth_del" href="javascript:;">删除</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="profile" class="tab-pane fade">
</div>
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
    var DetailHomeArray = <?=$warehousemessageJson?>;
    var LocatorArr=<?=$locatorArrJson?>;
    var thisGPS = '';
    $('.edit').on('click',function(){
        thisGPS = $(this).parents('tr').find('.GPS').html();
    })
    //封装删除单个数组元素方法
    function remove(arr, item) { 
        var result=[];
        for(var i=0; i<arr.length; i++){
        if(arr[i]!=item){
            result.push(arr[i]);
        }
        }
        return result;
    }
    //
   
    function remove2(arr,item){
        console.log("222222");
        var result = [];
        for(var i=0; i<arr.length;i++){
            console.log(arr[i]['GPSCode']+"  "+item+"<br>");
            if(arr[i]['GPSCode']!=item){
                result.push(arr[i])
            }
        }
    return result;
    }
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/toastr.min.js"></script>
<script src="/public/js/editable-toolBags.js?<?=rand(1,9999)?>"></script>
<script>
toastr.options.positionClass = 'toast-top-center';
function editable_save(saveobj){
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var tb_name = $.trim( saveobj.parents("tr").eq(0).find(".tb_name").eq(0).val() );
    var tools = $.trim( saveobj.parents("tr").eq(0).find(".tools").eq(0).val() );
    var reader = $.trim( saveobj.parents("tr").eq(0).find(".reader").eq(0).val() );
    var GPSId = $.trim( saveobj.parents("tr").eq(0).find(".GPS option:selected").eq(0).val() );
    var oldGPSId = $.trim( saveobj.parents("tr").eq(0).find(".GPS option").eq(0).val() );
    var tool_type = $.trim( saveobj.parents("tr").eq(0).find(".type").eq(0).val() );
    var house = $.trim( saveobj.parents("tr").eq(0).find(".house").eq(0).val() );
    var state = $.trim( saveobj.parents("tr").eq(0).find(".state").eq(0).val() );
    var type = "add";
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    saveobj.parents("tr").find("input").not(".note").each(function(index, element) {
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
            "tb_name":tb_name,
            "tools":tools,
            "reader":reader,
            "oldGPSId":oldGPSId,
            "GPSId":GPSId,
            "tool_type":tool_type,
            "house":house,
            "state":state,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
            console.log(msg);
              if(msg != "error")toastr.success("提交成功");
              if(type=="add"){
                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg); 
              }
        },
        error: function (msg) {
            console.log(msg);
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
