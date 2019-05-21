<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/21
 * Time: 23:58
 */

namespace app\admin\validate;


use think\Validate;

class Rule extends Validate
{
    protected $regex = [];

    protected $rule = [
        'name' => 'require|max:128|unique:auth_rule',
        'title' => 'require|max:16|unique:auth_rule',
    ];

    protected $field = [
        'name' => '规则名',
        'title' => '规则标题',
    ];

    protected $scene = [
        'add' => ['name','title'],
    ];
}