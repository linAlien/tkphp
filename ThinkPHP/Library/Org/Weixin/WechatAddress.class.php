<?php


class WechatAddress {

    //公众号的信息
    private $wx = array();

    public function __construct()
    {
        $this->wx['appid'] = C('appid');
        $this->wx['appsecret'] = C('appsecret');
        $this->wx['token'] = C('token');
    }

    //共享地址
    public function weixinAddress(){

        import('ORG.Weixin.WechatUserInfo');
        $WechatUserInfo = new \WechatUserInfo();
        $oauth2 = $WechatUserInfo->getOauth2();
        $oauth2AccessToken = $oauth2['access_token'];

        import('ORG.Util.Tool');
        $tool = new \Tool();
        $url =  $tool->get_url();
        $timeStamp=strval(time());
        $noncestr=$tool->generate_rand(6);
        $stringA="accesstoken=".$oauth2AccessToken."&appid=".$this->wx['appid']."&noncestr=".$noncestr."&timestamp=".$timeStamp."&url=".$url;
        $weixinAddressData=array('appid'=>$this->wx['appid'],'noncestr'=>$noncestr,'timestamp'=>$timeStamp,'addrsign'=>sha1($stringA),'url'=>$url);

        return $weixinAddressData;
    }

    function curl_file_get_contents($durl)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $durl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    //生成随机字符串
    function generate_rand($l){
        $c= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $rand="";
        srand((double)microtime()*1000000);
        for($i=0; $i<$l; $i++) {
            $rand.= $c[rand()%strlen($c)];
        }
        return $rand;
    }
} 