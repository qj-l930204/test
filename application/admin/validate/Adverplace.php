<?php
/**
 * Created by PhpStorm.
 * User: PHP_ADMIN
 * Date: 2019/1/30
 * Time: 11:22
 */

namespace app\admin\validate;


use think\Validate;

class Adverplace extends Validate
{
    protected $regex = [];

    protected $rule = [
        'place' => 'require|max:32|unique:adver_places',
    ];

    protected $field = [
        'place' => '广告位置名称',
    ];

    protected $scene = [
        'add' => ['place'],
    ];
}