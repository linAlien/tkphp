<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015-6-3
 * Time: 0:31
 */

class QRCode {

    public function _getpic($member){

        import('ORG.Weixin.AccessToken');
        $accessTokenUtil = new \AccessToken();
        $access_token = $accessTokenUtil->getAccessToken();

        $qrcode='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id":'.$member['systemid'].'}}}';
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        $result=$this->https_post($url,$qrcode);
        $jsoninfo=json_decode($result,true);

        $ticket=$jsoninfo['ticket'];
        $ticketurl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket);
        return $ticketurl;
    }

    public function getpic($member,$sub_weixin=null)
    {
	    if($sub_weixin)
	    {
		    import('ORG.Weixin.SubAccessToken');
		    $accessTokenUtil = new \SubAccessToken($member['token'],$sub_weixin['appid'],$sub_weixin['appsecret']);
		    $access_token = $accessTokenUtil->getAccessToken();
	    }
	    else
	    {
		    import('ORG.Weixin.AccessToken');
		    $accessTokenUtil = new \AccessToken();
		    $access_token = $accessTokenUtil->getAccessToken();
	    }
        $qrcode='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id":'.$member['qrcode_scene_id'].'}}}';
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        $result=$this->https_post($url,$qrcode);
        $jsoninfo=json_decode($result,true);

        $ticket=$jsoninfo['ticket'];
        $ticketurl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket);

        $imageinfo=$this->downloadImageFromWeiXin($ticketurl);
        $time=time().'_'.$member['id'];
        $filename="./QRCodeImage/$time.jpg";
        $local_file=fopen($filename,'w');
        if(false!==$local_file){
            if(false!==fwrite($local_file,$imageinfo['body'])){
                fclose($local_file);
            }else{
                return false;
            }
        }else{
            return false;
        }
        return $time.".jpg";
    }

    public function getQrCodeUrl($systemid){

        import('ORG.Weixin.AccessToken');
        $accessTokenUtil = new \AccessToken();
        $access_token = $accessTokenUtil->getAccessToken();

        $qrcode='{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id":'.$systemid.'}}}';
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        $result=$this->https_post($url,$qrcode);
        $jsoninfo=json_decode($result,true);

        $ticket=$jsoninfo['ticket'];
        $ticketurl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket);
        return $ticketurl;
    }

    //获取二维码
    private function https_post($url,$post_data=null){
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

    function downloadImageFromWeiXin($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 获取数据返回
        $package= curl_exec($ch);
        $httpinfo= curl_getinfo($ch);
        curl_close($ch);
        return array_merge(array('body'=>$package),array('header'=>$httpinfo));
    }
} 