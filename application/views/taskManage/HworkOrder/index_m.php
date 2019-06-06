<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
        <title>工单列表</title>
        <link rel="stylesheet" href="/public/css/mui.min.css?1.0">
        <link rel="stylesheet" href="/public/css/ui.css?1.1">
        <link rel="stylesheet" href="/public/css/app.css" />
        <link rel="stylesheet" href="/public/css/mui.picker.min.css" />
        <style>
            
            h5.mui-content-padded {
                margin-left: 3px;
                margin-top: 20px !important;
            }
            h5.mui-content-padded:first-child {
                margin-top: 12px !important;
            }
            .mui-btn {
                font-size: 16px;
                padding: 8px;
                 
            }
            .ui-alert {
                text-align: center;
                padding: 20px 10px;
                font-size: 16px;
            }
            * {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
            }
            setline{
            height:50px;
            line-height: 50px;
           }
           .list{display: flex;line-height: 35px;color:#666;font-size: 13px;clear:both;}
           .list li{text-align: center;width:70px;}
           .list li:nth-child(2){width:90px;}
           tr.today{color:#3385ff;}
           .sub:nth-child(odd){background: #f5f7fa}
           .firstLi{ margin: 10px 0 00;
            color: #fff;
            padding: 5px 10px;
            background: #3385ff;}
           .toolsBag{margin-top:;}
           .link{color:#3f51b5;}
           .newLi{color:red;}
           table tr{padding: 2px 5px !important;}
           table tr td{}
            table tr .td1{width:40px;}
           table tr .td2{width:105px;}
            table tr .td3{width:80px;}
           table tr .td4{width:110px;}
            table tr .td5{}
            
          table tr th{}
        </style>
    </head>

    <body>
        <!-- <div class="mui-navbar-inner mui-bar mui-bar-nav">
                <button type="button" class="mui-left mui-action-back mui-btn  mui-btn-link mui-btn-nav mui-pull-left">
                    <span class="mui-icon mui-icon-left-nav"></span>
                </button>
                <h1 class="mui-center mui-title">工单列表</h1>
            </div> -->
            <div class="mui-content mui-scroll-wrapper"><!--下拉刷新容器,包含整个body内容-->
        <div class="mui-content" >
            <div class="mui-page-content" >
                <!-- <div class="mui-scroll-wrapper" style="margin-top:;"> -->
                 <div class="mui-content-padded"  style="background-color: #fff;background-position: right;z-index: 999;"> 
                <button style="background-color: #fff;background: url(/public/images/data1.png) no-repeat;background-position: right;z-index: 999;" data-options='{"type":"date"}' class="btn4 mui-btn mui-btn-block">选择日期 ...</button>
                </div>

                <div class="navbox">
                            <div class="firstLi" style="margin-left:  ;">施工计划列表:</div>
                        </div>

                <table style="width: 100%;" class='toolsBag' id='ulBox'>
                        
                         <tr class="mui-table-view mui-table-view-chevron list">
                            <th class="td1">编号</th>
                            <th class="td2">天窗单元名称</th>                            
                            <th class="td3">计划时间</th>
                            <th class="td4">起讫时间</th>
                            <th class="td5"></th>
                        </tr>
                        
                        
                        <?php if(count($AllOrder)==0)echo '<tr><td style="text-align: center;color:#f30;">无工单<td></tr>'; foreach ($AllOrder as $key => $value) { ?>
                        <tr class="mui-table-view mui-table-view-chevron list sub <?php if( $value['JiHuaDate']==date("Y-m-d") )echo 'today';?>">
                            <td class="td1"><?=$value['twOrderId']?></td>
                            <td class="td2"><?=$value['TianChuangDYMC']?></td>
                            <td class="td3"><?=$value['JiHuaDate']?></td>
                            <td class="td4"><?=$value['QiQiSJ']?></td>
                            <td class="td5"><a href="/taskPlan/taskSummary/index_m&twOrderId=<?=$value['twOrderId']?>&orderType=history" class="mui-navigate-right link"></a></td>
                        </tr>
                        <?php }  ?>  
                        
                        </table>
                  </div>  
                </div>
</div>
</div>

<script src="/public/js/mui.min.js"></script>
<script src=" /public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.picker.min.js"></script>
<script type="text/javascript">
 var AllOrderArray = <?=json_encode($AllOrder)?>;
 //console.log(AllOrderArray);
mui.init();
mui('.mui-scroll-wrapper').scroll();
//var subLis = '';
(function($) {
    $.init();
    var result = $('#result')[0];
    var btns = $('.btn4');
    mui(".mui-content-padded").on('tap', '.btn4', function(event){
    // btns.addEventListener('tap', function() {
        var _self = this;
        //console.log(_self);
        if(_self.picker) {
            //console.log(111);
            _self.picker.show(function (rs) {
                _self.picker.dispose();
                _self.picker = null;
                //console.log(222);
            });
        } else {
            
            var optionsJson = this.getAttribute('data-options') || '{}';
            var options = JSON.parse(optionsJson);
            var id = this.getAttribute('id');
            _self.picker = new $.DtPicker(options);
            _self.picker.show(function(rs) {
                date = rs.text;
                //console.log(rs.text);
            var subs = '';
            $.each(AllOrderArray,function(index,row){
                //alert(date+ " "+row['JiHuaDate']);
                if(row['JiHuaDate'] == date){
                    var url = "/taskPlan/taskPlan/taskPlanDetail/index_m&orderType=history&twOrderId="+row['twOrderId'];
                    subs += '<tr class="mui-table-view mui-table-view-chevron list sub">'+'<td class="td1">'+row['twOrderId']+'</td>'+'<td class="td2">'+row['TianChuangDYMC']+'</td>'+'<td class="td3">'+row['JiHuaDate']+'</td>'+'<td class="td4">'+row['QiQiSJ']+'</td>'+'<td class="td5"><a href="'+url+'" class="mui-navigate-right link"></a></td>'+'</tr>';
                } 
            });
            
            subs = '<tr class="mui-table-view mui-table-view-chevron list">'+
                            '<th class="td1">编号</th>'+
                            '<th class="td2">天窗单元名称</th>'+
                            '<th class="td3">计划时间</th>'+
                            '<th class="td4">起讫时间</th>'+
                            '<th class="td5"> </th>'+
                            '</tr>'+subs;
            // if(AllOrderArray['JiHuaDate'] != date){
            //     mui.alert("未找到该天工单！");

            // }
            //var jihuaDate = $()
            ////console.log(subLis);
            //document.getElementById('ulBox').innerHTML='';
            document.getElementById('ulBox').innerHTML=subs;
                _self.picker.dispose();
                _self.picker = null;
            });
        }
        
    }, false);

})
(mui);
</script>
</body>
</html>