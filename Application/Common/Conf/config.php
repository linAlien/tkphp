<?php
return array(
	//'配置项'=>'配置值'
    //路由配置
    'URL_ROUTER_ON'   => true,
    'URL_MODEL'       =>    0,
    'DEFAULT_MODULE'       =>    'Wap',
    'DEFAULT_ACTION'       =>    'Index',
    'DEFAULT_CONTROLLER'   =>    'index',

    //数据库配置

    'DB_TYPE'       => 'mysql', // 数据库类型
    'DB_HOST'       => 'hdm359939388.my3w.com', // 服务器地址
    'DB_NAME'       => 'hdm359939388_db', // 数据库名
    'DB_USER'       => 'hdm359939388', // 用户名
    'DB_PWD'        => 'Peng22069', // 密码
    'DB_PORT'       => 3306, // 端口
    'DB_PREFIX'     => 'qun_', // 数据库表前缀
    'DB_CHARSET'    => 'utf8', // 字符集
    'DB_DEBUG'      =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

//    'host' => 'http://qun.lingxiren.com',
    'host' => 'http://www.jiechen258.com',//http://www.gao4567.com
    'URL' => 'http://www.jiechen258.com',
//    'URL' => 'http://qun.lingxiren.com',

    'get_code_url_userinfo' => 'http://www.jiechen258.com/index.php?a=getCodeUserinfo&c=Wechat&m=Wap',
    'get_code_url_base' => 'http://www.jiechen258.com/index.php?a=getCodeBase&c=Wechat&m=Wap',
    'appid'=>'wxe51f393aa1d64b94', //正式的
    'appSecret'=>'9eb38885d983aa181cc460aa684e523e', //正式的
);
