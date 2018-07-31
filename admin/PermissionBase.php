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
        $req = $this->service->getRequestHelper();
        $bid = $req->compony_id;

        $path = [
            'mark' => 'sys',
            'bid'  => $bid,
            'pl_name'=>'pub',
        ];
        $query = [
            'act'=>'login'
        ];

        $url = urlGen($req,$path,$query);
        $time = 0;
        $mess = '';

        $status = true;
        return [
            'status'=>$status,
            'mess'=>$mess,
            'url'=>$url,
            'time'=>$time,
        ];

    }
}