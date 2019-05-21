<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/27
 * Time: 1:13
 */

namespace app\admin\validate;


use think\Validate;

class Linkg extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require|max:32|unique:link_group',
    ];

    protected $field = [
        'title' => '友情链接组名称',
    ];

    protected $scene = [
        'add' => ['title'],
    ];
}