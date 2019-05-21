<?php
/**
 * Created by PhpStorm.
 * User: 王柏建
 * Date: 2016/9/6
 * Time: 13:06
 */

    /**
     * 加密
     * @param string $key   密钥
     * @param string $str   需加密的字符串
     * @return type
     * $iv 向量
     */
    function encode( $key, $str ,$iv){
        return urlencode(base64_encode(openssl_encrypt($str, 'AES-256-CBC',$key,$options=OPENSSL_RAW_DATA,$iv)));
    }

    /**
     * 解密
     * @param type $key
     * @param type $str
     * @return type
     * $iv 向量
     */
    function decode( $key, $str ,$iv){
        return openssl_decrypt(base64_decode(urldecode($str)),'AES-256-CBC',$key,$options=OPENSSL_RAW_DATA,$iv);
    }
    /**
     * 获取参数并且解密
     * $param $key 密钥
     * $param $method post or get
     * $param $param
     */
    function getParamDecode($key,$iv,$method,$param){
        $data = getParameters($method,$param);
        $count = count($data);
        foreach($data as $k=>$val){
            $data[$k] = decode($key,$val,$iv);
        }
        return $data;
    }

    function br2nl($text) {
        return preg_replace('/<br\\s*?\/??>/i', '', $text);
    }

