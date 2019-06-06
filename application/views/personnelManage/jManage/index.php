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
    <link href="/public/css/style.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <link href="/public/css/style-default.css?<?=rand(1,99999)?>" rel="stylesheet" id="style_color" />
    <link rel="stylesheet" href="/public/css/uniform.default.css" />
    <link href="/public/css/toastr.min.css" rel="stylesheet"> 

 	
    <style>
	#treeDiv{
		position: relative;
        font-size:1.2em;
		border: 1px solid #ddd;

		width: 600px;
        min-height:200px;
		padding:10px 0 20px 5px;
        
		margin: 2px 0 50px;
	}
	#treeDiv ul,#treeDiv li,#treeDiv ul li{
		clear:both;
		margin-bottom: 5px;
		color:#333;
	}
	#treeDiv ul{
		margin: 0 0 10px 43px;
		padding: 5px 0 0;
	}
	#treeDiv ul#ul-bumen-1{
		margin: 0 0 10px 1px;
		padding: 5px 0 0;
	}
	#ul-bumen0{margin-left:20px !important;}
	#ul-bumen2{
		font-weight:600;
	}
	.font_bumen,.font_zhiwei{
		cursor: pointer;
		
		padding: 0 0 0 20px;
	 }
	 .font_bumen{
		 background: url(/public/images/icon-png/bumen.png) 3px 3px no-repeat;
		 background-size: 13px;
	 }
	 .font_zhiwei{
		 background: url(/public/images/icon-png/zhiwei.png) 5px 3px no-repeat;
		 background-size: 13px;
	 }
	 #ul-bumen2 li{margin-top:5px;}
	#ul-bumen2 li ul li{
		font-weight:500;
	}
	
	.addchild,.editItem ,.saveItem, .deleteItem {
		display: inline-block;
		color: #fff;
		font-size: 0.8em;
		cursor: pointer;
		width: 18px;
		height: 18px;
		line-height: 18px;
		margin: 0 0 0 5px;
		text-align: center;
		 
		position: absolute;
		left: 380px;
	}
	.addBtn{color:#4a8bc2;font-weight:600;}
	.addchild{
		background-color: #5599FF;
	}
	.editItem,.saveItem{
		background-color: #7700BB;
		left: 410px;
	}
	.deleteItem{
		background-color: #f30;
		left: 440px;
	}
	.addInput{
		font-size:0.8em;
		margin: 2px 2px 5px 0;
		padding-left:2px;
		width: 120px;
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
	li label{
		 
		display: inline-block;
 	}
	li label input{
		
		margin: 0 2px 0 2px !important;
 
	}
	.addBtn{
		margin: 0 0 0 5px !important;
	}
	.setAdminBumen, .cancelAdminBumen{
		font-size: 12px;
    color: #5599FF;
    line-height: 14px;
    padding: 1px 2px;
    margin: -2px 0 0 5px;
	}
	.isAdministration{
		display: inline-block;
    font-size: 12px;
    background: #094;
    color: #fff;
    width: 18px;
    line-height: 18px;
    margin-left: 2px;
    text-align: center;
    border-radius: 2px !important;
	}
	.setRolesBox{
		float: right;
		position: relative;
     
	}
	.setRoles{
		 
		font-weight: 400;
		font-size: 14px;
		margin: 0 10px 0 0;
		color: #fff;
		padding: 3px 5px 3px 5px;
		cursor: pointer;
		border-radius: 3px !important;
		background-color: #007aff;
	}
	.roleList{
		position: absolute;
    left: 80px;
	top:0;
    z-index: 999999;
	min-width: 300px;
    background: #fff;
    border: 1px solid #ddd;
	border-radius: 3px !important;
    padding: 0 20px 20px;
	}
	.rlTitle{
		text-align: center;
    padding: 5px 0;
    margin: 0px 0 6px;
    border-bottom: 1px solid #ddd;
	}
	.selectpicker{
		display:block;
		float:right;
		font-weight:400;

	}
	.selectpicker_close{height: 26px  !important;}
 	.selectpicker option{display:none;}
	.selectpicker option:nth-child(1){display:block  !important;}
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
                        部门信息管理<span class="adminBumenName"></span>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">人员管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            部门信息管理
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
                    <div class="widget red">
                        <div class="widget-title">
                            <h4>我管理的部门信息</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                               <div>
                               	  <img style="width:13px;" src="/public/images/icon-png/bumen.png">表示部门(可添加子部门) &nbsp;
                                </div>
 
                                <div id="treeDiv">
                                
                                
                                </div>
                                
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
//多选 formSelects-v4
 var formSelects = layui.formSelects;
 var roleInfoJson = <?=$roleInfoJson?>;
$(function () {
    
	var Bmanage = <?=json_encode($Bmanage)?>;
	
 	 //alert(myAdminBumenId);
	
    GetData(-1, Bmanage);
   
	$("#treeDiv").append(menus);
    
	
	
	//点击角色分配按钮
	$(".setRoles").click(function(e) {
		var bumenName = $(this).parents("li").find(".font_bumen").eq(0).html();
		var bumenId = $(this).parents("li").attr("bumenid");
		var roleids = $(this).parents("li").attr("roleIds");
		roleids = ","+roleids+",";
		//alert(roleids);
 		var rolelistTxt = '<div class="roleList" bumenid="'+bumenId+'"><div class="rlTitle">给部门<span style="color:#f30">“'+bumenName+'”</span>分配角色</div>';
		$.each(roleInfoJson,function(index,row){
			  var checked="";
			  var roleid = ","+row['roleId']+",";
			  if (roleids.indexOf(roleid) >= 0) checked="checked";
			  rolelistTxt += '<dl><dt><input type="checkbox" id="role'+row['roleId']+'"  name="role" value="'+row['roleId']+'" '+checked+' />&nbsp;<label for="role'+row['roleId']+'">'+row['roleName']+'</label></dt></dl>';
        });
		//rolelistTxt += '<dl><dt><input type="checkbox" id="role1" name="role" value="1" />&nbsp;<label for="role1">aaa</label></dt></dl>';
		rolelistTxt += '<div style="text-align:right;border-top:1px solid #ddd;padding-top:5px;"><button id="roleList_cancel" class="layui-btn layui-btn-primary">取消</button><button style="margin-left:20px;"  id="roleList_submit" class="layui-btn layui-btn-normal">确定</button></div>';
		rolelistTxt += '</div>';
		$(".roleList").remove();
		$(this).parent(".setRolesBox").append(rolelistTxt);
	});
	
	//点击确定角色分配
	$("#roleList_submit").live('click',function(e) {
		var bumenId = $(this).parents(".roleList").attr("bumenid");//部门ID
        var roleIds = "";
 		$('input[name="role"]:checked').each(function(){ 
		   roleIds+=$(this).val()+','; 
		   
		}); 
	    if(bumenId=="" || roleIds==""){
			layer.alert("抱歉，角色信息不能为空！", {icon:0,title: '【提示】'});
			return false;
		}
		else{
			
			$.ajax({
			  async:false,
			  type: "post",
			  data: {
				  "bumenId":bumenId,
				  "roleIds":roleIds
			  },
			  dataType: 'json',
			  url: "<?=CURRENT_DIR?>/index_add.php?",
			  success: function (msg) {
				  console.log(msg);
					if(msg != "error"){
						layer.alert("分配成功！", {icon:1,title: '【提示】'});
						$(".roleList").remove();
					}
					
					 
			  },
			  error: function (msg) {
				  toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
			  }
		  });
			
			
			
		}
	 });
	  
    //点击取消角色分配
	$("#roleList_cancel").live('click',function(e) {
		 
        $(".roleList").remove();
    });
	/*$(".selectpicker11").click(function(e) {
		$(".selectpicker").addClass("selectpicker_close"); 
		$(this).removeClass("selectpicker_close");
        $(this).children("option").css("display","block");
		return false;
    });
	$(document).click(function(e) {
        //$(".selectpicker").addClass("selectpicker_close");
    });*/
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
	//初始化添加展开与收缩的图标
	$("#ul-bumen0 li").each(function(index, element) {
        if( $(this).children("ul").length > 0 ){
			$(this).children(".tagicon").html("-");
			$(this).children(".tagicon").addClass("hasChild");
			
		} 
    });
});


//初始化部门信息
var menus = '';

//根据菜单主键id生成菜单列表html
//id：菜单主键id
//arry：菜单数组信息
var myAdministration = false;
var myTopBumenArr = new Array(10);
var k = 0;
var menus = '<ul id="ul-bumen0">';
//if(isSuperAdmin)alert("fff");
 //alert(menus);
 
function GetData(id, arry) {
	 //alert(menus);
	  
	 
	var childArry = GetParentArry(id, arry);
	if (childArry.length > 0) {
		
		if(isSuperAdmin || myAdministration)menus += '<ul id="ul-bumen'+id+'">';
		for (var i in childArry) {
			
			//alert(childArry[i].id+' myAdminBumenId:'+myAdminBumenId);
			//alert("11");
			if(childArry[i].id==myAdminBumenId)myAdministration = true;
			if(isSuperAdmin || myAdministration){
				//alert("222");
				if(childArry[i].isSuperAdmin == 1)continue;//不显示系统管理员
				myTopBumenArr[k] = childArry[i].id;
				//alert(myTopBumenArr[k]+"  "+childArry[i].pid);
				
				if(isSuperAdmin || k==0 || (k>0 && isInArray(myTopBumenArr,childArry[i].pid)) ){
					
					//if(!myAdministration) continue;
					var font_class = "font_bumen";
					if(childArry[i].bumenOrZhiwei==0)font_class = "font_zhiwei";
					menus += '<li bumenId="'+childArry[i].id+'" roleIds="'+childArry[i].bManageRoleIds+'"  level="'+childArry[i].level+'" pid="'+childArry[i].pid+'" bumenOrZhiwei="'+childArry[i].bumenOrZhiwei+'"><span class="tagicon"></span><font class="'+font_class+'" bumenOrZhiwei="'+childArry[i].bumenOrZhiwei+'" isAdministration="'+childArry[i].isAdministration+'">' + childArry[i].name+'</font>';
					if(childArry[i].isAdministration==1){
						menus += '<span " class="isAdministration">主</span>';//显示是主管部门
					}
					//menus += '<select multiple class="form-control selectpicker selectpicker_close"><option value="0">配置角色</option><option value="1">广东省</option><option value="2">广西省</option><option value="3">山东省</option>    </select>';
 //menus += '<select class=" " name="city" xm-select="select1">    <option value="1" disabled="disabled">北京</option>    <option value="2" selected="selected">上海</option>    <option value="3">广州</option>    <option value="4" selected="selected">深圳</option>    <option value="5">天津</option></select>';
					
					 menus += '<div class="setRolesBox"><span class="setRoles">分配角色</span></div>';
   					k++;
				}
			}
			
			GetData(childArry[i].id, arry);
			menus += '</li>';
		}
		menus += '</ul>';
	}
}



function isInArray(arr,value){
    for(var i = 0; i < arr.length; i++){
        if(value === arr[i]){
            return true;
        }
    }
    return false;
}
//根据菜单主键id获取下级菜单
//id：菜单主键id
//arry：菜单数组信息
function GetParentArry(id, dataArr) {
	var newArry = new Array();
	for (var i in dataArr) {
		 
		if (dataArr[i].pid == id){
			//alert("dataArr-i-pid="+id);
			newArry.push(dataArr[i]);
		}
	}
	 
	return newArry;
}
     

</script>
<script>
    var CURRENT_DIR = "/application/views/personnelManage/bManage";//获取js格式的当前路径
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-bManage.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/toastr.min.js"></script>
<script>
toastr.options.positionClass = 'toast-top-center';
function editable_save(saveobj){
    //alert("ddd");
	return false;
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var name = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
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
        },
        dataType: 'json',
        url: "/application/views/personnelManage/bManage/index_add.php?",
        success: function (msg) {

              if(msg != "error")toastr.success("提交成功！");
              if(type=="add"){
                //alert("11")
                 saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
                 //alert(msg);
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
<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
<!-- BEGIN FOOTER -->

<!-- END FOOTER -->
</body></html>