<?php

namespace app\admin\controller;

use app\common\model\AuthRule;
use app\common\model\Channels;
use think\Request;

class Rule extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $ruleres = db("auth_rule")->select();
        $ruleres = (!empty($ruleres))?subtree($ruleres):'';
        $this->assign([
            'ruleres' => $ruleres,
            'empty' => '<b>暂无数据</b>',
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
        $ruleres = db('auth_rule')->select();
        $channel = Channels::all();
        $ruleres = (!empty($ruleres))?subtree($ruleres):'';
        $this->assign([
            'ruleres' => $ruleres,
            'channel' => $channel,
        ]);
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
        $data = $request->only(['name', 'title', 'status', 'pid', 'faicon', 'sort', 'channel_id']);
        $validate = \Think\Loader::validate('Rule');
        if ($validate->scene("add")->check($data)){
            $res = AuthRule::create($data);
            if ($res){
                return $this->success("添加成功",'/admin/rule.html');
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
        return redirect("/admin/rule.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $rules = AuthRule::get($id);
        $ruleres = db('auth_rule')->select();
        $channel = Channels::all();
        $ruleres = (!empty($ruleres))?subtree($ruleres):'';
        $this->assign([
            'rules' => $rules,
            'ruleres' => $ruleres,
            'channel' => $channel,
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
        $data = $request->only(['id', 'name', 'title', 'status', 'pid', 'faicon', 'sort', 'channel_id']);
        $validate = \Think\Loader::validate('Rule');
        if ($validate->scene("add")->check($data)){
            if (!isset($data['status'])){
                $data['status'] = '0';
            }
            $res = AuthRule::update($data);
            if ($res !== false){
                return $this->success("修改成功",'/admin/rule.html');
            }else{
                return $this->error("修改失败");
            }
        }else{
            return $this->error($validate->getError());
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = AuthRule::destroy($id);
        if ($res){
            return $this->success("删除成功",'/admin/rule.html');
        }else{
            return $this->error("删除失败");
        }
    }
}
