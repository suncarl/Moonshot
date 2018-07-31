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
use Delight\Cookie\Cookie;

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
        $bid = $req->compony_id;
        $path = [
            'mark' => 'sys',
            'bid'  => $bid,
            'pl_name'=>'pub',
        ];
        $query = [
            'act'=>'doLogin'
        ];

        $form_url = urlGen($req,$path,$query);

        $path = [
            'mark' => 'plugin',
            'bid'  => $req->compony_id,
            'pl_name'=>'verification_code',
        ];
        $query = [
            'act'=>'gen',
            'w'=>'248',
            'h'=>50,
        ];
        $vcode_url = urlGen($req,$path,$query,true);

        $status = true;
        $mess = '成功';
        $cookie_val = Cookie::exists('admin_user');

        $data = [
            'default_user'=>$cookie_val,
            'form_url' =>$form_url,
            'vcode_url'=>$vcode_url
        ];

        return $this->render($status,$mess,$data,'template','login');
    }

    public function doLoginAction(RequestHelper $req,array $preData)
    {
        var_dump($req->request_method());
    }


}