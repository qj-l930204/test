<?php

namespace app\common\model;

use think\Model;

class Sysconfigs extends Model
{
    public function sysconfiggroups(){
        return $this->belongsTo("SysconfigGroup","sysconfig_group_id","id");
    }
}
