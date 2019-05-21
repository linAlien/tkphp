<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class TeachController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function teach(){
       // new PowerController(9);
        $this->display();
    }
    public function addTeach(){
        $this->display();
    }

    //编辑套餐
    public function editTeach(){
        $kefu_id = I('teach_id');
        $kefu = CommonModel::getOneByWhere("teach",array("teach_id"=>$kefu_id));
        $this->assign("teach",$kefu);
        $this->display();
    }
}