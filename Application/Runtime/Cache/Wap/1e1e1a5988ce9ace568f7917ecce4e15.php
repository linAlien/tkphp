<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=640,user-scalable=0">
	<title>直播详情</title>
	<link rel="stylesheet" type="text/css" href="/Public/Wap/css/two.css">
</head>
<body>
	<div class="box">
		<header class="header">
			<div class="header-desc">直播情况</div>
			<div class="header-hr"></div>
			<div class="header-desc color1">人数统计</div>
		</header>
		<section class="center">
			<h4 class="center-title"><?php echo ($data["title"]); ?></h4>

			<div class="center-table-title">
				<div>群名称</div>
				<div>群人数</div>
			</div>

			<div class="center-tableBox">
                <?php if(is_array($data["rooms"])): $i = 0; $__LIST__ = $data["rooms"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><div class="center-tableBox-row">
					<div class="b-right"><?php echo ($a["roomName"]); ?></div>
					<div><?php echo ($a["memberCount"]); ?></div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>

			<div class="center-state color2">总计：<?php echo ($data["roomCount"]); ?>个群、<?php echo ($data["num"]); ?>人</div>
		</section>
	</div>
</body>
</html>
<script type="text/javascript">
	var nav = document.getElementsByClassName('header-desc')[0];
	nav.onclick = function(){
        var id = '<?php echo ($id); ?>';
        console.log(id);
        window.location.href = "<?php echo U('zhibo');?>&sessionid="+id+"&num=<?php echo ($num1); ?>"
	}
</script>