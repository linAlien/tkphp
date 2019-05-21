<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<title>直播详情</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/one.css">
</head>
<body>
	<div class="box">
		<header class="header">
			<div class="header-desc color1">直播情况</div>
			<div class="header-hr"></div>
			<div class="header-desc">人数统计</div>
		</header>
		<section class="center">
			<h4 class="center-title"><?php echo ($data["title"]); ?></h4>

			<div class="center-table-title">
				<div class="center-table-title-desc1">微燃课堂</div>
				<div class="center-table-title-desc2">群名称</div>
				<div class="center-table-title-desc3">邀请人</div>
				<div class="center-table-title-desc4">备注</div>
			</div>
            <?php if(is_array($data["robots"])): $i = 0; $__LIST__ = $data["robots"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div class="center-tableBox">
				<div class="center-tableBox-left"><?php echo ($s["robotId"]); ?></div>
				<div class="center-tableBox-right">
                    <?php if(is_array($s["rooms"])): $i = 0; $__LIST__ = $s["rooms"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><div class="center-tableBox-right-list">
						<div class="center-tableBox-right-list-row">
							<div class="tableBox-right-row1"><?php echo ($r["roomName"]); ?></div>
							<div class="tableBox-right-row2"><?php echo ($r["inviterNickname"]); ?></div>
							<div class="tableBox-right-row3"><?php if(!empty($r["kickerNickname"])): echo ($r["kickerNickname"]); ?>被踢出/踢出者<?php echo ($r["kickedOutTs"]); endif; ?></div>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="center-tableBox-right-bottom">
						<p>最大进群数：<?php echo ($s["maxJoinable"]); ?></p>
						<p>剩余进群数：<?php echo ($s["joined"]); ?></p>
					</div>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>

			<div class="center-state color1">直播状态：
                <?php if($data["status"] == 0): ?>已建立
                <?php elseif($data["status"] == 1): ?>
                已开始
                <?php elseif($data["status"] == 2): ?>
                暂停中
                <?php elseif($data["status"] == 3): ?>
                已结束
                <?php elseif($data["status"] == 4): ?>
                主讲群机器人被踢出<?php endif; ?></div>
			<div class="center-footer">
				<p class="color1">购买直播群数：<?php echo ($num); ?></p>
				<p class="color2">剩余可进群数：0</p>
			</div>
		</section>
	</div>
</body>
</html>
<script type="text/javascript">
	var nav = document.getElementsByClassName('header-desc')[1];
	nav.onclick = function(){
        var id = '<?php echo ($id); ?>';
        console.log(id);
		window.location.href = "<?php echo U('two');?>&sessionid="+id+"&num=<?php echo ($num1); ?>"
	}
</script>