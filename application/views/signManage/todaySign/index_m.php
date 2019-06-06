<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>高铁检修综合管理平台</title>
    <link href="/public/css/bootstrap.min_m.css?1.0" rel="stylesheet" />
    <link href="/public/css/style_m.css?1.0" rel="stylesheet" />
    <link href="/public/css/ui.css?<?=rand(1,99999)?>" rel="stylesheet" />
    <script src="/public/js/jquery-1.8.3.min.js"></script>
    <script src="/public/js/laydate/laydate.js?1.0"></script>
</head>
<body>
<div class="train-title">
        <div class="train-logo"><span class="train-v">考勤管理</span></div>
</div>
<div style="max-width:350px; margin:10px auto;">
    <P style="margin-top:20px;">请选择日期：<input type="text" id="test1" value="">
    <button class="form-submit btn-orange" type="submit" id="btn" style="width:20%;height:40px;font-size:16px">确 定</button>
    </P>
</div>
        <div class="container-fluid" style="margin-bottom:80px;">
            <div class="row-fluid">
                <div class="span11">
                    <div class="widget purple">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i>考勤管理</h4>
                        </div>
                        <div class="widget-body">
                            <div>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <h6 style="color:#000">负责人：XXXX</h6>
                                    </div>
                                    <div class="btn-group pull-right">
                                        <h6 style="color:#000">关联工单号：XXXXX</h6>
                                    </div>
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>人员编号</th>
                                        <th>姓名</th>
                                        <th>部门</th>
                                        <th>职位</th>
                                        <th>签到情况</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($TodaySign as $key => $value) { ?>
                                    <tr class="">
                                        <td><?=$value['twamPersonId']?></td>
                                        <td><?=$value['pManageName']?></td>
                                        <td><?=$value['bManageBranch']?></td>
                                        <td class="center"><?=$value['zManagePosition']?></td>
                                        <td><?php if($value['twamAttendance']==1) echo"是";else echo"否";?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <h6 style="color:#000">应签人数：<?=$TodaySign_amount?></h6>
                                    </div>
                                    <div class="btn-group pull-center" style="margin:0 20px">
                                        <h6 style="color:#000">实签人数：<?=$attendance_amount?></h6>
                                    </div>
                                    <div class="btn-group pull-center">
                                        <h6 style="color:#000">缺签人数：<?=$NoSign_amount?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
   laydate.render({
        elem: '#test1',
        done: function(value, date, endDate){
            $('#test1').change();  
            //console.log(value); //得到日期生成的值，如：2018-08-18
            oDate = value;
        }
    });
   $('#btn').click(function(){
   	//console.log(oDate);
    $.ajax({
        async:false,
        type: "post",
        data: {
            "oDate":oDate,
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_add.php?",
        success: function (msg) {
                 alert('success'); 
                 console.log(msg);
              },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
            console.log(oDate);
        }
    });
   })
</script>