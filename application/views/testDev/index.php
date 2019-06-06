<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>高铁检修综合管理平台</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="Mosaddek" name="author" />
  <script src="/public/js/jquery-1.8.3.min.js"></script>

  <style>
  	 li{  
	   list-style-type:none;
	   line-height:26px;
	   padding: 2px 5px;
	   margin-bottom:5px;
	   background:#094;
	   color:#fff;
	   font-size:16px;
	   cursor:pointer;
	    
    }  
  </style>
</head>

<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
    <div style="width:400px; margin:20px auto 500px;">
        <ul >
            <li id="testToolbag">模拟更新工具包数据</li>
            <li>模拟...</li>
        </ul>
    </div>
    
    
    
<script>
$("#testToolbag").click(function(e) {
   // testDev("testToolbag");
   window.location.href="/testDev/index&action="+$(this).attr("id")+"&orderId=5207";
   
});



function testDev(action){
	
	$.ajax({
        async:false,
        type: "post",
        data: {
            "action":action,
             
        },
        dataType: 'json',
        url: "<?=CURRENT_DIR?>/index_action.php",
        success: function (msg) {
              //alert(msg);
              if(msg != "error")alert("操作成功!");
              
        },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");

        }
    }); 
}


</script>   
 
</body></html>