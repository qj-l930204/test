<?php

namespace app\admin\controller;

use think\Request;
use app\common\model\Channels;

class Channel extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $channelres = Channels::all();
        $this->assign([
            'channelres' => $channelres,
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
        $data = $request->only(['title','ctitle','isdisplay']);
//        return dump($data);
        $validate = \Think\Loader::validate("Channel");
        if ($validate -> scene("add") -> check($data)){
//            $ch = new Channels($data);
//            $res = $ch ->allowField(['title','ctitle','isdisplay'])->save();
            $res = Channels::create($data);
            if ($res){
                return $this->success('添加成功','/admin/channel.html');
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
        return redirect("/admin/channel.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $channel = Channels::get($id);
        $this->assign([
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
        $data = $request->only(['title','ctitle','isdisplay']);
        $validate = \Think\Loader::validate("Channel");
        if ($validate -> scene("edit") -> check($data)){
            if (!isset($data['isdisplay'])){
                $data['isdisplay'] = '0';
            }
            $res = Channels::where('id',$id)->update($data);
            if ($res !== false){
                return $this->success('修改成功','/admin/channel.html');
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
        $res = Channels::destroy($id);
        if ($res){
            return $this->success('删除成功','/admin/channel.html');
        }else{
            return $this->error('删除失败');
        }
    }

    public function change(Request $request, $id){
        $data = $request->only(['name','value']);
        $map = [$data['name']=>$data['value']];
        $res = Channels::where('id',$id)->update($map);
        if ($res !== false){
            return $this->success('修改成功','/admin/channel.html');
        }else{
            return $this->error('修改失败');
        }
    }
}
