<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>系统设置</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/Public/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">系统设置</div>
          <div class="layui-card-body" pad15>
            <div class="layui-form" wid100 lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">vip包月价格<br/>(每月)</label>
                <div class="layui-input-block">
                  <input type="text" name="sys_vip_price" value="<?php echo ($sys["sys_vip_price"]); ?>" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">客服热线</label>
                <div class="layui-input-block">
                  <input type="text" name="sys_tel" value="<?php echo ($sys["sys_tel"]); ?>" class="layui-input">
                  <input type="hidden" name="sys_id" value="<?php echo ($sys["sys_id"]); ?>" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">分销比例<br/>（用户消费时上级获得的提成）</label>
                <div class="layui-input-block">
                  <input type="text" name="sys_ratio" value="<?php echo ($sys["sys_ratio"]); ?>" class="layui-input">
                </div>
              </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">区间外单群价格<br/>(直/录播群数在范围外时单价)</label>
                    <div class="layui-input-block">
                        <input type="text" name="sys_group_price" value="<?php echo ($sys["sys_group_price"]); ?>" class="layui-input">
                    </div>
                </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">vip包月特权</label>
                <div class="layui-input-block">
                  <textarea name="sys_vip" class="layui-textarea"><?php echo ($sys["sys_vip"]); ?></textarea>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">直播说明</label>
                <div class="layui-input-block">
                  <textarea name="sys_zhibo" class="layui-textarea" placeholder=""><?php echo ($sys["sys_zhibo"]); ?></textarea>
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">录播说明</label>
                <div class="layui-input-block">
                  <textarea name="sys_lubo" class="layui-textarea"><?php echo ($sys["sys_lubo"]); ?></textarea>
                </div>
              </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">新用户关注自动回复内容</label>
                    <div class="layui-input-block">
                        <textarea name="sys_new_user" class="layui-textarea"><?php echo ($sys["sys_new_user"]); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">点击转发回复的内容</label>
                    <div class="layui-input-block">
                        <textarea name="sys_zhuanfa" class="layui-textarea"><?php echo ($sys["sys_zhuanfa"]); ?></textarea>
                    </div>
                </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">客服二维码</label>
                <div class="layui-input-block">
                  <?php if($sys["sys_qrcode"] != ''): ?><input type="text" name="sys_qrcode" value="<?php echo ($sys["sys_qrcode"]); ?>" id="sys_qrcode" />
                      <?php else: ?>
                      <input type="text" name="sys_qrcode" id="sys_qrcode" /><?php endif; ?>
                    <button type="button" class="layui-btn" id="layuiadmin-upload">上传二维码</button>
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button  class="layui-btn" lay-submit lay-filter="set_website">确认保存</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/Public/layuiadmin/layui/layui.js"></script>
  <script>
      window.Url_Request ={
          url:'<?php echo U("Data/getData");?>&table=sys'
      }
      layui.config({
          base: '/Public/layuiadmin/' //静态资源所在路径
      }).extend({
          index: 'lib/index' //主入口模块
      }).use(['index', 'form', 'upload','layer'], function(){
     // }).use(['index', 'set']);
          var $ = layui.$
                  ,form = layui.form
                  ,admin = layui.admin
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
                  $('#sys_qrcode').val(res.data.src)
              },error: function(){
                  //请求异常回调
                  layui.layer.closeAll('loading');
                  layui.layer.msg("上传失败");
              }
          });
          form.on('submit(set_website)', function(obj){
              //提交修改
              admin.req({
                  url: 'index.php?m=Admin&c=Data&a=editData&table=sys'
                  ,data: obj.field
                  ,method:'post'
                  ,success: function(res){
                      if(res.code==0 && res.success==1){
                          layer.msg('编辑成功');
                          setTimeout("window.location.reload()",2000);
                      }
                      else{
                          layer.msg('编辑失败');
                      }
                  },
                  error:function(){
                      layer.msg('编辑失败');
                  }
              });
              return false;
          });
      })
  </script>
</body>
</html>