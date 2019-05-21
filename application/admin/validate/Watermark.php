<?php
/**
 * Created by PhpStorm.
 * User: PHP_ADMIN
 * Date: 2019/1/29
 * Time: 9:35
 */

namespace app\admin\validate;


use think\Validate;

class Watermark extends Validate
{
    protected $regex = [];

    protected $rule = [
        'watermark_type_id' => 'required',
        'wmheight' => 'require',
        'wmwidth' => 'require',
        'wmtext' => 'require|max:128',
        'wmfontsize' => 'require|between:12,36',
        'wmcolor' => 'require',
        'wmangle' => 'require|between:0,360',
        'wmalpha' => 'require|between:0,100',
        'watermark_place_id' => 'require',
    ];

    protected $field = [
        'watermark_type_id' => '水印类型',
        'wmheight' => '添加水印图片的最小高度',
        'wmwidth' => '添加水印图片的最小宽度',
        'wmtext' => '水印文字',
        'wmfontsize' => '水印文字大小',
        'wmcolor' => '水印文字颜色',
        'wmangle' => '水印文字旋转角度',
        'wmalpha' => '水印图片透明度',
        'watermark_place_id' => '水印位置',
    ];

    protected $scene = [
        'add' => [
            'watermark_type_id' => 'require',
            'wmheight' => 'require',
            'wmwidth' => 'require',
            'wmtext' => 'require|max:128',
            'wmfontsize' => 'require|between:12,36',
            'wmcolor' => 'require',
            'wmangle' => 'require|between:0,360',
            'wmalpha' => 'require|between:0,100',
            'watermark_place_id' => 'require',
        ]
    ];
}