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
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">
					<span class="x-red">*</span>区域分析 --- 中山区
				</label>
				<div class="layui-input-inline" style="width: 1000px;">
					<div id="summernot1"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">
					<span class="x-red">*</span>区域分析 --- 西岗区
				</label>
				<div class="layui-input-inline" style="width: 1000px;">
					<div id="summernot2"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">
					<span class="x-red">*</span>区域分析 --- 沙河口区
				</label>
				<div class="layui-input-inline" style="width: 1000px;">
					<div id="summernot3"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">
					<span class="x-red">*</span>区域分析 --- 甘井子区
				</label>
				<div class="layui-input-inline" style="width: 1000px;">
					<div id="summernot4"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">
					<span class="x-red">*</span>区域分析 --- 高新园区
				</label>
				<div class="layui-input-inline" style="width: 1000px;">
					<div id="summernot5"></div>
				</div>
			</div>
<!--			<div class="layui-form-item">-->
<!--				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">-->
<!--					<span class="x-red">*</span>区域分析 --- 旅顺口区-->
<!--				</label>-->
<!--				<div class="layui-input-inline" style="width: 1000px;">-->
<!--					<div id="summernot6"></div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="layui-form-item">-->
<!--				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">-->
<!--					<span class="x-red">*</span>区域分析 --- 开发区-->
<!--				</label>-->
<!--				<div class="layui-input-inline" style="width: 1000px;">-->
<!--					<div id="summernot7"></div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="layui-form-item">-->
<!--				<label for="L_pass" class="layui-form-label" style="width: 40%;font-size: 20px;text-align: -webkit-center;">-->
<!--					<span class="x-red">*</span>区域分析 --- 金州区-->
<!--				</label>-->
<!--				<div class="layui-input-inline" style="width: 1000px;">-->
<!--					<div id="summernot8"></div>-->
<!--				</div>-->
<!--			</div>-->
			<div class="layui-form-item">
				<label class="layui-form-label" style="width: 30%;">
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<span class="x-red">※</span>请确认输入的数据是否正确。
				</div>
			</div>
			<textarea id="content4" name="content4" style="display: none"><?php echo $content4 ?></textarea>
			<textarea id="content5" name="content5" style="display: none"><?php echo $content5 ?></textarea>
			<textarea id="content6" name="content6" style="display: none"><?php echo $content6 ?></textarea>
			<textarea id="content7" name="content7" style="display: none"><?php echo $content7 ?></textarea>
			<textarea id="content8" name="content8" style="display: none"><?php echo $content8 ?></textarea>
			<textarea id="content9" name="content9" style="display: none"><?php echo $content9 ?></textarea>
			<textarea id="content10" name="content10" style="display: none"><?php echo $content10 ?></textarea>
			<textarea id="content11" name="content11" style="display: none"><?php echo $content11 ?></textarea>
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
$(document).ready(function() {
        var content4=  $('#content4').val();
        $('#summernot1').summernote('code',content4);

        var content5=  $('#content5').val();
        $('#summernot2').summernote('code',content5);

        var content6=  $('#content6').val();
        $('#summernot3').summernote('code',content6);

        var content7=  $('#content7').val();
        $('#summernot4').summernote('code',content7);

        var content8=  $('#content8').val();
        $('#summernot5').summernote('code',content8);

        var content9=  $('#content9').val();
        $('#summernot6').summernote('code',content9);

        var content10=  $('#content10').val();
        $('#summernot7').summernote('code',content10);

        var content11=  $('#content11').val();
        $('#summernot8').summernote('code',content11);
    });
    $(document).ready(function() {
        $("#summernot1").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
        $("#summernot2").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
        $("#summernot3").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
        $("#summernot4").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
        $("#summernot5").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
        $("#summernot6").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
        $("#summernot7").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
        $("#summernot8").summernote({
            lang : "zh-CN",
            height: 666,
            focus: true,
            lang: 'zh-CN',
			onImageUpload: function(files, editor, $editable) {
				uploadSummerPic(files[0], editor, $editable);
			}
        })
    });
    function uploadSummerPic(file, editor, $editable) {
    var fd = new FormData();
    fd.append("file", file);
    $.ajax({
        type:"POST",
        url:"/index.php/upload/upload_img",
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
                    var obj = JSON.parse(data);
                    url=obj.data.src;
                    console.log(obj.data.src);
            editor.insertImage($editable, url);
        }
    });
}
    layui.use(['form','layedit', 'layer'],
        function () {
            var form = layui.form,
                layer = layui.layer;
            $("#tab").validate({
                submitHandler: function (form) {
                var content4 = $('#summernot1').summernote('code');
                $('#content4').val(content4);
                var content5 = $('#summernot2').summernote('code');
                $('#content5').val(content5);
                var content6 = $('#summernot3').summernote('code');
                $('#content6').val(content6);
                var content7 = $('#summernot4').summernote('code');
                $('#content7').val(content7);
                var content8 = $('#summernot5').summernote('code');
                $('#content8').val(content8);
                var content9 = $('#summernot6').summernote('code');
                $('#content9').val(content9);
                var content10 = $('#summernot7').summernote('code');
                $('#content10').val(content10);
                var content11 = $('#summernot8').summernote('code');
                $('#content11').val(content11);
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/set/set_save_edit_new_area' ?>",
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
</body>
</html>
