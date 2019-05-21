<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class RechargeController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function recharge(){
        new PowerController(6);
        $this->display();
    }

}