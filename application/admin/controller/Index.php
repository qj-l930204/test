<?php

namespace app\admin\controller;

use think\Request;

class Index extends Common
{
    public function index()
    {
        /*
         * {"code":0,"data":{"ip":"221.14.173.18","country":"中国","area":"","region":"河南","city":"郑州","county":"XX","isp":"联通","country_id":"CN","area_id":"","region_id":"410000","city_id":"410100","county_id":"xx","isp_id":"100026"}}
         * */
        //根据IP获取地址
        $ip = '221.14.173.18';
//        $ip = session("admininfo.last_login_ip");
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
        $info = _requeat($url);
        if ($info === false){
            $info = '{"code":0,"data":{"ip":"'.$ip.'","country":"XX","area":"XX","region":"XX","city":"XX","county":"XX","isp":"XX","country_id":"xx","area_id":"XX","region_id":"xx","city_id":"local","county_id":"local","isp_id":"local"}}';
        }
        $ipinfo = json_decode($info,true);
        $this->assign([
            'ipinfo' => $ipinfo,
        ]);
        return view();
    }

    public function logout(){
        session(null);
        if (!session("admininfo")){
            return $this->success("退出成功！");
        }
    }
}
