<?php
/**
 * Created by PhpStorm.
 * User: Lijie Love Qingjie
 * Date: 2019/1/24
 * Time: 0:52
 */

namespace app\index\controller;


use app\common\model\Columns;
use app\common\model\Sysconfigs;
use app\common\model\Tags;
use think\Controller;
use think\Request;

class Common extends Controller
{
    public function _initialize()
    {
        define('C_NAME',Request::instance()->controller());
        define('A_NAME',Request::instance()->action());

        //获取标签
        $tagres = Tags::all();
        //获取系统信息
        $sysinfo = $this -> getSysInfo();
        //获取系统菜单
        $menuinfo = $this -> getSysMenu();


        $this->assign([
            'tagres' => $tagres,
            'sysinfo' => $sysinfo,
            'menuinfo' => $menuinfo,
        ]);
    }

    //获取系统信息
    public function getSysInfo(){
        $sysinfo = [];
        $system = Sysconfigs::all();
        foreach ($system as $vo){
            $sysinfo[$vo['cname']] = $vo['value'];
        }
        return $sysinfo;
    }

    //获取系统菜单
    public function getSysMenu(){
        $map = [
            'isnav' => 1,
        ];
        $columnres = db("columns")->where($map) -> select();
        return children($columnres);
    }

}