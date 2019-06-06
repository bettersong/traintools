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
                            信息发布
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
                    <div class="widget" style="border:1px solid #ddd;">
                        <div class="widget-title" style="background: #3776bb">
                            <h4>信息发布</h4>
                        </div>
                        <div class="widget-body form"> 
        <!-- BEGIN FORM-->
                            <div class="cmxform form-horizontal" id="thisform">
                               <div class="control-group">
                                <label class="control-label">发布类型</label>
                                <div class="controls">
                                  <select class="selectType" data-placeholder="Choose a Category" tabindex="1">
                                    <option value="info">消息/通知</option>
                                    <option value="aqjs">安全揭示</option>
                                  </select>
                                </div>
                              </div>
                              <div class="control-group ">
                                <label for="title" class="control-label">标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题</label>
                                <div class="controls">
                                  <?php if (!$_GET['type'] || $_GET['type']=='info') { ?>
                                      <input id="title" name="title" required value="<?=$InfoArr[0]['informTitle']?>"/>
                                  <?php }else if ($_GET['type']=='aqjs') { ?>
                                      <input id="title" name="title" required value="<?=$InfoArr[0]['safetyTitle']?>"/>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="control-group ">
                                <label for="sourceFrom" class="control-label">信息来源</label>
                                <div class="controls">
                                    <?php if (!$_GET['type'] || $_GET['type']=='info') { ?>
                                      <input id="sourceFrom" name="sourceFrom" required value="<?=$InfoArr[0]['informSourceFrom']?>"/>
                                  <?php }else if ($_GET['type']=='aqjs') { ?>
                                      <input id="sourceFrom" name="sourceFrom" required value="<?=$InfoArr[0]['safetySourceFrom']?>"/>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="control-group ">
                                <label for="content" class="control-label">发布内容
                                  <div class="pushVideoNotice" style="font-size:12px;margin-top:5px;padding:3px 1px 3px 3px;border:1px dashed #ddd;">
                                    <div style="color:#f30">发布说明：</div>
                                      <div>1.&nbsp;上传视频：请点击<img style="vertical-align: initial; margin:0 2px;" src="/public/images/videologo.png" /></div>
                                      <div>2.&nbsp;添加介绍：填在视频下方</div>
                                  </div>
                                </label>
                                <div class="controls" id="contentBox"> 
                                  <?php if (!$_GET['type'] || $_GET['type']=='info') { 
                                            $editor_init=$InfoArr[0]['informContent']; include($_SERVER['DOCUMENT_ROOT']."/public/plugins/editor.php");//$editor_init为编辑框的初始化内容。
                                        }else if ($_GET['type']=='aqjs') { 
                                            $editor_init=$InfoArr[0]['safetyContent']; include($_SERVER['DOCUMENT_ROOT']."/public/plugins/editor.php");//$editor_init为编辑框的初始化内容。
                                        }
                                  ?>
                                </div>
                              </div>
                              <div class="form-actions">
                                <button class="btn btn-success" type="submit" id="submit">确认提交</button>
                              </div>
                            </div>
                          </div>
                        <!-- END INLINE TABS PORTLET-->
                    </div>
                </div>
                <!-- END PAGE -->
            </div>

<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-reportForms.js?v=0.101"></script>
<script src="/public/js/toastr.min.js"></script>
<script>

$(function () {
  // 高亮当前选择框
  $(".selectType option").each(function(index, element) {
    if($(this).attr("value")=="<?=$_GET['type']?>"){
      $(this).attr("selected","selected");
      return false;
    }
  });
})
//判断是添加还是更新
var act = "<?=$_GET['act']?>";
if (!act) { 
  act ="add";
}
var url = "/application/views/dealInfo/dealInfo_action.php?act="+act;
// alert(url);
var editid="<?=$_GET['editid']?>";
$("#submit").click(function(e) {

  var type = $(".selectType option:selected").attr("value");//获取select选中的值
  var title = $.trim($("#title").val());
  var sourceFrom = $.trim($("#sourceFrom").val());//lzInfoSourceFrom
  var content = $(window.frames['editbox'].document).find("body").html();//
  // alert("type:"+type+"   title:"+title+"   sourceFrom:"+sourceFrom+"   content:"+content+"   act:"+act);
  //判断数据是否有空
  var dataIsNull = false;
  $("#thisform").find("input").each(function(index, element) {
    if($(this).attr("name")!=="sourceFrom" && $(this).val()==""){
      dataIsNull = true;
    }
  });
  if(type==0 || content==""  )dataIsNull = true;
  if(dataIsNull){
    //Alert({title: '错误提示',msg: '数据全部不能为空，请填写！'});
     alert("数据全部不能为空，请填写！");
    return false;
  }
  $.ajax({
    async:false,
    type: "post",
    data: {
      "act":act,
      "id":editid,
      "type":type,
      "title":title,
      "sourceFrom":sourceFrom,
      "content":content
    },
    dataType: 'json',
    url: url,
    success: function (msg) {
      if(msg != "error")
      {
        var alertMsg="发布成功！";
        if(act=="update")alertMsg="更新成功！";
        alert(alertMsg);
        setTimeout(function(){ window.location.reload(); }, 200);
      }    
    },
    error: function (msg) {
      alert(msg.status + "服务繁忙，请刷新或稍后再试。");
    }
  });
});



</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
