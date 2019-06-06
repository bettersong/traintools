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
	#treeDiv{position:relative;font-size:1.2em;border:1px solid #ddd;width:550px;min-height:200px;padding:10px 0 20px 5px;margin:2px 0 50px}#treeDiv ul,#treeDiv li,#treeDiv ul li{margin-bottom:5px;color:#333}#treeDiv ul{margin:0 0 10px 43px;padding:5px 0 0}#treeDiv ul#ul-bumen-1{margin:0 0 10px 1px;padding:5px 0 0}#ul-bumen0{margin-left:20px!important}#ul-bumen2{font-weight:600}.font_bumen,.font_zhiwei{cursor:pointer;padding:0 0 0 20px}.font_bumen{background:url(/public/images/icon-png/bumen.png) 3px 3px no-repeat;background-size:13px}.font_zhiwei{background:url(/public/images/icon-png/zhiwei.png) 5px 3px no-repeat;background-size:13px}#ul-bumen2 li{margin-top:5px}#ul-bumen2 li ul li{font-weight:500}.addchild,.editItem,.saveItem,.deleteItem{display:inline-block;color:#fff;font-size:.8em;cursor:pointer;width:18px;height:18px;line-height:18px;margin:0 0 0 5px;text-align:center;position:absolute;left:430px}.addBtn{color:#4a8bc2;font-weight:600}.addchild{background-color:#59f}.editItem,.saveItem{background-color:#70b;left:460px}.deleteItem{background-color:#f30;left:490px}.addInput{font-size:.8em;margin:2px 2px 5px 0;padding-left:2px;width:120px}.hasChild{display:inline-block;color:#aaa;font-weight:500;margin-right:2px;width:14px;height:14px;line-height:14px;text-align:center;border:1px solid #ddd;cursor:pointer}li label{display:inline-block}li label input{margin:0 2px 0 2px!important}.addBtn{margin:0 0 0 5px!important}.setAdminBumen,.cancelAdminBumen{font-size:12px;color:#59f;line-height:14px;padding:1px 2px;margin:-2px 0 0 5px}.isAdministration{display:inline-block;font-size:12px;background:#094;color:#fff;width:18px;line-height:18px;margin-left:2px;text-align:center;border-radius:2px!important}
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


