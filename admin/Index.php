<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/24
 * Time: 下午7:09
 */

namespace admin;

use libs\asyncme\Plugins;
use admin\model;
use libs\asyncme\RequestHelper;

class Index extends PermissionBase
{
    public function IndexAction(RequestHelper $req,array $preData)
    {
        $status = true;
        $mess = '成功';
        $data = [
            'test'=>'hell admin!',
            'req'=>$req,
        ];

        return $this->render($status,$mess,$data);
    }

    public function tAction(RequestHelper $req,array $preData)
    {
        $status = true;
        $mess = '成功';

        $model = new model\Menu($this->service);
        $navs = $model->getNav();

        $data = [
            'title'=>'hello admin!',
            'bid'=>$req->compony_id,
            'pl_name'=>$req->request_plugin,
            'mod'=> $req->module,
            'act'=>$req->action,
            'navs' => $navs,
            'content'=>'this is the base template in admin plugins with model:'.$model->str(),
        ];

        return $this->render($status,$mess,$data,'template','Index/t');
    }

    public function codeAction(RequestHelper $req,array $preData)
    {
        $plugin_req = $req;
        $plugin_req->request_plugin = 'verification_code';
        $plugin_req->action = 'gen';

        $plugin_reponse = callPlugin($plugin_req,$this->service);
        return $plugin_reponse;
    }

    public function urlAction(RequestHelper $req,array $preData)
    {


        $path = [
            'mark' => 'plugin',
            'bid'  => $req->compony_id,
            'pl_name'=>'verification_code',
        ];
        $query = [
            'act'=>'gen'
        ];
        $url = urlGen($req,$path,$query,true);

        $status = true;
        $mess = '成功';
        $data = [
            'url' => $url,
        ];
        return $this->render($status,$mess,$data);
    }
}