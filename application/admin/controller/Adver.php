<?php

namespace app\admin\controller;

use app\common\model\AdverPlaces;
use app\common\model\Advers;
use think\Request;

class Adver extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $adverres = Advers::order(['adver_place_id'=>'asc','sort'=>'desc'])->select();
        $empty = "<b>暂无数据</b>";
        $this->assign([
            'adverres' => $adverres,
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
        $adverplaceres = AdverPlaces::all();
        $this->assign([
            'adverplaceres' => $adverplaceres,
        ]);
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     *
     *
     */
    public function save(Request $request)
    {
        $data = $request -> only(['title','adver_place_id','picwidth','picheight','isdisplay','link','sort']);
        $validate = \Think\Loader::validate("Adver");
        if ($validate->scene("add")->check($data)){
            $file = $request -> file("litpic");
            if ($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                    @addwatermark($path);
                    $data['litpic'] = $info->getSaveName();
                }else{
                    return $this->error($file->getError());
                }
            }
            $res = Advers::create($data);
            if ($res){
                return $this->success("添加成功","/admin/adver.html");
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
        return redirect("/admin/adver.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $advers = Advers::get($id);
        $adverplaceres = AdverPlaces::all();
        $this->assign([
            'advers'  => $advers,
            'adverplaceres'  => $adverplaceres,
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
        $data = $request -> only(['id', 'title','adver_place_id','picwidth','picheight','isdisplay','link','sort']);
        $validate = \Think\Loader::validate("Adver");
        if ($validate->scene("add")->check($data)){
            if (!isset($data['isdisplay'])){
                $data['isdisplay'] = '0';
            }
            $file = $request -> file("litpic");
            if ($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                    @addwatermark($path);
                    $data['litpic'] = $info->getSaveName();
                }else{
                    return $this->error($file->getError());
                }
            }
            $res = Advers::update($data);
            if ($res){
                return $this->success("修改成功","/admin/adver.html");
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
        $res = Advers::destroy($id);
        if ($res){
            return $this->success("删除成功","/admin/adver.html");
        }else{
            return $this->error("删除失败");
        }
    }

    public function change(Request $request, $id){
        $data = $request->only(['name','value']);
        $map = [$data['name']=>$data['value']];
        $res = Advers::where('id',$id)->update($map);
        if ($res !== false){
            return $this->success('修改成功','/admin/adver.html');
        }else{
            return $this->error('修改失败');
        }
    }
}
