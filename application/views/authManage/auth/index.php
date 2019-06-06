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
	<link href="/public/css/style.css?95608" rel="stylesheet" />
	<link href="/public/css/style-responsive.css?69940" rel="stylesheet" />
	<link href="/public/css/style-default.css?26779" rel="stylesheet" id="style_color" />
	<link href="/public/css/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="/public/css/jquery.fancybox.css" rel="stylesheet" />
	<link rel="stylesheet" href="/public/css/uniform.default.css" />
	<link href="/public/css/toastr.min.css" rel="stylesheet">
	<style>
tr th {
	letter-spacing: 1px;
}
ul.actionUL {
}
ul.actionUL li {
 float:;
}
ul.actionUL li label {
	margin: 0 5px 0 0;
}
ul.actionUL li input {
	vertical-align: baseline;
}
td.action {
}
td.no {
	color: #999;
}
font.actTxt {
	border: 1px solid #ddd;
	padding: 2px 5px;
	margin: 0 2px 0 1px;
}
.actTxtHidden {
	color: #fff !important;
	border: 0 !important;
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
        <h3 class="page-title" style="color:#000"> 权限分配列表：<span style="color:#000">
          <?=$Zmanage['bManageBranch']?>
          >>
          <?=$Zmanage['zManagePosition']?>
          </span> </h3>
        <ul class="breadcrumb">
              <li> <a href="#">主页</a> <span class="divider">/</span> </li>
              <li> <a href="#">权限管理</a> <span class="divider">/</span> </li>
              <li class="active"> 权限分配列表 </li>
            </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
        </div>
    <div class="row-fluid">
          <div class="span12"> 
        <!-- BEGIN EXAMPLE TABLE widget-->
        <div class="widget red">
              <div class="widget-title">
            <h4 style="color:#CCFF00;font-size:16px;">您正在给角色【<?=$Zmanage['bManageBranch']?> >> <?=$Zmanage['zManagePosition']?>】分配权限</h4>
          </div>
              <div class="widget-body" style="width: ;">
            <div> 
                  <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                      <tr>
                    <th>权限编号</th>
                    <th>权限名称</th>
                    <!--<th>父ID</th>--> 
                    <!--<th>控制器</th>-->
                    <th>已授权的权限</th>
                    <th>操作</th>
                    <!--<th>删除</th>--> 
                  </tr>
                    </thead>
                <tbody>
                <?php  
				    $i=1; 
					$pid = 1;
					/*$authTxt = "";
					$authTVal = "";
					//显示权限集合
					  if( $auths_cat1 !=""){
						  $authTxt = '<img class="forbidenImg" src="/public/images/forbid1.png" style="width:22px;" />';//--无--
					  }
					  else{
						  foreach($actionArrTemp as $key_auths=>$value_auths){
							  
							   echo $value_auths.' ';
						  }
					 }*/
					foreach ($catlogArrForAuth as $key => $value) { //遍历输出左侧导航
					 $authArr_cat1 = $authArr[$key][$key."--"];
					 $auths_cat1 =  $authArr_cat1['roleAuth_forbid'];////explode(",", $auths);
					 $actionArrTemp=$actionArr_cat1;
					 //$forbid = $auths_cat1 == "" ? "show": "";
					 //显示权限集合
					 $authTxt = "";
					 $authTVal = "";
					 if( $auths_cat1 !=""){
						  $authTxt = '<img class="forbidenImg" src="/public/images/forbid1.png" style="width:22px;" />';//--无--
					  }
					  else{
						  foreach($actionArrTemp as $key_auths=>$value_auths){
							  
							   $authTxt .= $value_auths.' ';
							   $authTVal .= $key_auths.',';
						  }
					 }
					 
					?>
                   <tr class="">
                      <!--<td class="id  sorting_1" idval="222" level="0" ascatalog="dealInfo" controller="" action=""><?=$i?></td>-->
                      <td class="id" idval="<?=$i?>" pid="0" level="1" asCatalog="<?=$key?>" controller=""  action="" ><?=$i?></td>
                      <td style="color:#4a8bc2;font-weight:600;" class=" "><?=$value['name']?></td>
                      <td style="color:#999;" title="角色拥有的权限" class="action  " value="<?=$authTVal?>">
                      <?=$authTxt?>
                     </td>
                      <td class=" "><a class="edit" href="javascript:;">设置权限</a></td>
                     <!-- <td><a class="delete" href="javascript:;">删除</a></td>-->
                  </tr>
                      
				<?php //遍历输出二级导航
			   if($value['subnav'] != ""){
				   foreach ($value['subnav'] as $keySub => $valueSub) { $i++;
				     $authArr_cat2 = $authArr[$key][$key."-".$keySub."-".$valueSub['action']];
					 $auths =  $authArr_cat2['roleAuth_forbid'];////explode(",", $auths);
					 $actionArrTemp=$actionArr;
					 $authTxt = "";
					 $authTVal = "";
					 foreach($actionArrTemp as $key_auths=>$value_auths){
							  //echo '  11auths:'.$auths.'  key_auths:'.$key_auths;
							 if(strpos($auths,$key_auths)===false){
								 $authTxt .= $value_auths.' ';
								 $authTVal .= $key_auths.',';
							 }
					  }
					 if($authTxt=="") $authTxt="--无--";
				   ?>
                   <tr class="">
                        <td class="id" idval="<?=$i?>" pid="<?=$pid?>" level="2" asCatalog="<?=$key?>" controller="<?=$keySub?>"  action="<?=$valueSub['action']?>" ><?=$i?></td>
                        <td style="padding-left:2em;" class=" ">➢&nbsp;<?=$valueSub['name']?></td>
                        <td style="color:#999;" title="角色拥有的权限" class="action" value="<?=$authTVal?>"> 
							 
							<div class="actTxt" style='<?php if($auths_cat1 != "")echo "display:none";?>'><?=$authTxt?></div>
                        </td>
                        <td class=" "><a style='<?php if($auths_cat1 != "")echo "display:none";?>' class="edit" href="javascript:;">设置权限</a></td>
                        <!-- <td><a class="delete" href="javascript:;">删除</a></td>--> 
                  	</tr>
             <?php 
			 	 }//end for sub
			   }// end if
			   
				$i++;$pid++;}//end foreach catlogForLeft
			  ?>
              
              
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
    var actionArr_cat2 = <?=json_encode($actionArr)?>;
	var actionArr_cat1 = <?=json_encode($actionArr_cat1)?>;
 	 //alert(actionArr_cat1+"  "+actionArr_cat2);
	var roleId = <?=$_GET['roleId']?>;
</script> 
<script src="/public/js/jquery.uniform.min.js"></script> 
<script src="/public/js/jquery.dataTables_auth.js?<?=rand(1,99999)?>"></script> 
<script src="/public/js/DT_bootstrap.js?<?=rand(1,99999)?>"></script> 
<script src="/public/js/jquery.scrollTo.min.js"></script> 
<script src="/public/js/common-scripts.js?v=0.101"></script> 
<script src="/public/js/editable-autoList.js?<?=rand(1,99999)?>"></script> 
<script src="/public/js/toastr.min.js"></script> 
<script>
toastr.options.positionClass = 'toast-top-center';



function editable_save(saveobj,actionNoCheckedVal){
	//alert(actionCheckedVal);
    //alert("开始保存");
	
	
    //var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("idval") );
	var level = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("level") );
	var asCatalog=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("asCatalog") );
	var controller=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("controller") );
	var action=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("action") );
	
    var auths = actionNoCheckedVal;//$.trim( saveobj.parents("tr").eq(0).find(".action").eq(0).val() );
    var type = "add";
	
	
	
	 var dataIsNull = true;
	 if( saveobj.hasClass('update') )type = "update";
    /*if( saveobj.hasClass('update') )type = "update";
    //判断数据是否有空
    var dataIsNull = false;
    saveobj.parents("tr").find("input").each(function(index, element) {
        if($(this).val()==""){
            toastr.warning("数据全部不能为空，请填写！");
            dataIsNull = true;
            return false;
        }
    });*/
	if(confirm("确定要分配确实吗？"))
	 {
	 
	 }
	 else return false;
	  
	 
    dataIsNull = false;
    if(dataIsNull) return "null"; //editable-table.js用到
	
	//alert(" level="+level+" asCatalog="+asCatalog+" controller="+controller+" action="+action+ " auths="+auths);//+" id="+id+" id="+id
	//return false;
	
    $.ajax({
        async:false,
        type: "post",
        data: {
            "level":level,
            //"id":id,
			//"pid":pid,
			"asCatalog":asCatalog,
			"controller":controller,
			"action":action,
            "auths":auths,
			"roleId":roleId
        },
        dataType: 'json',
        url: "/application/views/authManage/auth/index_add.php?",
        success: function (msg) {
             //layer.alert(msg, {icon:1,title: '【提示】'});
              if(msg != "error")layer.alert("分配权限成功！", {icon:1,title: '【提示】'});//toastr.success("分配权限成功！");
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

    //return false;
};


function roleAuth_init(id,pid,asCatalog,controller,action,auths){
	//alert(actionCheckedVal);
    //alert("开始保存");
	
	
    /*var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("idval") );
	var pid = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("pid") );
	var asCatalog=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("asCatalog") );
	var controller=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("controller") );
	var action=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("action") );
	
    var auths = $.trim( saveobj.parents("tr").eq(0).find(".action").eq(0).attr("value") );*/
    var type = "add";
	
	//alert(" type="+type+" asCatalog="+asCatalog+" controller="+controller+" action="+action+" id="+id+" + pid="+pid+" auths="+auths);//+" id="+id+" id="+id
	 //return false;
	
    $.ajax({
        async:false,
        type: "post",
        data: {
            "type":type,
            "id":id,
			"pid":pid,
			"asCatalog":asCatalog,
			"controller":controller,
			"action":action,
            "auths":auths,
			"roleId":roleId
        },
        dataType: 'json',
        url: "/application/views/authManage/auth/index_add.php?",
        success: function (msg) {

             // alert(msg);
        },
        error: function (msg) {
            toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");

        }
    });

    //return false;
};

//设置权限关联：如果取消了查看权限，则其他权限也须取消，如果选中了其他权限则必须同时自动选中查看权限
function checkboxOnclick(checkbox){
    //如果取消了查看权限，则其他权限也须取消
	if(checkbox.attr("value")=="show"){
		
		var pid = checkbox.parents("tr").eq(0).find(".id").eq(0).attr("pid");
		var idval = checkbox.parents("tr").eq(0).find(".id").eq(0).attr("idval");
		//点击了一级分类的权限，设置对应二级分类的权限分配显示样式
        if(pid==0){
			if ( !checkbox.is(':checked')){
				$("#editable-sample").find("tr").each(function(index, element) {
					if($(this).find(".id").eq(0).attr("pid") == idval){
						
						$(this).find(".actTxt").fadeOut();//.addClass("actTxtHidden");
						
						$(this).find(".edit").fadeOut();
					}
				});
			}else{
				
				$("#editable-sample").find("tr").each(function(index, element) {
					if($(this).find(".id").eq(0).attr("pid") == idval){
						
						$(this).find(".actTxt").fadeIn();//.removeClass("actTxtHidden");
						$(this).find(".edit").fadeIn();
					}
				});
			}
		}
		else{
			if ( checkbox.is(':checked')){
			
	
		 
			}else{
			 
			  $("#multiSelect").find(".actionInput").removeAttr("checked");
			 
			}
		}
	}
	//如果选中了其他权限则必须同时自动选中查看权限
	else{

		if ( checkbox.is(':checked') ){

			$("#multiSelect").find("input.show").attr("checked","");
		}
		
	}
}
/*$("#multiSelect").find("label").on("click", function(){
    if($(this).is(":checked")){
         alert("11");//选中
    }else {
         alert("22");//取消选中
    }
});*/


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
</body>
</html>