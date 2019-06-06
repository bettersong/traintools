var jqTds = "";
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

            function editRow(oTable, nRow,actionType="edit") {
                //$.getScript("/public/js/select.js");
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                if(actionType=="add")jqTds[0].innerHTML = '<input type="text" class="id small" id="small" disabled value="自动生成">';
                else jqTds[0].innerHTML = '<input type="text" class="id small" id="small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="location small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="leader small" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" class="down small" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<input type="text" class="execution small" value="' + aData[4] + '">';
                //jqTds[5].innerHTML = '<input type="text" class="people small" value="' + aData[5] + '">';
                //jqTds[6].innerHTML = '<input type="text" class="tools small" value="' + aData[6] + '">';
                // //遍历后台获取的类别信息
                // var devOption = "";
                // var waMessageArray=[{pManageId: "1", pManageName: "张三"},{pManageId: "2", pManageName: "李四"},{pManageId: "3", pManageName: "王五"}];
                // $.each(waMessageArray,function(index,row){                  
                //      devOption += '<option value="'+row['pManageId']+'">'+row['pManageName']+','+'</option>'; 
                // });
                // if(actionType=="add")
                // jqTds[5].innerHTML = '<select class="example-getting-started people" multiple="multiple " id="select">'+devOption+'</select>';
                // else jqTds[5].innerHTML = '<select class="example-getting-started people" multiple="multiple" id="select">'+devOption+'</select>';
                // //遍历后台获取的类别信息
                // var devOption = "";
                // var waMessageArray=[{pManageId: "1", pManageName: "张三"},{pManageId: "2", pManageName: "李四"},{pManageId: "3", pManageName: "王五"}];
                // $.each(waMessageArray,function(index,row){
                    
                //      devOption += '<option value="'+row['pManageId']+'">'+row['pManageName']+'</option>'; 
                // });
                // if(actionType=="add")
                // jqTds[6].innerHTML = '<select class="example-getting-started tools" multiple="multiple" id="select">'+devOption+'</select>';
                // else jqTds[6].innerHTML = '<select class="example-getting-started tools" multiple="multiple" id="select">'+devOption+'</select>';
                if(actionType=="edit")jqTds[5].innerHTML = '<a class="update" href="#">保存</a>';
                else if(actionType=="add")jqTds[5].innerHTML = '<a class="save" href="#">保存</a>';
                jqTds[6].innerHTML = '<a class="cancel" href="">取消</a>';
            }
            
            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                //oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                //oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 5, false);
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 6, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                //oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                //oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 5, false);
                oTable.fnDraw();
            }

            

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
                    var aiNew = oTable.fnAddData(['', '', '', '', '',
                            '<a class="edit" href="">编辑</a>', '<a class="cancel" data-mode="new" href="">取消</a>'
                    ]);
                    var nRow = oTable.fnGetNodes(aiNew[0]);
                    editRow(oTable, nRow,"add");
                    nEditing = nRow;
                //}
            }); 
			   
			$('.delete').live('click', function (e) {
                
			   /*//判断是否有删除权限
			   if(auths_page.indexOf('del') > -1){
				   layer.alert("<span style='color:#f30'>抱歉，您暂无该项权限！</span>", {icon:2,title: '【提示】'});
				   return false;
			   }
                e.preventDefault();*/

                if (confirm("确定删除 ?") == false) {
                     return false;
                }
               /* var id = $.trim( $(this).parents("tr").eq(0).find(".ids").eq(0).html() );
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
                oTable.fnDeleteRow(nRow);*/
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
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    //alert("Updated! Do not forget to do some ajax to sync with backend :)");
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }

                rows++;
            });
        }

    };

}();