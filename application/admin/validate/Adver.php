<?php
/**
 * Created by PhpStorm.
 * User: PHP_ADMIN
 * Date: 2019/1/30
 * Time: 11:22
 */

namespace app\admin\validate;


use think\Validate;

class Adver extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require|max:64|unique:advers',
        'adver_place_id' => 'require',
        'picwidth' => 'require|number',
        'picheight' => 'require|number',
        'link' => 'require|max:128|url',
    ];

    protected $field = [
        'title' => '标题',
        'adver_place_id' => '广告位置',
        'picwidth' => '图片宽度',
        'picheight' => '图片高度',
        'link' => 'URL地址',
    ];

    protected $scene = [
        'add' => [
            'title' => 'require|max:64|unique:advers',
            'adver_place_id' => 'require',
            'picwidth' => 'require|max:32',
            'picheight' => 'require|max:32',
            'link' => 'require|max:128|unique:advers',
        ],
    ];
}