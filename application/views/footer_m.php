</div></div>
<?php
    $today = date('Y-m-d');
    $data['JiHuaDate'] =  $today;
    $mysqlModel_order = new Model("tworkorder");

        //print_r($_SESSION['userInfo']);
        $userName = $_SESSION['userInfo']['pManageName'];
        $customCondition = " and ZhuTiZYFZR like '$userName' ";

        $roleEnName = $_SESSION['userInfo']['roleEnName'];
        //echo ' roleEnName:'.$roleEnName;
        $TworkOrderALL = array();
        //只有负责人可以看今日工单
        if( $roleEnName =="taskorder_charge" ){//负责人
            $TworkOrderALL = $mysqlModel_order ->query("select * from `tworkorder` where JiHuaDate='$today'  and ZhuTiZYFZR like '%$userName%'  ");//selectByCondition($data,$customCondition);
        }
        //管理员及领导
        else if( $roleEnName =="leader_commom" || $roleEnName =="admin_leve1" || $roleEnName =="admin_leve2" || $roleEnName =="admin_leve3"  ){
            //$TworkOrderALL = $mysqlModel_order ->query("select * from `tworkorder` where JiHuaDate='$today' ");//selectByCondition($data,$customCondition);
        }
        $twOrderId_today = $TworkOrderALL[0]['twOrderId'];
?>
<style>
    .mui-bar.mui-bar-nav,.mui-content1,.train-title{display: none;}
    .mui-bar-nav~.mui-content {
      padding-top:0;
     }
	.noauth{opacity: 0.4;}
    #submit_confirm.mui-btn-success{font-size:1.0em;font-weight:600;}
</style>
<!-- BEGIN FOOTER -->
<div class="tab-bar tab-bottom nav4" id="nav4_ul">
<nav>
    <div id="nav4_ul" class="nav_4">
  <ul>
  <li>
    <a class="tab-button tab1" href="/index/index_m"><i class="tab-button-icon icon icon-home"></i><span class="tab-button-txt">首页</span></a>
    </li>
    <li>
    <a class="tab-button tab2" href="/taskManage/HworkOrder/index_m"><i class="tab-button-icon icon icon-exhibition" style="background-size:30px"></i>
    <span class="tab-button-txt">工单查看</span>
    <!-- <dl>
            <dd><a href="/taskPlan/taskPlan/index_m" ><span>今日工单</span></a></dd>
            <dd><a href="/taskManage/HworkOrder/index_m"><span>工单列表</span></a></dd>
    </dl>   -->                          
    </a>
    </li>
    <li>
    <a class="tab-button tab3" href='/personLocal/RealTimeLocal/index_m&localname=0&twOrderId=<?=$twOrderId_today?>'><i class="tab-button-icon icon icon-service"></i><span class="tab-button-txt">定位管理</span>
    
    </a>
    </li>
    <li>
    <a class="tab-button tab4" href="/my/mine/index_m"><i class="tab-button-icon icon icon-my"></i><span class="tab-button-txt">我的</span>
    </a>
    </li>
    
    </ul>
    </div>
    </nav>
    <div id="nav4_masklayer" class="masklayer_div">&nbsp;</div>
</div>
<script>window.jQuery || document.write('<script src="/public/js/jquery-1.8.3.min.js">\x3C/script>')</script>
<!--<script src="/public/js/jquery-1.8.3.min.js"></script>-->
<script>
//下拉刷新
//var flushcon = '<div id="pullrefresh" class="mui-content mui-scroll-wrapper"></div>';//下拉刷新容器
//console.log(flushcon);
//$("body").prepend(flushcon);
var twOrderId_today  =<?=$twOrderId_today?>;
console.log(twOrderId_today);
$(function(){
    
    $('.tab3').attr('href','/personLocal/RealTimeLocal/index_m&localname=0&twOrderId=<?=$twOrderId_today?>');
    console.log($('.tab3').attr('href'));
})
var nav4 =(function(){
    bindClick = function(els, mask){
        if(!els || !els.length){return;}
        var isMobile = "ontouchstart" in window;
        for(var i=0,ci; ci = els[i]; i++){
            ci.addEventListener("click", evtFn, false); 
        }

        function evtFn(evt, ci){
            ci =this;
            for(var j=0,cj; cj = els[j]; j++){
                if(cj != ci){
                    //console.log(cj);
                    cj.classList.remove("on");
                }
            }
            if(ci == mask){mask.classList.remove("on");return;}
            switch(evt.type){
                case "click":
                    var on = ci.classList.toggle("on");
                    mask.classList[on?"add":"remove"]("on");
                break;
            }
        }
        mask.addEventListener(isMobile?"touchstart":"click", evtFn, false);
    }
    return {"bindClick":bindClick};
})();
</script>

        
        
        
        
<script type="text/javascript">
// nav4.bindClick(document.getElementById("nav4_ul").querySelectorAll("li>a"), document.getElementById("nav4_masklayer"));
</script>
<script>
//处理无权限项的事件及样式
//无权限的样式
$(".noauth,.noauth a").each(function(index, element) {
    $(this).attr("href","#");//取消链接
});
//无权限的事件
$(".noauth,.noauth a").on('click',function(e) {
	//layer.alert("您暂无该项权限，请联系管理员！", {icon:2,title: '【提示】'});
	mui.alert("<span style='color:#f30'>抱歉，您暂无该项权限！</span>");
	e.stopPropagation();
	e.preventDefault();   
	return false;
});

//权限控制功能：根据遍历该用户对应角色被禁止的权限集合，是否在被点击按钮的class类auth_xxx(xxx为add,edit,del)中，如果在则无权限。
var auths_page = <?=json_encode($auths_page)?>;//该用户对应角色被禁止的权限集合
$(".auth_add, .auth_edit, .auth_del").on("click",function(e) {
	var hasAuth = true;//权限用户标记
	var clickObj =$(this);
	//遍历被禁止的权限
   $.each(auths_page,function(index,value){
     	forbidAuth = "auth_"+value;//被禁止的权限
		//alert( clickObj.attr("class")+"  "+forbidAuth);
		if( clickObj.hasClass(forbidAuth) ){//如果点击的按钮包含禁止权限
			mui.alert("<span style='color:#f30'>抱歉，您暂无该项权限！</span>");
			hasAuth =false;//标记为无权限
		}
   });
   if(!hasAuth){//如果无权限则返回并阻止事件冒泡
	  e.stopPropagation();
   	  e.preventDefault(); 
	  return false; 
   }
});


/** 下拉刷新 **/
	//向每个页面写入下拉刷新的容器
	//$("body").prepend('<div id="pullrefresh" class="mui-content mui-scroll-wrapper">');
	//$("body").append('</div>');
	
</script>

 

<!-- <script src="/public/js/mui.min.js" type="text/javascript"></script> -->
<script>
    
    mui.init({
        pullRefresh: {
            container: '#pullrefresh',
            down: {
                style:'circle',
                callback: pulldownRefresh
            }
            
        }
    });
    
    
    /**
        * 下拉刷新具体业务实现
        */
    function pulldownRefresh() {
        setTimeout(function() {
            //addData();
            mui.toast("刷新成功");
            mui('#pullrefresh').pullRefresh().endPulldownToRefresh();
            
            location.reload();
        }, 1000);
    }
    //
    mui('body').on('tap', 'a', function() {
        window.top.location.href = this.href;
    });

</script>

<!-- END FOOTER --> 
</body></html>