<?php

namespace app\admin\controller;

use app\common\model\Sysconfigs;
use app\common\model\Watermarks;
use think\auth\Auth;
use think\Controller;
use think\Request;

class Common extends Controller
{
    public function _initialize()
    {
        if (!session("admininfo.id")){
            return $this->redirect("/admin/login.html");
        }
        static $sysinfo = [];
        static $watermark = [];
        define('C_NAME', Request::instance()->controller());
        define('M_NAME', Request::instance()->module());
        define('A_NAME', Request::instance()->action());

        $system = Sysconfigs::all();
        $watermark = Watermarks::get(1);
        foreach ($system as $vo){
            $sysinfo[$vo['cname']] = $vo['value'];
        }
        $servicesinfo = $this->sysMessage();

        $auth = new Auth();
        $name = "admin/" .C_NAME . "/" . A_NAME;
        if (!$auth ->check($name,1)){
//            return $this->error("没有权限");
        }
        $this->assign([
            'system' => $system,
            'watermark' => $watermark,
            'servicesinfo' => $servicesinfo,
        ]);

    }

    public function sysMessage(){
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
        );
        return $info;
    }
}
