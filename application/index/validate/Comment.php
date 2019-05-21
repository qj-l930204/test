<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/2/14
 * Time: 23:54
 */

namespace app\index\validate;


use think\Validate;

class Comment extends Validate
{
    protected $regex = [];

    protected $rule = [
        'user_id' => 'require',
        'article_id' => 'require',
        'content' => 'require|max:5000',
        'code' => 'require|length:5|captcha',
    ];

    protected $field = [
        'user_id' => '用户ID',
        'article_id' => '文章ID',
        'content' => '评论内容',
        'code' => '验证码',
    ];

    protected $scene = [
        'save' => [
            'user_id' => 'require',
            'article_id' => 'require',
            'content' => 'require|max:5000',
            'code' => 'require|length:5|captcha',
        ]
    ];
}