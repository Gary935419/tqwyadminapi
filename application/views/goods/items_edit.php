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
					<span class="x-red">*</span>商品名称
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="ename" value="<?php echo $ename ?>" name="ename" lay-verify="ename"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>最低订货
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="etitle" value="<?php echo $etitle ?>" name="etitle" lay-verify="etitle"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>商品类型
                </label>
                <div class="layui-input-inline layui-show-xs-block">
                    <div style="width: 300px" class="layui-input-inline layui-show-xs-block">
                        <select name="cid" id="cid" lay-verify="cid">
                            <?php if (isset($tidlist) && !empty($tidlist)) { ?>
                                <option value="">请选择</option>
                                <?php foreach ($tidlist as $k => $v) : ?>
                                    <option value="<?= $v['id'] ?>" <?php echo $cid == $v['id'] ? 'selected' : '' ?>><?= $v['cname'] ?></option>
                                <?php endforeach; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>单价购买价格
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="unitprice" value="<?php echo $unitprice ?>" name="unitprice" lay-verify="unitprice"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>单价购买订货量
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="unitnums" value="<?php echo $unitnums ?>" name="unitnums" lay-verify="unitnums"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>批量购买价格
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="batchprice" value="<?php echo $batchprice ?>" name="batchprice" lay-verify="batchprice"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>批量购买订货量
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="batchnums" value="<?php echo $batchnums ?>" name="batchnums" lay-verify="batchnums"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>最低购买价格
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="topprice" value="<?php echo $topprice ?>" name="topprice" lay-verify="topprice"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>最低购买订货量
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="topnums" value="<?php echo $topnums ?>" name="topnums" lay-verify="topnums"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>供货总量
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="sumnums" value="<?php echo $sumnums ?>" name="sumnums" lay-verify="sumnums"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>产地
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="place" value="<?php echo $place ?>" name="place" lay-verify="place"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>发货期
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="delivery" value="<?php echo $delivery ?>" name="delivery" lay-verify="delivery"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>商品排序
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="number" id="esort" value="<?php echo $esort ?>" name="esort" lay-verify="esort"
						   autocomplete="off" class="layui-input">
				</div>
			</div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>是否推荐
                </label>
                <div class="layui-input-inline" style="width: 500px;">
                    <input type="radio" name="ishot" lay-skin="primary" title="推荐首页"
                           value="1" <?php echo $ishot == 1 ? 'checked' : '' ?>>
                    <input type="radio" name="ishot" lay-skin="primary" title="暂不推荐"
                           value="0" <?php echo $ishot == 0 ? 'checked' : '' ?>>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>商家列表图
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <button type="button" class="layui-btn" id="upload1">上传图片</button>
                    <div class="layui-upload-list">
                        <input type="hidden" name="gimg" value="<?php echo $img ?>" id="gimg" lay-verify="gimg" autocomplete="off"
                               class="layui-input">
                        <img class="layui-upload-img" src="<?php echo $img ?>" style="width: 100px;height: 100px;" id="gimgimg" name="gimgimg">
                        <p id="demoText"></p>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>详情Banner图
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <button type="button" class="layui-btn" id="uploads">上传图片</button>
                    <div class="layui-upload-list" id="imgnew">
                        <?php foreach ($imgsall as $k=>$v){ ?>
                            <img id="avaterimg<?= $k+1 ?>" style="width:100px;height:100px;" src="<?= $v['img'] ?>" class="layui-upload-img">
                            <p id="avaterimgp<?= $k+1 ?>" style="margin-top: -70px;margin-left: -43px;" class="layui-btn layui-btn-xs layui-btn-danger demo-delete" onclick="jusp(<?= $k+1 ?>)">删除</p>
                        <?php } ?>
                    </div>
                    <div id="newinp">
                        <?php foreach ($imgsall as $k=>$v){ ?>
                            <input type="hidden" name="avater[]" id="avater<?= $k+1 ?>" value="<?= $v['img'] ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label" style="width: 30%;">
                    <span class="x-red">*</span>商品简介
                </label>
                <div class="layui-input-inline" style="width: 610px;">
                    <textarea id="content" name="content" placeholder="请输入内容" lay-verify="content" class="layui-textarea"><?php echo $content ?></textarea>
                </div>
            </div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>商品参数
				</label>
				<div class="layui-input-inline" style="width: 610px;">
					<textarea id="parameter" name="parameter" placeholder="请输入内容" lay-verify="parameter" class="layui-textarea"><?php echo $parameter ?></textarea>
				</div>
			</div>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 30%;">
                </label>
                <div class="layui-input-inline" style="width: 300px;">
                    <span class="x-red">※</span>请确认输入的数据是否正确。
                </div>
            </div>
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
            var editIndex1 = layedit.build('content', {
                height: 300,
            });
			var editIndex2 = layedit.build('parameter', {
				height: 300,
			});
            //自定义验证规则
			form.verify({
				ename: function (value) {
					if ($('#ename').val() == "") {
						return '请输入商品名称。';
					}
				},
				etitle: function (value) {
					if ($('#etitle').val() == "") {
						return '请输入最低订货。';
					}
				},
				cid: function (value) {
					if ($("#cid option:selected").val() == "") {
						return '请选择商品分类。';
					}
				},
				gimg: function (value) {
					if ($('#gimg').val() == "") {
						return '请上传商品列表图。';
					}
				},
				unitprice: function (value) {
					if ($('#unitprice').val() == "") {
						return '请输入单价购买价格。';
					}
				},
				unitnums: function (value) {
					if ($('#unitnums').val() == "") {
						return '请输入单价购买订货量。';
					}
				},
				sumnums: function (value) {
					if ($('#sumnums').val() == "") {
						return '请输入供货总量。';
					}
				},
				place: function (value) {
					if ($('#place').val() == "") {
						return '请输入产地。';
					}
				},
				delivery: function (value) {
					if ($('#delivery').val() == "") {
						return '请输入发货期。';
					}
				},
				content: function(value) {
					// 将富文本编辑器的值同步到之前的textarea中
					layedit.sync(editIndex1);
					if ($('#content').val() == "") {
						return '请输入商品简介。';
					}
				},
				parameter: function(value) {
					// 将富文本编辑器的值同步到之前的textarea中
					layedit.sync(editIndex2);
					if ($('#parameter').val() == "") {
						return '请输入商品参数。';
					}
				},
			});

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/goods/items_save_edit' ?>",
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
