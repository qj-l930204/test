<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/27
 * Time: 1:01
 */

namespace app\admin\validate;


use think\Validate;

class Link extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require|max:32|unique:links',
        'link' => 'require|max:128|unique:links',
        'sort' => 'lt:256',
    ];

    protected $field = [
        'title' => '名称',
        'link' => '链接',
        'sort' => '权重',
    ];

    protected $scene = [
        'title' => 'require|max:32|unique:links',
        'link' => 'require|max:128|unique:links',
        'sort' => 'lt:256',
    ];
}