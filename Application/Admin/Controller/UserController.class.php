<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class UserController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function user(){
        new PowerController(3);
        $this->display();
    }
    public function editUser($user_id){
        $user = CommonModel::getOneByWhere("user",array("user_id"=>$user_id));
        $this->assign("user",$user);
        $this->display();
    }

}