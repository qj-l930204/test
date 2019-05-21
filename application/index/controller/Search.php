<?php

namespace app\index\controller;

use app\common\model\Articles;
use think\Request;

class Search extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($tagname)
    {
        $map = [
            'tag_ids' => ['like','%'.$tagname.'%'],
        ];
        $articleres = Articles::where($map)
            ->withCount(['zans'=>'zan_count','comments'=>'comment_count'])
            ->paginate(10,false,[
                'query' => redirect() -> params(),
            ]);
        $this->assign([
            'articleres' => $articleres,
            'tagname' => $tagname,
        ]);
        return view('search');
    }

}
