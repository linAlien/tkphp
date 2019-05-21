<?php
namespace Wap\Controller;
use Common\Model\CommonModel;
use Wap\Controller\WechatController;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize()
    {
        session('this_url',curPageURL());
        session('user_id',I('user_id'));
            if(!session("in")){
                redirect('/index.php?m=Wap&c=Wechat&a=checkWechatLogin');
            }
    }
    //个人主页
    public function person(){
        $url = curPageURL();
        $wechat = new WechatController();
        $jsParam = $wechat->getWechatJsKey($url);
        $shareImg = C('host').'/Public/Wap/images/hd_img.jpg';
        $this->assign("param",$jsParam);
        $this->assign('url',$url.'&user_id='.session('in')['user_id']);
        $this->assign('img',$shareImg);
        $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        if(strpos($sys['sys_qrcode'],'Uploads')!==false){
            $sys['sys_qrcode'] = C('host').'/'.$sys['sys_qrcode'];
        }
        if(I('id')){
            $this->assign('id',I('id'));
        }
        $this->assign('user',$user);
        $this->assign('sys',$sys);
        $this->display('user_main');
    }
    //使用教程
    public function course(){
        $url = curPageURL();
        $wechat = new WechatController();
        $jsParam = $wechat->getWechatJsKey($url);
        $shareImg = C('host').'/Public/Wap/images/hd_img.jpg';
        $this->assign("param",$jsParam);
        $this->assign('url',$url.'&user_id='.session('in')['user_id']);
        $this->assign('img',$shareImg);
        $teach = CommonModel::getByWhere('teach',array('teach_state'=>1));
        $this->assign('teach',$teach);
        $this->display();
    }
    //使用教程详情
    public function course_details(){
        $url = curPageURL();
        $wechat = new WechatController();
        $jsParam = $wechat->getWechatJsKey($url);
        $shareImg = C('host').'/Public/Wap/images/hd_img.jpg';
        $this->assign("param",$jsParam);
        $this->assign('url',$url.'&user_id='.session('in')['user_id']);
        $this->assign('img',$shareImg);
        $id = I('id');
        $course = CommonModel::getOneByWhere('teach',array('teach_id'=>$id));
        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        $this->assign('sys',$sys);
        $this->assign('teach',$course);
        $this->display();
    }
    //充值页面
    public function recharge(){
        $url = curPageURL();
        $wechat = new WechatController();
        $jsParam = $wechat->getWechatJsKey($url);
        $shareImg = C('host').'/Public/Wap/images/hd_img.jpg';
        $this->assign("param",$jsParam);
        $this->assign('url',$url.'&user_id='.session('in')['user_id']);
        $this->assign('img',$shareImg);
        $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
        $this->assign('user',$user);
        //套餐
        $recharge = CommonModel::getByWhere('package',array('is_on'=>1,'package_state'=>1));
        $this->assign('tao',$recharge);
        $this->display();
    }
    //个人钱包
    public function wallet(){
        $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
        $recharge = CommonModel::getByWhere('recharge',array('recharge_type'=>array('neq',2),'user_id'=>$user['user_id'],'is_pay'=>1,'recharge_state'=>1),'recharge_createtime desc');
        $re = array();
        for($i=0;$i<count($recharge);$i++){
            if($recharge[$i]['recharge_type']==1){
                $re[$i]['name'] = '充值';
                $re[$i]['price'] = '+'.$recharge[$i]['money'];
            }elseif($recharge[$i]['recharge_type']==2){
                $re[$i]['name'] = '分销';
                $re[$i]['price'] = '+'.$recharge[$i]['money'];
            }elseif($recharge[$i]['recharge_type']==3){
                $re[$i]['name'] = '消费';
                $re[$i]['price'] = '-'.$recharge[$i]['money'];
            }
            $re[$i]['time'] = $recharge[$i]['recharge_createtime'];
        }
        $this->assign('data',$re);
        $this->assign('user',$user);
        $this->display();
    }
    //分销记录
    public function fenxiao(){
        $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
        $recharge = CommonModel::getByWhere('recharge',array('recharge_type'=>2,'user_id'=>$user['user_id'],'is_pay'=>1,'recharge_state'=>1),'recharge_createtime desc');
        $this->assign('data',$recharge);
        $this->assign('user',$user);
        $this->display();
    }
    //订单查询
    public function myorder(){
        $url = curPageURL();
        $wechat = new WechatController();
        $jsParam = $wechat->getWechatJsKey($url);
        $shareImg = C('host').'/Public/Wap/images/hd_img.jpg';
        $this->assign("param",$jsParam);
        $this->assign('url',$url.'&user_id='.session('in')['user_id']);
        $this->assign('img',$shareImg);

        $order = CommonModel::getByWhere('order',array('user_id'=>session('in')['user_id'],'is_pay'=>1),'order_createtime desc');
        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        foreach($order as $k=>$v){
            if($order[$k]['order_type']==1){
                $order[$k]['name'] = '直播套餐';
                $order[$k]['details'] = $sys['sys_zhibo'];
                if($order[$k]['kefu_id']){
                    $order[$k]['arr'] = array();
                    $kefu_id = explode(',',$order[$k]['kefu_id']);
                    if($kefu_id){
                        for($i=0;$i<count($kefu_id);$i++){
                            if($kefu_id[$i]){
                                $order[$k]['arr'][$i] = CommonModel::getOneByWhere('kefu',array('kefu_id'=>$kefu_id[$i]))['kefu_wechat'];
                            }
                        }
                    }
                }
            }elseif($order[$k]['order_type']==2){
                $order[$k]['name'] = '录播套餐';
                $order[$k]['details'] = $sys['sys_lubo'];
            }elseif($order[$k]['order_type']==3){
                $order[$k]['name'] = '包月vip';
                $order[$k]['details'] = $sys['sys_vip'];
            }
            $order[$k]['kefu_wechat'] = CommonModel::getOneByWhere('kefu',array('kefu_id'=>$order[$k]['kefu_id']))['kefu_wechat'];
        }
        $this->assign('order',$order);
        $this->display();
    }
    //主页
    public function index(){
        $url = curPageURL();
        $wechat = new WechatController();
        $jsParam = $wechat->getWechatJsKey($url);
        $shareImg = C('host').'/Public/Wap/images/hd_img.jpg';
        $this->assign("param",$jsParam);
        $this->assign('url',$url.'&user_id='.session('in')['user_id']);
        $this->assign('img',$shareImg);

        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        $group = CommonModel::getByWhere('group',array('group_state'=>1,'type'=>1));
        $lu_group = CommonModel::getByWhere('group',array('group_state'=>1,'type'=>2));
        $sys['sys_zhibo'] = str_replace("\r\n","<br />",$sys['sys_zhibo']);
        $sys['sys_zhibo'] = str_replace("\n","<br />",$sys['sys_zhibo']);
        $sys['sys_zhibo'] = html_entity_decode($sys['sys_zhibo']);
        $sys['sys_lubo'] = str_replace("\r\n","<br />",$sys['sys_lubo']);
        $sys['sys_lubo'] = str_replace("\n","<br />",$sys['sys_lubo']);
        $sys['sys_lubo'] = html_entity_decode($sys['sys_lubo']);
        $sys['sys_vip'] = str_replace("\r\n","<br />",$sys['sys_vip']);
        $sys['sys_vip'] = str_replace("\n","<br />",$sys['sys_vip']);
        $sys['sys_vip'] = html_entity_decode($sys['sys_vip']);
        if(strpos($sys['sys_qrcode'],'Uploads')!==false){
            $sys['sys_qrcode'] = C('host').'/'.$sys['sys_qrcode'];
        }
        if(I('id')){
            $this->assign('id',I('id'));
        }else{
            $this->assign('id',1);
        }
        $this->assign('sys',$sys);
        $this->assign('zhi_group',$group);
        $this->assign('lu_group',$lu_group);
        $this->display();
    }
    //支付页面
    public function pay(){
        $id = I('id');
        session('id',$id);
        $order = CommonModel::getOneByWhere('order',array('order_id'=>$id));
        //生成微信支付参数
        $data['WIDout_trade_no'] = $order['order_no'];
        $data['WIDtotal_fee'] = $order['order_price'];
        $data['WIDsubject'] = $order['order_no'];
        $data['WIDbody'] = '订单';
        session("trade_no",$data['WIDout_trade_no']);
        session("fee",$data['WIDtotal_fee']);
        session("attach",$data['WIDsubject']);
        session("body",$data['WIDbody']);
        redirect(U('Wxpay/doWxpay'));
//        $wxPay = new WxpayController();
//        $wxPay->doWxPay();
    }
    //直播 录播 下单页面
    public function order1(){
        $type = I('type');
        $classify = CommonModel::getByWhere('type',array('is_show'=>1,'type_state'=>1));
        $this->assign('type',$type);
        $this->assign('classify',$classify);
        $this->display();
    }
    //确认订单
    public function order2(){
        $id = I('id');
        $order = CommonModel::getOneByWhere('order',array('order_id'=>$id));
        $this->assign('order',$order);
        $this->display();
    }
    //vip包月下单页面
    public function b_order1(){
        $type = I('type');
        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        $this->assign('type',$type);
        $this->assign('price',$sys['sys_vip_price']);
        $this->display();
    }
    //包月确认订单页面
    public function b_order2(){
        $id = I('id');
        $order = CommonModel::getOneByWhere('order',array('order_id'=>$id));
        $this->assign('order',$order);
        $this->display();
    }
    //支付成功
    public function Success(){
        $id = I('id');
        if($id){
            $order = CommonModel::getOneByWhere('order',array('order_id'=>$id));
            if($order['kefu_id']){
                $img = array();
                $kefu_id = explode(',',$order['kefu_id']);
                if($kefu_id){
                    for($i=0;$i<count($kefu_id);$i++){
                        if($kefu_id[$i]){
                            $img[$i]['img'] = CommonModel::getOneByWhere('kefu',array('kefu_id'=>$kefu_id[$i]))['kefu_qrcode'];
                            $img[$i]['name'] = CommonModel::getOneByWhere('kefu',array('kefu_id'=>$kefu_id[$i]))['kefu_name'];
                        }
                    }
                }
            }
            $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
            $this->assign('img',$img);
            $this->assign('sys',$sys);
            $this->assign('order',$order);
        }else{
         //判断一天内的订单
          $order =  CommonModel::getOneByWhere('order',array('is_pay'=>1,'order_createtime'=>array('gt',date('Y-m-d H:i:s',strtotime('-1 day'))),'user_id'=>session('in')['user_id']));
            if($order['kefu_id']){
              $img = array();
              $kefu_id = explode(',',$order['kefu_id']);
              if($kefu_id){
                  for($i=0;$i<count($kefu_id);$i++){
                      if($kefu_id[$i]){
                          $img[$i]['img'] = CommonModel::getOneByWhere('kefu',array('kefu_id'=>$kefu_id[$i]))['kefu_qrcode'];
                          $img[$i]['name'] = CommonModel::getOneByWhere('kefu',array('kefu_id'=>$kefu_id[$i]))['kefu_name'];
                      }
                  }
              }
              $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
              $this->assign('img',$img);
              $this->assign('sys',$sys);
              $this->assign('order',$order);
          }else{
              $this->assign('type',1);
          }
        }
        $this->display();
    }
    public function is_pass(){
        $id = I('id');
        $order = CommonModel::getOneByWhere('order',array('order_id'=>$id));
        if($order['is_pay']==0){
            $res = getRes(-1,0,'error');
            $this->ajaxReturn($res,'json');exit();
        }elseif($order['is_pay']==1){
            if($order['num']&&$order['kefu_id']){
                //成功
                $res = getRes(1,1,'success',1);
            }else{
                $res = getRes(1,1,'success',2);
            }
        }
        $this->ajaxReturn($res,'json');
    }
    public function zhibo(){
        //订单详情页面
        $id = I('sessionid');
        $order_num = I('num');
        $data = file_get_contents("http://47.106.174.74/mp/v1/session/".$id);
        $data = json_decode($data,true);
        $data = $data['data'];
        if($data){
//            for($i=0;$i<count($data['robots']);$i++){
//                $max = file_get_contents("http://47.106.174.74/mp/v1/robot/entry/".$data['robots'][$i]['robotId']);
//                $max = json_decode($max,true);
//                $max = $max['data'];
//                $data['robots'][$i]['marjoin'] = $max['wxid']['maxJoinable'];
//                $data['robots'][$i]['canjoin'] = $max['wxid']['available'];
//            }
            $data['num'] = 0;
            for($j=0;$j<count($data['rooms']);$j++){
                $data['num'] += $data['rooms'][$j]['memberCount'];
            }
            foreach($data['robots'] as $k=>$v){
                $data['robots'][$k]['rooms'] = array();
                foreach($data['rooms'] as $kk=>$vv){
                    if($v['robotId']==$vv['robotId']){
                        $data['robots'][$k]['rooms'][$kk] = $vv;
                    }
                }
            }
            $this->assign('data',$data);
            $this->assign('num',$order_num);
            $this->assign('id',$id);
            $this->assign('num1',$order_num);
            $this->display('one');
        }
    }
    public function two(){
        //订单详情页面
        $id = I('sessionid');
        $order_num = I('num');
        $data = file_get_contents("http://47.106.174.74/mp/v1/session/".$id);
        $data = json_decode($data,true);
        $data = $data['data'];
        if($data){
//            for($i=0;$i<count($data['robots']);$i++){
//                $max = file_get_contents("http://47.106.174.74/mp/v1/robot/entry/".$data['robots'][$i]['robotId']);
//                $max = json_decode($max,true);
//                $max = $max['data'];
//                $data['robots'][$i]['marjoin'] = $max['wxid']['maxJoinable'];
//                $data['robots'][$i]['canjoin'] = $max['wxid']['available'];
//            }
            $data['num'] = 0;
            for($j=0;$j<count($data['rooms']);$j++){
                $data['num'] += $data['rooms'][$j]['memberCount'];
            }
            foreach($data['robots'] as $k=>$v){
                $data['robots'][$k]['rooms'] = array();
                foreach($data['rooms'] as $kk=>$vv){
                    if($v['robotId']==$vv['robotId']){
                        $data['robots'][$k]['rooms'][$kk] = $vv;
                    }
                }
            }
            $this->assign('data',$data);
            $this->assign('num',$order_num);
            $this->assign('id',$id);
            $this->assign('num1',$order_num);
            $this->display();
        }
    }
    public function zhibo1(){
        //订单详情页面
        $id = '281dd492bb3a2ced136dabf263fe8547';
        $data = file_get_contents("http://47.106.174.74/mp/v1/session/".$id);
        $data = json_decode($data,true);
        $data = $data['data'];
        if($data){
//            for($i=0;$i<count($data['robots']);$i++){
//                $max = file_get_contents("http://47.106.174.74/mp/v1/robot/entry/".$data['robots'][$i]['robotId']);
//                $max = json_decode($max,true);
//                $max = $max['data'];
//                $data['robots'][$i]['marjoin'] = $max['wxid']['maxJoinable'];
//                $data['robots'][$i]['canjoin'] = $max['wxid']['available'];
//            }
            $data['num'] = 0;
            for($j=0;$j<count($data['rooms']);$j++){
                $data['num'] += $data['rooms'][$j]['memberCount'];
            }
            foreach($data['robots'] as $k=>$v){
                $data['robots'][$k]['rooms'] = array();
                foreach($data['rooms'] as $kk=>$vv){
                    if($v['robotId']==$vv['robotId']){
                        $data['robots'][$k]['rooms'][$kk] = $vv;
                    }
                }
            }
            dump($data['robots']);exit();
            $this->assign('data',$data);
            $this->assign('num',$order_num);
            $this->display();
        }
    }
}