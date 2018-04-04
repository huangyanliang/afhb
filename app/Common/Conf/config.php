<?php
return array(
	'MODULE_ALLOW_LIST'    => array('Home','Admin'),//设置可访问目录
	'DEFAULT_MODULE'       => 'Home',                 //设置默认目录
	'TMPL_TEMPLATE_SUFFIX' => '.tpl',                 //设置模版后缀
	'DEFAULT_THEME'        => 'default',              //设置默认主题目录
	'DB_TYPE'              => 'mysqli',               //数据库类型
	'DB_HOST'              => 'localhost',            //服务器地址
	'DB_NAME'              => 'afhb',                 //数据库名
	'DB_USER'              => 'root',                 //用户名
	'DB_PWD'               => 'root',                     //密码
	'DB_PORT'              => 3306,                   //端口
	'DB_PREFIX'            => 'bh_',                  //数据库表前缀 
	'DB_CHARSET'           => 'utf8',                 //字符集
	'URL_MODEL'            => 2,                      //urlmodel
	'SHOW_PAGE_TRACE'      => true,                   //debug
	'TMPL_CACHE_ON'        => false,                  //是否开启模板编译缓存,设为false则每次都会重新编译
	'LOG_RECORD'           => true,                   //是否开启记录日志
	'URL_CASE_INSENSITIVE' => true,                   //是否验证大小写 true 不区分大小写
	'COOKIE_PREFIX'        => 'bh_',                  //cookie前缀
	//'TMPL_EXCEPTION_FILE'  => './app/Home/View/default/public/jump.tpl',
    'DEFAULT_FILTER'       => 'addslashes,htmlspecialchars,trim',           //默认过滤方法 //stripslashes
	'UPLOAD_PATH'          => './uploads/',           //图片上传路径
);
