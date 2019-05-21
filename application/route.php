<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];
Route::group([],function (){
    //首页
    Route::get('/','index/Index/index');
    //文章列表
    Route::get('/list/:view','index/Article/index');
    //文章详情
    Route::get('/article/:view/:id','index/Article/article');
    // 赞/取消赞
    Route::post('/article/zan','index/Article/zan');
    Route::post('/article/unzan','index/Article/unzan');
    //标签搜索
    Route::get('/search/tag/:tagname','index/Search/index');
    //登录
    Route::get('/login','index/Login/index');
    Route::post('/check','index/Login/login');
    //注册
    Route::get('/register','index/Register/index');
    Route::post('/register/save','index/Register/save');
    //退出登录
    Route::get('/logout','index/Logout/logout');
    //评论
    Route::post('/comment/save','index/Comment/save');
});

//后台
Route::group(['prefix'=>'admin'],function (){
    //后台首页
    Route::get('/index','admin/Index/index');


});
Route::group([],function (){
    //文章
    Route::resource('/admin/article','admin/Article');
    //单页
    Route::resource('/admin/single','admin/Single');
    //栏目
    Route::resource('/admin/column','admin/Column');
    //模型
    Route::resource('/admin/channel','admin/Channel');
    //管理员组
    Route::resource('/admin/group','admin/Group');
    //管理员
    Route::resource('/admin/admin','admin/Admin');
    //规则
    Route::resource('/admin/rule','admin/Rule');
    //注册用户
    Route::resource('/admin/user','admin/User');
    //用户评论
    Route::resource('/admin/comment','admin/Comment');
    //标签
    Route::resource('/admin/tag','admin/Tag');
    //系统设置
    Route::resource('/admin/sysconfig','admin/Sysconfig');
    //友情链接
    Route::resource('/admin/link','admin/Link');
    //友情链接组
    Route::resource('/admin/linkg','admin/Linkg');
    //水印
    Route::resource('/admin/watermark','admin/Watermark');
    //广告
    Route::resource('/admin/adver','admin/Adver');
    //广告位置
    Route::resource('/admin/adverplace','admin/Adverplace');
});
//栏目
Route::post('/admin/column/:id/change','admin/Column/change');
//模型
Route::post('/admin/channel/:id/change','admin/Channel/change');
//管理员
Route::post('/admin/admin/:id/change','admin/Admin/change');
//管理员头像
Route::post('/admin/upheadimg','admin/Admin/upheadimg');
//管理员组
Route::post('/admin/group/:id/change','admin/Group/change');
//管理员组权限
Route::any('/admin/groupper/:id','admin/Group/groupper');
//wangEdit编辑器上传图片
Route::any('/admin/article/upload','admin/Article/upload');
//系统信息
Route::post('/admin/sysconfig/updates','admin/Sysconfig/updates');
//友情链接
Route::post('/admin/link/:id/change','admin/Link/change');
//水印
Route::post('/admin/watermark/:id/change','admin/Watermark/change');
//广告
Route::post('/admin/adver/:id/change','admin/Adver/change');
//后台登录
Route::get('/admin/login','admin/Login/index');
Route::post('/admin/check','admin/Login/login');
//后台登出
Route::get('/admin/logout','admin/Index/logout');
