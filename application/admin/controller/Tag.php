<?php

namespace app\admin\controller;

use app\common\model\Tags;
use think\Request;

class Tag extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $tagres = Tags::all();
        $this->assign([
            'tagres' => $tagres,
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
        $data = $request -> only(['tagname']);
        $validate = \Think\Loader::validate("Tag");
        if ($validate->scene("add")->check($data)){
            $res = Tags::create($data);
            if ($res){
                return $this->success("添加成功",'/admin/tag.html');
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
        return redirect("/admin/tag.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $tags = Tags::get($id);
        $this->assign([
            'tags' => $tags,
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
        $data = $request -> only(['id','tagname']);
        $validate = \Think\Loader::validate("Tag");
        if ($validate->scene("add")->check($data)){
            $res = Tags::update($data);
            if ($res !== false){
                return $this->success("修改成功",'/admin/tag.html');
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
        $res = Tags::destroy($id);
        if ($res){
            return $this->success("删除成功",'/admin/tag.html');
        }else{
            return $this->error("删除失败");
        }
    }
}
