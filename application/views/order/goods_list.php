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
    <script src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery.mini.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
</head>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a>
              <cite>报告管理</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="<?= RUN, '/order/goods_list' ?>">
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="gname" id="gname" value="<?php echo $gname ?>"
                                   placeholder="报告名称" autocomplete="off" class="layui-input">
                        </div>
						<input type="hidden" name="btype" id="btype" value="<?php echo $btype ?>">
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn" lay-submit="" lay-filter="sreach"><i
                                        class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <button class="layui-btn layui-card-header" style="float: right;margin-top: -40px;margin-right: 20px;"
                        onclick="xadmin.open('添加','<?= RUN . '/order/goods_add?btype=' ?>'+'<?= $btype ?>',1000,600)"><i
                            class="layui-icon"></i>添加
                </button>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                            <th>报告名称</th>
							<?php if ($btype==1){ ?>
								<th>房源学校</th>
							<?php } ?>
							<?php if ($btype!=1){ ?>
								<th>房源区域</th>
							<?php } ?>
							<th>房源类型</th>
							<th>房源价位</th>
							<?php if ($btype==1){ ?>
								<th>房源及均价分析</th>
								<th>重点观点导向分析</th>
							<?php } ?>
							<?php if ($btype==2){ ?>
								<th>区域房源及价格分析</th>
								<th>置业友道观点导向分析</th>
							<?php } ?>
							<?php if ($btype==3){ ?>
								<th>投资区域房源及价格分析</th>
								<th>投资置业友道观点导向分析</th>
							<?php } ?>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        <?php if (isset($list) && !empty($list)) { ?>
                            <?php foreach ($list as $num => $once): ?>
                                <tr id="p<?= $once['id'] ?>" sid="<?= $once['id'] ?>">
                                    <td><?= $once['gname'] ?></td>
									<?php if ($btype==1){ ?>
										<td><?= $once['schoolname'] ?></td>
									<?php } ?>
									<?php if ($btype!=1){ ?>
										<td><?= $once['areaname'] ?></td>
									<?php } ?>
									<td><?= $once['classname'] ?></td>
									<td><?= $once['pricename'] ?></td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/order/goods_edit5?id=' ?>'+'<?= $once['id'] ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>编辑报告
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/order/goods_edit6?id=' ?>'+'<?= $once['id'] ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>编辑报告
										</button>
									</td>
                                    <td class="td-manage">
                                        <button class="layui-btn layui-btn-normal"
                                                onclick="xadmin.open('编辑','<?= RUN . '/order/goods_edit?id=' ?>'+'<?= $once['id'] ?>',1000,600)">
                                            <i class="layui-icon">&#xe642;</i>编辑
                                        </button>
                                        <button class="layui-btn layui-btn-danger"
                                                onclick="goods_delete('<?= $once['id'] ?>')"><i class="layui-icon">&#xe640;</i>删除
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="11" style="text-align: center;">暂无数据</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="layui-card-body ">
                    <div class="page">
                        <?= $pagehtml ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
<script>
    function goods_delete(id) {
        layer.confirm('您是否确认删除？', {
                title: '温馨提示',
                btn: ['确认', '取消']
                // 按钮
            },
            function (index) {
                $.ajax({
                    type: "post",
                    data: {"id": id},
                    dataType: "json",
                    url: "<?= RUN . '/order/goods_delete' ?>",
                    success: function (data) {
                        if (data.success) {
                            $("#p" + id).remove();
                            layer.alert(data.msg, {
                                    title: '温馨提示',
                                    icon: 6,
                                    btn: ['确认']
                                },
                            );
                        } else {
                            layer.alert(data.msg, {
                                    title: '温馨提示',
                                    icon: 5,
                                    btn: ['确认']
                                },
                            );
                        }
                    },
                });
            });
    }
</script>
</html>
