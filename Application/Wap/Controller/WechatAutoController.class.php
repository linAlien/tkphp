<?php
/**
 * Created by PhpStorm.
 * User: MBENBEN
 * Date: 2016/11/16
 * Time: 10:04
 */

namespace Wap\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class WechatAutoController extends Controller{


    public $contentStr;
    public $postObj;
    public function valid()
    {
        define("TOKEN", "rancytee");
        if($this->checkSignature()){
            $this->responseMsg();
            exit;
        }
    }

    public function responseMsg()
    {
        //$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = file_get_contents("php://input");
        if (!empty($postStr)){

            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->postObj = $postObj;

            //事件
            if($postObj->MsgType == "text"){
                //获取用户发送的内容
                $keyword = trim($postObj->Content);
                //判断是不是绑定客服事件     #绑定客服#客服id
                if(strpos($keyword,'#绑定机器人#')!==false){
                    //切割字符串
                    $kefu_id = explode("#",$keyword)[2];
                    if(CommonModel::getOneByWhere("kefu",array("kefu_id"=>$kefu_id))){   //存在这个客服
                        $fromUsername = sprintf("%s",$postObj->FromUserName);
                        CommonModel::editByWhere("kefu",'kefu_id',$kefu_id,array("kefu_openid"=>$fromUsername));
                        //回复消息
                        $resultStr = $this->replyText("绑定机器人成功");
                    }
                    else{
                        //回复消息
                        $resultStr = $this->replyText("绑定机器人失败，机器人id错误");
                    }
                }
                else if(strpos($keyword,'#绑定群链接#')!==false){  //绑定订单群链接  #绑定群链接#订单id#群链接
                    $param = explode("#",$keyword);
                    $order_id = $param[2];
                    $href = $param[3];
                    if(CommonModel::getOneByWhere("order",array("order_id"=>$order_id))){
                        CommonModel::editByWhere("order","order_id",$order_id,array("href"=>$href));
                        //回复消息
                        $resultStr = $this->replyText("绑定群链接成功");
                    }
                    else{
                        //回复消息
                        $resultStr = $this->replyText("绑定群链接失败");
                    }
                }
                else{
                    //看有没有自动回复
                    $reply = CommonModel::getOneByWhere("reply",array("reply_keyword"=>$keyword,"reply_state"=>1))["reply_content"];
                    if($reply){
                        $resultStr = $this->replyText($reply);
                    }
                }
                echo $resultStr;
            }elseif($postObj->MsgType == "event"){
                if($postObj->Event == "subscribe"){
                    //回复消息
                    $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
                    $resultStr = $this->replyText($sys['sys_new_user']);
                }elseif($postObj->Event== "CLICK"){
                    if($postObj->EventKey == "zhuanfaqun" ){
                        $sys = CommonModel::getOneByWhere('sys',array('sys_id'=>1));
                        $resultStr = $this->replyText($sys['sys_zhuanfa']);
                    }
                }
                echo $resultStr;
            }
        }else {
            echo "";
            exit;
        }
    }

    public function replyText($text){
        $time = time();
        $toUsername = $this->postObj->ToUserName;
        $fromUsername = $this->postObj->FromUserName;
        $textTpl = " <xml>
                                 <ToUserName><![CDATA[%s]]></ToUserName>
                                 <FromUserName><![CDATA[%s]]></FromUserName>
                                 <CreateTime>%s</CreateTime>
                                 <MsgType><![CDATA[%s]]></MsgType>
                                 <Content><![CDATA[%s]]></Content>
                             </xml>";
        return $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,"text",$text);
    }

    private function checkSignature()
    {

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }


}