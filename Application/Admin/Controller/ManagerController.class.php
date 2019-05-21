<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class ManagerController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function manager(){
        new PowerController(1);
        $role = CommonModel::getByWhere("role");
        $this->assign("role",$role);
        $this->display();
    }

    public function editManager($admin_id){
        $admin = CommonModel::getOneByWhere("admin",array('admin_id'=>$admin_id));
        $admin['admin_role_name'] = CommonModel::getOneByWhere('role',array('role_id'=>$admin['admin_role']))['role_name'];
        $role = CommonModel::getByWhere("role");
        $this->assign("role",$role);
        $this->assign("admin",$admin);
        $this->display();
    }

    public function addManager(){
        $role = CommonModel::getByWhere("role");
        $this->assign("role",$role);
        $this->display();
    }

}