<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class SetController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }
    //系统设置
    public function set(){
        new PowerController(7);
        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        $this->assign('sys',$sys);
        $this->display();
    }
    //修改密码
    public function editPwd(){
        $id = I('post.admin_id');
        $old = I('post.oldPassword');
        $new = I('post.admin_password');
        $admin = CommonModel::getOneByWhere('admin',array('admin_id'=>$id));
        if($admin['admin_password']!=$old){
            //原密码错误
            $res = getRes(-1,0,'error');
            $this->ajaxReturn($res,'json');exit();
        }
        $data['admin_password'] = $new;
        CommonModel::editByWhere('admin','admin_id',$id,$data);
        $res = getRes(1,0,'success');
        $this->ajaxReturn($res,'json');
    }
}