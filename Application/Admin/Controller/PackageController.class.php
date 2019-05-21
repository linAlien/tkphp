<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class PackageController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function lst(){
        new PowerController(10);
        $this->display();
    }
    public function addPackage(){
        $this->display();
    }

    //编辑套餐
    public function editPackage(){
        $kefu_id = I('package_id');
        $kefu = CommonModel::getOneByWhere("package",array("package_id"=>$kefu_id));
        $this->assign("package",$kefu);
        $this->display();
    }
}