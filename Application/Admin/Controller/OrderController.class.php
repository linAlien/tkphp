<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class OrderController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function order(){
        new PowerController(4);
        $this->display();
    }

    public function editOrder($order_id){
        $order = CommonModel::getOneByWhere("order",array("order_id"=>$order_id));
        $type = CommonModel::getByWhere("type");
        $this->assign("order",$order);
        $this->assign("type",$type);
        $this->display();
    }

}