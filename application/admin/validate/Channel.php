<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/18
 * Time: 22:56
 */

namespace app\admin\validate;

use think\Validate;


class Channel extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require|max:8|unique:channels',
        'ctitle' => 'require|max:16|unique:channels',
    ];

    protected $field = [
        'title' => '模型名称',
        'ctitle' => '别名',
    ];

    protected $scene = [
        'add' => ['title','ctitle'],
        'edit' => ['title'=>'require|max:8','ctitle'=>'require|max:16'],
    ];
}