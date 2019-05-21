<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function subtree($data,$pid=0,$level='0'){
    static $res = [];
    foreach ($data as $k => $v){
        if ($v['pid'] == $pid){
            $v['level'] = $level;
            $res[] = $v;
            subtree($data,$v['id'],$level+1);
        }
    }
    return $res;
}

function children($data){
    // 整理数组

    foreach($data as $key=>$vo){
        $res[$vo['id']] = $vo;
        $res[$vo['id']]['children'] = [];
    }
    unset( $data );

    // 查询子孙
    foreach($res as $key=>$vo){
        if( $vo['pid'] != 0 ){
            $res[$vo['pid']]['children'][] = &$res[$key];
        }
    }

    // 去除杂质
    foreach($res as $key=>$vo){
        if($vo['pid'] == 0){
            $tree[] = $vo;
        }
    }
    unset($res);
    return $tree;
}
