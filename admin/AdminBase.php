<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/26
 * Time: 下午6:03
 */

namespace admin;

use libs\asyncme\Plugins as Plugins;
use libs\asyncme\RequestHelper as RequestHelper;
use libs\asyncme\ResponeHelper as ResponeHelper;
use \Slim\Http\UploadedFile;

include_once NG_ROOT.'/admin/utils/common_func.php';

class AdminBase extends Plugins
{

    public  $global_view_var = [];

    //初始化代码 ，自己调用  看在第几层的情况下调用
    // 0 母程序初始化
    // 1 初始化数据库后
    // 2 初始化模版对象后
    public function initialize($level=0)
    {
        if($level==2){
            $cache_key = 'global_view_val';
            $this->global_view_var = $this->service->getCache()->get($cache_key);

            if (!$this->global_view_var) {
                $model = new model\Menu($this->service);
                $config_vals = $model->getConfig('sys_global');
                $this->global_view_var = $config_vals;
                $this->service->getCache()->set($cache_key,$config_vals,3600);
            }
            if(method_exists($this,'auth')) {
                $auth_reponse = $this->auth();
                if ($auth_reponse['status'] == false) {
                    //欠缺时间部分
                    $this->redirect($auth_reponse['url']);
                }

            }
        }
    }

    public function redirect($url)
    {
        header('Location:'.$url);
    }

    public function render($status,$mess,$data,$type='json',$template='') {
        $data = array_merge($this->global_view_var,$data);
        if ($template && substr($template,0,-10)!='.twig.html') {
            $template.= '.twig.html';
        }
        return new ResponeHelper($status,$mess,$data,$type,$template);
    }
}