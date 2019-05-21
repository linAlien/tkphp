<?php


class WeixinTemplateMessage {

	private function getTemplateSetting($message_name){
		$templateSetting = C($message_name);

		return explode("|",$templateSetting);
	}

	//$data字段包括：
	//1. first : {{first.DATA}}
	//2. keyword1 : 会员编号：{{keyword1.DATA}}
	//3. keyword2 : 有效期至：{{keyword2.DATA}}
	//4. remark : {{remark.DATA}}
	public function sendUpgradeMessage($token,$openid,$data,$member,$newLevelName){
		$data['first'] = "恭喜，您的等级已经提升！";
		$data['remark'] = "恭喜，您的等级已经提升！新等级为：" . $newLevelName;

		$templateSetting = $this->getTemplateSetting('会员升级通知');

		import('ORG.Weixin.AccessToken');
		$accessTokenUtil = new \AccessToken();
		$accessToken = $accessTokenUtil->getAccessToken();

		$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
		$mes='{
            "touser":"'.$openid.'",
			"template_id":"'. $templateSetting[2] . '",
			"url":"",
			"topcolor":"#FF0000",
            "data":{
            "first":{
			"value":"'.$data['first'].'",
			"color":"#173177"
            },
            "keyword1":{
			"value":"'.$data['keyword1'].'",
			"color":"#173177"
            },
            "keyword2":{
			"value":"'.$data['keyword2'].'",
			"color":"#173177"
            },
            "remark":{
			"value":"'.$data['remark'].'",
			"color":"#173177"
            }
            }
            }';

		$info = json_decode($this->https_post($url,$mes), true);

		$data['token'] = $token;
		$data['to_openid']=$openid;
		$data['to_msg']=str_replace('?','*',$mes);
		$data['result']=$info;
		$data['createtime'] =  date('y-m-d H:i:s',time());

