<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登入 - 微燃课堂后台</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/Public/layuiadmin/style/login.css" media="all">
</head>
<body>

  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>微燃课堂后台</h2>
      </div>
        <form action="/index.php?m=Admin&c=Login&a=doLogin" method="post" id="form">
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
          <input type="text" name="username" id="LAY-user-login-username"  placeholder="用户名" class="layui-input">
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
          <input type="password" name="password" id="LAY-user-login-password"  placeholder="密码" class="layui-input">
        </div>
        <!--<div class="layui-form-item">-->
          <!--<div class="layui-row">-->
            <!--<div class="layui-col-xs7">-->
              <!--<label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>-->
              <!--<input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input">-->
            <!--</div>-->
            <!--<div class="layui-col-xs5">-->
              <!--<div style="margin-left: 10px;">-->
                <!--<img src="https://www.oschina.net/action/user/captcha" class="layadmin-user-login-codeimg" id="LAY-user-get-vercode">-->
              <!--</div>-->
            <!--</div>-->
          <!--</div>-->
        <!--</div>-->
        <div class="layui-form-item" style="margin-bottom: 20px;">
          <!--<input type="checkbox" name="remember" lay-skin="primary" title="记住密码">-->
          <!--<a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">没有账号？</a>-->
        </div>
        <div class="layui-form-item">
          <button type="button" class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
        </div>
        <div class="layui-trans layui-form-item layadmin-user-login-other">
          <!--<label>社交账号登入</label>-->
          <!--<a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>-->
          <!--<a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>-->
          <!--<a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>-->
          
          <!--<a href="<?php echo U('Login/reg');?>" class="layadmin-user-jump-change layadmin-link">注册帐号</a>-->
        </div>
      </div>
        </form>
    </div>
    
  </div>

  <script src="/Public/layuiadmin/layui/layui.js"></script>
  <script>
      layui.config({
          base: '/Public/layuiadmin/' //静态资源所在路径
      }).extend({
          index: 'lib/index' //主入口模块
  }).use(['index', 'user'], function(){
    var $ = layui.$
    ,setter = layui.setter
    ,admin = layui.admin
    ,form = layui.form
    ,router = layui.router()
    ,search = router.search;

    form.render();
      form.on('submit(LAY-user-login-submit)', function(data){
          $.post("<?php echo U('Login/doLogin');?>",data.field,function(res){
              if(res.success == 1){
                  layer.msg(res.msg, {time: 2000});
                  var url = "/index.php?m=Admin&c=Index&a=index"; //
                  setTimeout(window.location.href=url,2000);
              }else{
                  layer.msg(res.msg, {time: 2000});
              }
          },'json');
          return false;
      });
  });

  </script>
</body>
</html>