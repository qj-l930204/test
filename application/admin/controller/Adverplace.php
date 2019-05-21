<?php

namespace app\admin\controller;

use app\common\model\AdverPlaces;
use app\common\model\Advers;
use think\Request;

class Adverplace extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $adverplaceres = AdverPlaces::all();
        $empty = "<b>暂无数据</b>";
        $this->assign([
            'adverplaceres' => $adverplaceres,
            'empty' => $empty,
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
        //
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
        $data = $request -> only(['place']);
        $validate = \Think\Loader::validate("Adverplace");
        if ($validate->scene("add")->check($data)){
            $res = AdverPlaces::create($data);
            if ($res){
                return $this->success('添加成功','/admin/adverplace.html');
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
        return redirect("/admin/adverplace.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $adverplaces = AdverPlaces::get($id);
        $this->assign([
            'adverplaces' => $adverplaces,
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
        $data = $request -> only(['id', 'place']);
        $validate = \Think\Loader::validate("Adverplace");
        if ($validate->scene("add")->check($data)){
            $res = AdverPlaces::update($data);
            if ($res !== false){
                return $this->success('修改成功','/admin/adverplace.html');
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
        $result = Advers::where('adver_place_id',$id)->select();
        if (!empty($res)){
            return $this->error("当前位置下有广告，请先删除广告");
        }
        $res = AdverPlaces::destroy($id);
        if ($res !== false){
            return $this->success('删除成功','/admin/adverplace.html');
        }else{
            return $this->error('删除失败');
        }

    }
}