function curPageURL()
{
    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }
    else
    {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
    //code msg data
    function getRes($success,$code,$msg,$data=null){
        $res['success'] = $success."";
        $res['code'] = $code."";
        $res['msg'] = $msg;
        if($data){
            $res['data'] = $data;
        }
        else{
            $res['data'] = "";
        }
        return $res;
    }

    function trimall($str)//删除空格
    {
        $qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
        return str_replace($qian,$hou,$str);
    }
    /**
     *   生成某个范围内的随机时间
     * @param <type> $begintime  起始时间 格式为 Y-m-d H:i:s
     * @param <type> $endtime    结束时间 格式为 Y-m-d H:i:s
     */
    function randomDate() {
        $flag = 1;
        while($flag){
            //随机生成月数
            //获取当前的月数
            $moon = date("m");
            $m = rand(1,$moon);
            if(strlen($m) == 1){
                $m = "0".$m;
            }
            //随机生成日
            $d = rand(1,28);
            if(strlen($d) == 1)
                $d= "0".$d;
            //随机生成小时
            $h = rand(6,23);
            if(strlen($h) == 1){
               $h = "0".$h;
            }
            //随机生成分钟
            $i = rand(1,59);
            if(strlen($i) == 1){
                $i = "0".$i;
            }
            //随机生成秒数
            $s = rand(1,60);
            if(strlen($s) == 1){
                $s = "0".$s;
            }
            $time = "2017-$m-$d $h:$i:$s";
            if($time > date("Y-m-d H:i:s")){
                $flag = 1;
            }
            else{
                $flag = 0;
            }
        }
        return $time;
    }

    //$method 方法，数组
    function getParameters($method,$keys){
        $data = array();
        foreach($keys as $key){
            if($method == "get"){
                if(isset($_GET[$key]) && (!empty($_GET[$key]) || $_GET[$key]==='0')){
                    $data[$key] = I($method.".".$key);
                }
            }
            else{
                if(isset($_POST[$key]) && (!empty($_POST[$key]) || $_POST[$key]==='0')){
                    $data[$key] = I($method.".".$key);
                }
            }

        }
        return $data;
    }


    //$method 方法，数组
    function getParametersCanNull($method,$keys){
        $data = array();
        foreach($keys as $key){
            if($method == "get"){
                $data[$key] = I($method.".".$key);
            }
            else{
                $data[$key] = I($method.".".$key);
            }

        }
        return $data;
    }

    //获取单独参数
    function getOneParameter($method,$key){
        $res = false;
        if($method == "get"){
            if(isset($_GET[$key]) && (!empty($_GET[$key]) || $_GET[$key]==='0')){
                $res = I($method.".".$key);
            }
        }
        else{
            if(isset($_POST[$key]) && (!empty($_POST[$key]) || $_POST[$key]==='0')){
                $res = I($method.".".$key);
            }
        }
        return $res;
    }

    function is_mobile_request(){
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
    $mobile_browser++;
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
    $mobile_browser++;
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
    $mobile_browser++;
    if(isset($_SERVER['HTTP_PROFILE']))
    $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
        $mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda','xda-'
    );
    if(in_array($mobile_ua, $mobile_agents))
    $mobile_browser++;
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
    $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows 
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
    $mobile_browser=0;
    // But WP7 is also Windows, with a slightly different characteristic 
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
    $mobile_browser++;
        if($mobile_browser>0)
    return true;
    else
    return false;
    }


    //where 条件添加
    function addWhere($where,$method,$name,$type=null){
        if($type == "like"){
            if($method == "post" && I($method.".".$name)!=-1){
                if(isset($_POST[$name]) && $_POST[$name]!== ""){
                    $where[$name] = array('like','%'.I($method.".".$name).'%');
                }
            }
            else{
                if(isset($_GET[$name])&& $_GET[$name]!== ""){
                    dump($_GET[$name]);
                    $where[$name] = array('like','%'.I($method.".".$name).'%');
                }
            }
        }
        else{
            if($method == "post" && I($method.".".$name)!=-1){
                if(isset($_POST[$name])&& $_POST[$name]!== ""){
                    $where[$name] = I($method.".".$name);
                }
            }
            else{
                if(isset($_GET[$name]) && $_GET[$name]!== ""){
                    $where[$name] = I($method.".".$name);
                }
            }
        }
        return $where;
    }

    //获取中文首字母
    function getFirstCharter($str){
        if(empty($str)){return '';}
        $fchar=ord($str{0});
        if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
        $s1=iconv('UTF-8','gb2312',$str);
        $s2=iconv('gb2312','UTF-8',$s1);
        $s=$s2==$str?$s1:$str;
        $asc=ord($s{0})*256+ord($s{1})-65536;
        if($asc>=-20319&&$asc<=-20284) return 'A';
        if($asc>=-20283&&$asc<=-19776) return 'B';
        if($asc>=-19775&&$asc<=-19219) return 'C';
        if($asc>=-19218&&$asc<=-18711) return 'D';
        if($asc>=-18710&&$asc<=-18527) return 'E';
        if($asc>=-18526&&$asc<=-18240) return 'F';
        if($asc>=-18239&&$asc<=-17923) return 'G';
        if($asc>=-17922&&$asc<=-17418) return 'H';
        if($asc>=-17417&&$asc<=-16475) return 'J';
        if($asc>=-16474&&$asc<=-16213) return 'K';
        if($asc>=-16212&&$asc<=-15641) return 'L';
        if($asc>=-15640&&$asc<=-15166) return 'M';
        if($asc>=-15165&&$asc<=-14923) return 'N';
        if($asc>=-14922&&$asc<=-14915) return 'O';
        if($asc>=-14914&&$asc<=-14631) return 'P';
        if($asc>=-14630&&$asc<=-14150) return 'Q';
        if($asc>=-14149&&$asc<=-14091) return 'R';
        if($asc>=-14090&&$asc<=-13319) return 'S';
        if($asc>=-13318&&$asc<=-12839) return 'T';
        if($asc>=-12838&&$asc<=-12557) return 'W';
        if($asc>=-12556&&$asc<=-11848) return 'X';
        if($asc>=-11847&&$asc<=-11056) return 'Y';
        if($asc>=-11055&&$asc<=-10247) return 'Z';
        return null;
    }
    //获取随机数字+字母
    function getRandomString($len, $chars=null)
    {
        if (is_null($chars)){
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000*(double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

    function curlPost($url,$post_data=null,$headers=null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        if($post_data)
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        //header变量
        if($headers)
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        $output = curl_exec($ch);
        curl_close($ch);
        //返回获得的数据
        return ($output);
    }

    //发送json
    function postJSON($url, $JSON,$headers){//file_get_content
        $opts = array('http' =>

            array(
                'method'  => 'POST',
                'header'  => $headers,
                'content' => $JSON
            )

        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    function curl_post($url,$data,$http_header)
    {
        $timeout = 5000;
        $postdataArray = array();
        foreach ($data as $key=>$value){
            array_push($postdataArray, $key.'='.urlencode($value));
        }
        $postdata = join('&', $postdataArray);

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt ($ch, CURLOPT_HEADER, false );
        curl_setopt ($ch, CURLOPT_HTTPHEADER,$http_header);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER,false); //处理http证书问题
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        if (false === $result) {
            $result =  curl_errno($ch);
        }
        curl_close($ch);
        echo $result;
        return $result;
    }
?>