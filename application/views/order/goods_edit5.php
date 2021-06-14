<!DOCTYPE html>
<html class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>我的管理后台-窝行我述</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport"
		  content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
	<link rel="stylesheet" href="<?= STA ?>/css/font.css">
	<link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
	<script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
	<script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
	<link rel="stylesheet" href="<?= STA ?>/css/bootstrap.css">
	<script type="text/javascript" src="<?= STA ?>/js/bootstrap.js"></script>
	<link rel="stylesheet" href="<?= STA ?>/css/summernote/summernote.css">
	<script type="text/javascript" src="<?= STA ?>/js/summernote/summernote.js"></script>
</head>
<body>
<div class="layui-fluid" style="padding-top: 66px;">
	<div class="layui-row">
		<form method="post" class="layui-form" action="" name="basic_validate" id="tab">
<!--			<div class="layui-form-item">-->
<!--				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">-->
<!--					<span class="x-red">*</span>房源及均价分析报告详情-->
<!--				</label>-->
<!--				<div class="layui-input-inline" style="width: 1000px;">-->
<!--					<div id="summernot"></div>-->
<!--				</div>-->
<!--			</div>-->
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>房源及均价分析报告详情
				</label>
				<div class="layui-input-inline" style="width: 610px;">
					<textarea id="gcontent" name="gcontent" placeholder="请输入内容" lay-verify="gcontent" class="layui-textarea"><?php echo $gcontent4 ?></textarea>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label" style="width: 30%;">
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<span class="x-red">※</span>请确认输入的数据是否正确。
				</div>
			</div>
<!--			<textarea id="gcontent" name="gcontent" style="display: none">--><?php //echo $gcontent4 ?><!--</textarea>-->
			<input type="hidden" id="state" name="state" value="5">
			<input type="hidden" id="id" name="id" value="<?php echo $id ?>">
			<div class="layui-form-item">
				<label for="L_repass" class="layui-form-label" style="width: 30%;">
				</label>
				<button class="layui-btn" lay-filter="add" lay-submit="">
					确认提交
				</button>
			</div>
		</form>
	</div>
</div>
<script>
layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#starttime' //指定元素
            });
        });
</script>
<script>
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload1'
            ,url: '<?= RUN . '/upload/pushFIle' ?>'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#gimgimg').attr('src', result); //图片链接（base64）
                    var img = document.getElementById("gimgimg");
                    img.style.display="block";
                });
            }
            ,done: function(res){
                if(res.code == 200){
                    $('#gimg').val(res.src); //图片链接（base64）
                    return layer.msg('上传成功');
                }else {
                    return layer.msg('上传失败');
                }
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
        //多图片上传
        upload.render({
            elem: '#uploads'
            ,url: '<?= RUN . '/upload/pushFIle' ?>'
            ,multiple: true
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                var timestamp = (new Date()).valueOf();
                obj.preview(function(index, file, result){
                    $('#imgnew').append('<img id="avaterimg'+ timestamp +'" style="width:100px;height:100px;" src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img"><p id="avaterimgp'+ timestamp +'" style="margin-top: -70px;margin-left: -43px;" class="layui-btn layui-btn-xs layui-btn-danger demo-delete" onclick="jusp('+ timestamp +')">删除</p>')
                });
            }
            ,done: function(res){
                //上传完毕
                if(res.code == 200){
                    var timestamp = (new Date()).valueOf();
                    $('#newinp').append('<input type="hidden" name="avater[]" id="avater'+ timestamp +'" value="'+ res.src +'">')
                    return layer.msg('上传成功');
                }else {
                    return layer.msg('上传失败');
                }
            }
        });
    });
    function jusp(index) {
        $("#avater"+index).remove();
        $("#avaterimg"+index).remove();
        $("#avaterimgp"+index).remove();
    }
</script>
<script>
    layui.use(['form','layedit', 'layer'],
        function () {
            var form = layui.form,
                layer = layui.layer;
            var layedit = layui.layedit;
            layedit.set({
                uploadImage: {
                    url: '<?= RUN . '/upload/pushFIletextarea' ?>',
                    type: 'post',
                }
            });
            var editIndex1 = layedit.build('gcontent', {
                height: 300,
            });
            //自定义验证规则
            form.verify({
                gcontent: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex1);
                    if ($('#gcontent').val() == "") {
                        return '请输入内容信息。';
                    }
                },
            });

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/order/goods_save_edit1' ?>",
                        data: $('#tab').serialize(),
                        async: false,
                        error: function (request) {
                            alert("error");
                        },
                        success: function (data) {
                            var data = eval("(" + data + ")");
                            if (data.success) {
                                layer.msg(data.msg);
                                setTimeout(function () {
                                    cancel();
                                }, 2000);
                            } else {
                                layer.msg(data.msg);
                            }
                        }
                    });
                }
            });
        });

    function cancel() {
        //关闭当前frame
        xadmin.close();
    }
</script>
<!--<script>-->
<!--$(document).ready(function() {-->
<!--        var detail=  $('#gcontent').val();-->
<!--        $('#summernot').summernote('code',detail);-->
<!--    });-->
<!--    $(document).ready(function() {-->
<!--        $("#summernot").summernote({-->
<!--            lang : "zh-CN",-->
<!--            height: 666,-->
<!--            focus: true,-->
<!--            lang: 'zh-CN',-->
<!--			onImageUpload: function(files, editor, $editable) {-->
<!--				uploadSummerPic(files[0], editor, $editable);-->
<!--			}-->
<!--        })-->
<!--    });-->
<!--    function uploadSummerPic(file, editor, $editable) {-->
<!--    var fd = new FormData();-->
<!--    fd.append("file", file);-->
<!--    $.ajax({-->
<!--        type:"POST",-->
<!--        url:"/index.php/upload/upload_img",-->
<!--        data: fd,-->
<!--        cache: false,-->
<!--        contentType: false,-->
<!--        processData: false,-->
<!--        success: function (data) {-->
<!--                    var obj = JSON.parse(data);-->
<!--                    url=obj.data.src;-->
<!--                    console.log(obj.data.src);-->
<!--            editor.insertImage($editable, url);-->
<!--        }-->
<!--    });-->
<!--}-->
<!--    layui.use(['form','layedit', 'layer'],-->
<!--        function () {-->
<!--            var form = layui.form,-->
<!--                layer = layui.layer;-->
<!--            var layedit = layui.layedit;-->
<!---->
<!---->
<!--            $("#tab").validate({-->
<!--                submitHandler: function (form) {-->
<!--                var detail = $('#summernot').summernote('code');-->
<!--                $('#gcontent').val(detail);-->
<!--                    $.ajax({-->
<!--                        cache: true,-->
<!--                        type: "POST",-->
<!--                        url: "--><?//= RUN . '/order/goods_save_edit1' ?><!--",-->
<!--                        data: $('#tab').serialize(),-->
<!--                        async: false,-->
<!--                        error: function (request) {-->
<!--                            alert("error");-->
<!--                        },-->
<!--                        success: function (data) {-->
<!--                            var data = eval("(" + data + ")");-->
<!--                            if (data.success) {-->
<!--                                layer.msg(data.msg);-->
<!--                                setTimeout(function () {-->
<!--                                    cancel();-->
<!--                                }, 2000);-->
<!--                            } else {-->
<!--                                layer.msg(data.msg);-->
<!--                            }-->
<!--                        }-->
<!--                    });-->
<!--                }-->
<!--            });-->
<!--        });-->
<!---->
<!--    function cancel() {-->
<!--        //关闭当前frame-->
<!--        xadmin.close();-->
<!--    }-->
<!--</script>-->
</body>
</html>
