<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>个人中心</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/user_main.css">
</head>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?php echo ($param["appId"]); ?>', // 必填，公众号的唯一标识
        timestamp:'<?php echo ($param["timestamp"]); ?>', // 必填，生成签名的时间戳
        nonceStr: '<?php echo ($param["nonceStr"]); ?>', // 必填，生成签名的随机串
        signature: '<?php echo ($param["signature"]); ?>',// 必填，签名，见附录1
        jsApiList: ["onMenuShareTimeline","onMenuShareAppMessage"] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.ready(function() {
        wx.onMenuShareTimeline({
            title: '微燃课堂', // 分享标题
            link: '<?php echo ($url); ?>', // 分享链接
            imgUrl: '<?php echo ($img); ?>', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        wx.onMenuShareAppMessage({
            title: '微燃课堂', // 分享标题
            desc: '微燃课堂',
            link: '<?php echo ($url); ?>', // 分享链接
            imgUrl: '<?php echo ($img); ?>', // 分享图标
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });
</script>
<body>
	<div id="app">
		<header>
			<div  class="b_bottom">
				<div class="img">
					<img src="<?php echo ($user["user_headimgurl"]); ?>" alt="" style="width: 133px">
				</div>
				<div class="user">
					<h4 class="w-100 f_size_30 text-hide"><?php echo ($user["user_nickname"]); ?></h4>
					<p class="w-100 f_size_28 p_color4 text-hide">用户ID：<?php echo ($user["user_id"]); ?></p>
				</div>
			</div>
		</header>
		<section class="order">
			<div class="b_bottom_8 w-100">
				<p class="f_size_28" onclick="window.location.href='<?php echo U('myorder');?>'" style="background: url('/Public/Wap/images/icon-order.png')no-repeat .12rem center;">订单查询</p>
			</div>
		</section>
		<section class="wallet">
			<div class="b_bottom w-100">
				<p class="f_size_28" onclick="window.location.href='<?php echo U('wallet');?>'" style="background: url('/Public/Wap/images/icon-wallet.png')no-repeat .12rem center;">个人钱包</p>
			</div>
            <div class="b_bottom w-100">
                <p class="f_size_28" onclick="window.location.href='<?php echo U('fenxiao');?>'" style="background: url('/Public/Wap/images/icon-wallet.png')no-repeat .12rem center;">分销记录</p>
            </div>
			<div class="b_bottom_8 w-100">
				<p class="f_size_28" onclick="window.location.href='<?php echo U('course');?>'" style="background: url('/Public/Wap/images/icon-use.png')no-repeat .12rem center;">使用教程</p>
			</div>
		</section>
		<section class="custom_service">
			<div class="b_bottom w-100">
				<p class="f_size_28" @click="kefu_box = !kefu_box" style="background: url('/Public/Wap/images/icon-custom_service.png')no-repeat .12rem center;">联系客服</p>
			</div>
			<div class="b_bottom_8 w-100 " style="background: none;"></div>
		</section>
		<footer>
			<p class="f_size_28 w-100 text-center p_color1"><a href="tel:<?php echo ($sys["sys_tel"]); ?>" style="text-decoration: none;color:green">客服热线：<?php echo ($sys["sys_tel"]); ?></a></p>
		</footer>
        <!-- code_img  是客服的二维码照片 -->
        <kefu v-show="kefu_box" :c_img="code_img"></kefu>
	</div>
    <script src="/Public/Wap/js/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="/Public/Wap/js/vue.min.js"></script>
    <script type="text/javascript" src="/Public/Wap/component/kefu.js"></script>
    <script type="text/javascript">
        var id = '<?php echo ($id); ?>';
        var img = '<?php echo ($sys["sys_qrcode"]); ?>';
		new Vue({
			el:"#app",
			data:{
                kefu_box:false,
                code_img:img
            },
            mounted(){
				let othis= this;
                if(id==1){
                    this.kefu_box = true;
                }
				Event.$on('close_kf',function(){
					othis.kefu_box = false;
				})
			}
		})

	</script>
</body>
</html>