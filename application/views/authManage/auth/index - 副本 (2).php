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
	
	tr th{letter-spacing:1px;}
	ul.actionUL{
		
	}
	ul.actionUL li{
		float: ;
		
	}
	ul.actionUL li label{
		margin:0 5px 0 0;
	}
	ul.actionUL li input{
		vertical-align: baseline;
	}
	td.action{
		 
	}
 
	td.no{
		color:#999;
	}
	.actTxt{
		border: 1px solid #ddd;
		padding: 2px 5px;
		margin: 0 2px 0 1px;
	}
	.actTxtHidden{
		color:#fff !important;
		border:0 !important;
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
                        权限分配列表：<span style="color:#000"><?=$Zmanage['bManageBranch']?> >> <?=$Zmanage['zManagePosition']?></span>
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">权限管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            权限分配列表
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
                          <h4 style="color:#CCFF00;font-size:16px;">您正在给角色【<?=$Zmanage['bManageBranch']?> >> <?=$Zmanage['zManagePosition']?>】分配权限</h4>
                        </div>
                        <div class="widget-body" style="width: ;">
                            <div>
                               <!-- <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn green">
                                            添加<i class="icon-plus"></i>
                                        </button>
                                    </div>
                                </div>-->
                               <!-- <div class="space15"></div>-->
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
                                    //遍历一级目录
                                    $i=1; 
									$pid = 1;
									//遍历权限
									foreach ($authArr as $key => $value) { 
									
									 $authName = "";
									 $asCatalog = $value['roleAuth_asCatalog'];//以及目录
									 $controller = $value['roleAuth_c'];//框架的控制器名称
									 $authAction = $value['roleAuth_a'];//框架的动作名称
									 //权限集合
									 $auths = $value['roleAuth_auths'];
									 $authsArr = explode(",",$auths);
									 //print_r($authsArr);
									 
									 //获取权限名称
									 if($value['roleAuth_pid']==0){//一级目录获取权限名称
										 $authName = $catlogArrForAuth[$asCatalog]['name'];
									 }
									 else{//其他级别目录获取权限名称
										 $authName = $catlogArrForAuth[$asCatalog]['subnav'][$controller]['name'];
									 }
									?>
                                    <tr class="">
                                        <td class="id" idval="<?=$value['roleAuth_id']?>" pid="<?=$value['roleAuth_pid']?>" asCatalog="<?=$asCatalog?>" controller="<?=$controller?>"  action="<?=$authAction?>" ><?=$i?></td>
                                        
                                         <?php //权限名称
										 if($value['roleAuth_pid']==0){?>
                                        <td style="color:#4a8bc2;font-weight:600;"><?=$authName?></td>
                                       <?php } else{?>
                                        <td style="padding-left:2em;">➢&nbsp;<?=$authName?></td>
                                       <?php }?>
                                    
                                        <td style="color:#999;" title="角色拥有的权限" class="action <?php if($auths=="")echo ' no '?>" value="<?=$value['roleAuth_auths']?>"><?php 
										$k = 1; 
										
										//if($value['roleAuth_pid']==0)echo '';
										//else{
											 
											if($value['roleAuth_pid'] ==0 && $auths==""){
												echo '<img class="forbidenImg" src="/public/images/forbid1.png" style="width:22px;" />';//--无--
												
											}
											//如果一级目录无显示权限，则不显示二级目录权限
											/*else if(($value['roleAuth_pid'] !=0 && $authArr[$value['roleAuth_pid']]['roleAuth_auths']=="") || $auths==""){
												echo '';//--无--
												
											}*/
											else{
												$actionArrTemp = $actionArr;
												if($value['roleAuth_pid']!=0 && $authArr[$value['roleAuth_pid']]['roleAuth_auths']=="")$actionArrTemp=$actionArr_hidden;
												
												
												foreach($authsArr as $key_auths => $value_auths){
													if( $k<count($authsArr) ) echo $actionArrTemp[$value_auths].' ';//', ';
													else echo $actionArrTemp[$value_auths];
													$k++;
												}
											}
											
										//}
										
										?></td>
                                        <td><?php 
											//if($value['roleAuth_pid']==0)echo '';
											//else 
											if($value['roleAuth_pid']!=0 && $authArr[$value['roleAuth_pid']]['roleAuth_auths']=="")
												echo '<a class="edit" style="display:none" href="javascript:;">设置权限</a>';
											else echo '<a class="edit" href="javascript:;">设置权限</a>'  
										?></td>
                                       <!-- <td><a class="delete" href="javascript:;">删除</a></td>-->
                                    </tr>
                                    <?php 
									 
									$i++;$pid++; }//end foreach ?>
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


//forbidenImg
//如果一级菜单无查看权限，则初始隐藏二级菜单信息

//把所有的权限存储到数据库
/*$("#editable-sample tbody tr").each(function(index, element) {
    var saveobj = $(this).find(".edit").eq(0);
	//var controller=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("controller") );
	//alert(controller);
	editable_save11(saveobj,"");
});*/
<?php //初始化新角色的权限：如果角色还未分配任何权限，则初始化权限

if( count($authArr ) <= 0 && $_GET['roleId'] !=""){
	
	//echo '//1111111111111111111111';
	$id = $authMaxId+1;
	  
	$pid_lev2 = $i;
	$asCatalog="";
	//遍历权限
	foreach($catlogArrForAuth as $key => $value){
	
	//end if
	 // else{
		  $pid_lev2 = $id;
		  ///$id =$i;
		  $pid =0;
		  $asCatalog = $key;
		  $controller = "";
		  $action = "";
		  $auths = "show";
		  ?>	
		  roleAuth_init("<?=$id?>","<?=$pid?>","<?=$asCatalog?>","<?=$controller?>","<?=$action?>","<?=$auths?>");
	   <?php $id++;
	   
	   
	     if($value['subnav']!=""){
		     $pid =$pid_lev2;
			 foreach ($value['subnav'] as $keySub => $valueSub) {
				  
				  //$asCatalog = $key;
				  $controller = $keySub;
				  $action = $valueSub["action"];
				  $auths = "show,add,edit,del";
			 ?>	 
				 
				 roleAuth_init("<?=$id?>","<?=$pid?>","<?=$asCatalog?>","<?=$controller?>","<?=$action?>","<?=$auths?>");
				 
			 <?php $id++;}//end foreach subnav
										
         }
	   
	   
	   
	   
	   }//end else
   //}//end foreach catlogArrForAuth
?>
 
<?php 

  echo 'location.reload()';//初始化完成刷新当前页面

}// end 初始化?>

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

function editable_save(saveobj,actionCheckedVal){
	//alert(actionCheckedVal);
    //alert("开始保存");
	
	
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("idval") );
	var pid = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("pid") );
	var asCatalog=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("asCatalog") );
	var controller=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("controller") );
	var action=$.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).attr("action") );
	
    var auths = $.trim( saveobj.parents("tr").eq(0).find(".action").eq(0).val() );
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

              if(msg != "error")toastr.success("分配权限成功！");
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