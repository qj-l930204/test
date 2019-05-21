<?php

namespace app\admin\controller;

use app\common\model\LinkGroup;
use think\Controller;
use think\Request;

class Linkg extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $linkgs = LinkGroup::all();
        $this->assign([
            'linkgs' => $linkgs,
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
        $data = $request -> only("title");
        $validate = \Think\Loader::validate("Linkg");
        if ($validate->scene("add")->check($data)){
            $res = LinkGroup::create($data);
            if ($res){
                return $this->success("添加成功","/admin/linkg.html");
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
        $linkgs = LinkGroup::get($id);
        $this->assign([
            'linkgs' => $linkgs,
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
        $data = $request -> only(['id', 'title']);
        $validate = \Think\Loader::validate("Linkg");
        if ($validate->scene("add")->check($data)){
            $res = LinkGroup::update($data);
            if ($res !== false){
                return $this->success("修改成功","/admin/linkg.html");
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
        $res = LinkGroup::destroy($id);
        if ($res !== false){
            return $this->success("删除成功","/admin/linkg.html");
        }else{
            return $this->error("删除失败");
        }
    }
}
