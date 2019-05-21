<?php

namespace app\admin\controller;

use app\common\model\Admins;
use app\common\model\AuthGroup;
use app\common\model\AuthGroupAccess;
use app\common\model\Columns;
use think\helper\Hash;
use think\Image;
use think\Request;

class Admin extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $adminres = Admins::all();
        $this->assign([
            'adminres' => $adminres,
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
        $groupres = AuthGroup::all();
        $columnres = db('columns')->select();
        $this->assign([
            'groupres' => $groupres,
            'columnres' => (!empty($columnres))?children($columnres):'',
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
        $data = $request->only(['username','password','nickname','headimg','phone','email','group_id','status','column_ids']);
        $validate = \Think\Loader::validate("Admin");
        if ($validate->scene("add")->check($data)){
            $data['password'] = Hash::make((isset($data['password']) && !empty($data['password'])) ? $data['password'] : '123456');
            if (!empty($data['column_ids'])){
                $data['column_ids'] = implode(',',$data['column_ids']);
            }
            $data['jur'] = $data['column_ids'];
            unset($data['column_ids']);
            $res = Admins::create($data)->getLastInsID();
            if ($res){
                AuthGroupAccess::create(['uid'=>$res, 'group_id'=>$data['group_id']]);
                return $this->success('添加成功','/admin/admin.html');
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
        return redirect("/admin/admins.html");
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $groupres = AuthGroup::all();
        $columnres = db('columns')->select();
        $admins = Admins::get($id);
        $this->assign([
            'groupres' => $groupres,
            'columnres' => children($columnres),
            'admins' => $admins,
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
        $data = $request->only(['username','password','nickname','headimg','phone','email','group_id','status','column_ids']);
        $data['id'] = $id;
        $validate = \Think\Loader::validate("Admin");
        if ($validate->scene("edit")->check($data)){
            if (empty($data['headimg'])){
                unset($data['headimg']);
            }
            if (empty($data['password'])){
                unset($data['password']);
            }else{
                $data['password'] = Hash::make($data['password']);
            }
            if (!empty($data['column_ids'])){
                $data['column_ids'] = implode(',',$data['column_ids']);
            }
            $data['jur'] = $data['column_ids'];
            unset($data['column_ids']);

            $res = Admins::update($data);
            if ($res){
                AuthGroupAccess::where('uid',$id)->update(['group_id'=>$data['group_id']]);
                return $this->success('修改成功','/admin/admin.html');
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
        if ($id == 1){
            return $this->error("默认管理员不能删除");
        }
        $res = Admins::destroy($id);
        if ($res){
            AuthGroupAccess::where(['uid'=>$id])->delete();
            return $this->success("删除成功");
        }else{
            return $this->error("删除失败");
        }
    }

    public function change(Request $request, $id){
        $data = $request->only(['name','value']);
        $map = [$data['name']=>$data['value']];
        $res = Admins::where('id',$id)->update($map);
        if ($res !== false){
            return $this->success('修改成功','/admin/admin.html');
        }else{
            return $this->error('修改失败');
        }
    }

    public function upheadimg(Request $request){
        if ($request->isPost()) {
            $databox = input('avatar_data');
            $databox = json_decode($databox,true);
            $file = $request->file('avatar_file');
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $path = $info->getSaveName();
                    $fp = ROOT_PATH . "public/uploads/" . $path;
                    $image = Image::open($fp);

                    $image->rotate($databox['rotate']);
                    $image->crop($databox['width'], $databox['height'], $databox['x'], $databox['y'], '800', '800');
                    $image->save($fp);
                    $res = [
                        'result' => "/uploads/" . str_replace('\\','/',$path),
                    ];
                    die(json_encode($res));
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            } else {
                echo "请选择图片";
            }
        }
    }
}
