<?php

namespace app\common\model;

use think\Model;

class AuthGroup extends Model
{
    public function admin(){
        return $this->hasMany('Admins','group_id','id');
    }
}
