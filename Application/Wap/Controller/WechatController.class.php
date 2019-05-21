<?php
/*author:1038848005@qq.com
 * for:΢�Žӿ�
 * time:2015-09-03
 */
namespace Wap\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class WechatController extends Controller
{

    public function index()
    {
    }

    function filterNickname($nickname)

    {
        $nickname = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $nickname);

        $nickname = preg_replace('/[\x{2700}-\x{27BF}]/u', '', $nickname);

        $nickname = str_replace(array('"', '\''), '', $nickname);

        return addslashes(trim($nickname));
    }

    // 过滤掉emoji表情
    function filterEmoji($str)
    {
        $str = preg_replace_callback(
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $str);

        return $str;
    }

    //判断是否已经微信登陆
    public function checkWechatLogin()
    {
        //先判断是否是第一个登陆
        $this->unFirstLogin();
    }

    //通过非静默方式获取用户的openid
    public function firstLogin()
    {
        $redirect_uri = urlencode(C("get_code_url_userinfo"));
        $getCode_uri = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . C("appid") . "&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        redirect($getCode_uri);
    }

    //静默方式snsapi_base获取用户openid
    public function unFirstLogin()
    {
        $redirect_uri = urlencode(C("get_code_url_base"));
        $getCode_uri = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . C("appid") . "&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
        redirect($getCode_uri);
    }

    //获取code   静默方式
    public function getCodeBase()
    {
        if (isset($_GET['code'])) {
            $content = $this->getAccessToken($_GET['code']);
            $content = json_decode($content);
            $access_token = $content->{'access_token'};
            $openid = $content->{'openid'};
            //判断是否已经获取了这个人的数据，如果获取了，就从数据库里面取出
            if ($this->getUserinfoFromDB($openid)) {
                if (session("this_url")) {
                    redirect(session("this_url"));
                } else {
                    redirect("/index.php?m=Wap&c=Index&a=index");
                }
            } else {
                //s
                $this->firstLogin();
            }
        } else {
            echo "error";
        }
    }

    //获取code 非静默方式
    public function getCodeUserinfo()
    {
        if (isset($_GET['code'])) {
            $content = $this->getAccessToken($_GET['code']);
            $content = json_decode($content);
            $access_token = $content->{'access_token'};
            $openid = $content->{'openid'};
            //判断是否已经获取了这个人的数据，如果获取了，就从数据库里面取出
            if ($this->getUserinfo($access_token, $openid)) {
                if (session("this_url")) {
                    redirect(session("this_url"));
                } else {
                    redirect("/index.php?m=Wap&c=Index&a=index");
                }
            } else {
                echo "error:can not login!";
            }
        } else {
            echo "error:can not login!";
        }
    }

    //获取access_token
    private function getAccessToken($code)
    {
        $uri = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . C("appid") . "&secret=" . C("appSecret") . "&code=$code&grant_type=authorization_code";
        $access_token = file_get_contents($uri);
        return $access_token;
    }

    //获取用户信息
    private function getUserinfo($access_token, $openid)
    {
        $uri = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $content = file_get_contents($uri);
        $content = json_decode($content);
        //如果得不到openid说明获取失败！
        if (!$content->{'openid'}) {
            if (session("login_time")) {
                //两次不成功就放弃！
                session("login_time", null);
                echo "login false";
                return false;
            } else {
                session("login_time", 1);
                $this->unFirstLogin();
            }
        } else {
            $user = CommonModel::getOneByWhere("user", array("user_openid" => $content->{'openid'}));
            if ($user) {
                $data['user_lasttime'] = date('Y-m-d H:i:s');
                $data['user_ip'] = $_SERVER["REMOTE_ADDR"];
                CommonModel::editByWhere('user', 'user_id', $user['user_id'], $data);
                session("in", $user);
            } else {
                $data['user_openid'] = $content->{'openid'};
                $data['user_headimgurl'] = $content->{'headimgurl'};
                $data['user_unionid'] = $content->{'unionid'};
                $data['user_nickname'] = $content->{'nickname'};
                $data['user_createtime'] = date("Y-m-d H:i:s");
                $data['user_sex'] = $content->{'sex'};
                $data['user_lasttime'] = date('Y-m-d H:i:s');
                $data['user_ip'] = $_SERVER["REMOTE_ADDR"];
                $data['user_nickname'] = $this->filterEmoji($content->{'nickname'});
                $data['user_id'] = CommonModel::addByWhere('user', $data);
                //绑定上下级
                if(session('user_id')){
                    //通过链接进来的
                    if($data['user_id']!=session('user_id')){
                        //不等于自己ID
                        //绑定关系
                        $da['user_up'] = session('user_id');
                        $da['user_up_time'] = date('Y-m-d H:i:s');
                        CommonModel::editByWhere('user','user_id',$data['user_id'],$da);
                    }
                }
                session("in", $data);
            }
            return true;
        }
    }

    //获取用户信息，从数据库中获取
    private function getUserinfoFromDB($openid)
    {
        $user = CommonModel::getOneByWhere('user', array('user_openid' => $openid));
        if ($user) {
            //如果没有头像，需要非静默登陆
            if (empty($user['user_headimgurl'])) {
                $this->firstLogin();
                exit;
            }
            $data['user_lasttime'] = date('Y-m-d H:i:s');
            $data['user_ip'] = $_SERVER["REMOTE_ADDR"];
            CommonModel::editByWhere('user', 'user_id', $user['user_id'], $data);
            session('in', $user);    //登陆成功!
            return $user;
        } else {
            return false;
        }
    }


    //取得微信js接口需要的东西
    public function getWechatJsKey($url)
    {
        //需要获得下面的东西
//        appId: '', // 必填，公众号的唯一标识
//        timestamp: , // 必填，生成签名的时间戳
//        nonceStr: '', // 必填，生成签名的随机串
//        signature: '',// 必填，签名，见附录1
        $jsKey["appId"] = C("appid");

        $jsKey["timestamp"] = time();
        $jsKey["nonceStr"] = "20160106";
        $wxTicket = $this->getWechatJsApiTicket();
        $jsKey["js_ticket"] = $wxTicket;
        $wxOri = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s",
            $wxTicket, $jsKey["nonceStr"], $jsKey["timestamp"], $url
        );
        $jsKey["signature"] = sha1($wxOri);
        return $jsKey;
    }

    //获取js_api_tiket
    public function getWechatJsApiTicket()
    {
        $ticket = S('wx_ticket');
        if (empty($ticket)) {
            $token = S('access_token');
            if (empty($token)) {
                $token = $this->wx_get_token();
            }
            $url2 = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi",
                $token);
            $res = file_get_contents($url2);
            $res = json_decode($res, true);
            $ticket = $res['ticket'];
            // 注意：这里需要将获取到的ticket缓存起来（或写到数据库中）
            // ticket和token一样，不能频繁的访问接口来获取，在每次获取后，我们把它保存起来。
            S('wx_ticket', $ticket, 3600);
        }
        return $ticket;
    }

    function wx_get_token()
    {
        $token = json_decode(S('access_token'));
        $token = $token->{'access_token'};
        if (!$token) {
            $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . C("appid") . '&secret=' . C("appSecret"));
            $res = json_decode($res, true);
            $token = $res['access_token'];
            // 注意：这里需要将获取到的token缓存起来（或写到数据库中）
            // 不能频繁的访问https://api.weixin.qq.com/cgi-bin/token，每日有次数限制
            // 通过此接口返回的token的有效期目前为2小时。令牌失效后，JS-SDK也就不能用了。
            // 因此，这里将token值缓存1小时，比2小时小。缓存失效后，再从接口获取新的token，这样
            // 就可以避免token失效。
            // S()是ThinkPhp的缓存函数，如果使用的是不ThinkPhp框架，可以使用你的缓存函数，或使用数据库来保存。
            S('access_token', $token, 3600);
        }
        return $token;
    }
    //获取永久素材media_id
    public function text(){
        $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . C("appid") . '&secret=' . C("appSecret"));
        $res = json_decode($res, true);
        $access_token = $res['access_token'];
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$access_token";
        $jsonmenu = '{
        "type":"news",
        "offset":0,
        "count":4
                }';
        $result = $this->http_request($url,$jsonmenu);
        echo $result;
    }
    //测试直播接口
    public function text1(){
        $url = "http://47.106.174.74/mp/v1/session/";
//        $data = array('roomCount'=>'10000',
//            'title'=>'测试',
//            'enteringIntroMessage'=>'欢迎参与本次直播',
//            'assistantNickname'=>'直播小助手',
//            'quittingNotification'=>'拜拜'
//            );
        $JSON = '{
        "roomCount":"1",
        "title":"测试",
        "enteringIntroMessage": "欢迎参与本次直播",
		"assistantNickname": "直播小助手",
		"quittingNotification":"拜拜"
        }';
        $headers = 'Content-type:application/json;';
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => $headers,
                'content' => $JSON
                    //http_build_query($data)
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        $we = json_decode($result,true);
        dump($we);
    }
