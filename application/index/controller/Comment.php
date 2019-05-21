<?php

namespace app\index\controller;

use app\common\model\Comments;
use think\Controller;
use think\Request;

class Comment extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     * article_id: "1"
        code: ""
        content: "<img src="http://wap.jjcms.com/static/home/images/smail/emoji/emoji-_6.svg" height="50" width="50" alt="">"
        user_id: "2"
     */
    public function save(Request $request)
    {
        $data = $request -> only(['user_id','article_id','pid','content','code']);
        $validate = \Think\Loader::validate("Comment");
        if ($validate->scene("save")->check($data)){
            unset($data['code']);
            $res = Comments::create($data);
            if ($res){
                return $this->success("评论成功");
            }else{
                return $this->error("评论失败");
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
        //
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
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
