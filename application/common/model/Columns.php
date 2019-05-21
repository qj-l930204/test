<?php

namespace app\common\model;

use think\Model;

class Columns extends Model
{
    public function channel(){
        return $this->belongsTo('Channels','channel_id','id');
    }
}
