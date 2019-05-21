<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class ReplyController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function reply(){
        new PowerController(9);
        $this->display();
    }
    public function addReply(){
        $this->display();
    }

    //编辑套餐
    public function editReply(){
        $kefu_id = I('reply_id');
        $kefu = CommonModel::getOneByWhere("reply",array("reply_id"=>$kefu_id));
        $this->assign("reply",$kefu);
        $this->display();
    }
}