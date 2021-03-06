<?php

namespace app\admin\controller;

use app\common\model\AuthGroup;
use think\Request;

class Group extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $groupres = AuthGroup::all();
        $this->assign([
            'groupres' => $groupres,
            'empty' => '<b>暂无数据</b>'
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
        $data = $request->only(['title','status']);
        $validate = \Think\Loader::validate("Group");
        if ($validate->scene("add")->check($data)){
            $res = AuthGroup::create($data);
            if ($res){
                return $this->success("添加成功",'/admin/group.html');
            }else{
                return $this->error('添加失败');
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
        return redirect('/admin/group.html');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $groups = AuthGroup::get($id);
        $this->assign([
            'groups' => $groups,
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
        $data = $request->only(['title','status']);
        $validate = \Think\Loader::validate("Group");
        if ($validate->scene("edit")->check($data)){
            $data['status'] = isset($data['status'])?$data['status']:'0';
            $res = AuthGroup::where('id',$id)->update($data);
            if ($res){
                return $this->success("修改成功",'/admin/group.html');
            }else{
                return $this->error('修改失败');
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
        if ($id == 1){
            return $this->error('默认管理员组不能删除');
        }
        $res = AuthGroup::destroy($id);
        if ($res){
            return $this->success('删除成功');
        }else{
            return $this->error('删除失败');
        }
    }


    public function change(Request $request, $id){
        $data = $request->only(['name','value']);
        $map = [$data['name']=>$data['value']];
        $res = AuthGroup::where('id',$id)->update($map);
        if ($res !== false){
            return $this->success('修改成功','/admin/group.html');
        }else{
            return $this->error('修改失败');
        }
    }

    public function groupper(Request $request, $id){
        $groups = AuthGroup::get($id);
        $rules = db('auth_rule')->select();
        $rules = (!empty($rules))?children($rules):'';
        if ($request->isPost()){
            $data = $request->only(['id','column_ids']);
            $data['rules'] = (!empty($data['column_ids'])) ? implode(',',$data['column_ids']) : '';
            unset($data['column_ids']);
            $res = AuthGroup::update($data);
            if ($res !== false){
                return $this->success('修改成功','/admin/group.html');
            }else{
                return $this->error('修改失败');
            }
        }
        $this->assign([
            'rules' => $rules,
            'groups' => $groups,
        ]);
        return view();
    }
}
