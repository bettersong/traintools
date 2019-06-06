<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link href="/public/css/bootstrap.min_m.css" rel="stylesheet" />
    <link href="/public/css/style_m.css?1.0" rel="stylesheet" />
    <link href="/public/css/ui.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <script src="/public/js/laydate/laydate.js?1.0"></script>
    <style>
    .table th, .table td {
        padding:0px !important;
    
     }
    </style>
</head>
<body>
<div class="train-title">
        <div class="train-logo"><span class="train-v">人员信息管理</span></div>
</div>
<div class="row-fluid" style="margin-top:30px;margin-bottom:80px">
                <div class="span11">
                    <!-- BEGIN EXAMPLE TABLE widget-->
                    <div class="widget orange">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>人员信息管理</h4>

                        </div>
                        <div class="widget-body">
                            <div>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="editable-sample_new" class="btn green">
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
                                        <th>所属部门</th>
                                        <th>所属职位</th>
                                        <th>职员编号</th>
                                        <th>联系方式</th>
                                        <th>编辑</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($personnerArr as $key => $value) { ?>
                                    <tr class="">
                                        <td class="ids"><?=$value['pManageId']?></td>
                                        <td class="td_name"><?=$value['pManageName']?></td>
                                        <td class="td_sex"><?php if($value['pManageSex']==1)echo '男';else echo '女';?></td>
                                        <td class="td_lines" value="<?=$value['bManageId']?>"><?=$value['bManageBranch']?></td>
                                        <td class="td_position" value="<?=$value['zManageId']?>"><?=$value['zManagePosition']?></td>
                                        <td><?=$value['pManageStaffId']?></td>
                                        <td><?=$value['pManageContact']?></td>
                                        <td><a class="edit" href="javascript:;">编辑</a></td>
                                        <td><a class="delete" href="javascript:;">删除</a></td>
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
    var ZhiweiArray = <?=$zhiweiJson?>;
</script>
<script src="/public/js/jquery.uniform.min.js"></script>
<script src="/public/js/jquery.dataTables.js?v=0.101"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<script src="/public/js/editable-pManage.js?<?=rand(1,99999)?>"></script>
<script src="/public/js/toastr.min.js"></script>
<script>
toastr.options.positionClass = 'toast-top-center';
function editable_save(saveobj){
    //alert("ddd");
    var id = $.trim( saveobj.parents("tr").eq(0).find(".id").eq(0).val() );
    var name = $.trim( saveobj.parents("tr").eq(0).find(".name").eq(0).val() );
    var sex = $.trim( saveobj.parents("tr").eq(0).find(".sex option:selected").eq(0).attr("value") );
    var department =$.trim( saveobj.parents("tr").eq(0).find(".lines option:selected").eq(0).attr("value") );
    var position = $.trim( saveobj.parents("tr").eq(0).find(".position option:selected").eq(0).attr("value") );
	// alert(sexHtml+" :: "+departmentHtml);return false;
	
    //var position = $.trim(saveobj.parents("tr").eq(0).find(".position").eq(0).val() );
    var code = $.trim(saveobj.parents("tr").eq(0).find(".code").eq(0).val() );
    var contact = $.trim(saveobj.parents("tr").eq(0).find(".contact").eq(0).val() );
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
    if(position==0 || position==0)dataIsNull = true;
    if(dataIsNull) alert("数据全部不能为空，请填写！");
    if(dataIsNull) return "null"; //editable-table.js用到
    $.ajax({
        async:false,
        type: "post",
        data: {
            "type":type,
            "id":id,
            "name":name,
            "sex":sex,
            "department":department,
            "position":position,
            "code":code,
            "contact":contact,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
            //alert(position);

              if(msg != "error")toastr.success("提交成功！");
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