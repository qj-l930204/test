<?php

namespace app\common\model;

use think\Model;

class Advers extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public function adverplace(){
        return $this->belongsTo("AdverPlaces",'adver_place_id','id');
    }
}
