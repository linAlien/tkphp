<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>下单成功</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css"/>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/Success.css">
</head>
<body>
	<div id="app">
		<header>
			<p class="p_color5">
                <?php if($order["order_type"] == 2): ?>下单成功
                    <?php else: ?>
                    支付成功<?php endif; ?>
            </p>
		</header>
        <?php if($order["order_type"] == 1): ?><section>
                <p class="f_size p_color5">1.请复制以下验证码（长按可复制，也可在订单详情页中查看）<br>
                    2.添加下方助手二维码，将验证码发给助手后邀请助手进群<br>
                    3.每个群内只需要进入一个助手，每个助手最多进6个群<br>
                    4.有任何疑问请随时联系微燃客服：zhuanbo77
                </p>
                <h4>验证码</h4>
                <div class="code"><span class="p_color5"><?php echo ($order["num"]); ?></span></div>
                <?php if(!empty($img)): if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><h4><?php echo ($g["name"]); ?>二维码：</h4>
                        <div class="code_m">
                            <!-- 二维码图片 -->
                            <img src="<?php echo ($g["img"]); ?>" alt="" style="width: 257px">
                        </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </section>
            <?php elseif($order["order_type"] == 2): ?>
            <section>
                <p class="f_size p_color5">请添加客服备注“录课”，客服会发给您分配录课助手并指导操作</p>
                <h4>客服微信二维码</h4>
                <div class="code_m">
                    <!-- 二维码图片 -->
                    <img src="<?php echo ($sys["sys_qrcode"]); ?>" alt="" style="width: 257px">
                </div>
            </section>
            <?php elseif($order["order_type"] == 3): endif; ?>
        <?php if(!empty($type)): ?><h4 style="text-align: center;font-size: 33px;">您当前没有订单,点击下方查看历史订单</h4><?php endif; ?>
		<footer>
			<div onclick="window.location.href='<?php echo U('myorder');?>'" class="p_back1">
				<span>订单详情</span>
			</div>
		</footer>
	</div>
    <div id="app1" style="display: none">
        <header>
            <p class="p_color5">
                <?php if($order["order_type"] == 2): ?>下单成功
                    <?php else: ?>
                    支付成功<?php endif; ?>
            </p>
        </header>
        <?php if($order["order_type"] == 3): else: ?>
            <section>
                <p class="f_size p_color5">客服小助手数量不足！请联系客服：
                    <a href="tel:<?php echo ($sys["sys_tel"]); ?>"><?php echo ($sys["sys_tel"]); ?></a></p>
            </section><?php endif; ?>
        <footer>
            <div onclick="window.location.href='<?php echo U('myorder');?>'" class="p_back1">
                <span>订单详情</span>
            </div>
        </footer>
    </div>
    <script src="/Public/Wap/js/jquery-2.0.2.js"></script>
    <script src="/Public/Wap/js/jquery.form.js"></script>
	<script type="text/javascript" src="/Public/Wap/js/vue.min.js"></script>
	<script type="text/javascript" src="/Public/Wap/js/Success.js"></script>
    <script  type="text/javascript" src="/Public/layui-v2.4.3/layui/layui.all.js"></script>
    <script>
    var type = '<?php echo ($order["order_type"]); ?>';
    if(type==1){
        //直播支付完成  判断是否建立直播
        //遮罩层
        $('#app').css('display','none');
        var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
        setTimeout("is_pass()",2000);
    }
    function is_pass(){
        $.ajax({
            url:'/index.php?m=Wap&c=Index&a=is_pass&id=<?php echo ($order["order_id"]); ?>',
            type:'get',
            success: function (data) {
                if (data.success == 1) {
                    // 此处可对 data 作相关处理
                    if(data.data==1){
                        $('#app').css('display','block');
                        //去掉层
                        layer.close(index);
                    }else if(data.data==2){
                        //小助手不足
                        $('#app').css('display','none');
                        $('#app1').css('display','block');
                        //去掉层
                        layer.close(index);
                    }
            }else if(data.success == -1){
                    //继续访问
                    is_pass();
            }
        }
        })
    }
</script>
</body>
</html>