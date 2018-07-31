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
//        $bid = $req->compony_id;
//        $path = [
//            'mark' => 'sys',
//            'bid'  => $bid,
//            'pl_name'=>'admin',
//        ];
//        $query = [
//            'mod'=>'pub',
//            'act'=>'doLogin'
//        ];
//
//        $form_url = urlGen($req,$path,$query);

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

        $error_code = 0;
        $error = '';
        if ($req->request_method=='POST') {

            $post_datas = $req->post_datas;
            $session_code = $this->service->getSession()->get($req->compony_id.'_vcode');

            if ($post_datas['verify']!=$session_code) {
                $error_code = 1005;
                $error = '验证码错误';
            } else if (!$post_datas['username']) {
                $error_code = 1001;
                $error = '用户名不为空';
            } else if (strlen($post_datas['username'])>16) {
                $error_code = 1002;
                $error = '用户名格式错误';
            } else if (!$post_datas['password']) {
                $error_code = 1003;
                $error = '密码不为空';
            }
            

        }

        $status = true;
        $mess = '成功';
        $cookie_val = Cookie::exists('admin_user');

        $data = [
            'default_user'=>$cookie_val,
            'form_url' =>'#',
            'vcode_url'=>$vcode_url,
            'error_code'=>$error_code,
            'error'=>$error,
        ];

        return $this->render($status,$mess,$data,'template','login');
    }

    public function doLoginAction(RequestHelper $req,array $preData)
    {
        if ($req->request_method=='POST') {

        }
    }


}