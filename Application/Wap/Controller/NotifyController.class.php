<?php
namespace Wap\Controller;
use Common\Model\CommonModel;
use Think\Controller;

class NotifyController extends Controller {

    public function wxNotify(){
        $out_trade_no = I('get.trade_no');
        if(strpos($out_trade_no,'re')!==false){
            //充值
            $chongzhi  =  M('recharge')->where(array('recharge_no'=>$out_trade_no))->find();
            if($chongzhi['is_pay'] == 1){
                return ;
            }
            else {
                //打钱给用户
                $user = M('user')->where(array('user_id'=>$chongzhi['user_id']))->find();
                $data['user_money'] = $user['user_money'] + $chongzhi['money'] + $chongzhi['send_money'];
                M('user')->where(array('user_id'=>$user['user_id']))->save($data);
                //支付成功，修改订单的一些数据
                $order1['is_pay'] = 1;
                $order1['user_next'] = $data['user_money']; //充值之后的钱
                M('recharge')->where(array('recharge_no' => $out_trade_no))->save($order1);
            }
            echo 'success';
        }else{
            //直播包月支付
            $order = CommonModel::getOneByWhere('order',array('order_no'=>$out_trade_no));
            if($order['is_pay']==1){
                return ;
            }
            $user = CommonModel::getOneByWhere('user',array('user_id'=>$order['user_id']));
            if($order['order_ratio']&&$order['order_ratio']!=0){
                //有分销
                $up = CommonModel::getOneByWhere('user',array('user_id'=>$user['user_up']));
                $up_data['user_money'] = $up['user_money'] + $order['order_ratio'];
                CommonModel::editByWhere('user','user_id',$up['user_id'],$up_data);
                $fen['money'] = $order['order_ratio'];
                $fen['user_id'] = $up['user_id'];
                $fen['recharge_type'] = 2;
                $fen['is_pay'] = 1;
                $fen['pay_func'] = 1;
                $fen['recharge_no'] = $order['order_no'];
                $fen['user_prev'] = $up['user_money'];
                $fen['user_next'] = $up_data['user_money'];
                $fen['recharge_state'] = 1;
                $fen['recharge_createtime'] = date('Y-m-d H:i:s');
                CommonModel::addByWhere('recharge',$fen);
            }
            //添加记录
            //$money = $user['user_money'] - $order['order_price'];
            $rech['money'] = $order['order_price'];
            $rech['user_id'] = $user['user_id'];
            $rech['recharge_type'] = 3; //消费
            $rech['is_pay'] = 1;
            $rech['pay_func'] = 1;
            $rech['recharge_no'] = $order['order_no'];
            $rech['user_prev'] = $user['user_money'];
            $rech['user_next'] = $user['user_money'];
            $rech['recharge_state'] = 1;
            $rech['recharge_createtime'] = date('Y-m-d H:i:s');
            CommonModel::addByWhere('recharge',$rech);
            //建立直播
            if($order['order_type']==1){
                $wechat = new WechatController();
                $we = $wechat->postJSON($order['qun_num'], '', $order['hello'], $order['nickname'],$order['out']);
                $we = json_decode($we,true);
                if($we['sessionId']){
                    //成功
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
//                    $server = CommonModel::getOneByWhere('kefu',array('kefu_wechat'=>$wc,'kefu_qrcode'=>$data['num'],'kefu_state'=>1));
//                    if($server){
//                        $data['kefu_id'] = $server['kefu_id'];
//                    }else{
//                        //没有 客服 新建客服
//                        $kk['kefu_wechat'] = $wc;
//                        $kk['kefu_state'] = 1;
//                        $kk['kefu_createtime'] = date('Y-m-d H:i:s');
//                        $data['kefu_id'] = CommonModel::addByWhere('kefu',$kk);
//                    }
                }
                //$data['kefu_qrcode'] = $data['num'];
            }
            //修改订单状态
            $data['is_pay'] = 1;//已支付
            $data['pay_type'] = 1; //微信支付
//            $o = CommonModel::getOneByWhere('order',array('order_id'=>array('lt',$order['order_id'])));
//            if($o){
//                $kefu = CommonModel::getOneByWhere('kefu',array('ke_id'=>array('gt',$o['kefu_id']),'kefu_state'=>1));
//                if($kefu){
//                    $data['kefu_id'] = $kefu['kefu_id'];
//                    if(strpos($kefu['kefu_qrcode'],'Uploads')!==false){
//                        $data['kefu_qrcode'] = C('host').'/'.$kefu['kefu_qrcode'];
//                    }else{
//                        $data['kefu_qrcode'] = $kefu['kefu_qrcode'];
//                    }
//                }
//                else{//假设上个客服是最后一个客服了,就只能从头开始
//                    $kefu = CommonModel::getOneByWhere('kefu',array('kefu_state'=>1));
//                    $data['kefu_id'] = $kefu['kefu_id'];
//                    if(strpos($kefu['kefu_qrcode'],'Uploads')!==false){
//                        $data['kefu_qrcode'] = C('host').'/'.$kefu['kefu_qrcode'];
//                    }else{
//                        $data['kefu_qrcode'] = $kefu['kefu_qrcode'];
//                    }
//                }
//            }else{
//                //第一单
//                $kefu = CommonModel::getOneByWhere('kefu',array('kefu_state'=>1));
//                $data['kefu_id'] = $kefu['kefu_id'];
//                if(strpos($kefu['kefu_qrcode'],'Uploads')!==false){
//                    $data['kefu_qrcode'] = C('host').'/'.$kefu['kefu_qrcode'];
//                }else{
//                    $data['kefu_qrcode'] = $kefu['kefu_qrcode'];
//                }
//            }
            CommonModel::editByWhere('order','order_id',$order['order_id'],$data);
            //发送随机码和订单号给客服
            if($server["kefu_openid"]){
                $weixin = new WechatReturnController();
                $weixin->receiveText($user["user_nickname"],$server["kefu_openid"],"订单id：".$order['order_id']." 随机码：".$order["num"]);
            }
            echo 'success';
        }
    }

}