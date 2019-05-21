<?php
/**
 * Created by PhpStorm.
 * User: PHP_ADMIN
 * Date: 2019/2/1
 * Time: 17:19
 */

namespace app\index\validate;


use think\Validate;

class Register extends Validate
{
    protected $regex = [];

    protected $rule = [
        'username' => 'require|email|unique:users',
        'password' => 'require|length:6,20|confirm',
        'code' => 'require|length:5|captcha',
    ];

    protected $field = [
        'username' => '用户名',
        'password' => '密码',
        'password_confirm' => '重复密码',
        'code' => '验证码',
    ];

    protected $scene = [
        'register' => [
            'username' => 'require|email|unique:users',
            'password' => 'require|length:6,20|confirm',
            'code' => 'require|length:5|captcha',
        ]
    ];
}