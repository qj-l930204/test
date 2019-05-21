<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/20
 * Time: 11:51
 */

namespace app\admin\validate;


use think\Validate;

class Admin extends Validate
{
    protected $regex = [
        'phone' => '/^0?(13|14|15|17|18)[0-9]{9}$/',
    ];

    protected $rule = [
        'username' => 'require|max:32|unique:admins',
        'password' => 'min:5|max:20',
        'nickname' => 'require|max:16|unique:admins',
        'phone' => 'max:16|regex:phone|unique:admins',
        'email' => 'email|max:128|unique:admins',
        'group_id' => 'require',
    ];

    protected $field = [
        'username' => '用户名',
        'password' => '密码',
        'nickname' => '昵称',
        'phone' => '手机号码',
        'email' => '电子邮箱',
        'group_id' => '管理员组',
    ];

    protected $scene = [
        'add' => ['username','password','nickname','phone','email','group_id'],
        'edit' => [
            'username' => 'require|max:32|unique:admins',
            'password' => 'min:5|max:20',
            'nickname' => 'require|max:16|unique:admins',
            'phone' => 'max:16|regex:phone|unique:admins',
            'email' => 'email|max:128|unique:admins',
            'group_id' => 'require',
        ],
    ];
}