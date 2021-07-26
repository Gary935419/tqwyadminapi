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
					<span class="x-red">*</span>报告名称
				</label>
				<div class="layui-input-inline" style="width: 300px;">
					<input type="text" id="gname" name="gname" lay-verify="gname"
						   autocomplete="off" value="<?php echo $gname ?>" class="layui-input">
				</div>
			</div>
<!--			<div class="layui-form-item">-->
<!--				<label for="L_pass" class="layui-form-label" style="width: 30%;">-->
<!--					<span class="x-red">*</span>报告分类-->
<!--				</label>-->
<!--				<div class="layui-input-inline layui-show-xs-block">-->
<!--					<div style="width: 300px" class="layui-input-inline layui-show-xs-block">-->
<!--						<select name="gtype" id="gtype">-->
<!--							<option value="">请选择</option>-->
<!--							<option --><?php //echo $gtype == '大连市内重点学校分析' ? 'selected' : '' ?><!-- value="大连市内重点学校分析">大连市内重点学校分析</option>-->
<!--							<option --><?php //echo $gtype == '大连市内重点学校预警' ? 'selected' : '' ?><!-- value="大连市内重点学校预警">大连市内重点学校预警</option>-->
<!--							<option --><?php //echo $gtype == '大连市教育相关政策' ? 'selected' : '' ?><!-- value="大连市教育相关政策">大连市教育相关政策</option>-->
<!--							<option --><?php //echo $gtype == '本学区所属区域分析' ? 'selected' : '' ?><!-- value="本学区所属区域分析">本学区所属区域分析</option>-->
<!--							<option --><?php //echo $gtype == '本学区房源及均价分析' ? 'selected' : '' ?><!-- value="本学区房源及均价分析">本学区房源及均价分析</option>-->
<!--							<option --><?php //echo $gtype == '置业有道观点导向分析' ? 'selected' : '' ?><!-- value="置业有道观点导向分析">置业有道观点导向分析</option>-->
<!--						</select>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<div class="layui-form-item" style="display: <?php echo $typename==='学区需求'?'block':'none' ?>">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>学校名称
				</label>
				<div class="layui-input-inline layui-show-xs-block">
					<div style="width: 300px" class="layui-input-inline layui-show-xs-block">
						<select name="schoolname" id="schoolname" lay-verify="schoolname">
							<?php if (isset($schoollist) && !empty($schoollist)) { ?>
								<option value="">请选择</option>
								<?php foreach ($schoollist as $k => $v) : ?>
									<option <?php echo $schoolname == $v['cname'] ? 'selected' : '' ?> value="<?= $v['cname'] ?>"><?= $v['cname'] ?></option>
								<?php endforeach; ?>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
<!--			<div class="layui-form-item">-->
<!--				<label for="L_pass" class="layui-form-label" style="width: 30%;">-->
<!--					<span class="x-red">*</span>报告类别-->
<!--				</label>-->
<!--				<div class="layui-input-inline layui-show-xs-block">-->
<!--					<div style="width: 300px" class="layui-input-inline layui-show-xs-block">-->
<!--						<select name="typename" id="typename">-->
<!--							<option value="">请选择</option>-->
<!--							<option --><?php //echo $typename == '学区' ? 'selected' : '' ?><!-- value="学区">学区</option>-->
<!--							<option --><?php //echo $typename == '自住' ? 'selected' : '' ?><!-- value="自住">自住</option>-->
<!--							<option --><?php //echo $typename == '投资' ? 'selected' : '' ?><!-- value="投资">投资</option>-->
<!--						</select>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
			<input type="hidden" name="typename" id="typename" value="<?php echo $typename ?>">
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>价位
				</label>
				<div class="layui-input-inline layui-show-xs-block">
					<div style="width: 300px" class="layui-input-inline layui-show-xs-block">
						<select name="pricename" id="pricename">
							<option value="">请选择</option>
							<option <?php echo $pricename == '200万以下' ? 'selected' : '' ?> value="200万以下">200万以下</option>
							<option <?php echo $pricename == '200万至300万之间' ? 'selected' : '' ?> value="200万至300万之间">200万至300万之间</option>
							<option <?php echo $pricename == '300万以上' ? 'selected' : '' ?> value="300万以上">300万以上</option>
						</select>
					</div>
				</div>
			</div>
			<div class="layui-form-item" style="display: <?php echo $typename==='学区需求'?'none':'block' ?>">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>区域
				</label>
				<div class="layui-input-inline layui-show-xs-block">
					<div style="width: 300px" class="layui-input-inline layui-show-xs-block">
						<select name="areaname" id="areaname">
							<option value="">请选择</option>
							<option <?php echo $areaname == '中山区' ? 'selected' : '' ?> value="中山区">中山区</option>
							<option <?php echo $areaname == '西岗区' ? 'selected' : '' ?> value="西岗区">西岗区</option>
							<option <?php echo $areaname == '沙河口区' ? 'selected' : '' ?> value="沙河口区">沙河口区</option>
							<option <?php echo $areaname == '甘井子区' ? 'selected' : '' ?> value="甘井子区">甘井子区</option>
							<option <?php echo $areaname == '高新园区' ? 'selected' : '' ?> value="高新园区">高新园区</option>
						</select>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<label for="L_pass" class="layui-form-label" style="width: 30%;">
					<span class="x-red">*</span>类型
				</label>
				<div class="layui-input-inline layui-show-xs-block">
					<div style="width: 300px" class="layui-input-inline layui-show-xs-block">
						<select name="classname" id="classname">
							<option value="">请选择</option>
							<option <?php echo $classname == '新房' ? 'selected' : '' ?> value="新房">新房</option>
							<option <?php echo $classname == '二手房' ? 'selected' : '' ?> value="二手房">二手房</option>
						</select>
					</div>
				</div>
			</div>
<!--			<div class="layui-form-item">-->
<!--				<label for="L_pass" class="layui-form-label" style="width: 30%;">-->
<!--					<span class="x-red">*</span>报告详情-->
<!--				</label>-->
<!--				<div class="layui-input-inline" style="width: 610px;">-->
<!--					<textarea id="gcontent" name="gcontent" placeholder="请输入内容" lay-verify="gcontent" class="layui-textarea">--><?php //echo $gcontent ?><!--</textarea>-->
<!--				</div>-->
<!--			</div>-->
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
                gname: function (value) {
                    if ($('#gname').val() == "") {
                        return '请输入报告名称。';
                    }
                },
<!--                gcontent: function(value) {-->
<!--                    // 将富文本编辑器的值同步到之前的textarea中-->
<!--                    layedit.sync(editIndex1);-->
<!--                    if ($('#gcontent').val() == "") {-->
<!--                        return '请输入报告详情。';-->
<!--                    }-->
<!--                },-->
            });

            $("#tab").validate({
                submitHandler: function (form) {
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url: "<?= RUN . '/order/goods_save_edit' ?>",
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
