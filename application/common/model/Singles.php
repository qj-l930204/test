<?php

namespace app\common\model;

use think\Model;

class Singles extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public function columns(){
        return $this->belongsTo("Columns",'column_id','id');
    }
}
