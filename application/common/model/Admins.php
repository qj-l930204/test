<?php

namespace app\common\model;

use think\Model;

class Admins extends Model
{
    public function authgroup(){
        return $this->belongsTo('AuthGroup','group_id','id');
    }
}
