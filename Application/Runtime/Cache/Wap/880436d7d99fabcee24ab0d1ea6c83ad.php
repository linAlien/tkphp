<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>我的订单</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/myorder.css">
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
        <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><div onclick="window.location.href='<?php echo U('zhibo');?>&sessionid=<?php echo ($o["session_id"]); ?>&num=<?php echo ($o["qun_num"]); ?>'" class="order-box w-100">
                <div>
                    <div class="order_to">
                        <div class="left">
                            <p class="left1 f-size-26"><?php echo ($o["name"]); ?></p>
                            <p><?php echo ($o["order_createtime"]); ?></p>
                        </div>
                        <div class="right text-right">
                            <span class="f-size-26">
                                <?php if($o["order_type"] == 2): else: ?>
                                    ￥<?php echo ($o["order_price"]); endif; ?>
                            </span>
                        </div>
                    </div>
                    <!--<div id="synopsis" class="b_bottom">-->
                        <!--<h4 class="f_size p_color5">套餐简介:</h4>-->
                        <!--<?php if($o["order_type"] == 1): ?>-->
                            <!--<p class="f-size-18 maxheight p_color4">老师在一个群内讲课的消息内容，（包括语音、图片、文字、小视频、小程序、公众号名片、图文链接等）都可以实时同步到其他多个群。小助手自动进群，按照指令设置转发规则。</p>-->
                        <!--<?php elseif($o["order_type"] == 2): ?>-->
                            <!--<p class="f-size-18 maxheight p_color4">下单后联系客服，客服会发给你录课助手和操作流程，录课成功之后，可以反复播放课程内容。</p>-->
                        <!--<?php elseif($o["order_type"] == 3): ?>-->
                            <!--<p class="f-size-18 maxheight p_color4"><?php echo ($o["details"]); ?></p>-->
                        <!--<?php endif; ?>-->
                    <!--</div>-->
                    <!--<div id="code">-->
                        <!--<?php if($o["order_type"] == 1): ?>-->
                            <!--<h4 class="f_size p_color5">验证码：<?php echo ($o["num"]); ?></h4>-->
                            <!--<?php else: ?>-->
                        <!--<?php endif; ?>-->
                        <!--<div style="flex-wrap: wrap;">-->
                            <!--<?php if($o["order_type"] == 1): ?>-->
                                <!--<?php if(is_array($o["arr"])): $i = 0; $__LIST__ = $o["arr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?>-->
                                    <!--<h4 class="f_size p_color5" style="width: 85px;">微信号：</h4>-->
                                    <!--<p style="width:488px;font-size: 27px;"><?php echo ($g); ?></p>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                                <!--<?php elseif($o["order_type"] == 2): ?>-->
                                <!--<div class="QR_Code">-->
                                    <!--<h4 class="f_size p_color5">客服微信号：</h4>-->
                                    <!--<p style="font-size: 27px">zhuanbo77</p>-->
                                    <!--&lt;!&ndash;<p style="font-size: 27px"><?php echo ($o["kefu_wechat"]); ?></p>&ndash;&gt;-->
                                <!--</div>-->
                                <!--<?php else: ?>-->
                            <!--<?php endif; ?>-->
                            <!--<?php if($o["href"] != ''): ?>-->
                                <!--<div onclick="window.location.href='<?php echo ($o["href"]); ?>'" class="btn text-center" style="margin-top: .18rem;"><span>查看群消息 ></span></div>-->
                                <!--<?php else: ?>-->
                                <!--<div onclick="alert('暂时没有群消息')" class="btn text-center"><span>查看群消息 ></span></div>-->
                            <!--<?php endif; ?>-->
                        <!--</div>-->
                    <!--</div>-->
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<script src="/Public/Wap/js/jquery-2.0.2.js"></script>
	<script type="text/javascript">
		$('.order_to').on('click',function(){
            $(this).parent().height('auto');
            var _height =  $(this).parent().height();
            $(this).parent().height('.8rem')
			$('.opacity-1').removeClass('opacity-1');
			if($(this).parent().hasClass('new-height')){
				$(this).parent().removeClass('new-height');
			}else{
				$('.new-height').removeClass('new-height');
				$(this).addClass('opacity-1')
				$(this).parent().addClass('new-height');
                $(this).parent().height(_height)
			}
		})
	</script>
</body>
</html>