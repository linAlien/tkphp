<?php
namespace Admin\Controller;
use Common\Model\AdminRoleModel;
use Think\Controller;
class PowerController extends Controller {


    public function __construct($power)
    {
        parent::__construct();
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
        $this->checkPower($power);
    }

    //判断是否有这个权限
    public function checkPower($power){
        //先获取用户的角色，从而获取权限
        $admin_role_id = session('admin');
        $a = $admin_role_id['admin_role'];
        $role = AdminRoleModel::getRoleById($a)['role_power'];
        $role = explode(",",$role);
        if(!in_array($power,$role)){
            echo ("你没有此操作权限！");exit;
        }
    }

}