<?php
namespace Wap\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class OrderController extends Controller {
    public function _initialize()
    {
        session('this_url',curPageURL());
            if(!session("in")){
                redirect('/index.php?m=Wap&c=Wechat&a=checkWechatLogin');
            }
    }

    //直播 录播 下单
    public function doOrder(){
        $data = getParameters('post',['hello','out','wechat','nickname','qun_num','times','zhibo_start_time','user_wechat','user_tel','type','classify']);
        if($data['type']==1){
            $data['order_type'] = 1;
        }elseif($data['type']==2){
            $data['order_type'] = 2;
        }
        if($data['classify']){
            $data['type_name'] = CommonModel::getOneByWhere('type',array('type_id'=>$data['classify']))['type_name'];
        }
        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        $max = $this->getAllnum();
         if($data['qun_num']>$max){
             //群数过大
             $res = getRes(-2,0,'error',$max);
             $this->ajaxReturn($res,'json');exit();
         }
        if($data['qun_num']<$sys['sys_min_qun']){
            //少于最底群数
            $res = getRes(-1,0,'error',$sys['sys_min_qun']);
            $this->ajaxReturn($res,'json');exit();
        }
        $data['order_no'] = time().rand(1000,9999);
        $data['user_id'] = session('in')['user_id'];
        $data['order_createtime'] = date('Y-m-d H:i:s');
        $data['order_state'] = 1;
        //直播单月价格
        $aa = CommonModel::getOneByWhere('group',array('type'=>$data['type'],'start'=>array('elt',$data['qun_num']),'end'=>array('egt',$data['qun_num']),'group_state'=>1));
        $qun_price = $aa['price'];
        if(!$qun_price){
            //在区间外  用设置的价格
            $qun_price = $sys['sys_group_price'];
        }
        if($data['type']==1){
            $data['is_pay'] = 0;
            $data['order_price'] = $data['qun_num'] * $qun_price;
            $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
            if($data['order_type']==1){
                if($user['user_up']){
                    //有上级 算钱
                    $money = $data['order_price'] * $sys['sys_ratio']/100;
                    $data['order_ratio'] = $money;
                }
            }
        }elseif($data['type']==2){
            //录播
//            $wechat = new WechatController();
//            $we = $wechat->postJSON($data['qun_num'],$data['type_name'],$data['hello'],$data['nickname']);
//            $we = json_decode($we,true);
//            if($we['errcode']==101001){
//                    //小助手数量不足
//                $res = getRes(-2,0,'error');
//                $this->ajaxReturn($res,'json');exit();
//            }elseif($we['errcode']==101007){
//                //验证码与现在直播中的验证码重复
//                $res = getRes(-3,0,'error');
//                $this->ajaxReturn($res,'json');exit();
//            }
//            $data['num'] = $we['validationCode'];//验证码
//            $wc = $we['assistants'][0];//微信号
//            $server = CommonModel::getOneByWhere('kefu',array('kefu_wechat'=>$wc,'kefu_state'=>1));
//            if($server){
//                $data['kefu_id'] = $server['kefu_id'];
//            }else{
//                //没有 客服 新建客服
//                $kk['kefu_wechat'] = $wc;
//                $kk['kefu_qrcode'] = $data['num'];
//                $kk['kefu_state'] = 1;
//                $data['kefu_id'] = CommonModel::addByWhere('kefu',$kk);
//            }
//            $data['kefu_qrcode'] = $data['num'];
            $data['is_pay'] = 1;
            $data['order_price'] = 0;
        }
        $id = CommonModel::addByWhere('order',$data);
//        if($data['type']==2){
//            $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
            ////发送随机码和订单号给客服
//            if($server["kefu_openid"]){
//                $weixin = new WechatReturnController();
//                $weixin->receiveText($user["user_nickname"],$server["kefu_openid"],"订单id：".$id." 随机码：".$data["num"]);
//            }
//        }
        $res = getRes(1,1,'success',$id);
        $this->ajaxReturn($res,'json');
    }
    //判断小助手可接的总群数
    public function getAllnum(){
        $a = file_get_contents('http://47.106.174.74/mp/v1/robot/?showAvailable=1');
        $a = json_decode($a,true);
        $a = $a['data'];
        $num = 0;
        for($i=0;$i<count($a['entries']);$i++){
            $num += $a['entries'][$i]['available'];
        }
        return $num;
    }
    //vip包月下单
    public function vipOrder(){
        $data = getParameters('post',['times','user_wechat','user_tel','type','vip_num']);
        $data['order_type'] = $data['type'];
        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
        $data['vip_price'] = $sys['sys_vip_price'];
        $data['order_no'] = time().rand(1000,9999);
        $data['user_id'] = session('in')['user_id'];
        $data['is_pay'] = 0;
        $data['order_createtime'] = date('Y-m-d H:i:s');
        $data['order_type'] = 3;
        $data['order_state'] = 1;
        $data['order_price'] = $data['times'] * $data['vip_price'] * $data['vip_num'];
        $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
        if($user['user_up']){
            //有上级 算钱
            $money = $data['order_price'] * $sys['sys_ratio']/100;
            $data['order_ratio'] = $money;
        }
        $id = CommonModel::addByWhere('order',$data);
        $res = getRes(1,1,'success',$id);
        $this->ajaxReturn($res,'json');
    }
    //支付
    public function payOrder(){
        $id = I('post.order_id');
        $type = I('post.pay_type');
        $order = CommonModel::getOneByWhere('order',array('order_id'=>$id));
        if($type==1){
            //微信支付
            $data['WIDout_trade_no'] = $order['order_no'];
            $data['WIDtotal_fee'] = $order['order_price'];
            $data['WIDsubject'] = $order['order_no'];
            $data['WIDbody'] = '订单';
            session("trade_no",$data['WIDout_trade_no']);
            session("fee",$data['WIDtotal_fee']);
            session("attach",$data['WIDsubject']);
            session("body",$data['WIDbody']);
            $wxPay = new WxpayController();
           // $wxPay->doWxPay();
        }elseif($type==2){
            if($order['is_pay']==1){
                return ;
            }
            //余额支付
            $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
            if($user['user_money']<$order['order_price']){
                //余额不足
                $res = getRes(-1,0,'error');
                $this->ajaxReturn($res,'json');exit();
            }
            //修改订单状态
            $data['is_pay'] = 1;//已支付
            $data['pay_type'] = 2;
//            $o = CommonModel::getOneByWhere('order',array('order_id'=>array('lt',$id)));
//            if($o){
//                $kefu = CommonModel::getOneByWhere('kefu',array('ke_id'=>array('gt',$o['kefu_id']),'kefu_state'=>1));
//                if($kefu){
//                    $data['kefu_id'] = $kefu['ke_id'];
//                    if(strpos($kefu['kefu_qrcode'],'Uploads')!==false){
//                        $data['kefu_qrcode'] = C('host').'/'.$kefu['kefu_qrcode'];
//                    }else{
//                        $data['kefu_qrcode'] = $kefu['kefu_qrcode'];
//                    }                }
//                else{
//                    $kefu = CommonModel::getOneByWhere('kefu',array('kefu_state'=>1));
//                    $data['kefu_id'] = $kefu['ke_id'];
//                    if(strpos($kefu['kefu_qrcode'],'Uploads')!==false){
//                        $data['kefu_qrcode'] = C('host').'/'.$kefu['kefu_qrcode'];
//                    }else{
//                        $data['kefu_qrcode'] = $kefu['kefu_qrcode'];
//                    }                }
//            }else{
//                //第一单
//                $kefu = CommonModel::getOneByWhere('kefu',array('kefu_state'=>1));
//                $data['kefu_id'] = $kefu['ke_id'];
//                if(strpos($kefu['kefu_qrcode'],'Uploads')!==false){
//                    $data['kefu_qrcode'] = C('host').'/'.$kefu['kefu_qrcode'];
//                }else{
//                    $data['kefu_qrcode'] = $kefu['kefu_qrcode'];
//                }
//            }
            if($order['order_type']==1) {
                //建立直播
                $wechat = new WechatController();
                $we = $wechat->postJSON($order['qun_num'],'', $order['hello'], $order['nickname'],$order['out']);
                $we = json_decode($we,true);
                if($we['errcode']==101001){
                    //小助手数量不足
                    $res = getRes(-2,0,'error');
                    $this->ajaxReturn($res,'json');exit();
                }elseif($we['errcode']==101007){
                    //验证码与现在直播中的验证码重复
                    $res = getRes(-3,0,'error');
                    $this->ajaxReturn($res,'json');exit();
                }
                $data['session_id'] = $we['sessionId'];
                $data['num'] = $we['validationCode'];//验证码
                $wc = $we['assistants'];//微信号
                if($wc){
                    $data['kefu_id'] = '';
                    for($i=0;$i<count($wc);$i++){
                        $server = CommonModel::getOneByWhere('kefu', array('kefu_wechat' => $wc[$i]['alias'], 'kefu_state' => 1));
                        if ($server) {
                            $data['kefu_id'] .= $server['kefu_id'].',';
                        } else {
                            //没有 客服 新建客服
                            $kk['kefu_wechat'] = $wc[$i]['alias'];
                            $kk['kefu_state'] = 1;
                            $kk['kefu_createtime'] = date('Y-m-d H:i:s');
                            $kefu_id = CommonModel::addByWhere('kefu', $kk);
                            $data['kefu_id'] .= $kefu_id.',';
                        }
                    }
                }
//                $server = CommonModel::getOneByWhere('kefu', array('kefu_wechat' => $wc, 'kefu_state' => 1));
//                if ($server) {
//                    $data['kefu_id'] = $server['kefu_id'];
//                } else {
//                    //没有 客服 新建客服
//                    $kk['kefu_wechat'] = $wc;
//                    $kk['kefu_state'] = 1;
//                    $kk['kefu_createtime'] = date('Y-m-d H:i:s');
//                    $data['kefu_id'] = CommonModel::addByWhere('kefu', $kk);
//                }
//                //$data['kefu_qrcode'] = $data['num'];
            }
            CommonModel::editByWhere('order','order_id',$id,$data);
            //扣钱
            $user_data['user_money'] = $user['user_money'] - $order['order_price'];
            CommonModel::editByWhere('user','user_id',$user['user_id'],$user_data);
            if($order['order_ratio']){
                //有分销
                $up = CommonModel::getOneByWhere('user',array('user_id'=>$user['user_up']));
                $up_data['user_money'] = $up['user_money'] + $order['order_ratio'];
                CommonModel::editByWhere('user','user_id',$up['user_id'],$up_data);
                $fen['money'] = $order['order_ratio'];
                $fen['user_id'] = $up['user_id'];
                $fen['recharge_type'] = 2;
                $fen['is_pay'] = 1;
                $fen['pay_func'] = 2;
                $fen['recharge_no'] = $order['order_no'];
                $fen['user_prev'] = $up['user_money'];
                $fen['user_next'] = $up_data['user_money'];
                $fen['recharge_state'] = 1;
                $fen['recharge_createtime'] = date('Y-m-d H:i:s');
                CommonModel::addByWhere('recharge',$fen);
            }
            //添加记录
            $money = $user['user_money'] - $order['order_price'];
            $rech['money'] = $order['order_price'];
            $rech['user_id'] = $user['user_id'];
            $rech['recharge_type'] = 3; //消费
            $rech['is_pay'] = 1;
            $rech['pay_func'] = 2;
            $rech['recharge_no'] = $order['order_no'];
            $rech['user_prev'] = $user['user_money'];
            $rech['user_next'] = $money;
            $rech['recharge_state'] = 1;
            $rech['recharge_createtime'] = date('Y-m-d H:i:s');
            CommonModel::addByWhere('recharge',$rech);
            $res = getRes(1,1,'success');
            $this->ajaxReturn($res,'json');
        }
    }

