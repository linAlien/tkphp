<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>编辑客服</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">类型</label>
        <div class="layui-input-inline">
            <select name="admin_role">
                <?php if($group["type"] == 1): ?><option selected value="1">直播套餐</option>
                    <option value="2">录播套餐</option>
                    <?php else: ?>
                    <option value="1">直播套餐</option>
                    <option selected value="2">录播套餐</option><?php endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">起点群数</label>
        <div class="layui-input-inline">
            <input type="text" name="start" value="<?php echo ($group["start"]); ?>" lay-verify="required" placeholder="请输入起点群数" autocomplete="off" class="layui-input">
            <input type="hidden" name="group_id" value="<?php echo ($group["group_id"]); ?>" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">末尾群数</label>
        <div class="layui-input-inline">
            <input type="text" name="end" value="<?php echo ($group["end"]); ?>" lay-verify="required" placeholder="请输入末尾群数" autocomplete="off" class="layui-input" >
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">单群价格</label>
        <div class="layui-input-inline">
            <input type="text" name="price" value="<?php echo ($group["price"]); ?>" lay-verify="required" placeholder="请输入单群价格" autocomplete="off" class="layui-input" >
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