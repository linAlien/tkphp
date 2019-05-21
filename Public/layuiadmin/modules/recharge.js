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

    //充值管理
    table.render({
        elem: '#LAY-recharge-manage'
        ,url: 'index.php?m=Admin&c=Data&a=getData&table=recharge&is_pay=1' //模拟接口
        ,cols: [[
            {type: 'checkbox', fixed: 'left'}
            ,{field: 'recharge_id', title: 'id', minWidth: 100}
            ,{field: 'user_id', title: '用户id', minWidth: 100}
            ,{field: 'user_id', title: '用户id', minWidth: 100}
            ,{field: 'money', title: '金额'}
            ,{field: 'recharge_type', title: '类型',templet: '#typeTpl'}
            ,{field: 'user_prev', title: '变化前余额'}
            ,{field: 'user_next', title: '变化后余额'}
            ,{field: 'recharge_createtime', title: '时间', sort: true}
            ,{title: '操作', width: 150, align:'center', fixed: 'right', toolbar: '#table-tool-bar'}
        ]]
        ,page: true
        ,limit: 30
        ,height: 'full-220'
        ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-recharge-manage)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('确定删除吗？', function(index) {
                //执行 Ajax 后重载
                layui.admin.req({
                    url: 'index.php?m=Admin&c=Data&a=deleteData&table=recharge&id='+data.recharge_id,
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
    });

    exports('recharge', {})
});