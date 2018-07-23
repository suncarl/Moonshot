<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/15
 * Time: 上午1:31
 */

namespace plugins\demo;

use libs\asyncme\Plugins as Plugins;
use libs\asyncme\RequestHelper as RequestHelper;
use libs\asyncme\ResponeHelper as ResponeHelper;


class Demo extends Plugins
{


    public function IndexAction($req)
    {
        $status = true;
        $mess = '成功';
        $data = [
            'test'=>'what the hell',
            'req'=>$req,
        ];

        return new ResponeHelper($status,$mess,$data);
    }
}