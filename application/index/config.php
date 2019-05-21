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
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------
    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__HOME__' => SITE_PATH.'/static/home',
        '__EDIT__' => SITE_PATH.'/static/wangedit',
        '__EMD__' => SITE_PATH.'/static/editor.md',
        '__UPLOADS__' => SITE_PATH.'/uploads',
    ],

    // auth配置
    'auth'  => [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => 'auth_group', // 用户组数据不带前缀表名
        'auth_group_access' => 'auth_group_access', // 用户-用户组关系不带前缀表
        'auth_rule'         => 'auth_rule', // 权限规则不带前缀表
        'auth_user'         => 'admins', // 用户信息不带前缀表
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
];
