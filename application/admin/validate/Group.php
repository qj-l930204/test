<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/20
 * Time: 12:08
 */

namespace app\admin\validate;


use think\Validate;

class Group extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require|max:16|unique:auth_group',
    ];

    protected $field = [
        'title' => '管理员组名称',
    ];

    protected $scene = [
        'add' => ['title'],
        'edit' => ['title'=>'require|max:16'],
    ];
}