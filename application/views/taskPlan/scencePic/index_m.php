<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>现场照片</title>
		<link rel="stylesheet" href="/public/css/mui.min.css">
		<link rel="stylesheet" href="/public/css/ui.css?1.1">
		<style>
		.uploadImg{display:block;width:50px;height:50px;background:url(/public/images/xiangji1.png) no-repeat center/100% 100%;margin:30% auto;}
        #btn{opacity: 0;width:100%;height:100%;position:absolute;top:initial;left:0px;}
        .imgShow{background: #fff !important}
        .imgShow li{padding: 0px !important;background: #fff !important;width: 30%;margin: 2% 0 0 2% !important;height: 125px;border: 1px solid #eee;height: 120px;line-height: 120px;}
        .imgShow li img{width: 100px;height: 100px;border-radius: 100px;}
        .progress {position: relative;padding: 1px;border-radius: 3px;margin: 60px 0 0 0;}
        .bar {background-color: green;display: block;width: 0%;height: 20px;border-radius: 3px;}
        .percent {position: absolute;height: 20px;display: inline-block;top: 3px;left: 2%;color: #fff}
		img.delete{width: 16px !important;height: 16px !important;position: absolute;top: 1px;right: 1px;}
		.showImg{width:100%;height:100%;background: rgba(0,0,0,0.5);}
   		.showImg img{width: 100%;height:300px;}
	    </style>
	</head>

<body>

<div class="mui-scrollbar mui-scrollbar-vertical showImg" style="transition-duration: 500ms; opacity: 0;"><div class="mui-scrollbar-indicator" style="transition-duration: 0ms; display: block; height: 271px; transform: translate3d(0px, 394px, 0px) translateZ(0px); transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);"></div></div>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">现场照片</h1>
</header>
<div class="mui-content" style='background: #fff'>
    <ul  style="border:0;" class="mui-table-view mui-grid-view mui-grid-9 imgShow" id="ul_pics">
       <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
	   <label for="fileinp" class="uploadImg">
	   <input type="file" id="btn" multiple="multiple" accept="image/*" capture="camera">
       </label>
	   </li>
    </ul> 
</div>
</div>
 
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/mui.min.js"></script>
<script src="/public/js/plupload.full.min.js"></script>
<script>
	mui.init();
	mui('.mui-scroll-wrapper').scroll();
	var twOrderId = <?=$_GET['twOrderId']?>;
	var pictureResource = <?=$pictureResourceJson?>;
	var path = '/public/upload/senceImg/';
	console.log(pictureResource);
	console.log(twOrderId);
	var personId = <?= json_encode($_SESSION['userInfo']['pManageId'])?>;
	var imgList = '';
	//显示图片
	$.each(pictureResource,function(index,row){
		imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><img delId='+row['pictureId']+' class="delete" src="/public/images/del4.png" />'+'<img class="mainImg" src="'+ path+row['pictureResource']+'">'+'</li>';
	});
	imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">'+'<label for="fileinp" class="uploadImg">'+'<input type="file" id="btn" accept="image/*" capture="camera">';
	   +'</li>';
	$('.imgShow').html(imgList);
    
var uploader = new plupload.Uploader({ //创建实例的构造方法
	runtimes: 'html5,flash,silverlight,html4', 
	browse_button: 'btn',
	url: "<?=CURRENT_DIR?>/ajax.php", 
	filters: {
		max_file_size: '1mb', //最大上传文件大小
		mime_types: [ //允许文件上传类型
			{
				title: "files",
				extensions: "jpg,png,gif,ico"
			}
		]
	},
	multi_selection: true, //true:ctrl多文件上传, false 单文件上传
	init: {
		FilesAdded: function(up, files) { //文件上传前
			if ($("#ul_pics").children("li").length > 30){
				mui.alert("您上传的图片太多了！");
				uploader.destroy();
			} else {
				var li = '';
				plupload.each(files, function(file) { //遍历文件
					li += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3" id="' + file['id'] + '"><div class="progress"><span class="bar"></span><span class="percent">0%</span></div></li>';
				});
				$("#ul_pics").append(li);
				uploader.start();
			}
		},
		UploadProgress: function(up, file) { //上传中，显示进度条
			var percent = file.percent;
			console.log(percent);
			$("#" + file.id).find('.bar').css({
				"width": percent + "%"
			});
			$("#" + file.id).find(".percent").text(percent + "%");
		},
		FileUploaded: function(up, file, info){ //文件上传成功
			var data = eval("(" + info.response + ")");
			$("#" + file.id).html("<div class='img'><img src='" + '<?=CURRENT_DIR?>'+'/'+data.pic+ "'/></div><p>" + data.name + "</p>");
			console.log('<?=CURRENT_DIR?>'+'/'+data.pic);
			console.log(data.pic);
			var imgArr = data.pic.split('/')[7];
			//var pic_URL = picURL[]
			//console.log(picURL);
			$.ajax({
			url: '<?=CURRENT_DIR?>/index_add.php?',
			type: 'POST',
			dataType: 'json',
			data: {
				'imgArr':imgArr,
				'twOrderId':twOrderId,
				'personId':personId,
			},
		})
		.done(function(msg) {
		var newImg = msg;
		var imgList='';
		$.each(newImg,function(index,row){
	     imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">'+'<img src="'+ path+row['pictureResource']+'">'+'</li>';
	      });
		imgList += '<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">'+'<label for="fileinp" class="uploadImg">'+'<input type="file" id="btn" accept="image/*" capture="camera">'+'</li>';
	    $('.imgShow').html(imgList);
		location.reload();
		})
		.fail(function(msg){
			//console.log(msg);
			console.log('error');
		})
		},
		Error: function(up, err) { //上传出错
			mui.alert(err.message);
		}
	}
});
uploader.init();
//删除图片
$("img.delete").click(function(e) {
	var delid = $(this).attr("delId");

	var delObj = $(this).parent("li");
    
	$.ajax({
	  url: '<?=CURRENT_DIR?>/index_del.php?',
	  type: 'POST',
	  dataType: 'json',
	  data: {
		  'delid': delid,
	  },
	  success: function (msg){
		delObj.remove();
		mui.toast("删除成功");
	  },
	  error: function(msg){
		mui.alert(msg.status + "服务繁忙，请刷新或稍后再试。");
		  }
  })
});

</script>
</body>
</html>