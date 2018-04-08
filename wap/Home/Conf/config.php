<?php
return array(
    'DB_TYPE'               =>  'mysql',     // 数据库类型

    'DB_HOST'               =>  '47.93.13.221', // 服务器地址
    'DB_NAME'               =>  'tao',          // 数据库
    'DB_USER'               =>  'shop_user',      // 用户名  
    'DB_PWD'                =>  'wht@shop',          // 密码 
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tao_',    // 数据库表前缀
    'TMPL_L_DELIM'=>'<{',
    'TMPL_R_DELIM'=>'}>',
    'TMPL_ACTION_ERROR'     => 'Public:error', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   => 'Public:success', // 默认成功跳转对应的模板文件
    'TOKEN_ON'=>true,  // 是否开启令牌验证
    'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
    
    'URL_CASE_INSENSITIVE'  =>   true, 
    'URL_MODEL'             =>   3,
    'TMPL_ACTION_ERROR'         =>  'public:tishi', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'       =>  'public:tishi', // 默认成功跳转对应的模板文件
    
    'TMPL_PARSE_STRING' =>array(     '/Uploads'=>__ROOT__.'/Uploads', ),
    //'HTML_CACHE_ON' => true,               //开启静态缓存  
    
    /* 错误设置 */  
    'ERROR_MESSAGE' => '您浏览的页面暂时发生了错误！请稍后再试～',//错误显示信息,非调试模式有效  
    'ERROR_PAGE' => '/', // 错误定向页面
    
    'SESSION_AUTO_START'        =>  true,  //session自动开启

);