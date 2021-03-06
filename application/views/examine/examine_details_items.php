<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>我的管理后台-置业友道</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="<?= STA ?>/css/font.css">
    <link rel="stylesheet" href="<?= STA ?>/css/xadmin.css">
    <script type="text/javascript" src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery.validate.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/upload/jquery_form.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form method="post" class="layui-form layui-form-pane" id="tab">
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
					报告费用
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交报告费用" id="price" name="price" class="layui-textarea"
                              lay-verify="price"><?php echo $price ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
					联系邮箱
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交联系邮箱" id="email" name="email" class="layui-textarea"
                              lay-verify="email"><?php echo $email ?></textarea>
                </div>
            </div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					报告类型
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交报告类型" id="btype" name="btype" class="layui-textarea"
							  lay-verify="btype"><?php echo $btype ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					学校名
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交学校名" id="school" name="school" class="layui-textarea"
							  lay-verify="school"><?php echo $school ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					区域信息
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交区域信息" id="area" name="area" class="layui-textarea"
							  lay-verify="area"><?php echo $area ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					房产价格
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交房产价格" id="money" name="money" class="layui-textarea"
							  lay-verify="money"><?php echo $money ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					房产类型
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交房产类型" id="ftype" name="ftype" class="layui-textarea"
							  lay-verify="ftype"><?php echo $ftype ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					支付订单号
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交支付订单号" id="paynumber" name="paynumber" class="layui-textarea"
							  lay-verify="paynumber"><?php echo $paynumber ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					支付状态
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交支付状态" id="status" name="status" class="layui-textarea"
							  lay-verify="status"><?php echo $status ?></textarea>
				</div>
			</div>
        </form>
    </div>
</div>
</body>
</html>
