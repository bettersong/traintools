<link rel="stylesheet" href="/public/plugins/editor/themes/default/default.css?<?=rand(1,99999)?>" />
<link rel="stylesheet" href="/public/plugins/editor/plugins/code/prettify.css?<?=rand(1,99999)?>" />
<script charset="utf-8" src="/public/plugins/editor/kindeditor.js?<?=rand(1,99999)?>"></script>
<script charset="utf-8" src="/public/plugins/editor/lang/zh_CN.js??<?=rand(1,99999)?>"></script> 
<script charset="utf-8" src="/public/plugins/editor/plugins/code/prettify.js?<?=rand(1,99999)?>"></script>  
<script>
    KindEditor.ready(function(K) {
        var editor1 = K.create('textarea[name="content1"]', {
            cssPath : '/public/plugins/editor/plugins/code/prettify.css?<?=rand(1,99999)?>',
            uploadJson : '/public/plugins/editor/php/upload_json.php',
            fileManagerJson : '/public/plugins/editor/php/file_manager_json.php',
            allowFileManager : true,
			
			resizeType : 1,
			pasteType : 1,  //粘贴 没格式
			allowPreviewEmoticons : false,
			allowImageRemote:false,  //网络图片关闭
			allowImageUpload : true, //本地图片开启
			

            afterCreate : function() {
                var self = this;
                K.ctrl(document, 13, function() {
                    self.sync();
                    K('form[name=example]')[0].submit();
                });
                K.ctrl(self.edit.doc, 13, function() {
                    self.sync();
                    K('form[name=example]')[0].submit();
                });
            }
        });
        prettyPrint();
    });
	
</script>
<textarea id="content1" name="content1" style="width:700px;height:250px;visibility:hidden;"><?=$editor_init?></textarea>