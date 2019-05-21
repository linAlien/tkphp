<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>我要下单</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/b_order2.css">
</head>
<body>
	<div id="app" v-clock>
		<div class="not_null">
			<div class="hd">
				<p>确认订单</p>
			</div>
			<div class="content">
				<div class="classify h58  m_bottom_25">
					<label>购买时长</label>
					<p class="w362 f_size_23"><?php echo ($order["times"]); ?>个月</p>
				</div>
                <div class="classify h58  m_bottom_25">
                    <label>购买群数量</label>
                    <p class="w362 f_size_23"><?php echo ($order["vip_num"]); ?>个群</p>
                </div>
				<div class="wx h58 b_bottom m_bottom_25">
					<label>手机号</label>
					<p class="w362 f_size_23"><?php echo ($order["user_tel"]); ?></p>
				</div>
				<div class="wx h58 b_bottom m_bottom_25">
					<label>微信号</label>
					<p class="w362 f_size_23"><?php echo ($order["user_wechat"]); ?></p>
				</div>
				<div class="price">
					<p class="p_color5 f_size_23">合计费用</p>
					<p class="p_color3 f_size_30">￥<?php echo ($order["order_price"]); ?></p>
				</div>
			</div>
		</div>
		<footer>
			<div>
				<p>实付款：￥<?php echo ($order["order_price"]); ?></p>
			</div>
			<div class="btn p_back1 p_color2" @click="getOrder">下一步</div>
		</footer>
	</div>
    <script>
        var id = '<?php echo ($order["order_id"]); ?>';
    </script>
	<script type="text/javascript" src="/Public/Wap/js/vue.min.js"></script>	
	<script type="text/javascript" src="/Public/Wap/js/b_order2.js"></script>
</body>
</html>