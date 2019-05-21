<?php

namespace app\admin\controller;

use app\common\model\AccessoryJur;
use app\common\model\Articles;
use app\common\model\Channels;
use app\common\model\Columns;
use app\common\model\Flags;
use app\common\model\Tags;
use think\Request;
use think\Route;

class Article extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $map = [];
        $order = [
            'sort' => 'desc',
            'id' => 'desc',
        ];
        $articleres = Articles::where($map)->order($order)->paginate(20);
        $flagres = Flags::all();
        $tagres = Tags::all();
        $columnres = db("columns")->select();
        $columnres = (!empty($columnres)) ? subtree($columnres) : '';
        $this->assign([
            'articleres' => $articleres,
            'flagres' => $flagres,
            'tagres' => $tagres,
            'columnres' => $columnres,
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
        $flags = Flags::all();
        $tags = Tags::all();
        $accessoryjur = AccessoryJur::all();
        $columnres = db("columns")->select();
        $columnres = (!empty($columnres)) ? subtree($columnres) : '';
        $this->assign([
            'flags' => $flags,
            'tags' => $tags,
            'accessoryjur' => $accessoryjur,
            'columnres' => $columnres,
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
        $data = $request -> only(['title','sub_title','flag_ids','tag_ids','sort','source','author','column_id','keywords','description','content','commentable','click','titlecolor','accessory','accessory_jur_id','fee','videourl','redirecturl','images']);
        $validate = \Think\Loader::validate("Article");
        if ($validate->scene("add")->check($data)){
            $data['flag_ids'] = (!empty($data['flag_ids'])) ? implode(',',$data['flag_ids']) : '0';
            $data['tag_ids'] = (!empty($data['tag_ids'])) ? implode(',',$data['tag_ids']) : '0';
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
            $res = Articles::create($data);
            if ($res){
                return $this->success("添加成功","/admin/article.html");
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
        $flags = Flags::all();
        $tags = Tags::all();
        $accessoryjur = AccessoryJur::all();
        $columnres = db("columns")->select();
        $columnres = (!empty($columnres)) ? subtree($columnres) : '';
        $articles = Articles::get($id);
        $this->assign([
            'flags' => $flags,
            'tags' => $tags,
            'accessoryjur' => $accessoryjur,
            'columnres' => $columnres,
            'articles' => $articles,
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
        $data = $request -> only(['id' ,'title','sub_title','flag_ids','tag_ids','sort','source','author','column_id','keywords','description','content','commentable','click','titlecolor','accessory','accessory_jur_id','fee','videourl','redirecturl','images']);
        $validate = \Think\Loader::validate("Article");
        if ($validate->scene("add")->check($data)){
            $data['flag_ids'] = (!empty($data['flag_ids'])) ? implode(',',$data['flag_ids']) : '0';
            $data['tag_ids'] = (!empty($data['tag_ids'])) ? implode(',',$data['tag_ids']) : '0';
            if (!isset($data['commentable'])){
                $data['commentable'] = '0';
            }
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
            $res = Articles::update($data);
            if ($res !== false){
                return $this->success("修改成功","/admin/article.html");
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
        $res = Articles::destroy($id);
        if ($res !== false){
            return $this->success("删除成功","/admin/article.html");
        }else{
            return $this->error("删除失败");
        }

    }

    public function upload(Request $request){
        $imags = [];
        $errors = [];
        $files = $request -> file();

        foreach($files as $file){

            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){

                $img = ROOT_PATH . 'public' . DS . 'uploads' . DS . $info->getSaveName();
                @addwatermark($img);

                $path = '/uploads/'.str_replace('\\','/',$info->getSaveName());
                array_push($imags,$path);
            }else{
                array_push($errors,$file->getError());
            }
        }
        if(empty($errors)){
            $msg['errno'] = 0;
            $msg['data'] = $imags;
            return json_encode($msg);
        }else {
            $msg['errno'] = 1;
            $msg['data'] = $imags;
            $msg['msg'] = "上传出错";
            return json_encode($msg);
        }
    }
}
