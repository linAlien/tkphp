<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>我的分销记录</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/wallet.css">
</head>
<body>
	<div id="app">
		<header class="w-100">
			<p class="f_size_23 p_color2 w-100 text-center">可用余额(元)</p>
			<h2 class="w-100 p_color2 text-center">+<?php echo ($user["user_money"]); ?></h2>
			<div id="btn" class="p_color2 text-center"><span>充值</span></div>
		</header>
		<section>
			<div class="title">
				<span class="f_size">分销记录</span>
			</div>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$d): $mod = ($i % 2 );++$i;?><div class="list">
                    <div class="left">
                        <h2 class="p_color5">分销</h2>
                        <p class="p_color4"><?php echo ($d["recharge_createtime"]); ?></p>
                    </div>
                    <div class="right">
                        <p class="p_color5 text-right"><?php echo ($d["money"]); ?></p>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
		</section>
	</div>
	<script type="text/javascript">
		var btn = document.getElementById('btn');
		btn.onclick= function(){
			window.location.href='<?php echo U('recharge');?>';
		}
	</script>
</body>
</html>