//"assistantCount":'.$num.',
//"maxJoinedRooms":'.$group.',
//"title":"'.$title.'",
//"enteringIntroMessage":"'.$huanying.'",
//"assistantNickname":"'.$nickname.'"
    //发送json

    function postJSON($group,$title,$huanying,$nickname,$outt){
        $url = "http://47.106.174.74/mp/v1/session/";
        $data = array('roomCount'=>$group,
            'title'=>$title,
            'enteringIntroMessage'=>$huanying,
            'assistantNickname'=>$nickname,
            'quittingNotification'=>$outt,
            );
        $JSON = json_encode($data);
//        $JSON = '{
//        "roomCount":$group,
//        "title":'.$title.'
//        "enteringIntroMessage":"'.$huanying.'",
//		"assistantNickname":"'.$nickname.'"，
//		"quittingNotification":"'.$outt.'"
//        }';
        $headers = 'Content-type:application/json;';
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => $headers,
                'content' => $JSON
            )
        );
        $context = stream_context_create($opts);
        return $result = file_get_contents($url, false, $context);
    }

//"name":"分销提成",
//"sub_button":[
//{
//"type":"media_id",
//"name":"免费体验",
//"media_id":"juzVRdN5wUfz3l5bG33dX7LJxlP4PyQ0_LfGXrFuFEQ"
//},
//{
//"type":"click",
//"name":"转发得群",
//"key": "zhuanfaqun"
//}]
//"type":"media_id",
//"name":"私人订制",
//"media_id": "juzVRdN5wUfz3l5bG33dXzmTC3GIVEY1rfNPRFq8GGQ"
    //创建公众号自定义菜单栏
    public function access_token()
    {
        $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . C("appid") . '&secret=' . C("appSecret"));
        $res = json_decode($res, true);
        $access_token = $res['access_token'];

        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $jsonmenu = ' {
        "button":[
        {
          "name":"我要转播",
           "sub_button":[
            {
               "type":"view",
               "name":"我要直播",
               "url":"http://www.jiechen258.com/index.php?m=Wap&c=Index&a=index&id=1"
            },
            {
               "type":"view",
               "name":"我要录课",
               "url":"http://www.jiechen258.com/index.php?m=Wap&c=Index&a=index&id=2"
            },
            {
               "type":"view",
               "name":"我的订单",
               "url":"http://www.jiechen258.com/index.php?m=Wap&c=Index&a=Success"
            }]
       },
       {
          "type":"click",
          "name":"分销提成",
          "key": "zhuanfaqun"
       },
      {
          "name":"使用教程",
           "sub_button":[
           {
               "type":"view",
               "name":"充值优惠",
               "url":"http://www.jiechen258.com/index.php?m=Wap&c=Index&a=recharge"
            },
            {
               "type":"view",
               "name":"使用教程",
               "url":"http://www.jiechen258.com/index.php?m=Wap&c=Index&a=course"
            },
            {
               "type":"view",
               "name":"联系客服",
               "url":"http://www.jiechen258.com/index.php?m=Wap&c=Index&a=person&id=1"
            },
            {
               "type":"view",
               "name":"个人中心",
               "url":"http://www.jiechen258.com/index.php?m=Wap&c=Index&a=person"
            }]
       }]
}';
//$url="https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=$access_token";
//echo  http_request($url,$jsonmenu2);
        echo $this->http_request($url, $jsonmenu);
    }

//curl请求啊
    function http_request($url, $data = null, $headers = array())
    {
        $curl = curl_init();
        if (count($headers) >= 1) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}

