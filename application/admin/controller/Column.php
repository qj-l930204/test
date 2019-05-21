<?php

namespace app\admin\controller;

use app\common\model\Channels;
use app\common\model\Columns;
use think\Request;

class Column extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $columnres = Columns::all();
        $this->assign([
            'columnres' => subtree($columnres),
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
        $channel = Channels::all();
        $column = Columns::all();
        $this->assign([
            'channel' => $channel,
            'column' => subtree($column),
        ]);
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     *   'title' => string '' (length=0)
        'ctitle' => string '' (length=0)
        'pid' => string '0' (length=1)
        'channel_id' => string '' (length=0)
        'sort' => string '50' (length=2)
        'isnav' => string '1' (length=1)
        'status' => string '1' (length=1)
     */
    public function save(Request $request)
    {
        $data = $request -> only(['title','ctitle','pid','channel_id','sort','isnav','status']);
        $validate = \Think\Loader::validate("Column");
        if ($validate->scene("add")->check($data)){
            $res = Columns::create($data);
            if ($res){
                return $this->success('添加成功','/admin/column.html');
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
        return redirect("/admin/column.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $channel = Channels::all();
        $column = Columns::all();
        $columns = Columns::get($id);
        $this->assign([
            'channel' => $channel,
            'columns' => $columns,
            'column' => subtree($column),
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
        $data = $request -> only(['title','ctitle','pid','channel_id','sort','isnav','status']);
        $validate = \Think\Loader::validate("Column");
        if ($validate->scene("edit")->check($data)){
            $data['isnav'] = isset($data['isnav'])?$data['isnav']:'0';
            $data['status'] = isset($data['status'])?$data['status']:'0';

            $res = Columns::where('id',$id)->update($data);
            if ($res !== false){
                return $this->success('修改成功','/admin/column.html');
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
        $res = Columns::destroy($id);
        if ($res){
            return $this->success('删除成功','/admin/column.html');
        }else{
            return $this->error('删除失败');
        }
    }

    public function change(Request $request, $id){
        $data = $request->only(['name','value']);
        $map = [$data['name']=>$data['value']];
        $res = Columns::where('id',$id)->update($map);
        if ($res !== false){
            return $this->success('修改成功','/admin/column.html');
        }else{
            return $this->error('修改失败');
        }
    }
}