    //充值下单支付
    public function payRecharge(){
           $money =  I('post.number');
           $data['money'] = $money;
           $sys_re = CommonModel::getByWhere('package',array('is_on'=>1,'package_state'=>1),'money desc');
           $data['send_money'] = 0;
           for($i=0;$i<count($sys_re);$i++){
               if($money>=$sys_re[$i]['money']){
                   //符合条件
                   $data['send_money'] = $sys_re[$i]['send_money'];
                   break;
               }
           }
           $data['time'] = date('Y-m-d H:i:s');
           $data['user_id'] = session('in')['user_id'];
           $data['is_pay'] = 0;
           $data['pay_func'] = 1;
           $data['recharge_state'] = 1;
           $data['recharge_type'] = 1; //充值
           $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
           $data['user_prev'] = $user['user_money']; //充值之前的金额
           $data['recharge_createtime'] = date('Y-m-d H:i:s');
           $data['recharge_no'] = 're'.time().rand(1000,9999);
            $id = CommonModel::addByWhere('recharge',$data);
            $data['WIDout_trade_no'] = $data['recharge_no'];
            $data['WIDtotal_fee'] = $data['money'];
            $data['WIDsubject'] = $data['recharge_no'];
            $data['WIDbody'] = '充值订单';
            session("trade_no",$data['WIDout_trade_no']);
            session("fee",$data['WIDtotal_fee']);
            session("attach",$data['WIDsubject']);
            session("body",$data['WIDbody']);
            $wxPay = new WxpayController();
            $wxPay->doWxPay1();
    }
}