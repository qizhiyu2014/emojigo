<?php
return array(
	//设置url后缀
	'URL_HTML_SUFFIX'      => '.html',

	//设置URL大小写不敏感
	'URL_CASE_INSENSITIVE' => true,
	'URL_MODEL'            =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
	//数据库
	'DB_TYPE'              => 'mysqli', // 数据库类型
	'DB_HOST'              => '127.0.0.1', // 服务器地址
	'DB_NAME'              => 'emojigo', // 数据库名
	'DB_USER'              => 'root', // 用户名
	'DB_PWD'               => 'chongyu', // 密码
	'DB_PORT'              => 3306, // 端口
	'DB_PREFIX' 			=> 'emojigo_', // 数据库表前缀

	'DEFAULT_CONTROLLER'	=>	'Event',



	//缓存配置
	'DATA_CACHE_TYPE' => 'File',
	'DATA_CACHE_TIME' => '3600',


	'WEB_HOST'              => 'http://localhost/',

);