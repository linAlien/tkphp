<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
	<title>我要下单</title>
	<link type="text/css" rel="stylesheet" href="/Public/Wap/css/jquery-weui.min.css" />
	<link type="text/css" rel="stylesheet" href="/Public/Wap/css/weui.min.css" />
	<link type="text/css" rel="stylesheet" href="/Public/Wap/css/demos.css" />
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/public.css">
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/order1.css">
    <style>
        input {
            -webkit-appearance: none;
            -webkit-tap-highlight-color:transparent;
        }
        .first{
            width: 4.34rem;
            height: 5.7rem;
            padding: 0 .35rem;
            margin: 2.5rem auto;
            background: #fff;
            border-radius: .08rem;
            box-sizing: border-box;
            position: absolute;
            top: 0;
            left: 100px;
        }
        h4{
            width: 100%;
            height: .74rem;
            border-bottom: 3px solid #f4f4f4;
            box-sizing: border-box;
            font-size: .3rem;
            color: #232323;
            font-weight: 500;
            text-align: center;
            line-height: .74rem;
        }
        .code{
            width: 3.2rem;
            height: 3.2rem;
            margin: .3rem auto;
            background: #eeeeee;
        }
        .close{
            height: .58rem;
            position: relative;
            top: 1rem;
        }
    </style>
