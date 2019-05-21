<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>用户管理</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css?qwe=456" media="all">
  <link rel="stylesheet" href="/Public/layuiadmin/style/admin.css?zxc=789" media="all">
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-form layui-card-header layuiadmin-card-header-auto">
        <div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">ID</label>
            <div class="layui-input-block">
              <input type="text" name="user_id" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
              <input type="text" name="user_nickname#like" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
              <select name="user_sex">
                <option value="">不限</option>
                <option value="0">未知</option>
                <option value="1">男</option>
                <option value="2">女</option>
              </select>
            </div>
          </div>
          <div class="layui-inline">
            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-user-front-search">
              <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
            </button>
          </div>
        </div>
      </div>
      
      <div class="layui-card-body">
        <div style="padding-bottom: 10px;">
          <button class="layui-btn layuiadmin-btn-useradmin" data-type="batchdel">删除</button>
        </div>
        
        <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>
        <script type="text/html" id="imgTpl"> 
          <img style="display: inline-block;  height: 100%;" src= {{ d.user_headimgurl }}>
        </script>
        <script type="text/html" id="sexTpl">
          <span>{{#
              if(d.user_sex==1){
                return "男";
              }
              else if(d.user_sex==2){
                return "女";
              }
              else if(d.user_sex==0){
                return "未知";
              }
            }}</span>
        </script>
        <script type="text/html" id="table-tool-bar">
          <!--<a class="layui-btn layui-btn-normal layui-btn-xs" target="_blank" href="index.php?m=Admin&c=Order&a=order&user_id={{d.user_id}}">订单</a>-->
          <a class="layui-btn layui-btn-success layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-delete"></i>修改余额</a>
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
        </script>
      </div>
    </div>
  </div>

  <script src="/Public/layuiadmin/layui/layui.js"></script>
  <script>
    layui.config({
      base: '/Public/layuiadmin/', //静态资源所在路径    //自定义响应字段
      version: true
    }).extend({
      index: 'lib/index' //主入口模块
    }).use(['index', 'user', 'table','admin'], function(){
      var $ = layui.$
      ,form = layui.form
      ,table = layui.table;

      //监听搜索
      form.on('submit(LAY-user-front-search)', function(data){
        var field = data.field;
        //执行重载
        table.reload('LAY-user-manage', {
          where: field
        });
      });

      //事件
      var active = {
        batchdel: function(){
          var checkStatus = table.checkStatus('LAY-user-manage')
          ,checkData = checkStatus.data; //得到选中的数据
          var idList = "";
          for(var i = 0;i<checkData.length;i++){
            idList += checkData[i].user_id+",";
          }
          if(checkData.length === 0){
            return layer.msg('请选择数据');
          }
          layer.confirm('确定删除吗？', function(index) {
            //执行 Ajax 后重载
            layui.admin.req({
              url: 'index.php?m=Admin&c=Data&a=deleteData&table=user&id='+idList,
              method:'get',
              success:function(res){
                if(res.code==0 && res.success==1){
                  table.reload('LAY-user-manage');
                  layer.msg('已删除');
                }
                else{
                  layer.msg('删除失败');
                }
              },
              error:function(){
                layer.msg('删除失败');
              }
            });
          });
        }
      };

      $('.layui-btn.layuiadmin-btn-useradmin').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
      });
    });
  </script>
</body>
</html>