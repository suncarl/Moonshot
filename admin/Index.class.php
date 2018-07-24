<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/24
 * Time: 下午7:09
 */

namespace admin;

use libs\asyncme\Plugins as Plugins;
use libs\asyncme\RequestHelper as RequestHelper;
use libs\asyncme\ResponeHelper as ResponeHelper;
use \Slim\Http\UploadedFile;

class Index extends Plugins
{
    public function IndexAction($req,$preData)
    {
        $status = true;
        $mess = '成功';
        $data = [
            'test'=>'hell admin!',
            'req'=>$req,
        ];

        return new ResponeHelper($status,$mess,$data);
    }

    public function tAction($req,$preData)
    {
        $status = true;
        $mess = '成功';
        $data = [
            'title'=>'hello admin!',
            'req'=>$req,
            'content'=>'this is the base template in admin plugins',
        ];

        return new ResponeHelper($status,$mess,$data,'template','Index/t.twig.html');
    }
}