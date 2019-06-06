var jqTds = "";


//菜单列表html
var menus = '';
var myAdministration = false;
var myTopBumenArr = new Array(10);
var k = 0;
var menus = '<ul id="ul-bumen0">';
//根据菜单主键id生成菜单列表html
//id：菜单主键id
//arry：菜单数组信息
var currentId="";
function GetData(id, arry) {
	if(arguments[2]) currentId = arguments[2];
	//if(currentId !=-2)alert("GetData:"+currentId);

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
                    if(childArry[i].id==currentId){
                      menus += '<li bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'"><span class="tagicon"></span><font class="selected"  title="点击选择">' + childArry[i].name+'</font>';

                    }
				 else menus += '<li bumenId="'+childArry[i].id+'"  pid="'+childArry[i].pid+'"><span class="tagicon"></span><font title="点击选择">' + childArry[i].name+'</font>';
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
// var stationName = ZhiweiArray;
// //console.log(stationName);
// //var arr1 = [].slice.call(ZhiweiArray);
// //var stationName = [[1,2,3],[4,5,6]];
// //var arr = Object.keys(stationName);
// //console.log(arr1);
// function getStationName() {
//     var line_num = document.getElementById("lines");
//     var station_name = document.getElementById("station");
//     var lineStation = stationName[line_num.selectedIndex - 1];
//     station_name.length = 1;
//     for (var i = 0; i < lineStation.length; i++) {
//         station_name[i + 1] = new Option(lineStation[i], lineStation[i]);
//     }
// }

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
                //jqTds[2].innerHTML = '<input type="text" class="sex small" value="' + aData[2] + '">';
                
                //选择角色时用到
                var rolelistTxt = '<div class="roleList">';
                var roleids = "";//aData[4]; //已分配给用户的角色

                //添加时的部门与职位联动
                if(actionType=="add"){//添加
					//遍历后台获取的部门信息
					var lineNu = "";
					var devOption = "";
					/*$.each(BumenArray,function(index,row){
						 devOption += '<option value="'+row['bManageId']+'">'+row['bManageBranch']+'</option>'; //构造option
	
					});*/
					jqTds[2].innerHTML = '<select id="sex" class="sex small" style="width:60px">'+'<option value="1">男</option>'+'<option value="2">女</option>'+'</select>'
					//jqTds[3].innerHTML = '<select name="lines" class="lines" class="department" style="width:160px">'+'<option value="0">请选择部门</option>'+devOption+'</select>';// onchange="getStationName(this)"
					
					//生成部门信息
					menus = "";
					GetData(-1, Bmanage);
					jqTds[3].innerHTML = '<div id="treeDiv" selectedid="" style="margin:0;">'+menus+'</div>';//.append(menus);
					//显示部门展开与收缩标记
					$("#treeDiv li").each(function(index, element) {
						if( $(this).children("ul").length > 0 ){
							$(this).children(".tagicon").html("+");
							$(this).children(".tagicon").addClass("hasChild");
							$(this).children("font").addClass("font_hasChild");
							
						} 
						else{
							$(this).children(".tagicon").addClass("noChild");
							$(this).children("font").addClass("font_nohasChild");
						}
					});
					//jqTds[4].innerHTML = '<select name="station" id="station" class="position" style="width:160px">'+'<option value="0">请选择职位</option>'+'</select>'
					 jqTds[9].innerHTML = '<a class="cancel" data-mode="new" href="">取消</a>';
				}
				//编辑时的部门与职位联动
                else{//编辑
					//该用户所在部门
					var selectedBumenName = thisObj.parents("tr").eq(0).find(".td_lines").eq(0).html();
					var selectedBumenValue = thisObj.parents("tr").eq(0).find(".td_lines").eq(0).attr("value");
					//该用户职位
					var selectedZhiweiName = thisObj.parents("tr").eq(0).find(".td_position").eq(0).html();
					var selectedZhiweiValue = thisObj.parents("tr").eq(0).find(".td_position").attr("value");
					//该用户所的性别
					var sexHtml = thisObj.parents("tr").eq(0).find(".td_sex").eq(0).html();
					var sexValue = thisObj.parents("tr").eq(0).find(".td_sex").eq(0).attr("value");
 					//alert(selectedZhiweiName+selectedZhiweiValue);
					//遍历后台获取的部门信息
					var lineNu = "";
					var devOption = "";
 				 
					if(sexValue==1){
					jqTds[2].innerHTML = '<select id="sex" class="sex small" style="width:60px">'+'<option selected value="1">男</option>'+'<option value="2">女</option>'+'</select>'
					}else{
						jqTds[2].innerHTML = '<select id="sex" class="sex small" style="width:60px">'+'<option value="1">男</option>'+'<option selected value="2">女</option>'+'</select>'
					}
					//jqTds[3].innerHTML = '<select name="lines" class="lines" class="department" style="width:160px">'+'<option value="0">请选择部门</option>'+devOption+'</select>';// onchange="getStationName(this)"
					
					//生成部门信息
					k = 0;
                    menus = '<ul id="ul-bumen0">';
					//alert(selectedBumenValue);
					GetData(-1, Bmanage,selectedBumenValue);
					jqTds[3].innerHTML = '<div id="treeDiv" selectedid="" style="margin:0;">'+menus+'</div>';//.append(menus);
					//显示部门展开与收缩标记
					var selectedid  = thisObj.parents("tr").eq(0).find(".td_selectedid ").eq(0).attr("value");//该用户所在部门
					$("#ul-bumen0 li").each(function(index, element) {
						var bumenid = $(this).attr("bumenid");
						if(bumenid == selectedid){//编辑该用户所在部门
							$(this).children("font").addClass("selected");
							$(this).parents("ul").css("display","block");
							$(this).parents("ul").find(".hasChild").html("-");
						}
						if( $(this).children("ul").length > 0 ){
							$(this).children(".tagicon").html("+");
							$(this).children(".tagicon").addClass("hasChild");
							$(this).children("font").addClass("font_hasChild");
							
						}
						else{
							$(this).children(".tagicon").addClass("noChild");
							$(this).children("font").addClass("font_nohasChild");
						}
                    });
                    
                    jqTds[9].innerHTML = '<a class="cancel" href="">取消</a>';//data-mode
                    
                     //已分配给用户的角色
                    roleids = thisObj.parents("tr").eq(0).find(".td_roleName ").eq(0).attr("roleids");//aData[4];
                    roleids = ","+roleids+",";//为了角色类别遍历设置默认选择时准确匹配
		 
				}
               
                


                //角色列表
                
                $.each(roleInfoJson,function(index,row){
                    var checked="";
                    if (roleids.indexOf( ","+row['roleId']+"," ) >= 0) checked="checked";
                    rolelistTxt += '<dl><dt><input type="checkbox" id="role'+row['roleId']+'"  name="role" value="'+row['roleId']+'" '+checked+' />&nbsp;<label for="role'+row['roleId']+'">'+row['roleName']+'</label></dt></dl>';
                });
                //rolelistTxt += '<dl><dt><input type="checkbox" id="role1" name="role" value="1" />&nbsp;<label for="role1">aaa</label></dt></dl>';
                 rolelistTxt += '</div>';
                jqTds[4].innerHTML = rolelistTxt;

                jqTds[5].innerHTML = '<input type="text" class="code small" value="' + aData[5] + '">';
                jqTds[6].innerHTML = '<input type="text" class="contact small" value="' + aData[6] + '">';
                //遍历后台获取的GPS列表
                var devOption = "";
                devOption += '<option  value="">请选择定位器</option>';
				$.each(gpslibs,function(index,row){
					//alert(device_id);
                    if( aData[7]==row['GPSCode'] )
					 devOption += '<option selected value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';
                     else devOption += '<option value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';
				});
                if(actionType=="add")
				jqTds[7].innerHTML = '<select class="gps" id="select">'+devOption+'</select>';
                else jqTds[7].innerHTML = '<select class="gps" id="select">'+devOption+'</select>';
                if(actionType=="edit")jqTds[8].innerHTML = '<a class="update" href="#">保存</a>';
                else if(actionType=="add")jqTds[8].innerHTML = '<a class="save" href="#">保存</a>';

                
                
				
 
            }

            function saveRow(oTable, nRow,saveobj='') {

				if(saveobj !=''){
					//获取已选择的性别、部门、职位的文字及value值。
					var sex = $.trim( saveobj.parents("tr").eq(0).find(".sex option:selected").eq(0).attr("value") );
					var department =$.trim( saveobj.parents("tr").eq(0).find(".lines option:selected").eq(0).attr("value") );
					var position = $.trim( saveobj.parents("tr").eq(0).find(".position option:selected").eq(0).attr("value") );
					var sexHtml = saveobj.parents("tr").eq(0).find(".sex option:selected").eq(0).html();
					var departmentHtml = saveobj.parents("tr").eq(0).find(".lines option:selected").eq(0).html();
					var positionHtml = saveobj.parents("tr").eq(0).find(".position option:selected").eq(0).html();
					//选中的部门
					var bumen_selectedid =$("#treeDiv").parent("td").attr("selectedid");//选中的部门
 				    var bumen_name = $(".selected").eq(0).html();
                    var parent_bname = $(".selected").eq(0).parents("ul").prev("font").eq(0).html();
					//保存后更新页面信息
					saveobj.parents("tr").eq(0).find(".sex").eq(0).parent("td").attr("value",sex).html(sexHtml);
					$("#treeDiv").parent("td").html(parent_bname+' > '+bumen_name);
				 	//saveobj.parents("tr").eq(0).find(".lines").eq(0).parent("td").attr("value",department).html(departmentHtml);
				 	//saveobj.parents("tr").eq(0).find(".position").eq(0).parent("td").attr("value",position).html(positionHtml);
				}
	           
				
                var jqInputs = $('input', nRow);
                //var b=$("#sex").val();
                //var c=$("#lines").val();
                //var d=$("#station").val();
                var c = $('#select option:selected').text();
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
				
                //oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                //角色
                //var roleName = saveobj.parents("tr").eq(0).find(".code").eq(0).val();
                //oTable.fnUpdate(roleName, nRow, 4, false);
                //编号
                var code = saveobj.parents("tr").eq(0).find(".code").eq(0).val();
                oTable.fnUpdate(code, nRow, 5, false);
                //联系方式
                var contact = saveobj.parents("tr").eq(0).find(".contact").eq(0).val();
                oTable.fnUpdate(contact, nRow, 6, false);
                oTable.fnUpdate(c, nRow, 7, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 8, false);
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 9, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', 0);
                var b=$("#sex").val();
                var c=$("#lines").val();
                var d=$("#station").val();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(b, nRow, 2, false);
                oTable.fnUpdate(c, nRow, 3, false);
                oTable.fnUpdate(d, nRow, 4, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 5, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 6, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 7, false);
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
                    var aiNew = oTable.fnAddData(['', '', '', '','','','','',
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
                    url: CURRENT_DIR+"/index_delete.php?",
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
                    editRow(oTable, nRow, "edit",$(this));
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