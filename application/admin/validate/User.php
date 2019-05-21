<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/2/12
 * Time: 17:27
 */

namespace app\admin\validate;


use think\Validate;

class User extends Validate{
    protected $regex = [];

    protected $rule = [
        'username' => 'require|email',
        'password' => 'require|length:6,20|confirm',
    ];

    protected $field = [
        'username' => '用户名',
        'password' => '密码',
        'password_confirm' => '确认密码',
    ];

    protected $scene = [
        'add' => [
            'username' => 'require|email',
            'password' => 'require|length:6,20|confirm',
        ]
    ];
}