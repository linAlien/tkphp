<?php

class WeixinMessage {
    //回复文本消息
    public function send($name,$token,$openid,$text){
        $text = str_replace('"','',$text);

        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token;
        $mes='{
            "touser":"'.$openid.'",
            "msgtype":"text",
            "text":
              {
                 "content":"'.$name.':'.$text.'"
              }
            }';

        $info = json_decode($this->https_post($url,$mes), true);
        $data['token'] = $token;
        $data['to_openid']=$openid;
        $data['to_msg']=str_replace('?','*',$text);
        $data['result']=$info;
        $data['createtime'] =  date('y-m-d H:i:s',time());
        return $info;
    }
    //回复图片消息
    public function toImg($name,$token,$openid,$mediaId){

        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token;
        $mes='{
            "touser":"'.$openid.'",
            "msgtype":"image",
            "content":"'.$name.'",
            "image":
              {
                 "media_id":"'.$mediaId.'"
              }
            }';

        $info = json_decode($this->https_post($url,$mes), true);
        $data['token'] = $token;
        $data['to_openid']=$openid;
        $data['to_msg']=$mediaId;
        $data['result']=$info;
        $data['createtime'] =  date('y-m-d H:i:s',time());
        return $info;
    }
    //回复语音消息
    public function toVoice($name,$token,$openid,$mediaId){

        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token;
        $mes='{
            "touser":"'.$openid.'",
            "msgtype":"voice",
            "content":"'.$name.'",
            "voice":
              {
                 "media_id":"'.$mediaId.'"
              }
            }';

        $info = json_decode($this->https_post($url,$mes), true);
        $data['token'] = $token;
        $data['to_openid']=$openid;
        $data['to_msg']=$mediaId;
        $data['result']=$info;
        $data['createtime'] =  date('y-m-d H:i:s',time());
        return $info;
    }
    //回复视频消息
    public function toVideo($name,$token,$openid,$mediaId){

        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token;
        $mes='{
            "touser":"'.$openid.'",
            "msgtype":"video",
            "content":"'.$name.'",
            "video":
              {
                 "media_id":"'.$mediaId.'",
                  "thumb_media_id":"'.$mediaId.'",
                  "title":"TITLE",
                  "description":"DESCRIPTION"
              }
            }';

        $info = json_decode($this->https_post($url,$mes), true);
        $data['token'] = $token;
        $data['to_openid']=$openid;
        $data['to_msg']=$mediaId;
        $data['result']=$info;
        $data['createtime'] =  date('y-m-d H:i:s',time());
        return $info;
    }

    //回复发送者
    public function self($token,$openid,$text){
        $text = str_replace('"','',$text);

        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token;
        $mes='{
            "touser":"'.$openid.'",
            "msgtype":"text",
            "text":
              {
                 "content":"'.$text.'"
              }
            }';

        $info = json_decode($this->https_post($url,$mes), true);
        $data['token'] = $token;
        $data['to_openid']=$openid;
        $data['to_msg']=str_replace('?','*',$text);
        $data['result']=$info;
        $data['createtime'] =  date('y-m-d H:i:s',time());
        return $info;
    }


    function https_post($url,$post_data=null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

