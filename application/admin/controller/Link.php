<?php

namespace app\admin\controller;

use app\common\model\LinkGroup;
use app\common\model\Links;
use think\Request;

class Link extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $linkres = Links::all();
        $this->assign([
            'linkres' => $linkres,
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
        $linkgres = LinkGroup::all();
        $this->assign([
            'linkgres' => $linkgres,
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
        $data = $request -> only(['title', 'link', 'sort', 'link_group_id', 'isdisplay']);
        $validate = \Think\Loader::validate("Link");
        if ($validate->scene("add")->check($data)){
            $file = $request -> file("litpic");
            if ($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $data['litpic'] = $info->getSaveName();
                }else{
                    return $this->error($file->getError());
                }
            }
            $res = Links::create($data);
            if ($res){
                return $this->success("添加成功","/admin/link.html");
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
        $linkgres = LinkGroup::all();
        $links = Links::get($id);
        $this->assign([
            'linkgres' => $linkgres,
            'links' => $links,
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
        $data = $request -> only(['id', 'title', 'link', 'sort', 'link_group_id', 'isdisplay']);
        $validate = \Think\Loader::validate("Link");
        if ($validate->scene("add")->check($data)){
            if (!isset($data['isdisplay'])){
                $data['isdisplay'] = '0';
            }
            $file = $request -> file("litpic");
            if ($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $data['litpic'] = $info->getSaveName();
                }else{
                    return $this->error($file->getError());
                }
            }
            $res = Links::update($data);
            if ($res){
                return $this->success("修改成功","/admin/link.html");
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
        $res = Links::destroy($id);
        if ($res){
            return $this->success("删除成功","/admin/link.html");
        }else{
            return $this->error("删除失败");
        }
    }

    public function change(Request $request, $id){
        $data = $request->only(['name','value']);
        $map = [$data['name']=>$data['value']];
        $res = Links::where('id',$id)->update($map);
        if ($res !== false){
            return $this->success('修改成功','/admin/link.html');
        }else{
            return $this->error('修改失败');
        }
    }
}
