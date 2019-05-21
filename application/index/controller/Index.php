<?php
namespace app\index\controller;


use app\common\model\Advers;
use app\common\model\Articles;

class Index extends Common
{
    public function index()
    {
        //获取banner
        $banners = $this -> getBanner();
        //获取文章列表
        $articleres = Articles::withCount(['comments'=>'comment_count','zans'=>'zan_count'])->select();

        $this -> assign([
            'banners' => $banners,
            'articleres' => $articleres,
        ]);
        return view();
    }

    //获取banner
    public function getBanner(){
        $map = [
            'adver_place_id' => 1,
        ];
        $bannerres = Advers::where($map)->select();
        return $bannerres;
    }

}
