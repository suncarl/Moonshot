<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/29
 * Time: 下午5:48
 */

namespace plugins\verification_code;

use libs\asyncme\Plugins as Plugins;
use libs\asyncme\RequestHelper as RequestHelper;
use libs\asyncme\ResponeHelper as ResponeHelper;

use Gregwar\Captcha\CaptchaBuilder;

class VerificationCode extends Plugins
{
    public function genAction(RequestHelper $req,array $preData)
    {
        $builder = new CaptchaBuilder;
        $builder->build();

        $status = true;
        $mess = '成功';
        $data = $builder;
        $type = 'captcha';

        $auth_name = $req->query_datas['auth'] ? $req->query_datas['auth'] : 'vcode';
        $_SESSION[$auth_name] = $builder->getPhrase();

        return new ResponeHelper($status,$mess,$data,$type);
    }
}