<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/2/1
 * Time: 0:09
 */

namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
    protected $regex = [];

    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'code' => 'require|length:5|captcha',
    ];

    protected $field = [
        'username' => '用户名',
        'password' => '密码',
        'code' => '验证码',
    ];

    protected $scene = [
        'username' => 'require',
        'password' => 'require',
        'code' => 'require|length:5|captcha',
    ];
}