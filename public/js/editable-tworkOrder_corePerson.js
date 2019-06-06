var jqTds = "";
var EditableTable1 = function () {

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
             function editRow(oTable, nRow,actionType="edit"){
                var aData = oTable.fnGetData(nRow);

                var tid = $('.bold',nRow).attr('tid');
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" tid="'+ tid +'" class="position small aaa" disabled  id="small" value="' + aData[0] + '">';
                var devOption = "";
                $.each(pmanage_admin,function(index,row){
                    if (aData[1] == row['pManageName']) devOption += '<option selected="selected" value="'+row['pManageId']+'">'+row['pManageName']+'</option>';
                    else devOption += '<option value="'+row['pManageId']+'">'+row['pManageName']+'</option>';
                });
                jqTds[1].innerHTML = '<select class="name" id="select">'+devOption+'</select>';

                jqTds[2].innerHTML = '<input disabled type="text" class="sex small" value="' + aData[2] + '">';

                jqTds[3].innerHTML = '<input disabled type="text" class="id small" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<input disabled type="text" class="zhiwei small" value="' + aData[4] + '">';
                
                jqTds[5].innerHTML = '<input disabled type="text" class="contect small" value="' + aData[5] + '">';
                jqTds[6].innerHTML = '<input type="text" class="kaoqin small" value="' + aData[6] + '">';
                
                if(actionType=="edit")jqTds[7].innerHTML = '<a class="update" href="#">保存</a>';
                else if(actionType=="add")jqTds[7].innerHTML = '<a class="save" href="#">保存</a>';
                jqTds[8].innerHTML = '<a class="cancel" href="">取消</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                var c = $('#select option:selected').text();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(c, nRow, 1, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
                oTable.fnUpdate(jqInputs[4].value, nRow, 5, false);
                oTable.fnUpdate(jqInputs[5].value, nRow, 6, false);
                
                //oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 7, false);
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 8, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
                
                //oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 7, false);
                
                oTable.fnDraw();
            }

            var oTable = $('#editable-sample_corePerson').dataTable({
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

            var rows = $("#editable-sample_corePerson").children("tbody").find("tr").length;//初始化行
            $('#editable-sample_new_corePerson').live('click',function (e) {
                console.log(222); 
                //判断是否为初始化状态

                //alert("rows="+rows);
                //if(rows<=1){
                    //$("#editable-sample").children("tbody").find(".edit").eq(0).click();
                    //alert("rows:"+rows);
                //}
                //else{
                    e.preventDefault();
                    var aiNew = oTable.fnAddData(['', '', '', '', '', '', '',
                            '<a class="edit" href="">编辑</a>', '<a class="cancel" data-mode="new" href="">取消</a>'
                    ]);
                    var nRow = oTable.fnGetNodes(aiNew[0]);
                    editRow(oTable, nRow,"add");
                    nEditing = nRow;
                //}
            }); 
			   
			$('#editable-sample_corePerson a.delete').live('click', function (e) {
       
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
				 
                //判断数据是否有空
                $.ajax({
                    type: "post",
                    data: {
                        "id":id
                    },
                    dataType: 'json',
                    url: CURRENT_DIR+"/index_delete.php",
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

            $('#editable-sample_corePerson a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $('#editable-sample_corePerson a.edit,#editable-sample_corePerson a.save,#editable-sample_corePerson a.update').live('click', function (e) {
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