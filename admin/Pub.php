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

class Pub extends AdminBase
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

    public function loginAction(RequestHelper $req,array $preData)
    {
        $status = true;
        $mess = '成功';


        $data = [

        ];

        return $this->render($status,$mess,$data,'template','login');
    }


}