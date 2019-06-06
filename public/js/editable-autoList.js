var jqTds = "";
var actionCheckedTxt = "";//可操作方法被选中的文字
var actionCheckedVal = "";//可操作方法被选中的值
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
			//编辑
            function editRow(oTable, nRow,actionType="edit",trObj=""){
				if(actionType=="")actionType="edit";
				//alert(trObj.html());
				//之前选择的权限/操作
				var pid = trObj.find(".id").eq(0).attr("pid");
				//trObj.find(".action").eq(0).addClass("action_edited");
				var oldAction = $.trim( trObj.find(".action").eq(0).attr("value") );
				//alert(oldAction);
				
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                if(actionType=="add"){
					jqTds[0].innerHTML = '<input type="text" disabled class="id small" id="small"  value="自动生成">';
					
				}
                else{
					 jqTds[0].innerHTML = '<input type="text" class="id small aaa" disabled  id="small" value="' + aData[0] + '">';
					 
				}
                //jqTds[1].innerHTML = '<input type="text" class="name small" value="' + aData[1] + '">';
                //遍历后台获取的类别信息
                var devOption = '<ul class="actionUL">';
                if(pid==0)actionArrTemp= actionArr_cat1;
				else actionArrTemp= actionArr_cat2;
                $.each(actionArrTemp,function(index,value){
                     
                     //devOption += '<option value="'+index+'">'+value+'</option>'; //构造option
					 //oldAction
					 var checkedTxt = "";//设置默认选中：如果之前是选中的则点击设置权限后也默认选中
					 if(oldAction.indexOf(index) != -1) checkedTxt=' checked ';
					 devOption += '<li><label><input onclick="checkboxOnclick($(this))" '+checkedTxt+' class="actionInput '+index+'" name="'+index+'" type="checkbox" value="'+index+'"  txt="'+value+'">'+value+' </label></li>'; //构造option

                });
				devOption += "</ul>";
				//alert(jqTds.attr("class"));
                //jqTds[1].innerHTML = '<input type="text" class="zhiwei small" value="' + aData[1] + '">';
                //jqTds[2].innerHTML = '<input type="text" class="zhiwei small" value="' + aData[2] + '">';
				//if(jqTds.hasClass("rootId")) jqTds[2].innerHTML = '<input type="text" class="zhiwei small" value="0" disabled>';
				//else jqTds[1].innerHTML = '<input type="text" class="zhiwei small" value="' + aData[2] + '">';
                jqTds[1].innerHTML = '<input type="text" disabled class="zhiwei small" value="' + aData[1] + '">';
                //jqTds[4].innerHTML = '<select class="bumen" id="select">'+devOption+'</select>';
				jqTds[2].innerHTML = '<div id="multiSelect">'+devOption+'</div>';
				if(actionType=="edit")jqTds[3].innerHTML = '<a class="update" href="#">保存</a>&nbsp;<a class="cancel" href="">取消</a>';
                else if(actionType=="add")jqTds[3].innerHTML = '<a class="save" href="#">保存</a&nbsp;><a class="cancel"  href="">取消</a>';
            }
			//保存
            function saveRow(oTable, nRow,trObj) {//nRow = $(this).parents('tr')[0];
				//alert("11");
				
                var jqInputs = $('input', nRow);
                var c = $('#select option:selected').text();
				
				//权限的集合
				if(actionCheckedTxt==""){
					var pid = trObj.find(".id").eq(0).attr("pid");
					if(pid==0)actionCheckedTxt='<img class="forbidenImg" src="/public/images/forbid1.png" style="width:22px;" />';
					else actionCheckedTxt="--无--";
					trObj.find(".action").addClass("no");
					
				}else trObj.find(".action").removeClass("no");
				//alert(actionCheckedVal);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                //oTable.fnUpdate(c, nRow, 1, false);
				 oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                //oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                //oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate(actionCheckedTxt, nRow, 2, false);
				//oTable.fnUpdate(actionCheckedVal, nRow, 2, false);
                //oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">设置权限</a>', nRow, 3, false);
                //oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 6, false);
                oTable.fnDraw();
				
            }
			//取消
            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', 0);
                var c = $('#select option:selected').text();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(c, nRow, 1, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
                //oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                //oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                // oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">设置权限</a>', nRow, 3, false);
                oTable.fnDraw();
            }

            var oTable = $('#editable-sample').dataTable({
				
                "aLengthMenu": [
                    [10, 15, 20, -1],
                    [10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 10,
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
                    var aiNew = oTable.fnAddData(['', '', '',
                            '<a class="edit" href="">设置权限</a>', '<a class="cancel" data-mode="new" href="">取消</a>'
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

               /* if (confirm("确定删除 ?") == false) {
                     return false;
                }*/
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
				//alert("sdf");
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
                
				
				actionCheckedTxt = "";//可操作方法被选中的文字
				actionCheckedVal = "";//可操作方法被选中的值
				actionNoCheckedVal = "";
                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];
				
				 var trObj = $(this).parents('tr').eq(0);
               //alert("trObj11= "+trObj.html() );
                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow,"",trObj );
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "保存") {
					
					
					
					//选中的权限集合
					$("#multiSelect").find("input").each(function(index, element) {
						 if( $(this).is(':checked') ){
							actionCheckedVal += $(this).val()+", ";
							actionCheckedTxt += $(this).attr("txt")+" ";//权限集合
						 }
						 else{
							 actionNoCheckedVal += $(this).val()+", ";

						 }
					});
					actionCheckedTxt = $.trim(actionCheckedTxt);
					actionCheckedTxt = actionCheckedTxt.substr(0, actionCheckedTxt.length - 1);
					actionCheckedVal = $.trim(actionCheckedVal);
					actionCheckedVal = actionCheckedVal.substr(0, actionCheckedVal.length - 1);
				
					//alert("trObj22= "+trObj.html() );
					trObj.find(".action").eq(0).attr("value",actionCheckedVal);
					//alert("  333: "+actionCheckedVal);
					 
                    if(editable_save($(this),actionNoCheckedVal) == "null" )return false;//有数据未填，则不执行后面的操作
                     
					 saveRow(oTable, nEditing,trObj);
                    /* Editing this row and want to save it */
                    
                    nEditing = null;
                    //alert("Updated! Do not forget to do some ajax to sync with backend :)");
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow,"",trObj);
                    nEditing = nRow;
                }

                rows++;
            });
        }

    };

}();