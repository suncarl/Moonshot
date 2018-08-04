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
        $plugin_menus = $this->recursion_menus($req,$plugin_menus);

        $data = [
            'default_frame_name'=>'仪表盘',
            'content'=>'',
            'default_frame_url'=>$default_frame_url,
            'plugin_menus'=>$plugin_menus,
        ];
        $data = array_merge($nav_data,$data);

        return $this->render($status,$mess,$data,'template','plugin/index');
    }

    /**
     * 应用中心
     * @param RequestHelper $req
     * @param array $preData
     */
    public function centerAction(RequestHelper $req,array $preData)
    {
        $plugin_lists = $this->load_datas($req,$preData);
        $status = true;
        $mess = '成功';
        $data = [
            'plugin_lists'=>$plugin_lists,
        ];

        return $this->render($status,$mess,$data,'template','plugin/center');
    }

    public function infoAction(RequestHelper $req,array $preData)
    {
        die();
    }

    /**
     * @param RequestHelper $req
     * @param array $preData
     */
    protected function load_datas(RequestHelper $req,array $preData)
    {
        $plugin_dir = '../plugins';
        $plugins_lists = [];
        if (is_dir($plugin_dir)) {
            $fp = opendir($plugin_dir);
            while($file = readdir($fp)) {
                //去掉隐藏
                if(substr($file,0,1)=='.') continue;

                if ($plugin_dir.'/'.$file.'/info.xml') {
                    $mtime = filemtime($plugin_dir.'/'.$file);
                    $ctime = filectime($plugin_dir.'/'.$file);
                    $plugins_lists[] = ['file'=>$file,'root'=>$plugin_dir,'ctime'=>$ctime,'mtime'=>$mtime];
                }

            }
        }
        $result = [];
        if ($plugins_lists) {
            foreach ($plugins_lists as $key=>$val) {
                $xml = simplexml_load_file($val['root'].'/'.$val['file'].'/info.xml');
                $json_xml=json_encode($xml);
                $dejson_xml=json_decode($json_xml,true);
                $result[] = array_merge($dejson_xml,$val);
            }
        }
        return $result;
    }
}