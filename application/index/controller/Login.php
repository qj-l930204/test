<?php

namespace app\index\controller;

use app\common\model\Users;
use think\Controller;
use think\helper\Hash;
use think\Request;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view("login");
    }

    public function login(Request $request){
        $url = ($request->input("u"))?$request->input("u"):'/';
        $data = $request -> only(['username','password','code']);
        $validate = \Think\Loader::validate("Login");
        if ($validate->scene("login")->check($data)){
            $users = Users::where('username',$data['username'])->find();
            if (empty($users)){
                return $this->error("用户名不存在");
            }
            $res = Hash::check($data['password'],$users['password']);
            if ($res){
                session("userinfo",$users);
                $this->updatelogininfo($request);
                return $this->success("登录成功",$url);
            }else{
                return $this->error("用户名过密码输入错误");
            }
        }else{
            return $this->error($validate->getError());
        }
    }

    public function updatelogininfo($request){
        $data = [
            'id' => session("userinfo.id"),
            'last_login_time' => time(),
            'last_login_ip' => $request -> ip(),
        ];
        Users::update($data);
    }
}
