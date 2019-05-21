<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>订单详情</title>
  <meta name="viewport" content="target-densitydpi=286, width=640, user-scalable=no" />
 
  <link rel="stylesheet" href="/Public/Wap/css/media.css" />

  <!-- Demo styles -->
  <style>
    html, body {
      position: relative;
      height: 100%;
    }

    .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
    video::-webkit-media-controls-enclosure {overflow:hidden;}
		video::-webkit-media-controls-panel {width: calc(100% + 30px);}
  </style>
</head>
<body>
	<div class="body-class">
			<div class="nav-class">
			  	<span class="span-act" data="one">直播情况</span>
			  	<span data="two">人数统计</span>
			</div>
			<div class="content-box tal_one" style="padding:0 0 0 0 ;margin-top: 20px;">
		  	<div class="content-class" style="text-align: center;">
		  		<span style="color: #E77E55;font-size: 30px"><?php echo ($data["title"]); ?></span>
		  	</div>
		  	<hr />
		  	<div style="line-height: 50px;width: 100%;height: 60px;">
		  			<span style="font-size:22px;font-family:PingFang-SC-Medium;font-weight:500;color:rgba(153,153,153,1);">微燃课堂</span>
		  			<span style="font-size:22px;margin-left:71px;font-family:PingFang-SC-Medium;font-weight:500;color:rgba(153,153,153,1);">群名称</span>
		  			<span style="font-size:22px;margin-left:94px;font-family:PingFang-SC-Medium;font-weight:500;color:rgba(153,153,153,1);">邀请人</span>
		  			<span style="font-size:22px;margin-left:92px;font-family:PingFang-SC-Medium;font-weight:500;color:rgba(153,153,153,1);">备注</span>
		  	</div>
                <?php if(is_array($data["robots"])): $i = 0; $__LIST__ = $data["robots"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div style="border-top: 2px solid #CCCCCC;display: flex;">
                    <div style="height: auto;border-left: 2px solid #CCCCCC;border-bottom: 2px solid #CCCCCC;float: left;width: 150px;text-align: center;">
                        <?php echo ($s["robotId"]); ?>
                    </div>
                    <div style="border-left: 2px solid #CCCCCC;border-right: 2px solid #CCCCCC;border-bottom: 2px solid #CCCCCC;float: right;width:75%">
                   <?php if(is_array($s["rooms"])): $i = 0; $__LIST__ = $s["rooms"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><div style="display:flex;border-bottom: 2px solid #CCCCCC;">
                            <div style="border-right: 2px solid #CCCCCC;width:33%;font-size: 24px;height: 79px;text-align: center;"><?php echo ($r["roomName"]); ?></div>
                            <div style="border-right: 2px solid #CCCCCC;width:33%;font-size: 24px;height: 79px;text-align: center;"><?php echo ($r["inviterNickname"]); ?></div>
                            <div style="height: 79px;text-align: center;line-height: 79px;width:33%;"><?php if(!empty($r["kickerNickname"])): echo ($r["kickerNickname"]); ?>被踢出/踢出者<?php echo ($r["kickedOutTs"]); endif; ?></div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div style="display:flex;"><p style="width: 50%;font-size: 24px;">最大进群数：<?php echo ($s["maxJoinable"]); ?></p><p style="width: 50%;font-size: 24px;">剩余进群数：<?php echo ($s["joined"]); ?></p></div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
		  	<div style="border-top: 2px solid #CCCCCC;border-bottom: 2px solid #CCCCCC;float:right;position:relative;top:70px;width: 100%;height: 60px;line-height: 55px;text-align: center;">
		  		<span style="font-size: 24px;color: #48A948;margin-left: 80px;">直播状态：
                <?php if($data["status"] == 0): ?>已建立
                    <?php elseif($data["status"] == 1): ?>
                    已开始
                    <?php elseif($data["status"] == 2): ?>
                    暂停中
                    <?php elseif($data["status"] == 3): ?>
                    已结束
                    <?php elseif($data["status"] == 4): ?>
                    主讲群机器人被踢出<?php endif; ?>
                </span>
		  	</div>
		  	<div style="border-bottom: 2px solid #CCCCCC;float:right;position:relative;top:70px;width: 100%;height: 60px;line-height: 55px;">
		  		<span style="font-size: 24px;color: #48A948;margin-left: 80px;">购买直播群数：<?php echo ($num); ?></span>
		  		<span style="font-size: 24px;color: #E77E55;margin-left: 80px;">剩余可进群数：0</span>
		  	</div>
		  </div>
		 	
			<div class="tal_two" style="display: none;padding:0 0 0 0 ;margin-top: 20px;" >
			 <div class="content-class" style="text-align: center;">
		  		<span style="color: #E77E55;font-size: 30px;"><?php echo ($data["title"]); ?></span>
		  	</div>
		  	<hr />
		  	<div style="line-height: 50px;width: 100%;height: 60px;">
		  			<span style="font-size:22px;font-family:PingFang-SC-Medium;font-weight:500;color:rgba(153,153,153,1);">群名称</span>
		  			<span style="font-size:22px;margin-left:300px;font-family:PingFang-SC-Medium;font-weight:500;color:rgba(153,153,153,1);">群人数</span>
		  	</div>
		  	<div style="border-bottom: 2px solid #CCCCCC;">
               <?php if(is_array($data["rooms"])): $i = 0; $__LIST__ = $data["rooms"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><div style="height: 60px;line-height:60px;display:flex;width: 100%;">
		  			<div style="width:50%;font-size: 24px;border-top: 2px solid #CCCCCC;border-right: 2px solid #CCCCCC;"><?php echo ($a["roomName"]); ?></div><div style="font-size:22px;width:50%;border-top: 2px solid #CCCCCC;"><?php echo ($a["memberCount"]); ?></div>
		  	    </div><?php endforeach; endif; else: echo "" ;endif; ?>
		  	</div>
		  	<div style="width: 100%;height: 60px;line-height: 55px;text-align: center;">
		  		<span style="font-size: 24px;color: #E77E55;margin-left: 80px;">总计：<?php echo ($data["roomCount"]); ?>个群、<?php echo ($data["num"]); ?>人</span>
		  	</div>
		  	<hr />
		  </div>
		  </div>

   </div>
  

  <!-- Swiper JS -->
  <script type="text/javascript" src="/Public/Wap/js/jquery.min.js" ></script>
  <script src="/Public/Wap/js/swiper.js"></script>

  <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
            },
        });
        $(".nav-class").find("span").on("click",function(){
            $(".nav-class").find("span").removeClass("span-act");
            $(this).addClass("span-act");
            var tal=$(this).attr("data");
            if(tal=="one"){
                $(".tal_two").hide();
                $(".tal_one").show();

            }else{
                $(".tal_one").hide();
                $(".tal_two").show();
            }
        })

        var video1=document.getElementById("cideoPlay1");

        video1.onclick=function(){
            if(video1.paused){
                video1.play();
            }else{
                video1.pause();
            }
        }

    </script>
</body>
</html>