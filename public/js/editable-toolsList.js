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
            function editRow(oTable, nRow,actionType="edit",thisObj="") {
                
                var aData = oTable.fnGetData(nRow);
                var nums = thisObj.parents("tr").find(".link").eq(0).text();//$("#link").text();
                var conn = thisObj.parents("tr").find(".link").attr('href'); //获取数量中的href链接
                var jqTds = $('>td', nRow);
                if(actionType=="add")jqTds[0].innerHTML = '<input type="text" disabled class="id small" id="small"  value="自动生成">';
                else jqTds[0].innerHTML = '<input type="text" class="id small aaa" disabled  id="small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="name small" value="' + aData[1] + '">';
                if(actionType=="add")jqTds[2].innerHTML ='<a id="numsLink_temp" class="link" href="javascript:void;" style="text-decoration:underline;">'+'<input type="text" class="amount small" value="自动统计" disabled>'+ '</a>';
                else jqTds[2].innerHTML = '<a id="numsLink_temp" class="link" href="'+conn+'" style="text-decoration:underline;">'+'<input type="text" class="amount small" value="' + nums + '" disabled>'+ '</a>';

                //下拉工具大小分类
                var td_Class_val = "";//默认选中
                if(actionType=="edit")td_Class_val = thisObj.parents("tr").eq(0).find(".td_class").eq(0).attr("value");
                var devOption = "";//工具大小分类
                $.each(rfidclassArray,function(index,row){
                    if(td_Class_val !="" && td_Class_val==row['RFIDClassId'])
                         devOption += '<option selected value="'+row['RFIDClassId']+'">'+row['RFIDClassType']+'</option>';
                    else devOption += '<option value="'+row['RFIDClassId']+'">'+row['RFIDClassType']+'</option>';
                }); 
                jqTds[3].innerHTML = '<select class="type" id="select">'+devOption+'</select>';

                //下拉所属仓库
                var td_warehouse_val = "";//默认选中
                if(actionType=="edit")td_warehouse_val = thisObj.parents("tr").eq(0).find(".td_warehouse").eq(0).attr("value");
                var devOption_warehouse = "";
                $.each(DetailHomeArray,function(index,row){
                    if(td_warehouse_val !="" && td_warehouse_val==row['waMessageId'])
                         devOption_warehouse += '<option selected value="'+row['waMessageId']+'">'+row['waMessageName']+'</option>';
                    else devOption_warehouse += '<option value="'+row['waMessageId']+'">'+row['waMessageName']+'</option>';
                });
                jqTds[4].innerHTML = '<select class="selectWareHouse" id="selectWareHouse">'+devOption_warehouse+'</select>';

                var td_master_val = "";//默认选中
                if(actionType=="edit")  td_master_val = thisObj.parents("tr").eq(0).find(".td_master").eq(0).attr("value");
                var devOption_master = "";
                $.each(pmanage_builders,function(index,row){
                    if(td_master_val !="" && td_master_val==row['pManageId'])
                         devOption_master += '<option selected value="'+row['pManageId']+'">'+row['pManageName']+'</option>';
                    else devOption_master += '<option value="'+row['pManageId']+'">'+row['pManageName']+'</option>';
                });
                jqTds[5].innerHTML = '<select class="selectMaster" id="selectMaster">'+devOption_master+'</select>';

                if(actionType=="edit")jqTds[6].innerHTML = '<a class="update" href="#">保存</a>';
                else if(actionType=="add")jqTds[6].innerHTML = '<a class="save" href="#">保存</a>';
                jqTds[7].innerHTML = '<a class="cancel" href="">取消</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                var conn = $("#numsLink_temp").attr('href');
                var num = $('#numsLink_temp').find('input').val();
                var b ='<a href="'+conn+'" class="link">'+num+'</a>';
                var c = $('#select option:selected').text();
                var d = $('#selectWareHouse option:selected').text();
                var e = $('#selectMaster option:selected').text();
                
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(b, nRow, 2, false);
                oTable.fnUpdate(c, nRow, 3, false);
                oTable.fnUpdate(d, nRow, 4, false);
                oTable.fnUpdate(e, nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 6, false);
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 7, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) { 
                var jqInputs = $('input', 0);
                var conn = $("#numsLink_temp").attr('href');
                var num = $('#numsLink_temp').find('input').val();
                var b ='<a href="conn" class="link>'+num+'</a>';
                var c = $('#select option:selected').text();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(b, nRow, 2, false);
                oTable.fnUpdate(c, nRow, 3, false);
                oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
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

                    e.preventDefault();
                    var aiNew = oTable.fnAddData(['', '', '', '','','',
                            '<a class="edit" href="">编辑</a>', '<a class="cancel" data-mode="new" href="">取消</a>'
                    ]);
                    var nRow = oTable.fnGetNodes(aiNew[0]);
                    editRow(oTable, nRow,"add",$(this));
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
                var tbody = $(this).parents("tbody").html();
                $.ajax({
                    type: "post",
                    data: {
                        "id":id
                    },
                    dataType: 'json',
                    url: CURRENT_DIR+"/index_delete.php?",
                    success: function (msg) {
                        if(msg == 'error'){
                           toastr.error("删除失败,该类别下有工具,请先移除！");
                        }
                        else{
                          delobj.remove();
                          toastr.success("删除成功！"); 
                        }
                          
                    },
                    error: function (msg) {
                        toastr.error(msg.status + "服务繁忙，请刷新或稍后再试。");
                    }
                });

                
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
                    //editRow(oTable, nRow);
                    editRow(oTable, nRow, "edit",$(this));
                    nEditing = nRow;
                }

                rows++;
            });
        }

    };

}();