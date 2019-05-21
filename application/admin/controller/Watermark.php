<?php

namespace app\admin\controller;

use app\common\model\WatermarkPlace;
use app\common\model\Watermarks;
use app\common\model\WatermarkType;
use think\Request;

class Watermark extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $wmtyperes = WatermarkType::all();
        $wmplaceres = WatermarkPlace::all();
        $watermarkres = Watermarks::get(1);

        $this->assign([
            'wmtyperes' => $wmtyperes,
            'wmplaceres' => $wmplaceres,
            'watermarkres' => $watermarkres,
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
        $data = $request -> only(['id','isopen','watermark_type_id','wmheight','wmwidth','wmtext','wmfontsize','wmcolor','wmangle','wmalpha','watermark_place_id']);
        $validate = \Think\Loader::validate("Watermark");
        if ($validate->scene("add")->check($data)){
            if (!isset($data['isopen'])){
                $data['isopen'] = "0";
            }
            $file = $request -> file("wmpic");
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'watermark');
                if($info){
                    $data['wmpic'] = $info->getSaveName();
                }else{
                    return $this->error($file->getError());
                }
            }
            $res = Watermarks::update($data);
            if ($res !== false){
                return $this->success("修改成功");
            }else{
                return $this->error("修改失败");
            }
        }else{
            return $this->error($validate->getError());
        }

    }

    public function change(Request $request, $id){
        $data = $request->only(['name','value']);
        $map = [$data['name']=>$data['value']];
        $res = Watermarks::where('id',$id)->update($map);
        if ($res !== false){
            return $this->success('修改成功');
        }else{
            return $this->error('修改失败');
        }
    }
}
