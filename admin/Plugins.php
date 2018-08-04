<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/8/4
 * Time: 下午2:32
 */

namespace admin;

use admin\model;
use libs\asyncme\RequestHelper;

class Plugins extends PermissionBase
{
    public function indexAction(RequestHelper $req,array $preData)
    {
        $status = true;
        $mess = '成功';

        $nav_data = $this->nav_default($req,$preData);


        //ng_func_privilege_check($req->company_id,$this->sessions['admin_uid'],'index');

        $path = [
            'mark' => 'sys',
            'bid'  => $req->company_id,
            'pl_name'=>'admin',
        ];
        $query = [
            'mod'=>'plugins',
            'act'=>'info'
        ];
        $default_frame_url = urlGen($req,$path,$query,true);


        $plugin_menus = [
            ['id'=>1,'parentid'=>0,'app'=>'admin' ,'model'=>'plugins','action'=>'info',
                'data'=>'','category'=>'应用','placehold'=>'','use_priv'=>1,'type'=>1,
                'link'=>1,'status'=>1,'name'=>'信息','icon'=>'th'
            ],
            ['id'=>2,'parentid'=>0,'app'=>'admin' ,'model'=>'plugins','action'=>'center',
                'data'=>'','category'=>'应用','placehold'=>'','use_priv'=>1,'type'=>1,
                'link'=>1,'status'=>1,'name'=>'应用中心','icon'=>'th'
            ]


        ];

        $data = [
            'default_frame_name'=>'仪表盘',
            'content'=>'',
            'default_frame_url'=>$default_frame_url,
            'plugin_menus'=>$plugin_menus,
        ];
        $data = array_merge($nav_data,$data);

        return $this->render($status,$mess,$data,'template','plugin/index');
    }

    public function infoAction(RequestHelper $req,array $preData)
    {
        echo 1;
        die();
    }
}