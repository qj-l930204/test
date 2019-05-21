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

/*
    'watermark_type_id' => '水印类型',
    'wmheight' => '添加水印图片的最小高度',
    'wmwidth' => '添加水印图片的最小宽度',
    'wmpic' => '水印图片',
    'wmtext' => '水印文字',
    'wmfontsize' => '水印文字大小',
    'wmcolor' => '水印文字颜色',
    'wmangle' => '水印文字旋转角度',
    'wmalpha' => '水印图片透明度',
    'watermark_place_id' => '水印位置',
    // 返回图片的宽度
    $width = $image->width();
    // 返回图片的高度
    $height = $image->height();
 * */
function addwatermark($path){
    $wms = \app\common\model\Watermarks::get(1);
    if ($wms['isopen'] == '0'){
        return false;
    }
    $image = \think\Image::open($path);
    if ($wms['wmheight'] > $image->height() || $wms['wmwidth'] > $image->width()){
        return false;
    }
    $place_id = ($wms['watermark_place_id'] == '0') ? rand(1,9) : $wms['watermark_place_id'];

    if ($wms['watermark_type_id'] == '1'){
        $image -> water( ROOT_PATH . 'public' . DS . 'watermark' . DS . $wms['wmpic'], $place_id, $wms['wmalpha'] ) -> save($path);
    }elseif ($wms['watermark_type_id'] == '2'){
        $image -> text($wms['wmtext'],ROOT_PATH . 'public' . DS . 'static' . DS . 'admin' . DS . 'assets' . DS . 'fonts' . DS . 'HYGuLiW.ttf',$wms['wmfontsize'],$wms['wmcolor'],$place_id,'0',$wms['wmangle']) -> save($path);
    }else{
        return false;
    }
}

function _requeat($curl, $https = true, $method='GET', $data = null){  //
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $curl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    if ($https){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    }
    if ($method == 'POST'){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    $content = curl_exec($ch);
    $stacode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // 200
    curl_close($ch);
    if ($stacode == 200){
        return $content;
    }else{
        return false;
    }

}
//
function stacode($curl){  //
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $curl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_exec($ch);
    $stacode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // 200
    curl_close($ch);
    return $stacode;
}
