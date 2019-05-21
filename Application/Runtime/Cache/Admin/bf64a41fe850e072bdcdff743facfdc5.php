<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>角色管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/Public/layuiadmin/layui/css/layui.css?qwe=456" media="all">
    <link rel="stylesheet" href="/Public/layuiadmin/style/admin.css?zxc=789" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-useradmin" data-type="batchdel">删除</button>
                <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
            </div>

            <table id="LAY-role-manage" lay-filter="LAY-role-manage"></table>
            <script type="text/html" id="table-tool-bar">
                <a class="layui-btn layui-btn-success layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-delete"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
        </div>
    </div>
</div>

<script src="/Public/layuiadmin/layui/layui.js"></script>
<script>
    window.Url_Request ={
        url:'<?php echo U("Data/getData");?>&table=role'
    }
    layui.config({
        base: '/Public/layuiadmin/', //静态资源所在路径    //自定义响应字段
        version: true
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'role', 'table','admin'], function(){
        var $ = layui.$
                ,form = layui.form
                ,table = layui.table;


        //事件
        var active = {
            batchdel: function(){
                var checkStatus = table.checkStatus('LAY-role-manage')
                        ,checkData = checkStatus.data; //得到选中的数据
                var idList = "";
                for(var i = 0;i<checkData.length;i++){
                    idList += checkData[i].role_id+",";
                }
                if(checkData.length === 0){
                    return layer.msg('请选择数据');
                }
                layer.confirm('确定删除吗？', function(index) {
                    //执行 Ajax 后重载
                    layui.admin.req({
                        url: 'index.php?m=Admin&c=Data&a=deleteData&table=role&id='+idList,
                        method:'get',
                        success:function(res){
                            if(res.code==0 && res.success==1){
                                table.reload('LAY-role-manage');
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
            ,add: function(){
                layer.open({
                    type: 2
                    ,title: '添加角色'
                    ,content: 'index.php?m=Admin&c=Role&a=addRole'
                    ,maxmin: true
                    ,area: ['500px', '450px']
                    ,btn: ['确定', '取消']
                    ,yes: function(index, layero){
                        var iframeWindow = window['layui-layer-iframe'+ index]
                                ,submitID = 'LAY-front-submit'
                                ,submit = layero.find('iframe').contents().find('#'+ submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                            var field = data.field; //获取提交的字段
                            //执行 Ajax 后重载
                            layui.admin.req({
                                url: 'index.php?m=Admin&c=Data&a=addData&table=role',
                                method:'post',
                                data:field,
                                success:function(res){
                                    if(res.code==0 && res.success==1){
                                        table.reload('LAY-role-manage'); //数据刷新
                                        layer.msg('添加成功');
                                    }
                                    else{
                                        layer.msg('添加失败');
                                    }
                                },
                                error:function(){
                                    layer.msg('添加失败');
                                }
                            });
                            layer.close(index); //关闭弹层
                        });

                        submit.trigger('click');
                    }
                });
            },
        };

        $('.layui-btn.layuiadmin-btn-useradmin').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>
</body>
</html>