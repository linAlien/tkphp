<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/layuiadmin/style/admin.css">
    <title>首页</title>
</head>

<body>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8">
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-header">快捷方式</div>
                            <div class="layui-card-body">

                                <div class="layui-carousel layadmin-carousel layadmin-shortcut">
                                    <div carousel-item>
                                        <ul class="layui-row layui-col-space10">
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Manager/manager');?>">
                                                    <i class="layui-icon layui-icon-console"></i>
                                                    <cite>添加账号</cite>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Role/role');?>">
                                                    <i class="layui-icon layui-icon-chart"></i>
                                                    <cite>添加角色</cite>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Order/order');?>">
                                                    <i class="layui-icon layui-icon-template-1"></i>
                                                    <cite>管理订单</cite>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Set/set');?>">
                                                    <i class="layui-icon layui-icon-chat"></i>
                                                    <cite>系统设置</cite>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Group/lst');?>">
                                                    <i class="layui-icon layui-icon-find-fill"></i>
                                                    <cite>添加直/录播套餐</cite>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Kefu/kefu');?>">
                                                    <i class="layui-icon layui-icon-survey"></i>
                                                    <cite>添加机器人</cite>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Set/password');?>">
                                                    <i class="layui-icon layui-icon-user"></i>
                                                    <cite>修改密码</cite>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Login/outSys');?>">
                                                    <i class="layui-icon layui-icon-set"></i>
                                                    <cite>退出登陆</cite>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-header">事项</div>
                            <div class="layui-card-body">

                                <div class="layui-carousel layadmin-carousel layadmin-backlog">
                                    <div carousel-item>
                                        <ul class="layui-row layui-col-space10">
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Order/order');?>" class="layadmin-backlog-body">
                                                    <h3>今日订单数</h3>
                                                    <p>
                                                        <cite><?php echo ($order_num); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Order/order');?>" class="layadmin-backlog-body">
                                                    <h3>今日订单总额</h3>
                                                    <p>
                                                        <cite><?php echo ($money); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Recharge/recharge');?>" class="layadmin-backlog-body">
                                                    <h3>今日充值数</h3>
                                                    <p>
                                                        <cite><?php echo ($re_num); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Recharge/recharge');?>" class="layadmin-backlog-body">
                                                    <h3>今日充值总额</h3>
                                                    <p>
                                                        <cite><?php echo ($re_money); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Recharge/recharge');?>" class="layadmin-backlog-body">
                                                    <h3>今日分销数</h3>
                                                    <p>
                                                        <cite><?php echo ($fen_num); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a lay-href="<?php echo U('Recharge/recharge');?>" class="layadmin-backlog-body">
                                                    <h3>今日分销总额</h3>
                                                    <p>
                                                        <cite><?php echo ($fen_money); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a href="javascript:;" onclick="layer.tips('不跳转', this, {tips: 3});" class="layadmin-backlog-body">
                                                    <h3>今日新增用户</h3>
                                                    <p>
                                                        <cite><?php echo ($user_num); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="layui-col-xs3">
                                                <a href="javascript:;" onclick="layer.tips('不跳转', this, {tips: 3});" class="layadmin-backlog-body">
                                                    <h3>今日推荐用户</h3>
                                                    <p>
                                                        <cite><?php echo ($pro_num); ?></cite>
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="layui-col-md12">-->
                        <!--<div class="layui-card">-->
                            <!--<div class="layui-card-header">数据概览</div>-->
                            <!--<div class="layui-card-body">-->
                                <!--<div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-dataview">-->
                                    <!--<div carousel-item id="LAY-index-dataview">-->
                                        <!--<div>-->
                                            <!--<i class="layui-icon layui-icon-loading1 layadmin-loading"></i>-->
                                        <!--</div>-->
                                        <!--&lt;!&ndash; <div></div>-->
                                        <!--<div></div> &ndash;&gt;-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!-- <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-header">数据概览</div>
                            <div class="layui-card-body">
                                <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-dataview">
                                    <div carousel-item id="LAY-index-dataview">
                                        <div></div>
                                        <div>
                                            <i class="layui-icon layui-icon-loading1 layadmin-loading"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="layui-col-md4">
                    <div class="layui-card">
                        <div class="layui-card-header">动态</div>
                        <div class="layui-card-body">
                            <dl class="layuiadmin-card-status">
                                <?php if(is_array($re)): $i = 0; $__LIST__ = $re;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><dd>
                                    <div class="layui-status-img">
                                        <a href="javascript:;">
                                            <img src="<?php echo ($r["img"]); ?>">
                                        </a>
                                    </div>
                                    <div>
                                        <?php if($r["recharge_type"] == 1): ?><p><?php echo ($r["name"]); ?> 充值了 ￥<?php echo ($r["money"]); ?> 元</p>
                                            <?php elseif($r["recharge_type"] == 2): ?>
                                            <p><?php echo ($r["name"]); ?> 分销获得了 ￥<?php echo ($r["money"]); ?> 元</p>
                                            <?php elseif($r["recharge_type"] == 3): ?>
                                            <p><?php echo ($r["name"]); ?> 消费了 ￥<?php echo ($r["money"]); ?> 元</p><?php endif; ?>
                                        <span><?php echo ($r["recharge_createtime"]); ?></span>
                                    </div>
                                </dd><?php endforeach; endif; else: echo "" ;endif; ?>
                            </dl>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="/Public/layuiadmin/layui/layui.js?t=1"></script>
    <script>
        layui.config({
            base: '/Public/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'console']);
    </script>
</body>

</html>