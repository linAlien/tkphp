<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>编辑订单</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>

  <div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
    <!--<div class="layui-form-item">-->
      <!--<label class="layui-form-label">用户手机</label>-->
      <!--<div class="layui-input-inline">-->
        <!--<input type="text" name="user_tel" value="<?php echo ($order["user_tel"]); ?>" lay-verify="required" placeholder="请输入用户手机号" autocomplete="off" class="layui-input">-->
      <!--</div>-->
    <!--</div>-->
    <div class="layui-form-item">
      <label class="layui-form-label">用户微信</label>
      <div class="layui-input-inline">
        <input type="text" name="wechat" value="<?php echo ($order["wechat"]); ?>" lay-verify="required" placeholder="请输入微信号" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">直播/录播时间</label>
      <div class="layui-input-inline">
        <input type="text" id="date" name="zhibo_start_time" value="<?php echo ($order["zhibo_start_time"]); ?>" lay-verify="required" placeholder="请输入直播/录播时间" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">群助手昵称</label>
      <div class="layui-input-inline">
        <input type="text" name="nickname" value="<?php echo ($order["nickname"]); ?>" lay-verify="required" placeholder="请输入群助手昵称" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">进群欢迎语</label>
      <div class="layui-input-inline">
        <input type="text" name="hello" value="<?php echo ($order["hello"]); ?>" lay-verify="required" placeholder="请输入进群欢迎语" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">退群语</label>
      <div class="layui-input-inline">
        <input type="text" name="out" value="<?php echo ($order["out"]); ?>" lay-verify="required" placeholder="请输入退群语" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item layui-hide">
      <input type="hidden" name="order_id" value="<?php echo ($order["order_id"]); ?>">
      <input type="button" lay-submit lay-filter="LAY-front-submit" id="LAY-front-submit" value="确认">
    </div>
  </div>

  <script src="/Public/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '/Public/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'form', 'upload','layer','laydate'], function(){
    var $ = layui.$
    ,form = layui.form;
    var laydate = layui.laydate;
    //日期选择器
    laydate.render({
      elem: '#date'
      ,type: 'datetime' //默认，可不填
    });
  })
  </script>
</body>
</html>