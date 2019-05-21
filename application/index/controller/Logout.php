<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/2/13
 * Time: 23:36
 */

namespace app\index\controller;


class Logout extends Common
{
    public function logout(){
        session(null);
        if (!session("userinfo.id")){
            return $this->success("退出成功","/");
        }
    }

}