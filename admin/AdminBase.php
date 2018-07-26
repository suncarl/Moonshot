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
            $global_view_var = [
                'site_title' => '插件管理平台',
                'site_desc' => '插件,管理,平台,微信,小程序',
                'site_style' => 'bluesky',
                'root'=> 'xxx',
            ];
            //从配置文件中读取
            $this->global_view_var = $global_view_var;
        }


    }

    public function render($status,$mess,$data,$type='json',$template='') {
        $data = array_merge($this->global_view_var,$data);
        if ($template && substr($template,0,-10)!='.twig.html') {
            $template.= '.twig.html';
        }
        return new ResponeHelper($status,$mess,$data,$type,$template);
    }
}