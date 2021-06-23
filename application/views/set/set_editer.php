<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>我的管理后台-置业友道</title>
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
</head>
<body>
<div class="layui-fluid" style="padding-top: 66px;">
    <div class="layui-row">
        <form method="post" class="layui-form" action="" name="basic_validate" id="tab">
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>二手房交易管理
                </label>
                <div class="layui-input-inline" style="width: 610px;">
                    <textarea id="ertext" name="ertext" placeholder="请输入内容" lay-verify="ertext" class="layui-textarea"><?php echo $ertext ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 30%;">
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <span class="x-red">※</span>请确认输入的数据是否正确。
                </div>
            </div>
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
                    $('#customercodeimg').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                if(res.code == 200){
                    $('#customercode').val(res.src); //图片链接（base64）
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
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload2'
            ,url: '<?= RUN . '/upload/pushFIle' ?>'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#imgimg').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                if(res.code == 200){
                    $('#img').val(res.src); //图片链接（base64）
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
    });
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
            var editIndex1 = layedit.build('ertext', {
                height: 300,
            });
            //自定义验证规则
            form.verify({
                ertext: function(value) {
                    // 将富文本编辑器的值同步到之前的textarea中
                    layedit.sync(editIndex1);
                    if ($('#ertext').val() == "") {
                        return '请输入详细说明。';
                    }
                },
            });

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/set/set_save_editer' ?>",
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
