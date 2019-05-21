<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>编辑管理员</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>

<div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin" style="padding: 20px 0 0 0;">
  <div class="layui-form-item">
    <label class="layui-form-label">账号</label>
    <div class="layui-input-inline">
      <input type="text" name="admin_account" value="<?php echo ($admin["admin_account"]); ?>" lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-inline">
      <input type="text" name="admin_password" value="<?php echo ($admin["admin_password"]); ?>" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">角色</label>
    <div class="layui-input-inline">
      <select name="admin_role">
        <option value="<?php echo ($admin["admin_role"]); ?>"><?php echo ($admin["admin_role_name"]); ?></option>
        <?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><option value="<?php echo ($role["role_id"]); ?>"><?php echo ($role["role_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
  </div>
  <div class="layui-form-item layui-hide">
    <input type="hidden" name="admin_id" value="<?php echo ($admin["admin_id"]); ?>">
    <input type="button" lay-submit lay-filter="LAY-front-submit" id="LAY-front-submit" value="确认">
  </div>
</div>

<script src="/Public/layuiadmin/layui/layui.js"></script>
<script>
  layui.config({
    base: '/Public/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'form', ], function(){
    var $ = layui.$,form = layui.form;

  })
</script>
</body>
</html>