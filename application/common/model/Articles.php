<?php

namespace app\common\model;

use think\Model;

class Articles extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public function authors(){
        return $this -> belongsTo("Admins",'author','id');
    }

    public function columns(){
        return $this -> belongsTo("Columns",'column_id','id');
    }

    public function accessoryjur(){
        return $this -> belongsTo("AccessoryJur",'accessory_jur_id','id');
    }

    public function comments(){
        return $this -> hasMany("Comments",'article_id','id');
    }

    public function zans(){
        return $this -> hasMany("Zans",'article_id','id');
    }
}