</head>
<body>
    <form action="/index.php?m=Wap&c=Order&a=doOrder" method="post" id="form">
	<div id="app" v-clock>
		<div class="not_null">
			<div class="hd">
				<p>基本信息 (必填)</p>
			</div>
			<div class="content">
                <?php if($type == 1): ?><!--<div class="classify m_bottom_20 b_bottom">-->
                        <!--<p>主题分类</p>-->
                        <!--<div class="classify-list">-->
                            <!--<?php if(is_array($classify)): $i = 0; $__LIST__ = $classify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?>-->
                                <!--<div class="type" index="<?php echo ($c["type_id"]); ?>"><?php echo ($c["type_name"]); ?></div>-->
                            <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--</div>-->
                    <!--</div>-->
                    <div class="phone h58 b_bottom m_bottom_20">
                        <label for="phone">微信号</label>
                        <input type="text" name="wechat" id="wechat" class="w428 b_none f_size" placeholder="用于分销提成">
                    </div>
                    <!--<div class="phone h58 b_bottom m_bottom_20">-->
                        <!--<label for="phone">手机号码</label>-->
                        <!--<input type="number" name="user_tel" id="phone" class="w428 b_none f_size" v-model="phone" :value="phone" placeholder=" 请输入手机号码">-->
                    <!--</div>-->
                    <!--<div class="wx h58 b_bottom m_bottom_20">-->
                        <!--<label for="wx">微信号码</label>-->
                        <!--<input type="number" id="wx" name="user_wechat" class="w428 b_none f_size" v-model="wxNum" :value="wxNum" placeholder=" 请输入微信号码">-->
                    <!--</div>-->
                    <!--<div class="startTime h58 b_bottom m_bottom_20" style="position: relative;">-->
                        <!--<label>开播时间</label>-->
                        <!--<input class="w428 b_none f_size" name="zhibo_start_time" type="datetime-local" value="" placeholder="请输入开播时间">-->
                        <!--&lt;!&ndash;<input class="weui-input w428 b_none f_size" id="time-inline" style="background: #fff" type="text" value="" readonly="">&ndash;&gt;-->
                    <!--</div>-->
                    <div class="qunNum h58 b_bottom m_bottom_20">
                        <label for="qunNum">预计群数</label>
                        <input type="number" id="qunNum" name="qun_num" class="w428 b_none f_size" v-model="qunNum" :value="qunNum" placeholder=" 请输入预计群数">
                    </div>
                    <div class="Time h58 b_bottom m_bottom_20" style="height: 59px">
                        <label>温馨提示：</label>
                        <!--<input type="number" id="Time" name="times" class="w428 b_none f_size" v-model="Time" :value="Time" placeholder=" 请输入直播时长(小时为单位)">-->
                    </div>
                    <div class="Time h58 b_bottom m_bottom_20" style="height: 59px">
                        <label>仅下单当天直播，150群以上预约请联系客服</label>
                        <!--<input type="number" id="Time" name="times" class="w428 b_none f_size" v-model="Time" :value="Time" placeholder=" 请输入直播时长(小时为单位)">-->
                    </div>
                    <?php else: ?>
                    <div class="phone h58 b_bottom m_bottom_20">
                        <label for="phone">微信号</label>
                        <input type="text" name="wechat" id="wechat" class="w428 b_none f_size" placeholder="用于分销提成">
                    </div>
                    <!--<div class="phone h58 b_bottom m_bottom_20">-->
                        <!--<label for="phone">课程主题</label>-->
                        <!--<input type="text" name="type_name" id="type_name" class="w428 b_none f_size" placeholder="请输入课程主题">-->
                    <!--</div>-->
                    <div class="startTime h58 b_bottom m_bottom_20" style="position: relative;">
                        <label>开播时间</label>
                        <input class="w428 b_none f_size" name="zhibo_start_time" type="datetime-local" value="" placeholder="请输入开播时间">
                        <!--<input class="weui-input w428 b_none f_size" id="time-inline" style="background: #fff" type="text" value="" readonly="">-->
                    </div>
                    <!--<div class="Time h58 b_bottom m_bottom_20">-->
                        <!--<label>录课时长</label>-->
                        <!--<input type="number" id="Time" name="times" class="w428 b_none f_size" v-model="Time" :value="Time" placeholder=" 请输入录课时长(小时为单位)">-->
                    <!--</div>-->
                    <div class="qunNum h58 b_bottom m_bottom_20">
                        <label for="qunNum">预计群数</label>
                        <input type="number" id="qunNum" name="qun_num" class="w428 b_none f_size" v-model="qunNum" :value="qunNum" placeholder=" 请输入预计群数">
                    </div><?php endif; ?>
			</div>
		</div>
		<div class="no_not_null">
			<div class="hd">
				<p>基本设置 (非必填，进、退群语无内容则不发送)</p>
			</div>
			<div class="content">
				<div class="special_helper h58 b_bottom m_bottom">
					<label for="special_helper">小助手昵称</label>
					<input type="text" id="special_helper" name="nickname" class="w428 b_none f_size" style="background: #fff" value="直播助手">
				</div>
				<div class="qunText h58 b_bottom m_bottom" style="height:120px;">
					<label for="qunText">进群招呼语</label>
                    <textarea id="qunText" style="line-height: 65px;width: 4.25rem;border: none;font-size: 21px;" name="hello" >大家好，我是微燃科技小助手，今天的课程由我为大家直播。</textarea>
					<!--<input type="text" id="qunText" name="hello" class="w428 b_none f_size"  value="大家好，我是微燃科技小助手，今天的课程由我为大家直播。">-->
				</div>
                <div class="qunText h58 b_bottom m_bottom" style="height:120px;">
                    <label for="qunText">退群招呼语</label><br>
                    <textarea id="qunText" style="line-height: 65px;width: 4.25rem;border: none;font-size: 21px;" name="out" >本次课程到此结束，感谢大家收听！稍后小助手会自动退群。</textarea>
                    <!--<input type="text" id="qunText" name="out" class="w428 b_none f_size"  value="本次课程到此结束，感谢大家收听！稍后小助手会自动退群。">-->
                </div>
			</div>
		</div>
		<div class="getOrder" style="margin-bottom: 200px;">
            <input type="hidden" name="type" value="<?php echo ($type); ?>" />
            <input type="hidden" name="classify" id="classify" />
            <button type="button" class=" noborder" style="background: #2baa3f !important;" id="sureOrder">确认下单</button>
		</div>
		<transition>
			<div v-if="alertBox" class="alert">{{alertText}}</div>
		</transition>
	</div>
    </form>
    <div class="meng" style="position: absolute;top: 0;width: 100%;height: 100%;opacity: 0.3;background: rgba(0,0,0,5);display: none">
    </div>
    <div class="first" style="display: none;">
        <h4>联系客服</h4>
        <div class="code">
            <img style="width: 100%;height: 100%" src="http://www.jiechen258.com/Uploads/2018-09-10/5b9610c46f8da.png" />
        </div>
        <p style="text-align: center; font-size: 17px">您的下单数量超过100个群，请直接联系客服(长按扫描二维码或添加微信：zhuanbo77) 我们将为您提供VIP定制服务，将节省您后续大量时间。</p>
        <div class="close" style="background: url('/Public/Wap/images/close.png') center center no-repeat;"></div>
    </div>
    <script src="/Public/Wap/js/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="/Public/Wap/js/vue.min.js"></script>
	<script type="text/javascript" src="/Public/Wap/js/order1.js"></script>
    <script src="/Public/Wap/js/jquery.form.js"></script>
    <script  type="text/javascript" src="/Public/layer-v3.0.3/mobile/layer.js"></script>
    <script type="text/javascript" src="/Public/Wap/js/jquery-weui.min.js"></script>
    <script type="text/javascript" src="/Public/Wap/js/swiper.min.js"></script>
    <script>
        var type = '<?php echo ($type); ?>';
        $('.classify-list').on('click','.type',function(){
            $('.classify-list .p_back1').removeClass('p_back1');
            var classify = $(this).attr('index');
            $('#classify').val(classify);
            $(this).addClass('p_back1');
        })
        $('.close').click(function (){
            $('.meng').css('display','none');
            $('.first').css('display','none');
        })
        $('#sureOrder').click(function(){
            if(type==1){
                if($('#qunNum').val()>=100){
                    $('.meng').css('display','block');
                    $('.first').css('display','block');
                    return false;
                }
//                if($('#phone').val()==''||$('#phone').val().length!=11){
//                    layer.open({
//                        content: '请输入正确手机格式!'
//                        , skin: 'msg'
//                        , time: 2 //2秒后自动关闭
//                    });
//                    return false;
//                }
                if($('#qunNum').val()==''||$('#wechat').val()==''){
                    layer.open({
                        content: '请填写完整!'
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                    return false;
                }
            }else{
                if($('#qunNum').val()==''||$('#startTime').val()==''||$('#wechat').val()==''){
                    layer.open({
                        content: '请填写完整!'
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                    return false;
                }
            }

            $('#form').ajaxSubmit({
                type: "post",
                url : '/index.php?m=Wap&c=Order&a=doOrder',
                success: function (data) {
                if (data.success == 1) {
                    // 此处可对 data 作相关处理
                    layer.open({
                        content: '下单成功!'
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                    if(type==1){
                        setTimeout('window.location.href = "<?php echo U('Index/order2');?>&id='+data.data+'";',1000);
                    }else{
                        setTimeout('window.location.href = "<?php echo U('Index/Success');?>&id='+data.data+'";',1000);
                    }
                }else if(data.success == -1){
                    layer.open({
                        content: '最底不少于'+data.data+'个群!'
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                }else if(data.success == -2){
                    layer.open({
                        content: '小助手数量不足!'
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                }else if(data.success == -3){
                    layer.open({
                        content: '验证码与现在直播中的验证码重复!'
                        , skin: 'msg'
                        , time: 2 //2秒后自动关闭
                    });
                }
                return false;
            }
            })
        })
    </script>
</body>
</html>