<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>课程列表</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/course.css">
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
</head>
<body>
	<div id="app">
		<div class="top"></div>
		<div class="list">
            <?php if(is_array($teach)): $i = 0; $__LIST__ = $teach;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><div class="w-100" onclick="window.location.href='<?php echo U('course_details');?>&id=<?php echo ($t["teach_id"]); ?>'">
                    <h2 class="f_size_28 p_color5"><?php echo ($t["teach_title"]); ?></h2>
                    <p><?php echo ($t["teach_name"]); ?></p>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</body>
</html>