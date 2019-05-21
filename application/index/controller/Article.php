<?php

namespace app\index\controller;

use app\common\model\Articles;
use app\common\model\Columns;
use app\common\model\Comments;
use app\common\model\Zans;
use think\Request;

class Article extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($view)
    {
        $map = [];
        //获取查询菜单
        $finds = $this->getFindMenu($view);
        //获取栏目
        $column = $this->getSubColumn($view);
        //获取文章列表
        $map['column_id'] = ['in',$finds];
        $articleres = Articles::where($map)->withCount(['comments'=>'comment_count','zans'=>'zan_count'])->paginate(25);
        $this->assign([
            'articleres' => $articleres,
            'view' => $view,
            'column' => $column,
        ]);
        return view("list");
    }

    /**
     * 显示单个资源.
     *
     * @return \think\Response
     */
    public function article($view, $id)
    {
        $articles = Articles::withCount(["zans"=>"zan_count"])->find($id);
        $commentres = Comments::where('article_id','=',$id)->select();
        //获取栏目
        $column = $this->getSubColumn($view);
        $this->assign([
            'articles' => $articles,
            'commentres' => $commentres,
            'column' => $column,
            'view' => $view,
        ]);
        return view();
    }
    //获取查询菜单
    public function getFindMenu($view){
        $findview = [];
        $columns = Columns::get($view);
        if ($columns['pid'] == '0'){
            $findres = Columns::where('pid',$view)->select();
            foreach ($findres as $vo){
                array_push($findview, $vo['id']);
            }
            array_push($findview, $view);
        }else{
            array_push($findview, $view);
        }
        return $findview;
    }

    //获取栏目及子栏目
    public function getSubColumn($view){
        $column = [];
        $columns = Columns::get($view);
        if ($columns['pid'] == '0'){
            $column['chi'] = Columns::where('pid',$view)->select();
            $column['par'] = $columns;
        }else{
            $column['chi'] = Columns::where('pid',$columns['pid'])->select();
            $column['par'] = Columns::get($columns['pid']);
        }
        return $column;
    }

    //赞
    public function zan(Request $request){
        $data = $request -> only(['user_id','article_id']);
        if (!Zans::where($data)->count()){
            $res = Zans::create($data);
            if ($res){
                return $this->error("点赞成功");
            }else{
                return $this->error("点赞失败");
            }
        }else{
            return $this->error("已经点过攒了");
        }
    }

}
