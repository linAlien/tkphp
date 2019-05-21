<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class KefuController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function kefu(){
        new PowerController(5);
        $this->display();
    }

    public function addKefu(){
        $this->display();
    }

    //编辑客服
    public function editKefu($kefu_id){
        $kefu = CommonModel::getOneByWhere("kefu",array("kefu_id"=>$kefu_id));
        $this->assign("kefu",$kefu);
        $this->display();
    }

}