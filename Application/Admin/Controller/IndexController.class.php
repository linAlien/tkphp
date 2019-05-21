<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    public function index(){
        $this->assign("admin",session('admin'));
        $this->display('index');
    }

    public function homePage(){
        $this->assign("admin",session('admin'));
        $re = CommonModel::getInPageByWhere('recharge',0,6,array('is_pay'=>1,'recharge_state'=>1),'recharge_createtime desc');
        for($i=0;$i<count($re['data']);$i++){
            $re['data'][$i]['name'] = CommonModel::getOneByWhere('user',array('user_id'=>$re['data'][$i]['user_id']))['user_nickname'];
            $re['data'][$i]['img'] = CommonModel::getOneByWhere('user',array('user_id'=>$re['data'][$i]['user_id']))['user_headimgurl'];
        }
        //今日订单数
        $order = CommonModel::getByWhere('recharge',array('recharge_createtime'=>array('like',date('Y-m-d').'%'),'recharge_state'=>1,'is_pay'=>1,'recharge_type'=>3));
        $order_num = count($order);
        //今日订单总额
        $money = 0;
        foreach($order as $k=>$v){
            $money += $v['money'];
        }
        //今日充值数
        $recharge = CommonModel::getByWhere('recharge',array('recharge_createtime'=>array('like',date('Y-m-d').'%'),'recharge_state'=>1,'is_pay'=>1,'recharge_type'=>1));
        $re_num = count($recharge);
        $re_money = 0;
        foreach($recharge as $r=>$a){
            $re_money += $a['money'];
        }
        //今日分销数
        $fen = CommonModel::getByWhere('recharge',array('recharge_createtime'=>array('like',date('Y-m-d').'%'),'recharge_state'=>1,'is_pay'=>1,'recharge_type'=>2));
        $fen_num = count($fen);
        $fen_money = 0;
        foreach($fen as $r=>$a){
            $fen_money += $a['money'];
        }
        //今日新增用户
        $user = CommonModel::getByWhere('user',array('user_state'=>1,'user_createtime'=>array('like',date('Y-m-d').'%')));
        $user_num = count($user);
        //今日推荐人数
        $pro = CommonModel::getByWhere('user',array('user_state'=>1,'user_up_time'=>array('like',date('Y-m-d').'%')));
        $pro_num = count($pro);
        $this->assign('pro_num',$pro_num);
        $this->assign('user_num',$user_num);
        $this->assign('order_num',$order_num);
        $this->assign('money',$money);
        $this->assign('re_num',$re_num);
        $this->assign('re_money',$re_money);
        $this->assign('fen_num',$fen_num);
        $this->assign('fen_money',$fen_money);
        $this->assign('re',$re['data']);
        $this->display();
    }
    public function uploadImage()//上传模块
    {
        $upload = new\Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath = './Uploads/';
        $upload->savePath = '/';
        $info = $upload->upload();
        if (!$info) {
            $this->error($upload->getError());
        } else {
            foreach ($info as $file) {
                $data = '/Uploads' . $file['savepath'] . $file['savename'];
                $file_a = $data;
                echo '{"code":0,"msg":"成功上传","data":{"src":"' . $file_a . '"}}';
            }
        }
    }
}