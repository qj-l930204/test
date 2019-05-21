<?php

namespace app\common\model;

use think\Model;

class Comments extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public function articles(){
        return $this->belongsTo("Articles",'article_id','id');
    }

    public function users(){
        return $this->belongsTo("Users",'user_id','id');
    }
}
