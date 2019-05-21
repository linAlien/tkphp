<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>编辑套餐</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <select name="is_on">
                <?php if($package["is_on"] == 1): ?><option selected value="1">开启</option>
                    <option value="0">禁止</option>
                    <?php else: ?>
                    <option value="1">开启</option>
                    <option selected value="0">禁止</option><?php endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">充值门槛</label>
        <div class="layui-input-inline">
            <input type="text" name="money" value="<?php echo ($package["money"]); ?>" lay-verify="required" placeholder="请输入充值门槛" autocomplete="off" class="layui-input" >
            <input type="hidden" name="package_id" value="<?php echo ($package["package_id"]); ?>" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">赠送金额</label>
        <div class="layui-input-inline">
            <input type="text" name="send_money" value="<?php echo ($package["send_money"]); ?>" lay-verify="required" placeholder="请输入赠送金额" autocomplete="off" class="layui-input" >
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-front-submit" id="LAY-front-submit" value="确认">
    </div>
</div>

  <script src="/Public/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '/Public/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'form', 'upload','layer'], function(){
    var $ = layui.$
    ,form = layui.form
    ,upload = layui.upload ;
  })
  </script>
</body>
</html>