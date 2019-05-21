<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/23
 * Time: 0:15
 */

namespace app\admin\validate;


use think\Validate;

class Article extends Validate
{
    protected $regex = [];

    protected $rule = [
        'title' => 'require|max:64',
        'sub_title' => 'max:64',
        'sort' => 'between:1,255',
        'source' => 'max:16',
        'column_id' => 'require',
        'keywords' => 'max:64',
        'description' => 'max:256',
        'videourl' => 'max:128',
        'redirecturl' => 'max:128',
    ];

    protected $field = [
        'title' => '标题',
        'sub_title' => '副标题',
        'sort' => '权重',
        'source' => '来源',
        'column_id' => '栏目',
        'keywords' => '关键词',
        'description' => '摘要',
        'videourl' => '视频地址',
        'redirecturl' => '跳转地址',
    ];

    protected $scene = [
        'add' => [
            'title' => 'require|max:64',
            'sub_title' => 'max:64',
            'sort' => 'between:1,255',
            'source' => 'max:16',
            'column_id' => 'require',
            'keywords' => 'max:64',
            'description' => 'max:256',
            'videourl' => 'max:128',
            'redirecturl' => 'max:128',
        ],
    ];
}