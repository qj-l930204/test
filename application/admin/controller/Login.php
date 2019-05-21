<?php

namespace app\admin\controller;

use app\common\model\Admins;
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
    public function index(Request $request)
    {
        return view("login");
    }

    public function login(Request $request){
        $data = $request -> only(["username", "password", "code"]);
        $validate = \Think\Loader::validate("Login");
        if ($validate->scene("add")->check($data)){
            $admins = Admins::where(['username'=>$data['username']])->find();
            if (empty($admins)){
                return $this->error('用户名不存在');
            }
            $res = Hash::check($data['password'],$admins['password']);
            if ($res){
                session('admininfo',$admins);
                $this->updatelogininfo($request);
                return $this->success('登录成功');
            }else{
                return $this->error('用户名或密码错误');
            }
        }else{
            return $this->error($validate->getError());
        }
    }

    public function updatelogininfo($request){
        $data = [
            'id' => session("admininfo.id"),
            'last_login_time' => time(),
            'last_login_ip' => $request -> ip(),
        ];
        Admins::update($data);
    }
}
