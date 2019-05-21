<?php

namespace app\index\controller;

use app\common\model\Users;
use think\Controller;
use think\helper\Hash;
use think\Request;

class Register extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view("register");
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request -> only(['username','password','password_confirm','code']);
        $validate = \Think\Loader::validate("Register");
        if ($validate->scene("register")->check($data)){
            unset($data['password_confirm']);
            unset($data['code']);
            $data['password'] = Hash::make($data['password']);
            $data['nickname'] = "User_" . substr(Hash::make(time()),0,10);
            $res = Users::create($data);
            if ($res){
                return $this->success("注册成功","/login.html");
            }else{
                return $this->error("注册失败");
            }
        }else{
            return $this->error($validate->getError());
        }
    }

}
