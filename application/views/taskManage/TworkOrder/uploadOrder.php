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
    <link href="/public/css/bootstrap.min<?=$_m?>.css?v=0.101" rel="stylesheet" />
    <link href="/public/css/toastr.min.css" rel="stylesheet">
    <link href="/public/css/bootstrap-responsive.min<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/bootstrap-fileupload<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/style<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-responsive<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default<?=$_m?>.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color" />
    <link href="/public/css/bootstrap-fullcalendar<?=$_m?>.css" rel="stylesheet" />
    <link href="/public/css/jquery.fancybox<?=$_m?>.css" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/uniform.default<?=$_m?>.css" />
    <link rel="stylesheet" href="/public/css/bootstrap-multiselect<?=$_m?>.css?<?=rand(1,99999)?>" type="text/css"/>
    <style>
	.bold{font-weight:600;}
	.noname{color:#4a8bc2;}
    <?php if($_GET['pManage']==1){//施工上线人员管理=工单中隐藏与人员管理无关的内容?>
      .notPmanage{display: none;}
    <?php }?>
	</style>
</head>
<body class="fixed-top">
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
  <div id="main-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <h3 class="page-title" style="color:#000">
                       导入天窗作业计划
                            <span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span>
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
                            导入天窗作业计划
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
            <div class="row-fluid notPmanage" id="onload">
                <div class="span5">
                    <div class="widget blue">
                        <div class="widget-title">
                            <h4>导入天窗作业计划</h4>
                        </div>
                        <div class="widget-body">
            <form enctype="multipart/form-data" method="post" id='addForm'>
            <span id="fileNameOrFileFormat" style="color:red">支持文件格式：xls，xlsx</span>
            <div id="filePanel">
                <span class="selectFileDiv" href="javascript:;" style="width:320px">
                     选择文件
                    <input type="file" name="file" id="selectFile">
                </span>
                <input type='button' id="upLoad" class="btn customButton btn-primary auth_add" value='确认上传' name="上传" style="float:right" />
            </div>
            
        </form>
          </div>
      </div>
  </div>
</div>      
<style type="text/css">
a.ordernum{color:#999 !important;}

a.currenOrdernum,a.ordernum:hover{color:#4A8BC2 !important;}
#addForm{margin-bottom: 0 !important;}
</style>
 
 
</div>
</div>
<script>
   
</script>
<script src="/public/js/jquery.form.js"></script>
 <script src="/public/js/toastr.min.js"></script>
<script type="text/javascript">
 toastr.options.positionClass = 'toast-top-center';
$(function(){
    var activity_id = sessionStorage.getItem('activity_id');
    // 点击上传按钮
    var startUpload =false;
    $('#upLoad').click(function(){
        if($("#selectFile").val()==""){
            return false;
        }
        if(startUpload) return false;
        toastr.success('上传中... ');//<img src="/public/images/loading.gif" />
        startUpload = true;
        $('#addForm').ajaxSubmit({
            forceSync: false,  
            url:  "<?=CURRENT_DIR?>/index_upload.php",
            type: 'post',
            dataType: 'text',
            success: function(response){
                if( response.indexOf("noCharge") != -1 ){//有工单负责人不存在的情况
                  toastr.clear();
                  var msg = response.replace('noCharge','');
                  layer.alert(msg, {icon:2,title: '【提示】'});
                  startUpload = false;
                  return false;
                }
                else if( response.indexOf("orderExist") != -1 ){//有工单负责人不存在的情况
                  toastr.clear();
                  var msg = response.replace('orderExist','');
                  layer.alert(msg, {icon:2,title: '【提示】'});
                  startUpload = false;
                  return false;
                }
                else{
                    toastr.success('上传成功！');
                    startUpload = false;
                    location.reload();
                }
               
            },
            error: function(response){
                toastr.error('上传失败！');
                startUpload = false;
            }
        });
    });
    $("#selectFile").on("change",function(){
        var file = document.getElementById('selectFile').files;    //获取上传的文件
        var fileName = file[0].name;
        // 获取文件的格式为.xsl、.xslx
        var fileFormat = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
        if( checkFileFormat(fileFormat) == false){
            toastr.warning("上传的文件类型有误！");
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
 
<script>
   
 

 
 
//工具清单分页

</script>


</body>
<!-- END BODY -->
</html>
