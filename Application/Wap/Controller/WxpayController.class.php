<?php
namespace Wap\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class WxpayController extends Controller {

    private static $user_id=null;

    //在类初始化方法中，引入相关类库
    public function _initialize() {
        vendor('Wxpay.Config');
        vendor('Wxpay.Data');
        vendor('Wxpay.Api');
        vendor('Wxpay.Exception');
        vendor('Wxpay.JsApiPay');
        vendor('Wxpay.Notify');


        if(!!!session('in')){
            redirect('index.html');
        }
        else{
            $this->assign('user_nickname',session('in')['user_nickname']);
            self::$user_id=session('in')['user_id'];
        }
    }

    //doalipay方法
    /*该方法其实就是将接口文件包下alipayapi.php的内容复制过来
      然后进行相关处理
    */
    //doalipay方法
    /*该方法其实就是将接口文件包下alipayapi.php的内容复制过来
      然后进行相关处理
    */
    //消费订单
    public function doWxPay(){
        //①、获取用户openid
        $tools = new \JsApiPay();
        $url = C("host")."/index.php?m=Wap&c=Wxpay&a=doWxPay";
        $this->assign("url", $url);
        $openId = $tools->GetOpenid($url);
        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody(session("body"));
        $input->SetAttach(session("body"));
        $input->SetOut_trade_no(session("trade_no"));
        $fee = session("fee")*100;
        $input->SetTotal_fee($fee);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("null");
        $input->SetNotify_url(C("host")."/WxpayAPI/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);
        if ($order['return_code'] == "FAIL") {
            redirect("/", 2, "订单失效，请重新下单");
        } else {
            $ord = CommonModel::getOneByWhere('order',array('order_id'=>session('id')));
            $user = CommonModel::getOneByWhere('user',array('user_id'=>session('in')['user_id']));
            if($ord['order_type']==1){
                $ord['details'] = '直播订单';
            }elseif($ord['order_type']==3){
                $ord['details'] = '包月vip';
            }
            $jsApiParameters = $tools->GetJsApiParameters($order);
            $this->assign("jsApiParameters", $jsApiParameters);
            $this->assign("order", $ord);
            $this->assign("user", $user);
            $this->assign("fee", $fee / 100);
            $this->display('Index/pay');
        }
    }
    //充值订单
    public function doWxPay1(){
        //①、获取用户openid
        $tools = new \JsApiPay();
        $url = C("host")."/index.php?m=Wap&c=Wxpay&a=doWxPay1";
        $openId = $tools->GetOpenid($url);
        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody(session("body"));
        $input->SetAttach(session("body"));
        $input->SetOut_trade_no(session("trade_no"));
        $fee = session("fee")*100;
        $input->SetTotal_fee($fee);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("null");
        $input->SetNotify_url(C("host")."/WxpayAPI/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);
        if ($order['return_code'] == "FAIL") {
            redirect("/", 2, "订单失效，请重新下单");
        } else {
            $jsApiParameters = $tools->GetJsApiParameters($order);
            $this->assign("jsApiParameters", $jsApiParameters);
            $this->assign("money", $fee / 100);
            $this->display('Index/rechargePay');
        }
    }
}
?>
