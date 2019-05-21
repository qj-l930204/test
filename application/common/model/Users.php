<?php

namespace app\common\model;

use think\Model;

class Users extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public function comments(){
        return $this->hasMany("Comments",'user_id','id');
    }

    public function zans(){
        return $this->hasMany("Zans","user_id","id");
    }

    public function genders() {
        return $this->belongsTo('Genders', 'gender_id', 'id');
    }
}
