<?php

namespace app\common\model;

use think\Model;

class Watermarks extends Model
{
    public function wmplace(){
        return $this->belongsTo("WatermarkPlace",'watermark_place_id','id');
    }
    public function wmtype(){
        return $this->belongsTo("WatermarkType",'watermark_type_id','id');
    }
}
