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
        <label class="layui-form-label">关键字</label>
        <div class="layui-input-inline">
            <input type="text" name="reply_keyword" value="<?php echo ($reply["reply_keyword"]); ?>" lay-verify="required" placeholder="请输入关键字" autocomplete="off" class="layui-input">
            <input type="hidden" name="reply_id" value="<?php echo ($reply["reply_id"]); ?>" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">回复内容</label>
        <div class="layui-input-inline">
            <input type="text" name="reply_content" value="<?php echo ($reply["reply_content"]); ?>" lay-verify="required" placeholder="请输入回复内容" autocomplete="off" class="layui-input" >
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