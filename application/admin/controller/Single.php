<?php

namespace app\admin\controller;

use app\common\model\Singles;
use think\Request;

class Single extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     * `title`, 标题
     * `litpic`,  缩略图
     * `column_id`,  栏目ID
     * `keywords`,  关键词
     * `description`,  摘要
     * `content`,  内容
     * `videourl` 视频地址
     */
    public function index()
    {
        $singleres = Singles::all();
        $this->assign([
            'singleres' => $singleres,
            'empty' => "<b>暂无数据</b>",
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
        $columnres = db("columns")->select();
        $columnres = (!empty($columnres)) ? subtree($columnres) : '';
        $this->assign([
            'columnres' => $columnres,
        ]);
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     * 'title' => string '' (length=0)
        'column_id' => string '' (length=0)
        'keywords' => string '' (length=0)
        'description' => string '' (length=0)
        'content' => string '' (length=0)
        'videourl' => string '' (length=0)
     */
    public function save(Request $request)
    {
        $data = $request -> only(['title','column_id','keywords','description','content','videourl']);
        $validate = \Think\Loader::validate("Single");
        if ($validate -> scene("add") -> check($data)){
            $file = $request-> file("litpic");
            if ($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // 成功上传后 获取上传信息
                    $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                    @addwatermark($path);
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $data['litpic'] = $info->getSaveName();

                }else{
                    // 上传失败获取错误信息
                    return $this->error($file->getError());
                }
            }
            $res = Singles::create($data);
            if ($res){
                return $this->success("添加成功","/admin/single.html");
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
        return redirect("/admin/single.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $singles = Singles::get($id);
        $columnres = db("columns")->select();
        $columnres = (!empty($columnres)) ? subtree($columnres) : '';
        $this->assign([
            'columnres' => $columnres,
            'singles' => $singles,
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
        $data = $request -> only(['id','title','column_id','keywords','description','content','videourl']);
        $validate = \Think\Loader::validate("Single");
        if ($validate -> scene("add") -> check($data)){
            $file = $request-> file("litpic");
            if ($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // 成功上传后 获取上传信息
                    $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                    @addwatermark($path);
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $data['litpic'] = $info->getSaveName();

                }else{
                    // 上传失败获取错误信息
                    return $this->error($file->getError());
                }
            }
            $res = Singles::update($data);
            if ($res !== false){
                return $this->success("修改成功","/admin/single.html");
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
        $res = Singles::destroy($id);
        if ($res !== false){
            return $this->success("删除成功","/admin/single.html");
        }else{
            return $this->error("删除失败");
        }
    }
}
