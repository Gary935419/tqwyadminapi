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
              <cite>所属区域分析管理</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">

                </div>

                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                            <th>项目名称</th>
							<th>中山区报告</th>
							<th>西岗区报告</th>
                            <th>沙河口区报告</th>
							<th>甘井子区报告</th>
							<th>高新园区报告</th>
                        </thead>
                        <tbody>
                                <tr id="p1" sid="1">
                                    <td>学区房区域分析</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=4' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=5' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=6' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=7' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=8' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
                                </tr>
								<tr id="p2" sid="2">
									<td>自住房区域分析</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=12' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=13' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=14' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=15' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=16' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
								</tr>
								<tr id="p3" sid="3">
									<td>投资房区域分析</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=20' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=21' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=22' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=23' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
									<td>
										<button class="layui-btn layui-btn-success"
												onclick="xadmin.open('编辑','<?= RUN . '/set/set_edit_new_area?id=24' ?>',1000,600)">
											<i class="layui-icon">&#xe642;</i>区域分析编辑
										</button>
									</td>
								</tr>
                        </tbody>
                    </table>
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
