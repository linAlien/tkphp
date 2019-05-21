<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>我要下单</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/order2.css">
</head>
<body>
	<div id="app" v-clock>
		<div class="not_null">
			<div class="hd">
				<p>确认订单</p>
			</div>
			<div class="content">
				<div class="classify h58  m_bottom_25">
					<label>主题分类</label>
					<p class="w362 f_size_23"><?php echo ($order["type_name"]); ?></p>
				</div>
				<div class="wx h58 b_bottom m_bottom_25">
					<label>开播时间</label>
					<p class="w362 f_size_23"><?php echo ($order["zhibo_start_time"]); ?></p>
				</div>
				<div class="wx h58 b_bottom m_bottom_25">
					<label>群数</label>
					<p class="w362 f_size_23"><?php echo ($order["qun_num"]); ?></p>
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
	<script type="text/javascript" src="/Public/Wap/js/order2.js"></script>
</body>
</html>