var jqTds = "";


//菜单列表html
var menus = '';
var myAdministration = false;
var myTopBumenArr = new Array(10)
var k = 0;
var menus = '<ul id="ul-bumen0">';
//根据菜单主键id生成菜单列表html
//id：菜单主键id
//arry：菜单数组信息
function GetData(id, arry) {
	var childArry = GetParentArry(id, arry);
	if (childArry.length > 0) {
		
		if(isSuperAdmin || myAdministration)menus += '<ul id="ul-bumen'+id+'">';
		for (var i in childArry) {
			if(childArry[i].id==myAdminBumenId)myAdministration = true;
			if(isSuperAdmin || myAdministration){
				 
				myTopBumenArr[k] = childArry[i].id;
				//alert(myTopBumenArr[k]+"  "+childArry[i].pid);
				if(isSuperAdmin || k==0 || (k>0 && isInArray(myTopBumenArr,childArry[i].pid)) ){
                if(childArry[i].isAdministration==1){
			      menus += '<li class="isAdministration" bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'"><span class="tagicon"></span><font title="点击选择">' + childArry[i].name+'</font>';
				}
				else{
				 menus += '<li bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'"><span class="tagicon"></span><font title="点击选择">' + childArry[i].name+'</font>';
				}
			//menus += '<span title="添加子菜单" class="addchild" bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'">添</span>';
			//menus += '<span title="删除" class="deleteItem" bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'">删</span>';
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
function GetParentArry(id, arry) {
	var newArry = new Array();
	for (var i in arry) {
		if (arry[i].pid == id)
			newArry.push(arry[i]);
	}
	return newArry;
}

var EditableTable = function () {
    return {

        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow,actionType="edit",thisObj="") {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                if(actionType=="add")jqTds[0].innerHTML = '<input type="text" disabled class="id small" id="small"  value="自动生成">';
                else jqTds[0].innerHTML = '<input type="text" class="id small" disabled  id="small" value="' + aData[0] + '">';
                
				jqTds[1].innerHTML = '<input type="text" class="name small" value="' + aData[1] + '">';

				if (aData[2]=="女") jqTds[2].innerHTML = '<select id="sex" class="sex small" style="width:60px">'+'<option value="1">男</option>'+'<option selected="selected" value="2">女</option>'+'</select>';
                else 				jqTds[2].innerHTML = '<select id="sex" class="sex small" style="width:60px">'+'<option selected="selected" value="1">男</option>'+'<option value="2">女</option>'+'</select>';
                
                jqTds[3].innerHTML = '<input type="text" class="code small" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<input type="text" class="contact small" value="' + aData[4] + '">';

                var devOption = "";
                var GPS_ID = $('.td_GPSCode',nRow).attr("value");
                devOption += '<option value="'+GPS_ID+'">'+aData[5]+'</option>';
                $.each(gpslibs,function(index,row){
                    if (aData[5] == row['GPSCode']) devOption += '<option selected="selected" value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';
                    else                            devOption += '<option value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';
                });
                jqTds[5].innerHTML = '<select class="gps" id="select">'+devOption+'</select>';

                if(actionType=="edit")jqTds[6].innerHTML = '<a class="update" href="#">保存</a>';
                else if(actionType=="add")jqTds[6].innerHTML = '<a class="save" href="#">保存</a>';
               
               jqTds[7].innerHTML = '<a class="cancel" data-mode="new" href="">取消</a>';
            }

            function saveRow(oTable, nRow,saveobj='') {
                var jqInputs = $('input', nRow);
                var sex=$("#sex option:selected").text();
                var gps=$("#select option:selected").text();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(sex, nRow, 2, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
                oTable.fnUpdate(gps, nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 6, false);
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 7, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                var sex=$("#sex option:selected").text();
                var gps=$("#select option:selected").text();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(sex, nRow, 2, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
                oTable.fnUpdate(gps, nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 6, false);
                oTable.fnDraw();
            }

            var oTable = $('#editable-sample').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ 每页记录",
                    "oPaginate": {
                        "sPrevious": "上一页",
                        "sNext": "下一页"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass(" medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass(" xsmall"); // modify table per page dropdown

            var nEditing = null;

            var rows = $("#editable-sample").children("tbody").find("tr").length;//初始化行
            $('#editable-sample_new').live('click',function (e) {
                
                //判断是否为初始化状态

                //alert("rows="+rows);
                //if(rows<=1){
                    //$("#editable-sample").children("tbody").find(".edit").eq(0).click();
                    //alert("rows:"+rows);
                //}
                //else{
                    e.preventDefault();
                    var aiNew = oTable.fnAddData(['', '', '', '','','',
                            '<a class="edit" href="">编辑</a>', '<a class="cancel" data-mode="new" href="">取消</a>'
                    ]);
                    var nRow = oTable.fnGetNodes(aiNew[0]);
                    editRow(oTable, nRow,"add");
                    nEditing = nRow;
                //}
            }); 
			   
			$('#editable-sample a.delete').live('click', function (e) {
                
			   //判断是否有删除权限
			   if(auths_page.indexOf('del') > -1){
				   layer.alert("<span style='color:#f30'>抱歉，您暂无该项权限！</span>", {icon:2,title: '【提示】'});
				   return false;
			   }
                e.preventDefault();

                if (confirm("确定删除 ?") == false) {
                     return false;
                }
                var id = $.trim( $(this).parents("tr").eq(0).find(".ids").eq(0).html() );
                var delobj = $(this).parents("tr");

                //var type = "add";
                //if( saveobj.hasClass('update') )type = "update";
                //判断数据是否有空
                $.ajax({
                    type: "post",
                    data: {
                        "id":id
                    },
                    dataType: 'json',
                    url: CURRENT_DIR+"/builders_delete.php?",
                    success: function (msg) {
                          delobj.remove();
                          toastr.success("删除成功！");
                    },
                    error: function (msg) {
                        toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
                        //alert(id);
                    }
                });

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
                //alert("Deleted! Do not forget to do some ajax to sync with backend :)");
            });

            $('#editable-sample a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $('#editable-sample a.edit,#editable-sample a.save,#editable-sample a.update').live('click', function (e) {
                e.preventDefault();
                
                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
					
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "保存") {
                    if(editable_save($(this)) == "null")return false;//有数据未填，则不执行后面的操作
                     
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing,$(this));
                    nEditing = null;
                    //alert("Updated! Do not forget to do some ajax to sync with backend :)");
                } else {//编辑
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow, "edit",$(this));
                    nEditing = nRow; 
                }

                rows++;
            });
        }

    };

}();