$(function () {
    
	var Bmanage = <?=json_encode($Bmanage)?>;
	
 	 //alert(myAdminBumenId);
	
    GetData(-1, Bmanage);
   
	$("#treeDiv").append(menus);
	
	
	$(".addchild").live('click',function(e) {
		var bumenId = $(this).attr("bumenId");
		var level = $(this).attr("level");
		var pid = $(this).attr("pid");
		$(".addchildBox").remove();//先删除之前的添加框
		//var addchild = '<span title="添加子菜单" class="addchild" bumenId=" "  pid="'+pid+'">+</span>';
		if( $(this).parent("li").eq(0).children("#ul-bumen"+bumenId).length>0 ){//子菜单添加
			var input = '<div class="addchildBox"><input class="addInput" placeholder="填写子菜单名称" pid='+bumenId+' level='+(parseInt(level)+1)+' />'+
			'<input class="addBtn" type="button" value="添加" /></div>';
			$("#ul-bumen"+bumenId).prepend(input);
		}else{
			var input = '<ul id="ul-bumen'+bumenId+'"><div class="addchildBox"><input class="addInput"  placeholder="填写子菜单名称" pid='+bumenId+' level='+(parseInt(level)+1)+' />'+
			'<input class="addBtn" type="button" value="添加" /></div>';
			$(this).parent("li").eq(0).append(input);
		}
		
	}); 
	//提交添加子分类
	$(".addBtn").live('click',function(e) {
		var name = $.trim( $(this).prevAll("input").val() );
		var pid = $(this).prevAll("input").attr("pid");
		var level = $(this).prevAll("input").attr("level");
 		var addtype = 1;//部门。$("input[name='addtype']:checked").val();
		
		
		if(name==""){
			layer.alert("抱歉，名称不能为空！", {icon:0,title: '【提示】'});
			return false;
		}
	 
		if(pid=="")return false;
		 
		//AJAX提交到后台
		$.ajax({
        async:false,
        type: "post",
        data: {
            "type":"add",
			"addtype":addtype,//添加的是部门还是职位
			"name":name,
            "pid":pid,
			"level":level
        },
        dataType: 'json',
        url: "/application/views/personnelManage/bManage/index_action.php?",
        success: function (msg) {
              //alert("msg:"+msg);
              if(msg == "error"){
				  layer.alert("添加失败，名称已存在或其他故障！", {icon:2,title: '【提示】'});
			  }
			  else{
				  toastr.success("提交成功！");
				  window.location.reload();
			  }
              if(type=="add"){
                //alert("11")
                 //saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
                 //alert(msg);
              }
			},
			error: function (msg) {
				toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
	
			}
		});
		
		
	});
	//判断删除的部门/职位下面是否有用户
	function isHasUsers(bumenid,bumenorzhiwei){
		var hasUsers = true;
		$.ajax({
			async:false,
			type: "post",
			data: {
				"bumenid":bumenid,
				"bumenorzhiwei":bumenorzhiwei
			},
			dataType: 'json',
			url: "/application/views/personnelManage/bManage/index_checkHasUsers.php?",
			success: function (msg) {
				 
				if(msg == "no"){
					hasUsers = false;
				}
				
				},
				error: function (msg) {
					toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
		
				}
		});

       if(hasUsers)return true;
	   else return false;
    
   }
	//删除分类
	$(".deleteItem").live('click',function(e) {
		var bumenorzhiwei = $(this).parents("li").eq(0).attr("bumenorzhiwei");
		//alert(bumenorzhiwei);
		var bumenid = $(this).attr("bumenid");
		//alert(bumenid);
		if(bumenid==""){
			return false; 
		}else{
            /*
			if(isHasUsers(bumenid,bumenorzhiwei)){
				//layer.msg('该条目下有用户，请先转移！');
				var tip = "该职位下有用户，请先转移！";
				if(bumenorzhiwei==1) tip = "请先删除该部门下的子条目！";
				//layer.tips(tip, $(this), { tips: [4, '#f30'], time: 3000 });
				layer.alert(tip, {icon:0,title: '【提示】'});
				return false; 
			}
			*/
			//else alert("可以删除");
		}
		//return false;
		//alert(name+" "+pid);
		
		if (confirm("谨慎操作，确定删除 ?") == false) {
			 return false;
		}
		//AJAX提交到后台
		$.ajax({
        async:false,
        type: "post",
        data: {
			"type":"del",
            "id":bumenid
        },
        dataType: 'json',
        url: "/application/views/personnelManage/bManage/index_action.php?",
        success: function (msg) {
              //alert("msg:"+msg);
              if(msg == "error"){
				  layer.alert("添加失败，名称已存在或其他故障！", {icon:2,title: '【提示】'});
			  }
			  else{
				  toastr.success("删除成功！");
				  window.location.reload();
			  }
              if(type=="add"){
                //alert("11")
                 //saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
                 //alert(msg);
              }
			},
			error: function (msg) {
				toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
	
			}
		});
		
		
	});
	//点击编辑
	$(".editItem").live('click',function(e) {
		var name = $(this).parent("li").children("font").html();
		var bumenOrZhiwei = $(this).attr("bumenOrZhiwei");
		//alert(bumenOrZhiwei);
		
		
		var inputhtml = '<input class="bumenname" style="width:80px;" value="'+name+'" />';
		
		 
		$(this).parent("li").children("font").html(inputhtml);
		$(this).html("保").removeClass("editItem").addClass("saveItem");
	});
	//点击保存编辑
	$(".saveItem").live('click',function(e) {
		var bumenid = $(this).attr("bumenid");
		var bumenname = $.trim( $(this).parent("li").find(".bumenname").eq(0).val() );
		if(bumenname==""){
			layer.alert("名称不能为空！", {icon:2,title: '【提示】'});
			return false;
		}
 	 
 		//AJAX提交到后台
		$.ajax({
        async:false,
        type: "post",
        data: {
			"type":"update",
            "bumenid":bumenid,
			"bumenname":bumenname
        },
        dataType: 'json',
        url: "/application/views/personnelManage/bManage/index_action.php?",
        success: function (msg) {
              //alert("msg:"+msg);
              if(msg == "error"){
				  layer.alert("添加失败，名称已存在或其他故障！", {icon:2,title: '【提示】'});
			  }
			  else{
				  toastr.success("更新成功！");
				  window.location.reload();
			  }
              if(type=="add"){
                //alert("11")
                 //saveobj.parents("tr").eq(0).find(".id").eq(0).val(msg);
                 //alert(msg);
              }
			},
			error: function (msg) {
				toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
	
			}
		});
		
		
	});
	//给部门设为”主管部门“
	$("#treeDiv font").hover(function(){ //.live('hover',function(e) {
		
		if(!isSuperAdmin)return false;//只有超级管理员可以设置该项
		
		clearTimeout(timeout_setadmin);
		
		
		var bumenorzhiwei = $(this).attr("bumenorzhiwei");
		if(bumenorzhiwei==1){
			
			$(".setAdminBumen").remove();
			
			if( $(this).attr("isAdministration")==1 ){//已经是主
				$(this).after('<input  class="setAdminBumen cancelAdminBumen"  type="button" value="取消主管单位" />');
		    }
			else{
				$(this).after('<input  class="setAdminBumen" style="z-index:99999"  type="button" value="设为主管单位" />');
			}
			
		}
		var timeout_setadmin=setTimeout('$(".setAdminBumen").remove()',50000);
		 
	},function(){
		//$(".setAdminBumen").remove();
	});
	//点击设为主管但
	$(".setAdminBumen").live('click',function(e) {
		var bumenid = $(this).parent("li").attr("bumenid");
		var setAdminBumenValue = 1;
		if( $(this).hasClass("cancelAdminBumen") )setAdminBumenValue = 0;
		//AJAX提交到后台
		$.ajax({
        async:false,
        type: "post",
        data: {
			"type":"setAdminBumen",
			"setAdminBumenValue":setAdminBumenValue,
            "bumenid":bumenid
        },
        dataType: 'json',
        url: "/application/views/personnelManage/bManage/index_action.php?",
        success: function (msg) {
              //alert("msg:"+msg);
              if(msg == "error"){
				  layer.alert("抱歉，设置失败！", {icon:2,title: '【提示】'});
			  }
			  else{
				  toastr.success("设置成功！");
				  window.location.reload();
			  }
               
			},
			error: function (msg) {
				toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
	
			}
		});
	});
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
					var bname = childArry[i].name;
					if(childArry[i].bumenOrZhiwei==0)font_class = "font_zhiwei";
					menus += '<li bumenId="'+childArry[i].id+'"  level="'+childArry[i].level+'" pid="'+childArry[i].pid+'" bumenOrZhiwei="'+childArry[i].bumenOrZhiwei+'"><span class="tagicon"></span><font class="'+font_class+'" bumenOrZhiwei="'+childArry[i].bumenOrZhiwei+'" isAdministration="'+childArry[i].isAdministration+'">' + childArry[i].name+'</font>';
					if(childArry[i].isAdministration==1){
						menus += '<span " class="isAdministration">主</span>';//显示是主管部门
					}
					if(childArry[i].bumenOrZhiwei==1 && bname.indexOf("工区")==-1)menus += '<span title="添加子菜单" class="addchild" bumenId="'+childArry[i].id+'"   level="'+childArry[i].level+'" pid="'+childArry[i].pid+'">添</span>';//只有部门下可以添加子项，职位为最低级
					menus += '<span title="编辑" class="editItem" bumenOrZhiwei="'+childArry[i].bumenOrZhiwei+'"  bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'"level="'+childArry[i].level+'">编</span>';
					menus += '<span title="删除" class="deleteItem" bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'">删</span>';
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