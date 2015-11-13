<?php
return array(
    'DB_TYPE'   => 'oracle', // 数据库类型
    'DB_HOST'   => '172.16.253.118', // 服务器地址
    'DB_NAME'   => 'orcl', // 数据库名
    'DB_USER'   => 'libthird', // 用户名
    'DB_PWD'    => 'libthird', // 密码
    'DB_PORT'   => 1521, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_FIELDS_CACHE' => false,
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
    'DB_PARAMS' =>  array(
        'presist' => true,
    ),

    'URL_CASE_INSENSITIVE' => true,
    'URL_MODEL' => 3,
    'LOG_RECORD' => true, // 开启日志记录
    'SHOW_PAGE_TRACE' =>true,
    

   /* 'HTML_CACHE_ON'     =>    true, // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
         
        'getPage'    =>    array('{:action}',-1),
    )*/


);