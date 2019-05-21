<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>编辑客服</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
</head>
<style>
    .layui-input-inline{
        width:1000px;
    }
</style>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">教程标题</label>
        <div class="layui-input-inline">
            <input type="text" name="teach_title" value="<?php echo ($teach["teach_title"]); ?>" lay-verify="required" placeholder="请输入关键字" autocomplete="off" class="layui-input">
            <input type="hidden" name="teach_id" value="<?php echo ($teach["teach_id"]); ?>" />
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">教程简介</label>
        <div class="layui-input-inline">
            <input type="text" name="teach_name" value="<?php echo ($teach["teach_name"]); ?>" lay-verify="required" placeholder="请输入回复内容" autocomplete="off" class="layui-input" >
        </div>
    </div>
    <div class="">
        <label class="layui-form-label">教程内容</label>
        <div class="layui-input-inline">
            <textarea id="demo" lay-verify="content" style="display: none;"><?php echo ($teach["teach_content"]); ?></textarea>
            <input type="hidden" name="teach_content" value="<?php echo ($teach["teach_content"]); ?>" id="teach_content" />
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-front-submit" id="LAY-front-submit" value="确认">
    </div>
</div>

  <script src="/Public/layuiadmin/layui/layui.js"></script>
  <script>
      var editIndex1 = null,layedit1 = null;
  layui.config({
    base: '/Public/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'form', 'upload','layer'], function(){
    var $ = layui.$
    ,form = layui.form
    ,upload = layui.upload ;
      layui.use('layedit', function(){
          layedit1 = layui.layedit;
          layedit1.set({
              uploadImage: {
                  url: '/index.php?m=Admin&c=Index&a=uploadImage' //接口url
                  ,type: 'post', //默认post
                  success:function(res){

                  }
              }
          });
          editIndex1  = layedit1.build('demo',{
              width: 1000, //设置编辑器高度
              height: 300 //设置编辑器高度
          }); //建立编辑器
      });
  })
  </script>
</body>
</html>