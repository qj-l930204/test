<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/23
 * Time: 0:48
 */

namespace app\admin\validate;


use think\Validate;

class Tag extends Validate
{
    protected $regex = [];

    protected $rule = [
        'tagname' => 'require|max:16|unique:tags',
    ];

    protected $field = [
        'tagname' => '标签名称',
    ];

    protected $scene = [
        'add' => ['tagname'],
    ];
}