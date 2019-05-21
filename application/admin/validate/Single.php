<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/23
 * Time: 0:15
 */

namespace app\admin\validate;


use think\Validate;

class Single extends Validate
{
    protected $regex = [];

    protected $rule = [

        'title' => 'require|max:64|unique:singles',
        'column_id' => 'require|unique:singles',
        'content' => 'require',
    ];

    protected $field = [
        'title' => '标题',
        'column_id' => '栏目',
        'content' => '内容',
    ];

    protected $scene = [
        'add' => [
            'title' => 'require|max:64|unique:singles',
            'column_id' => 'require|unique:singles',
            'content' => 'require',
        ],
    ];
}