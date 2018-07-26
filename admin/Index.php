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

class Index extends AdminBase
{
    public function IndexAction($req,$preData)
    {
        $status = true;
        $mess = '成功';
        $data = [
            'test'=>'hell admin!',
            'req'=>$req,
        ];

        return $this->render($status,$mess,$data);
    }

    public function tAction($req,$preData)
    {
        $status = true;
        $mess = '成功';
        $model = new model\Admin();

        $data = [
            'title'=>'hello admin!',
            'req'=>$req,
            'content'=>'this is the base template in admin plugins with model:'.$model->test(),
        ];


        return $this->render($status,$mess,$data,'template','Index/t');
    }
}