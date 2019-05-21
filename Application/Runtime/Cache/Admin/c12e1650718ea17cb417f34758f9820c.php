<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>添加角色</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>

  <div class="layui-form" lay-filter="layuiadmin-form-role" id="layuiadmin-form-role" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">角色名</label>
      <div class="layui-input-inline">
        <input type="text" name="role_name" lay-verify="required" placeholder="请输入角色名" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">权限范围</label>
      <div class="layui-input-block">
        <input type="checkbox" name="role_power[]" value="1" lay-skin="primary" title="账号管理">
        <input type="checkbox" name="role_power[]" value="2" lay-skin="primary" title="角色管理">
        <input type="checkbox" name="role_power[]" value="3" lay-skin="primary" title="用户管理">
        <input type="checkbox" name="role_power[]" value="4" lay-skin="primary" title="订单管理">
        <input type="checkbox" name="role_power[]" value="5" lay-skin="primary" title="机器人管理">
        <input type="checkbox" name="role_power[]" value="6" lay-skin="primary" title="余额管理">
        <input type="checkbox" name="role_power[]" value="7" lay-skin="primary" title="设置管理">
        <input type="checkbox" name="role_power[]" value="8" lay-skin="primary" title="套餐管理">
        <input type="checkbox" name="role_power[]" value="9" lay-skin="primary" title="自动回复管理">
        <input type="checkbox" name="role_power[]" value="10" lay-skin="primary" title="充值套餐管理">
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
  }).use(['index', 'form'], function(){
    var $ = layui.$
    ,form = layui.form ;
  })
  </script>
</body>
</html>