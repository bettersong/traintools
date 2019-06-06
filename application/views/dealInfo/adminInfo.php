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
    <link href="/public/css/toastr.min.css" rel="stylesheet">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
 <!-- BEGIN header-left -->
 <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>

 <!-- END header-left -->

 <!-- BEGIN CONTAINER -->
 <div id="main-content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">

                <h3 class="page-title" style="color:#000">
                    信息发布与管理<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span>

                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">主页</a>
                        <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">信息发布与管理</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active">
                        信息管理
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
                <div class="widget"  style="border:1px solid #ddd;">
                    <div class="widget-title"  style="background: #3776bb">
                        <h4>信息管理</h4>
                    </div>
                    <div class="cmxform form-horizontal" id="thisform">
                      <div class="control-group" style="margin-top: 20px;margin-left: 10px;">
                        <label class="control-label">发布类型</label>
                        <div class="controls">
                            <select class="selectType" data-placeholder="Choose a Category" tabindex="1">
                                <option value="info">消息/通知</option>
                                <option value="aqjs">安全揭示</option>
                            </select>
                        </div>
                     </div>

                <div class="tab-content" id="myTabContent">
                  <div id="home" class="tab-pane fade in active">
                    <div class="widget-body">
                      <div>
                        <div class="space15"></div>
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                          <thead>
                            <tr>
                              <th>序号</th>
                              <th>标题</th>
                              <th>编辑</th>
                              <th>删除</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i=1;foreach($InfoArr as $index => $value){?>
                            <tr class="">
                              <?php
                                if (!$_GET['type'] || $_GET['type']=='info') {
                              ?>
                                <td class="ids" value="<?=$value['informId']?>"><?=$i?></td>
                                <td pushTime="<?=$value['informPublishTime']?>" videoSrc="<?=$value['videoSrc']?>" thumbnail="<?=$value['thumbnail']?>"><?=$value['informTitle']?></td>
                              <td>
                                <a href="/dealInfo/pushInfo&act=update&type=<?=$value['informType']?>&editid=<?=$value['informId']?>">编辑</a>
                              </td>
                              <td>
                                <a class="delete" href="javascript:;">删除</a>
                              </td>

                              <?php
                                }else if ($_GET['type']=='aqjs') {
                              ?>
                                <td class="ids" value="<?=$value['safetyId']?>"><?=$i?></td>
                                <td pushTime="<?=$value['safetyPublishTime']?>" videoSrc="<?=$value['videoSrc']?>" thumbnail="<?=$value['thumbnail']?>"><?=$value['safetyTitle']?></td>
                                <td>
                                  <a href="/dealInfo/pushInfo&act=update&type=<?=$value['safetyType']?>&editid=<?=$value['safetyId']?>">编辑</a>
                                </td>
                                <td>
                                  <a class="delete" href="javascript:;">删除</a>
                                </td>

                              <?php
                                }
                              ?>
                          </tr>
                          <?php $i++;}?> 
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      <div id="profile" class="tab-pane fade"> </div>
  </div>

</div>
<!-- END INLINE TABS PORTLET-->
</div>
</div>
<!-- END PAGE -->
</div>
<!--表单及分页所需js-->
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/editable-table.js?v=<?=rand(1,99999)?>"></script>
<script>
jQuery(document).ready(function() {
    EditableTable.init();
});
</script>
<!--END 表单及分页所需js-->
<script>

// <!--高亮当前选择框-->
$(".selectType option").each(function(index, element) {
  if($(this).attr("value")=="<?=$_GET['type']?>"){
    $(this).attr("selected","selected");
    return false;
  }
});

$(".selectType").change(function(e) {
  var type = $(".selectType option:selected").attr("value");//获取select选中的值
  window.location.href="adminInfo&type="+type; 
});

//删除功能
$('#editable-sample a.delete').live('click', function (e) {
    var delobj = $(this).parents("tr").eq(0);
    var id =delobj.find(".ids").eq(0).attr("value");
    var type = $(".selectType option:selected").attr("value");//获取select选中的值

    $.ajax({
        type: "post",
        data: {
            "id":id,
            "type":type
        },
        dataType: 'json',
        url: "/application/views/dealInfo/dealInfo_action.php?act=delete",
        success: function (msg) {
            // delobj.remove();
            alert("删除成功！");
            setTimeout(function(){ window.location.reload(); }, 200);
        },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });

    //alert("Deleted! Do not forget to do some ajax to sync with backend :)");
});
 


</script> 
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
