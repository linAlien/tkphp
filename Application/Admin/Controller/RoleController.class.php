<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class RoleController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function role(){
        new PowerController(2);
        $this->display();
    }

    public function editRole($role_id){
        $role = CommonModel::getOneByWhere("role",array("role_id"=>$role_id));
        $power = explode(",",$role['role_power']);
        for($i=0;$i<10;$i++){
            if(in_array($i+1,$power)){
                $checked[$i] = "checked";
            }
            else{
                $checked[$i] = "";
            }
        }
        $this->assign("role",$role);
        $this->assign("checked",$checked);
        $this->display();
    }

    public function addRole(){
        $this->display();
    }


}