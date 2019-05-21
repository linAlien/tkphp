<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>首页</title>
	<link rel="stylesheet" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" href="/Public/Wap/css/index.css">
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
	<div id="app" v-clock>
		<header>
			<nav>
				<div :class="[nav==0?'back':'']"  @click="changeNav(0)"><a>我要直播</a></div>
				<div :class="[nav==1?'back':'']" @click="changeNav(1)"><a>我要录播</a></div>
				<div :class="[nav==2?'back':'','noborder']"  @click="changeNav(2)"><a>包月</a></div>
			</nav>
			<div class="hd_img">
				<img v-show="nav==0" src="/Public/Wap/images/hd_img.jpg" alt="">
				<img v-show="nav==1" src="/Public/Wap/images/hd_img2.jpg" alt="">
				<img v-show="nav==2" src="/Public/Wap/images/hd_img3.jpg" alt="">
			</div>
			<div class="kefu">
				<div class="kefu_dian">
					<div></div>
					<div></div>
					<div></div>
				</div>
				<div class="kefu_center">
					<div class="kefu_img">
						<img src="/Public/Wap/images/logo.jpg" alt="">
					</div>
					<div class="kefu_text" style="padding-top:26px;">
						<p>在线客服</p>
						<button style="height: 40px;width: 141px;font-size:18px" class="noborder" @click="kefu_box = !kefu_box">咨询/免费体验</button>
					</div>
				</div>
				<div class="kefu_dian">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
			<div style="background: #dcdcdc;height: 4px;"></div>
		</header>
		<section style="    margin-bottom: 200px;" id="zhibo" v-show="nav==0">
			<div>
				<h4>收费规则</h4>
				<table>
					<thead>
						<tr>
							<th scope="row">群数(个)</th>
							<th scope="row">金额(元)</th>
						</tr>
					</thead>
					<tbody>
						<!-- arr[nav].collect_fee=[
							{
								num:'0-50个群',
								price:'0'
							},
							{
								num:'51-100个群',
								price:'0'
							},
							{
								num:'101个群以上',
								price:'0'
							}
						],-->
                        <?php if(is_array($zhi_group)): $i = 0; $__LIST__ = $zhi_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr >
                                <?php if($v["start"] >= 100): ?><td><?php echo ($v["start"]); ?>个群以上</td>
                                    <?php else: ?>
                                    <td><?php echo ($v["start"]); ?>-<?php echo ($v["end"]); ?>个群</td><?php endif; ?>
                                <td><span class="p_color1"><?php echo ($v["price"]); ?></span>元/群</td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
			<div class="zhibo">
				<h4>直播说明</h4>
				<p><?php echo ($sys["sys_zhibo"]); ?></p>
			</div>
		</section>
		<section id="zhibo2" style="    margin-bottom: 200px;" v-show="nav==1">
			<div>
				<h4>收费规则</h4>
				<table>
					<thead>
						<tr>
							<th scope="row">群数(个)</th>
							<th scope="row">金额(元)</th>
						</tr>
					</thead>
					<tbody>
						<!-- arr[nav].collect_fee=[
							{
								num:'0-50个群',
								price:'0'
							},
							{
								num:'51-100个群',
								price:'0'
							},
							{
								num:'101个群以上',
								price:'0'
							}
						],-->
                        <?php if(is_array($lu_group)): $i = 0; $__LIST__ = $lu_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$w): $mod = ($i % 2 );++$i;?><tr >
                                <?php if($w["start"] >= 100): ?><td><?php echo ($w["start"]); ?>个群以上</td>
                                    <?php else: ?>
                                    <td><?php echo ($w["start"]); ?>-<?php echo ($w["end"]); ?>个群</td><?php endif; ?>
                                <td><span class="p_color1"><?php echo ($w["price"]); ?></span>元/群</td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
			<div class="zhibo">
				<h4>录播说明</h4>
                <p><?php echo ($sys["sys_lubo"]); ?></p>
			</div>
		</section>
		<section id="monthly" v-show="nav==2">
			<div class="monthly1">
				<h4>VIP包月服务售价</h4>
				<div class="text1">
					<p><?php echo ($sys["sys_vip_price"]); ?></p>
				</div>
				<div class="text2">
					<p>VIP包月服务有效期为一个月，如果您是当月15日购买，则下个月15日失效。</p>
				</div>
				<div style="background: #dcdcdc;height: 4px;"></div>
			</div>
			<div class="monthly2">
				<h4>VIP尊享特权</h4>
                <div style="max-height: 9999px;padding: 0 40px;font-size: .18rem;color: #232323;text-align: justify">
                    <?php echo ($sys["sys_vip"]); ?>
                </div>
                <!--<?php if(is_array($vip)): $i = 0; $__LIST__ = $vip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>-->
                    <!--<p>-->
                        <!--<?php echo ($v["vip_name"]); ?>: <a><?php echo ($v["vip_content"]); ?>-->
                    <!--</a></p>-->
                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
			</div>
		</section>
		<footer>
			<div class="submit p_back1 p_color2" @click="getOrder">我要下单</div>
		</footer>
		<!-- code_img  是客服的二维码照片 -->
		<kefu v-show="kefu_box" :c_img="code_img"></kefu>
	</div>
    <script>
        var img1 = '<?php echo ($sys["sys_qrcode"]); ?>';
        var index_id = '<?php echo ($id); ?>';
    </script>
	<script type="text/javascript" src="/Public/Wap/js/vue.min.js"></script>
	<script type="text/javascript" src="/Public/Wap/component/kefu.js"></script>
	<script type="text/javascript" src="/Public/Wap/js/index.js"></script>
</body>
</html>