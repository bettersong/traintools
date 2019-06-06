<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>工具包详情</title>
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="/public/css/ui.css?1.1">
    <script src="/public/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/mui.min.js"></script>
    <link href="/public/css/bootstrap.min_m.css?1.0" rel="stylesheet" />
    <link href="/public/css/style_m.css?1.0" rel="stylesheet" />
    <link rel="stylesheet" href="/public/css/mui.min.css?<?=rand(1,99999)?>">
    
    <style>
	.table th, .table td{padding:2px;}
	.widget{margin-bottom:10px;}
	.table th, .table td {
		padding: 8px 2px;
		text-align: center;
	}
    .active{
        display:block;
    }
	.dataTables_length{display:none !important;}
	.widget-body .dataTables_info, .widget-body .dataTables_paginate{
		width: 250px !important;
    	margin-right: -35px !important;
	}
	#editable-sample1_info{display:none;}
    ul{text-align: center;margin-top:20px;}
    ul li{float: left;
    width: 25%;}
    ul li a{}
    img.gray{ opacity: 0.3;}
	</style>
</head>
<body class="fixed-top" style="background:#fff !important">
<!-- <div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span>
    </button>
    <h1 class="mui-center mui-title"><?=$directionTxt?>工具包列表</h1>
</div> -->

<div class="mui-page-content" >
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll" style="">
        
          <ul>
            <?php foreach($toolbagDetailArr as $index=>$value){ 

                $creatTime = $todaytime=strtotime($value['read_time']);//$todaytime=strtotime(“today”)，;
                $differTime = ( time() -$creatTime )/60;
                
                ?>
             
              <li>
               
                <a href="/toolsToolbag/toolsToolbag/toolbagDetail_m&toolBagId=<?=$value['tbid']?>">
                    <div class="grids-grid3">                   
                        <div class="grids-grid3-cont">
                            <div class="grids-grid-icon">
                            <img class="<?php if( $differTime>10 )echo 'gray' ?>" style="width: 35px; height: 35px;margin: 10px 0 0;" src="/public/images/icon-png/gjb3.png" alt=""></div>
                            <p class="grids-grid-label"><?=$value['tb_name']?><?php if( $differTime>10 )echo '<br>离线';else echo '<br>在线'; ?></p>
                            <!--<p class="grids-grid-num"> <?=$Tworkorder_mount?> 0条</p>-->
                        </div>
                    </div>
                </a>
              </li>


            <?php } ?>      
             </ul>
          </div>
        </div>
           

    </div>
</div>
</div>
<script>
    var CURRENT_DIR = "<?=CURRENT_DIR?>"; //获取js格式的当前路径
    var toolbagDetailArr = <?=json_encode($toolbagDetailArr)?>;
    console.log(toolbagDetailArr);
</script>
<script src="/public/js/jquery.dataTables.js?<?=rand(1,9999)?>"></script>
<script src="/public/js/DT_bootstrap.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>
<script src="/public/js/common-scripts.js?v=0.101"></script>
<!-- <script src="/public/js/bootstrap-multiselect.js?<?=rand(1,99999)?>"></script> -->
<script type="text/javascript">
    var groupCheckbox=$(".out");
    //console.log(groupCheckbox);
    for(i=0;i<groupCheckbox.length;i++){
        if(groupCheckbox[i].checked){
            var val =groupCheckbox[i].value;
            alert(val );
        }
    }

    //console.log(outValue);
//         $.ajax({
//         async:false,
//         type: "post",
//         data: {
//             "userName":userName,
//             "contact":contact,
//         },
//         dataType: 'json',
//         url: "<?=CURRENT_DIR?>/index_add.php?",
//         success: function (msg) {
//         if(contact==''){mui.alert('电话号码不能为空！'); return false;}
//           else if(contact.length!=11){mui.alert('电话号码格式不正确！'); return false;}
//               else mui.alert("修改成功！");
//            console.log(msg);
//             $('.phoneNumber').html(contact);
//           },
//         error: function(msg){
//             mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
//         }
    
// });

</script>
<script>
   
//出库分页
$('#editable-sample1').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'r>t<'row-fluid'<'span8'i><'span8'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    
                    "oPaginate": {
                        "sPrevious": "",
                        "sNext": ""
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });
$('#editable-sample2').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'r>t<'row-fluid'<'span8'i><'span8'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    
                    "oPaginate": {
                        "sPrevious": "",
                        "sNext": ""
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });
</script>
</body>
</html>
</body>