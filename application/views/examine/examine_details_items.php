<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>我的管理后台-天桥伟业</title>
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
                    联系邮箱
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交联系邮箱" id="email" name="email" class="layui-textarea"
                              lay-verify="email"><?php echo $email ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label">
                    合作事宜
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="暂无提交合作事宜" id="contentnew" name="contentnew" class="layui-textarea"
                              lay-verify="content"><?php echo $contentnew ?></textarea>
                </div>
            </div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					商品名称
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交商品名称" id="ename" name="ename" class="layui-textarea"
							  lay-verify="email"><?php echo $ename ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					最低订货
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交最低订货" id="etitle" name="etitle" class="layui-textarea"
							  lay-verify="etitle"><?php echo $etitle ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					单价购买价格
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交单价购买价格" id="unitprice" name="unitprice" class="layui-textarea"
							  lay-verify="unitprice"><?php echo $unitprice ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					单价购买订货量
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交单价购买订货量" id="unitnums" name="unitnums" class="layui-textarea"
							  lay-verify="unitnums"><?php echo $unitnums ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					批量购买价格
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交批量购买价格" id="batchprice" name="batchprice" class="layui-textarea"
							  lay-verify="batchprice"><?php echo $batchprice ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					批量购买订货量
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交批量购买订货量" id="batchnums" name="batchnums" class="layui-textarea"
							  lay-verify="batchnums"><?php echo $batchnums ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					最低购买价格
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交最低购买价格" id="topprice" name="topprice" class="layui-textarea"
							  lay-verify="topprice"><?php echo $topprice ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					最低购买订货量
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交最低购买订货量" id="topnums" name="topnums" class="layui-textarea"
							  lay-verify="topnums"><?php echo $topnums ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					供货总量
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交供货总量" id="sumnums" name="sumnums" class="layui-textarea"
							  lay-verify="sumnums"><?php echo $sumnums ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					产地
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交产地" id="place" name="place" class="layui-textarea"
							  lay-verify="place"><?php echo $place ?></textarea>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="desc" class="layui-form-label">
					发货期
				</label>
				<div class="layui-input-block">
                    <textarea placeholder="暂无提交发货期" id="delivery" name="delivery" class="layui-textarea"
							  lay-verify="delivery"><?php echo $delivery ?></textarea>
				</div>
			</div>
        </form>
    </div>
</div>
</body>
</html>
