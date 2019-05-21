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
    //用户管理
    table.render({
        elem: '#LAY-teach-manage'
        ,url:  Url_Request.url //模拟接口
        ,cols: [[
            {type: 'checkbox', fixed: 'left'}
            ,{field: 'teach_id', title: 'ID', sort: true}
            ,{field: 'teach_title', title: '教程标题'}
            ,{field: 'teach_name', title: '教程简介'}
            ,{field: 'teach_content', title: '教程内容'}
            ,{field: 'teach_createtime', title: '创建时间', sort: true}
            ,{title: '操作', width: 150, align:'center', fixed: 'right', toolbar: '#table-tool-bar'}
        ]]
        ,page: true
        ,limit: 25
        ,height: 'full-220'
        ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-teach-manage)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('确定删除吗？', function(index) {
                //执行 Ajax 后重载
                layui.admin.req({
                    url: 'index.php?m=Admin&c=Data&a=deleteData&table=teach&id='+data.teach_id,
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
                ,title: '编辑套餐'
                ,content: 'index.php?m=Admin&c=Teach&a=editTeach&teach_id='+data.teach_id
                ,maxmin: true
                ,area: ['500px', '450px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){
                    var iframeWindow = window['layui-layer-iframe'+ index]
                        ,submitID = 'LAY-front-submit'
                        ,submit = layero.find('iframe').contents().find('#'+ submitID);

                    //监听提交
                    iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                        var $contents = iframeWindow.layedit1.getContent(iframeWindow.editIndex1); //获取编辑器内容
                        var field = data.field; //获取提交的字段
                        field['teach_content'] = $contents;
                        //执行 Ajax 后重载
                        layui.admin.req({
                            url: 'index.php?m=Admin&c=Data&a=editData&table=teach',
                            method:'post',
                            data:field,
                            success:function(res){
                                if(res.code==0 && res.success==1){
                                    table.reload('LAY-teach-manage'); //数据刷新
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

    exports('teach', {})
});