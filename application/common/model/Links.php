<?php

namespace app\common\model;

use think\Model;

class Links extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public function linkgroups(){
        return $this->belongsTo("LinkGroup",'link_group_id','id');
    }
}
