<?php

namespace app\admin\controller;

use app\common\model\Users;
use think\helper\Hash;
use think\Request;

class User extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $map = [];
        $userres = Users::where($map)->paginate(20,false,[
            'query' => redirect() -> params(),
        ]);
        $this->assign([
            'userres' => $userres,
            'empty' => "<b>暂无数据</b>"
        ]);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request -> only(['username','password','password_confirm']);
        $validate = \Think\Loader::validate("User");
        if ($validate->scene("add")->check($data)){
            unset($data['password_confirm']);
            $data['password'] = Hash::make($data['password']);
            $res = Users::create($data);
            if ($res){
                return $this->success("添加成功",'/admin/user.html');
            }else{
                return $this->error("添加失败");
            }
        }else{
            return $this->error($validate->getError());
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $users = Users::get($id);
         $this->assign([
             'users' => $users,
         ]);
        return view();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
