<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/19
 * Time: 16:17
 */

namespace app\admin\validate;


use think\Validate;

class Column extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require',
        'ctitle' => 'require',
        'channel_id' => 'require',
    ];

    protected $field = [
        'title' => '栏目名称',
        'ctitle' => '模板名称',
        'channel_id' => '模型',
    ];

    protected $scene = [
        'add' => ['title','ctitle','channel_id'],
        'edit' => ['title'=>'require','ctitle','channel_id'],
    ];
}