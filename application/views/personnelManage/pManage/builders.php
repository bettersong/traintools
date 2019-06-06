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
    <style>
	#treeDiv ul,#treeDiv ul li{
		margin-bottom: 5px;
		color:#333;
	}
	#treeDiv #ul-bumen0{
		margin-left:0;
	 }
	#treeDiv ul{
		margin-left: 0;
    	padding-left: 20px;
	 }
	#treeDiv ul#ul-bumen-1{padding-left:0};
	#ul-bumen2{
		font-weight:600;
	}
	#treeDiv ul li font{
		cursor:pointer;
	 }
	 #ul-bumen2 li{margin-top:5px;}
	#ul-bumen2 li ul li{
		font-weight:500;
	}
	
	.addchild, .deleteItem {
		display: inline-block;
		color: #fff;
		font-size: 0.8em;
		cursor: pointer;
		width: 19px;
		height: 19px;
		line-height: 19px;
		margin: 0 0 0 5px;
		text-align: center;
		border: 1px solid #fff;
		border-radius: 19px !important;
		background-color: #4a8bc2;
	}
	.addBtn{color:#4a8bc2;font-weight:600;}
	.deleteItem{
		background-color: #f30;
	}
	.addInput{
		font-size:0.8em;
		margin: 2px 2px 5px 0;
		padding-left:2px;
	}
	.hasChild{
		display: inline-block;
		color: #aaa;
		font-weight: 500;
		margin-right: 2px;
		width: 14px;
		height: 14px;
		line-height: 14px;
		text-align: center;
		border: 1px solid #ddd;
		cursor:pointer;
	}
	#treeDiv ul li .font_nohasChild:hover,#treeDiv ul li font.selected{
		color:#00F !important;
		border:1px dashed #00F;
		padding:2px 2px;
		margin-left:-3px;
	}
	</style>
	<style>
	#ul-bumen0{
		
	}
	#ul-bumen0  ul{
		display:none;
	}
	</style>
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
                        施工上线人员信息管理（添加/编辑/删除）<span class="adminBumenName">（<?=$_SESSION['userInfo']['adminBumenName']?>）</span>

                      </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">施工上线人员管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            施工上线人员信息管理
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
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>施工上线人员信息（<?=$_SESSION['userInfo']['adminBumenName']?>）</h4>

                        </div>
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
                                        <th>ID编号</th>
                                        <th>姓名</th>
                                        <th>性别</th>
                                        <!-- <th>所属职位</th>-->
                                        <th>职员编号</th>
                                        <th>联系方式</th>
                                        <th>绑定定位器</th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($personnerArr as $key => $value) {?>
                                    <tr class="">
                                        <td class="ids"><?=$value['pManageId']?></td>
                                        <td class="td_name"><?=$value['pManageName']?></td>
                                        <td class="td_sex"><?php if($value['pManageSex']==1)echo '男';else echo '女';?></td>
                                        <!--<td class="td_position" value="<，?=$value['zManageId']?>"><，?=$value['zManagePosition']?></td>-->
                                        <td><?=$value['pManageStaffId']?></td>
                                        <td><?=$value['pManageContact']?></td>
                                        <td class="td_GPSCode" value="<?=$value['GPSId']?>" ><?=$value['GPSCode']?></td>
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
	var personnerArray = <?=$bumenJson?>;
    var BumenArray = <?=$bumenJson?>;
	var Bmanage = <?=json_encode($Bmanage)?>;
    var ZhiweiArray = <?=$zhiweiJson?>;
    var gpslibs = <?=$gpslibsJson?>;
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-pManage_builders.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/toastr.min.js"></script>
<script>
//点击展开和收缩
$(".tagicon").live('click',function(e) {
	var node = $(this).nextAll("ul").eq(0);
	if( node.is(':hidden') ){//展开
		node.fadeIn();
		$(this).html("-");
	}
	else{//收缩
		node.fadeOut();
		$(this).html("+");
	}
});
//点击选择部门
$("#treeDiv li font").live('click',function(e) {
	if( $(this).parent("li").children("ul").length > 0 ){
		//layer.alert("请点击选中具体的子部门", {icon:1,title: '【提示】'});
		return false;
	}
	else{
		$("#treeDiv ul li font.selected").removeClass("selected");
		$(this).addClass("selected");
		 var selectid = $(this).parent("li").attr("bumenid");
		 $("#treeDiv").parent("td").attr("selectedid",selectid);
		 layer.alert("选择成功，可点击其他项/子项。", {icon:1,title: '【提示】'});
	}
});



toastr.options.positionClass = 'toast-top-center';
function editable_save(saveobj){
	
    //alert("ddd");
	
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var name = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
    var sex = $.trim( saveobj.parents("tr").eq(0).find(".sex option:selected").eq(0).attr("value") );
    var code = $.trim(saveobj.parents("tr").eq(0).find(".code").eq(0).val() );
    var contact = $.trim(saveobj.parents("tr").eq(0).find(".contact").eq(0).val() );
    var gps = $.trim( saveobj.parents("tr").eq(0).find(".gps option:selected").eq(0).attr("value") );
    var type = "add";
    if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    
    var dataIsNull = false;
    saveobj.parents("tr").find("input").each(function(index, element) {
        if($(this).val()==""){
            dataIsNull = true;
            return false;
        }
    });
    if(dataIsNull){
        layer.alert("数据全部不能为空，请填写！", {icon:0,title: '【提示】'});//alert("数据全部不能为空，请填写！");
		
	}
    if(dataIsNull) return "null"; //editable-table.js用到
    $.ajax({
        async:false,
        type: "post",
        data: {
            "type":type,
            "id":id,
            "name":name,
            "sex":sex,
            "code":code,
            "contact":contact,
            "gps":gps,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/builders_add.php?",
        success: function (msg) {
            console.log(msg);
              if(msg != "error")toastr.success("提交成功！");
              location.reload();
              if(type=="add"){
				 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
              }
        },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");

        }
    }); 

    //return false;
};
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>

<script>
//根据选择的部门，显示相应职位
$(".lines").live('change',function(e) {
	//当前被选中的部门
    var selectedBumenValue = $(this).children('option:selected').val();
	//根据选择的部门，显示相应职位：遍历职位数组，并判断职位中的部门ID是否等于部门数组的ID
	var allOption = '<option value="0">请选择职位</option>';
	$.each(ZhiweiArray,function(index,row){
		 if(selectedBumenValue==row['zManageBranch']){
			 allOption += '<option value="'+row['zManageId']+'">'+row['zManagePosition']+'</option>'; //构造option
			 
		 }
	});
	//alert(allOption);
	//if(allOption=="");
	//获取职位对象,并改变其option
	var zhiweiObj = $(this).parents("tr").eq(0).find(".position").eq(0);
	zhiweiObj.html(allOption);
	
	return false;
});
 
 
</script>
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
