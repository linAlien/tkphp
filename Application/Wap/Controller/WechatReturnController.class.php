<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/15
 * Time: 16:02
 */

namespace Wap\Controller;
use Think\Controller;

class WechatReturnController extends Controller{
    //回复文本消息
    public function receiveText($name,$openid, $text){
        import('Org.Weixin.WeixinMessage');
        $wx = new WechatController();
        $accessToken = $wx->wx_get_token();
        $weixinMessage  = new \WeixinMessage();

        $weixinMessage ->send($name,$accessToken, $openid, $text);
    }
    //回复图片消息
    public function receiveImage($name,$openid, $mediaId){
        import('Org.Weixin.WeixinMessage');
        $wx = new WechatController();
        $accessToken = $wx->wx_get_token();
        $weixinMessage  = new \WeixinMessage();

        $weixinMessage ->toImg($name,$accessToken, $openid, $mediaId);
    }
    //回复语音消息
    public function receiveVoice($name,$openid, $mediaId){
        import('Org.Weixin.WeixinMessage');
        $wx = new WechatController();
        $accessToken = $wx->wx_get_token();
        $weixinMessage  = new \WeixinMessage();

        $weixinMessage ->toVoice($name,$accessToken, $openid, $mediaId);
    }
    //回复视频消息
    public function receiveVideo($name,$openid, $mediaId){
        import('Org.Weixin.WeixinMessage');
        $wx = new WechatController();
        $accessToken = $wx->wx_get_token();
        $weixinMessage  = new \WeixinMessage();

        $weixinMessage ->toVideo($name,$accessToken, $openid, $mediaId);
    }
    //回复发送者
    public function receiveSelf($openid, $text){
        import('Org.Weixin.WeixinMessage');
        $wx = new WechatController();
        $accessToken = $wx->wx_get_token();
        $weixinMessage  = new \WeixinMessage();

        $weixinMessage ->self($accessToken, $openid, $text);
    }
}