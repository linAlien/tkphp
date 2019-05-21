<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>添加客服</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>

  <div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">名称</label>
      <div class="layui-input-inline">
        <input type="text" name="kefu_name" lay-verify="required" placeholder="请输入机器人名" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">微信号</label>
      <div class="layui-input-inline">
        <input type="text" name="kefu_wechat" lay-verify="required" placeholder="请输入机器人微信号" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">二维码</label>
      <div class="layui-input-inline">
        <input type="text" name="kefu_qrcode" lay-verify="required" placeholder="请上传图片" autocomplete="off" class="layui-input" >
      </div>
      <button style="float: left;" type="button" class="layui-btn" id="layuiadmin-upload">上传二维码</button>
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
    
    upload.render({
      elem: '#layuiadmin-upload'
      ,url: 'index.php?m=Admin&c=Tool&a=upload'
      ,accept: 'images'
      ,field: 'file'
      ,method: 'post'
      ,acceptMime: 'image/*'
      ,before: function(obj){
        console.log('文件上传中');
        layui.layer.load();
      }
      ,done: function(res){
        layui.layer.closeAll('loading');
        $(this.item).prev("div").children("input").val(res.data.src)
      },error: function(){
        //请求异常回调
        layui.layer.closeAll('loading');
        layui.layer.msg("上传失败");
      }
    });
  })
  </script>
</body>
</html>