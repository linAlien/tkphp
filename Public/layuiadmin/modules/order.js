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
        elem: '#LAY-order'
        ,url: 'index.php?m=Admin&c=Data&a=getData&table=order' //模拟接口
        ,cols: [[
            {type: 'checkbox', fixed: 'left'}
            ,{field: 'order_id', width: 80, title: 'ID', sort: true}
            ,{field: 'order_no', title: '订单编号', minWidth: 150,sort: true}
            ,{field: 'user_id', title: '用户id', minWidth: 150,sort: true}
            //,{field: 'user_tel', title: '用户手机号码', minWidth: 150,sort: true}
            ,{field: 'wechat', title: '用户微信号', minWidth: 150,sort: true}
            ,{field: 'order_type', title: '订单类型', minWidth: 150,sort: true,templet: '#orderTypeTpl'}
            //,{field: 'type_name', minWidth: 150, title: '主题名称',sort: true,}
            ,{field: 'zhibo_start_time', minWidth: 150, title: '开始直播/录播时间',sort: true}
            ,{field: 'times', minWidth: 150, title: '直播/录播=>时长 包月=>月数',sort: true}
            ,{field: 'qun_num',minWidth: 150, title: '群数',sort: true}
            ,{field: 'hello',minWidth: 150, title: '欢迎语',sort: true}
            ,{field: 'nickname',minWidth: 150, title: '助手昵称',sort: true}
            ,{field: 'num',minWidth: 150, title: '验证码',sort: true}
            ,{field: 'kefu_id',minWidth: 150, title: '客服id',sort: true}
            ,{field: 'kefu_qrcode',minWidth: 150, title: '客服二维码',sort: true}
            ,{field: 'out',minWidth: 150, title: '退群语',sort: true}
            ,{field: 'order_price', minWidth: 150,title: '价格',sort: true}
            ,{field: 'order_ratio', minWidth: 150,title: '分销金额',sort: true}
            ,{field: 'is_pay',minWidth: 150, title: '是否支付', sort: true,templet: '#isPayTpl'}
            ,{field: 'pay_type',minWidth: 150, title: '支付方式', sort: true,templet: '#payTypeTpl'}
            ,{field: 'order_createtime',minWidth: 150, title: '创建时间', sort: true}
            ,{title: '操作', width: 150, align:'center', fixed: 'right', toolbar: '#table-tool-bar'}
        ]]
        ,page: true
        ,limit: 25
        ,height: 'full-220'
        ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-order)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('确定删除吗？', function(index) {
                //执行 Ajax 后重载
                layui.admin.req({
                    url: 'index.php?m=Admin&c=Data&a=deleteData&table=order&id='+data.order_id,
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
                ,title: '编辑机器人'
                ,content: 'index.php?m=Admin&c=Order&a=editOrder&order_id='+data.order_id
                ,maxmin: true
                ,area: ['500px', '550px']
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
                            url: 'index.php?m=Admin&c=Data&a=editData&table=order',
                            method:'post',
                            data:field,
                            success:function(res){
                                if(res.code==0 && res.success==1){
                                    table.reload('LAY-order'); //数据刷新
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

    exports('order', {})
});