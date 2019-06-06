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
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                if(actionType=="add")jqTds[0].innerHTML = '<input  type="text" disabled class="id" id="small"  value="自动生成">';
                else jqTds[0].innerHTML = '<input  type="text" class="id aaa" disabled  id="small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input  type="text"   class="tb_name tools small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input  type="text" class="reader small" value="' + aData[2] + '">';
                var gpsUsedCodes = [];//保存已使用的定位器
                $('.GPS').each(function(i,n){
                    var gpsCodes = $('.GPS')[i];
                    console.log(gpsCodes.innerHTML);
                    if(gpsCodes.innerHTML != '无'){
                        gpsUsedCodes.push(gpsCodes.innerHTML);
                    }
                });
                console.log(gpsUsedCodes);

                //定位器
                var devOption = "";
                GPS_ID = $('.GPS').attr("value");
                //var thisGPS = $(this);
                console.log(thisGPS);
                gpsUsedCodes = remove(gpsUsedCodes,thisGPS);//已使用但不包含本身
                console.log(gpsUsedCodes);
                devOption += '<option value="0">请选择定位器</option>';
                if(aData[3]!=""){
                    devOption += '<option selected="selected" value="'+GPS_ID+'">'+aData[3]+'</option>';
                    //devOption += '<option value="0">&nbsp;</option>';
                }
                var newArray = LocatorArr;// [];
                for(var i=0;i<gpsUsedCodes.length;i++){
                    newArray = remove2(LocatorArr,gpsUsedCodes[i]);
                }
                //console.log("3333");
                //console.log(newArray);
                
                $.each(newArray,function(index,row){
                    devOption += '<option value="'+row['GPSId']+'">'+row['GPSCode']+'</option>';
                });
                jqTds[3].innerHTML = '<select  class="GPS" id="select0">'+devOption+'</select>';

                
                //工具包类型
                var devOption = "";
                //默认选中
                switch(aData[4])
                {
                    case "小型": devOption = '<option selected="selected" value="SMALL">小型</option><option value="MEDIUM">中型</option><option value="BIG">大型</option>'; break;
                    case "中型": devOption = '<option value="SMALL">小型</option><option selected="selected" value="MEDIUM">中型</option><option value="BIG">大型</option>'; break;
                    case "大型": devOption = '<option value="SMALL">小型</option><option value="MEDIUM">中型</option><option selected="selected" value="BIG">大型</option>'; break;
                    default:     devOption = '<option value="SMALL">小型</option><option value="MEDIUM">中型</option><option value="BIG">大型</option>'; break;
                }
                
                jqTds[4].innerHTML = '<select style="width:145px" class="type" id="select1">'+devOption+'</select>';

                //仓库
                var devOption = "";
                $.each(DetailHomeArray,function(index,row){
                    if (row['waMessageName'] == aData[5]) {devOption += '<option selected="selected" value="'+row['waMessageId']+'">'+row['waMessageName']+'</option>';}
                    else devOption += '<option value="'+row['waMessageId']+'">'+row['waMessageName']+'</option>';
                });
                jqTds[5].innerHTML = '<select style="width:90px" class="house" id="select2">'+devOption+'</select>';

                var devOption = "";
                switch(aData[6])
                {
                    case "使用中": devOption = '<option selected value="3">使用中</option><option value="2">待使用</option><option value="1">维修中</option><option value="0">报废</option>';; break;
                    case "待使用": devOption = '<option value="3">使用中</option><option selected value="2">待使用</option><option value="1">维修中</option><option value="0">报废</option>';; break;
                    case "维修中": devOption = '<option value="3">使用中</option><option value="2">待使用</option><option selected value="1">维修中</option><option value="0">报废</option>';; break;
                    case "报废":   devOption = '<option value="3">使用中</option><option value="2">待使用</option><option value="1">维修中</option><option selected value="0">报废</option>';; break;
                    default:       devOption = '<option value="3">使用中</option><option value="2">待使用</option><option value="1">维修中</option><option value="0">报废</option>' ; break;
                }
                
                jqTds[6].innerHTML = '<select class="state" id="select3">'+devOption+'</select>';

                if(actionType=="edit")jqTds[7].innerHTML = '<a class="update" href="#">保存</a>';
                else if(actionType=="add")jqTds[7].innerHTML = '<a class="save" href="#">保存</a>';
                jqTds[8].innerHTML = '<a class="cancel" href="">取消</a>';

            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                var A = $('#select0 option:selected',nRow).text();
                var a = $('#select1 option:selected',nRow).text();
                var b = $('#select2 option:selected',nRow).text();
                var c = $('#select3 option:selected',nRow).text();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(A, nRow, 3, false);
                oTable.fnUpdate(a, nRow, 4, false);
                oTable.fnUpdate(b, nRow, 5, false);
                oTable.fnUpdate(c, nRow, 6, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 7, false);
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, 8, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', 0);
                var A = $('#select0 option:selected',nRow).text();
                var a = $('#select1 option:selected',nRow).text();
                var b = $('#select2 option:selected',nRow).text();
                var c = $('#select3 option:selected',nRow).text();
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(A, nRow, 3, false);
                oTable.fnUpdate(a, nRow, 4, false);
                oTable.fnUpdate(b, nRow, 5, false);
                oTable.fnUpdate(c, nRow, 6, false);
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, 7, false);

                oTable.fnDraw();
            }

            var oTable = $('#editable-sample').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
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
                    var aiNew = oTable.fnAddData(['', '', '', '','','','',
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