		M("send_msg_log")->add($data);
	}

	//$data字段包括：
	//1. first : {{first.DATA}}
	//2. keyword1 : 订单号：{{keyword1.DATA}}
	//3. keyword2 : 订单金额：{{keyword2.DATA}}
	//4. keyword3 : 分成金额：{{keyword3.DATA}}
	//5. keyword4 : 时间：{{keyword4.DATA}}
	//6. remark : {{remark.DATA}}
	public function sendGetMoneyMessage($token,$openid,$data,$member){
		$data['first'] = "亲，您又成功分销出一笔订单了";
		$data['remark'] = "【".$member['nickname']."】感谢有您，客服热线：8888888";

		$templateSetting = $this->getTemplateSetting('分销订单提成通知');

		import('ORG.Weixin.AccessToken');
		$accessTokenUtil = new \AccessToken();
		$accessToken = $accessTokenUtil->getAccessToken();

		$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
		$mes='{
            "touser":"'.$openid.'",
			"template_id":"'. $templateSetting[2] . '",
			"url":"",
			"topcolor":"#FF0000",
            "data":{
            "first":{
			"value":"'.$data['first'].'",
			"color":"#173177"
            },
            "keyword1":{
			"value":"'.$data['keyword1'].'",
			"color":"#173177"
            },
            "keyword2":{
			"value":"'.$data['keyword2'].'",
			"color":"#173177"
            },
            "keyword3":{
			"value":"'.$data['keyword3'].'",
			"color":"#173177"
            },
            "keyword4":{
			"value":"'.$data['keyword4'].'",
			"color":"#173177"
            },
            "remark":{
			"value":"'.$data['remark'].'",
			"color":"#173177"
            }
            }
            }';

		$info = json_decode($this->https_post($url,$mes), true);

		$data['token'] = $token;
		$data['to_openid']=$openid;
		$data['to_msg']=str_replace('?','*',$mes);
		$data['result']=$info;
		$data['createtime'] =  date('y-m-d H:i:s',time());

		M("send_msg_log")->add($data);
	}

	//$data字段包括： [IT科技 - 互联网|电子商务 / TM00005]
	//1. productType ， 商品名称提示文字
	//2. name ， 商品名称
	//3. time ， 消费时间
	//4. remark ， 消息内容
	public function sendConsumeMessage($token,$openid,$data)
	{
		$data['productType'] = "消费内容";
		$data['remark'] = "谢谢您的惠顾，双创平台为您提供最佳的购物体验！";

		$templateSetting = $this->getTemplateSetting('会员消费通知');

		import('ORG.Weixin.AccessToken');
		$accessTokenUtil = new \AccessToken();
		$accessToken = $accessTokenUtil->getAccessToken();

		$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
		$mes='{
            "touser":"'.$openid.'",
			"template_id":"'. $templateSetting[2] . '",
			"url":"",
			"topcolor":"#FF0000",
            "data":{
            "productType":{
			"value":"'.$data['productType'].'",
			"color":"#173177"
            },
            "name":{
			"value":"'.$data['name'].'",
			"color":"#173177"
            },
            "time":{
			"value":"'.$data['time'].'",
			"color":"#173177"
            },
            "remark":{
			"value":"'.$data['remark'].'",
			"color":"#173177"
            }
            }
            }';

		$info = json_decode($this->https_post($url,$mes), true);

		$data['token'] = $token;
		$data['to_openid']=$openid;
		$data['to_msg']=str_replace('?','*',$mes);
		$data['result']=$info;
		$data['createtime'] =  date('y-m-d H:i:s',time());

		M("send_msg_log")->add($data);
	}

	//$data字段包括：
	//1. first : {{first.DATA}}
	//2. keyword1 : 客户名称：{{keyword1.DATA}}
	//3. keyword2 : 收款单号：{{keyword2.DATA}}
	//4. keyword3 : 收款金额：{{keyword3.DATA}}
	//6. remark : {{remark.DATA}}
	public function sendConsumeVendorMessage($token,$openid,$data,$message=''){
		$data['first'] = "亲，又有人在您的商铺用双创币收费啦！";
		$data['remark'] = "谢谢您的使用！<br>".$message;

		$templateSetting = $this->getTemplateSetting('商户收款通知');

		import('ORG.Weixin.AccessToken');
		$accessTokenUtil = new \AccessToken();
		$accessToken = $accessTokenUtil->getAccessToken();

		$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
		$mes='{
            "touser":"'.$openid.'",
			"template_id":"'. $templateSetting[2] . '",
			"url":"",
			"topcolor":"#FF0000",
            "data":{
            "first":{
			"value":"'.$data['first'].'",
			"color":"#173177"
            },
            "keyword1":{
			"value":"'.$data['keyword1'].'",
			"color":"#173177"
            },
            "keyword2":{
			"value":"'.$data['keyword2'].'",
			"color":"#173177"
            },
            "keyword3":{
			"value":"'.$data['keyword3'].'",
			"color":"#173177"
            },
            "remark":{
			"value":"'.$data['remark'].'",
			"color":"#173177"
            }
            }
            }';

		$info = implode(',',json_decode($this->https_post($url,$mes), true));

		$data['token'] = $token;
		$data['to_openid']=$openid;
		$data['to_msg']=str_replace('?','*',$mes);
		$data['result']=$info;
		$data['createtime'] =  date('y-m-d H:i:s',time());

		M("send_msg_log")->add($data);
	}

	//$data字段包括：
	//1. first : {{first.DATA}}
	//2. keyword1 : 充值金额：{{keyword1.DATA}}
	//3. keyword2 : 充值时间：{{keyword2.DATA}}
	//4. keyword3 : 账户总额：{{keyword3.DATA}}
	//6. remark : {{remark.DATA}}
	public function sendChargeMessage($token,$openid,$data,$message=''){
		$data['first'] = "您好，您已经充值成功!";
		$data['remark'] = "感谢您对我们的信任，我们将为您提供更优质的服务!".$message;

		$templateSetting = $this->getTemplateSetting('充值成功提醒');

		import('ORG.Weixin.AccessToken');
		$accessTokenUtil = new \AccessToken();
		$accessToken = $accessTokenUtil->getAccessToken();

		$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
		$mes='{
            "touser":"'.$openid.'",
			"template_id":"'. $templateSetting[2] . '",
			"url":"",
			"topcolor":"#FF0000",
            "data":{
            "first":{
			"value":"'.$data['first'].'",
			"color":"#173177"
            },
            "keyword1":{
			"value":"'.$data['keyword1'].'",
			"color":"#173177"
            },
            "keyword2":{
			"value":"'.$data['keyword2'].'",
			"color":"#173177"
            },
            "keyword3":{
			"value":"'.$data['keyword3'].'",
			"color":"#173177"
            },
            "remark":{
			"value":"'.$data['remark'].'",
			"color":"#173177"
            }
            }
            }';

		$info = json_decode($this->https_post($url,$mes), true);
		$data['token'] = $token;
		$data['to_openid']=$openid;
		$data['to_msg']=str_replace('?','*',$mes);
		$data['result']=$info;
		$data['createtime'] =  date('y-m-d H:i:s',time());

		M("send_msg_log")->add($data);
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

