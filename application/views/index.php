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
    <link type="text/css" href="<?= STA ?>/css/jquery-ui.css" rel="stylesheet"/>
    <script src="<?= STA ?>/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery.mini.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/xadmin.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery-ui.mini.js"></script>
    <script type="text/javascript" src="<?= STA ?>/js/jquery.ui.datepicker-ja.min.js"></script>
</head>
<body class="index">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="<?= RUN . '/admin/index' ?>"> 我的管理后台-置业友道 </a>
    </div>

    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>

    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><span style="font-size: 14px"><?php echo $_SESSION['user_name'] ?></span></a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('修改登录密码','<?= RUN . '/admin/passwordedit' ?>',900,500)"
                       href="javascript:;">密码修改</a>
                </dd>
                <dd>
                    <a href="<?= RUN . '/login/logout' ?>">退出登录</a>
                </dd>
            </dl>
        </li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div style="color: green" id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="管理员管理">&#xe726;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="changeSrc('<?= RUN . '/users/users_list' ?>')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>
                    <cite>会员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="changeSrc('<?= RUN . '/member/member_list' ?>')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>
                        </a>
                    </li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/member/member_listv' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>vip会员列表</cite>
						</a>
					</li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="设置管理">&#xe6ae;</i>
                    <cite>设置管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
<!--                    <li>-->
<!--                        <a onclick="changeSrc('--><?//= RUN . '/notice/notice_list' ?><!--')">-->
<!--                            <i class="iconfont">&#xe6a7;</i>-->
<!--                            <cite>公告管理</cite>-->
<!--                        </a>-->
<!--                    </li>-->
                    <li>
                        <a onclick="changeSrc('<?= RUN . '/set/advertisement_list' ?>')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>广告管理</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="changeSrc('<?= RUN . '/set/set_edit' ?>')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>联系我们</cite>
                        </a>
                    </li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/set/set_editer' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>二手房交易管理</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/set/set_editxin' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>新房交易管理</cite>
						</a>
					</li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="资讯管理">&#xe6b5;</i>
                    <cite>学校管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
<!--                    <li>-->
<!--                        <a onclick="changeSrc('--><?//= RUN . '/taskclass/taskclass_list' ?><!--')">-->
<!--                            <i class="iconfont">&#xe6a7;</i>-->
<!--                            <cite>资讯信息</cite>-->
<!--                        </a>-->
<!--                    </li>-->
					<li>
						<a onclick="changeSrc('<?= RUN . '/taskclass/itemsclass_list' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>学校信息</cite>
						</a>
					</li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="资讯管理">&#xe6b5;</i>
                    <cite>资讯管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="changeSrc('<?= RUN . '/goods/goods_list' ?>')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>资讯信息</cite>
                        </a>
                    </li>
                </ul>
            </li>
			<li>
				<a href="javascript:;">
					<i class="iconfont left-nav-li" lay-tips="搬家服务">&#xe6b5;</i>
					<cite>服务中心</cite>
					<i class="iconfont nav_right">&#xe697;</i></a>
				<ul class="sub-menu">
					<li>
						<a onclick="changeSrc('<?= RUN . '/goods/goods_list1' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>搬家服务</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/goods/goods_list2' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>装修服务</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/goods/goods_list3' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>保洁服务</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/goods/goods_list4' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>法律服务</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/goods/goods_list5' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>二手房估价</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/goods/goods_list6' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>格局规划</cite>
						</a>
					</li>
				</ul>
			</li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="问答管理">&#xe705;</i>
                    <cite>问答管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="changeSrc('<?= RUN . '/examine/task_list' ?>')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>问答信息</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="订单管理">&#xe723;</i>
                    <cite>订单管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
					<li>
						<a onclick="changeSrc('<?= RUN . '/order/goodsorder_list' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>房产报告订单</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/order/viporder_list' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>vip服务订单</cite>
						</a>
					</li>
                </ul>
            </li>
			<li>
				<a href="javascript:;">
					<i class="iconfont left-nav-li" lay-tips="报告管理">&#xe723;</i>
					<cite>报告管理</cite>
					<i class="iconfont nav_right">&#xe697;</i></a>
				<ul class="sub-menu">
					<li>
						<a onclick="changeSrc('<?= RUN . '/order/goods_list?btype=1' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>学区房报告列表</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/order/goods_list?btype=2' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>自住房报告列表</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/order/goods_list?btype=3' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>投资房报告列表</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/order/goods_list1' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>通用报告信息设定</cite>
						</a>
					</li>
					<li>
						<a onclick="changeSrc('<?= RUN . '/order/goods_list2 ' ?>')">
							<i class="iconfont">&#xe6a7;</i>
							<cite>所属区域分析设定</cite>
						</a>
					</li>
				</ul>
			</li>
        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <a href="<?= RUN . '/admin/index' ?>">
            <li class="home">
                <i class="layui-icon">&#xe68e;</i>回到首页
            </li>
            </a>
        </ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd>
            </dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='<?= RUN . '/Welcome/index' ?>' frameborder="0" scrolling="yes" id="x-iframe"
                        class="x-iframe"></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>
</div>
<div class="page-content-bg"></div>
<style id="theme_style"></style>

<script>
    function changeSrc(url) {
        document.getElementById("x-iframe").src = url;
    }
</script>
</body>

</html>
