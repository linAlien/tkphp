/**

 @Name：layuiAdmin 用户管理 管理员管理 角色管理
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：LPPL

 */


layui.define(['table', 'form'], function(exports){
    var $ = layui.$
        ,table = layui.table
        ,form = layui.form;
    //管理员管理
    table.render({
        elem: '#LAY-manager-manage'
        ,url: Url_Request.url //模拟接口
        ,cols: [[
            {type: 'checkbox', fixed: 'left'}
            ,{field: 'admin_id', width: 80, title: 'ID', sort: true}
            ,{field: 'admin_account', title: '登录名'}
            ,{field: 'admin_role', title: '角色id'}
            ,{field: 'admin_createtime', title: '加入时间', sort: true}
            ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-tool-bar'}
        ]]
        ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-manager-manage)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('确定删除吗？', function(index) {
                //执行 Ajax 后重载
                layui.admin.req({
                    url: 'index.php?m=Admin&c=Data&a=deleteData&table=admin&id='+data.admin_id,
                    method:'get',
                    success:function(res){
                        if(res.code==0 && res.success==1){
                            obj.del();
                            layer.close(index);
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
        else if(obj.event === 'edit'){
            layer.open({
                type: 2
                ,title: '编辑账号'
                ,content: 'index.php?m=Admin&c=Manager&a=editManager&admin_id='+data.admin_id
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
                            url: 'index.php?m=Admin&c=Data&a=editData&table=admin',
                            method:'post',
                            data:field,
                            success:function(res){
                                if(res.code==0 && res.success==1){
                                    table.reload('LAY-manager-manage'); //数据刷新
                                    layer.msg('编辑成功');
                                }
                                else{
                                    layer.msg('编辑失败');
                                }
                            },
                            error:function(){
                                layer.msg('编辑失败');
                            }
                        });
                        layer.close(index); //关闭弹层
                    });
                    submit.trigger('click');
                }
            });
        }
    });

    exports('manager', {})
});