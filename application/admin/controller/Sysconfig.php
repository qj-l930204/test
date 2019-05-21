<?php

namespace app\admin\controller;

use app\common\model\SysconfigGroup;
use app\common\model\Sysconfigs;
use think\Request;

class Sysconfig extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($gid = null)
    {
        if ($gid == null){
            $gid = 1;
        }
        $syscfg_group = SysconfigGroup::all();
        $sysconfigres = Sysconfigs::where("sysconfig_group_id",$gid)->select();
        $this->assign([
            'syscfg_group' => $syscfg_group,
            'sysconfigres' => $sysconfigres,
            'gid' => $gid,
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
        $syscfgres = SysconfigGroup::all();
        $sysconfigres = Sysconfigs::all();
        $this->assign([
            'syscfgres' => $syscfgres,
            'sysconfigres' => $sysconfigres,
            'empty' => '<option value="">暂无数据</option>',
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
        $data = $request -> only(['title','cname','type','sysconfig_group_id','value']);
        $validate = \Think\Loader::validate("Sysconfig");
        if ($validate->scene("add")->check($data)){
            $res = Sysconfigs::create($data);
            if ($res){
                return $this->success("添加成功","/admin/sysconfig/create.html");
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
        $syscfgres = SysconfigGroup::all();
        $syscfgs = Sysconfigs::get($id);
        $this->assign([
            'syscfgres' => $syscfgres,
            'syscfgs' => $syscfgs,
            'empty' => '<option value="">暂无数据</option>',
        ]);
        return view();
    }

    public function updates(Request $request){
        $data = $request -> only(['id','title','cname','type','sysconfig_group_id']);
        $validate = \Think\Loader::validate("Sysconfig");
        if ($validate->scene("add")->check($data)){
            $res = Sysconfigs::update($data);
            if ($res){
                return $this->success("修改成功","/admin/sysconfig/create.html");
            }else{
                return $this->error("修改失败");
            }
        }else{
            return $this->error($validate->getError());
        }
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
        $gid = $id;
        $names = [];
        $dts = [];
        $syscfgs = Sysconfigs::where("sysconfig_group_id",$gid)->select();
        foreach ($syscfgs as $vo){
            array_push($names,$vo['id'] . "___" . $vo['cname']);
        }
        $datas = $request -> only($names);
        foreach ($datas as $k => $data){
            list($_id, $_cname) = explode('___', $k);
            $dts[] = [
                'id' => $_id,
                'cname' => $_cname,
                'value' => $data,
            ];
        }
        $syscfgm = new Sysconfigs();
        $res = $syscfgm->saveAll($dts);
        if ($res !== false){
            return $this->success('修改成功', '/admin/sysconfig.html');
        }else{
            return $this->error('修改失败');
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
        $res = Sysconfigs::destroy($id);
        if ($res){
            return $this->success('删除成功', '/admin/sysconfig/create.html');
        }else{
            return $this->error('删除失败');
        }
    }
}
