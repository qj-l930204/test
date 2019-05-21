<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/25
 * Time: 23:15
 */

namespace app\admin\validate;


use think\Validate;

class Sysconfig extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require|max:32',
        'cname' => 'require|max:32|unique:sysconfigs',
        'type' => 'require',
        'sysconfig_group_id' => 'require',
        'value' => 'max:1024',
    ];

    protected $field = [
        'cname' => '别名',
        'title' => '变量名',
        'sysconfig_group_id' => '变量组',
        'type' => '类型',
        'value' => '变量值',
    ];

    protected $scene = [
        'add' => [
            'cname' => 'require|max:32|unique:sysconfigs',
            'title' => 'require|max:32',
            'sysconfig_group_id' => 'require',
            'type' => 'require',
            'value' => 'max:1024',
        ],
    ];
}