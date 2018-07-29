<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/28
 * Time: 上午1:20
 */

namespace admin;

use libs\asyncme\Plugins as Plugins;
use libs\asyncme\RequestHelper as RequestHelper;
use libs\asyncme\ResponeHelper as ResponeHelper;
use \Slim\Http\UploadedFile;

class PermissionBase extends AdminBase
{
    public function auth()
    {
        $request = $this->service->getRequestHelper();
        $router = $request->router;
        $bid = $request->compony_id;
        $pl_name = $request->request_plugin;
        $url = "http://work.crab.com/wxapp/debug.php/sys/123/admin?mod=public&act=login";
        //$url = $router->pathFor('sys',['bid'=>$bid,'pl_name'=>$pl_name],["mod"=>'public','act'=>'login']);

        $time = 0;
        $status = true;
        return [
            'status'=>$status,
            'url'=>$url,
            'time'=>$time,
        ];



    }
}