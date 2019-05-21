<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class GroupController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function lst(){
        new PowerController(8);
        $this->display();
    }
    public function addGroup(){
        $this->display();
    }

    //编辑套餐
    public function editGroup(){
        $kefu_id = I('group_id');
        $kefu = CommonModel::getOneByWhere("group",array("group_id"=>$kefu_id));
        $this->assign("group",$kefu);
        $this->display();
    }
}