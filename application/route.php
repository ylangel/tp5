<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'index' => 'index/index', //首页

    'login' => 'login/login', //登录


    /* 测试页面 */
    'table' => 'index/basic_table',
    'elements' => 'index/basic_elements',
    'page' => 'index/bland_page',
    'buttons' => 'index/buttons',
    'chartjs' => 'index/chartjs',
    'error_404' => 'index/error_404',
    'error_500' => 'index/error_500',
    'mdi' => 'index/mdi',
    'register' => 'index/register',
    'typography' => 'index/typography',
];
