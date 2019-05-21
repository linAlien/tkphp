/**

 @Name：layuiAdmin（iframe版） 设置
 @Author：贤心
 @Site：http://www.layui.com/admin/
 @License: LPPL
    
 */
 
layui.define(['form', 'upload'], function(exports){
  var $ = layui.$
  ,layer = layui.layer
  ,laytpl = layui.laytpl
  ,setter = layui.setter
  ,view = layui.view
  ,admin = layui.admin
  ,form = layui.form
  ,upload = layui.upload;

  var $body = $('body');

    //设置密码
    form.on('submit(setmypass)', function(obj){
        //提交修改
        admin.req({
        url: 'http://www.gao4567.com/index.php?m=Admin&c=Set&a=editPwd'
        ,data: obj.field
        ,method:'post'
        ,success: function(res){
                if(res.code==0 && res.success==1){
                    window.location.reload();
                }
                else if(res.success == -1){
                    layer.msg('原密码错误!');
                }
            },
            error:function(){
                layer.msg('编辑失败');
            }
        });
        return false;
    });
    //自定义验证
    form.verify({
        //我们既支持上述函数式的方式，也支持下述数组的形式
        //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
        pass: [
            /^[\S]{6,12}$/
            ,'密码必须6到12位，且不能出现空格'
        ]

        //确认密码
        ,repass: function(value){
            if(value !== $('#LAY_password').val()){
                return '两次密码输入不一致';
            }
        }
    });
  //网站设置
  form.on('submit(set_website)', function(obj){
    //提交修改
    admin.req({
        url: 'http://www.gao4567.com/index.php?m=Admin&c=Data&a=editData&table=sys'
      ,data: obj.field
      ,method:'post'
      ,success: function(res){
            if(res.code==0 && res.success==1){
                layer.msg('编辑成功');
                window.location.reload();
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
  //上传头像
  var avatarSrc = $('#LAY_avatarSrc');
    upload.render({
        elem: '#layuiadmin-upload'
        ,url: 'http://www.gao4567.com/index.php?m=Admin&c=Tool&a=upload'
        ,accept: 'images'
        ,field: 'file'
        ,method: 'post'
        ,acceptMime: 'image/*'
        ,before: function(obj){
            console.log('文件上传中');
            layui.layer.load();
        }
        ,done: function(res){
            $('#sys_qrcode').val(res.data.src);
            console.log(res.data.src);
            layui.layer.closeAll('loading');
        },error: function(){
            //请求异常回调
            layui.layer.closeAll('loading');
            layui.layer.msg("上传失败");
        }
    });
  
  //对外暴露的接口
  exports('set', {});
});