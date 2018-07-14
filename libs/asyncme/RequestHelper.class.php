<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/11
 * Time: 上午11:34
 */

namespace libs\asyncme;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use libs\exceptions\InvaildException;

class RequestHelper
{
    //企业id（大B）
    public $compony_id;
    //用户id
    public $client_openid;
    //路由对象
    public $router;
    //post数据
    public $post_datas;
    //get数据
    public $query_datas;
    //请求标志
    public $request_tag;
    //插件名称
    public $request_plugin;
    //模型
    public $module = null;
    //动作
    public $action = null;


    public function __construct(Request $request)
    {
        $tag = $request->getQueryParam('tag');
        $tag = $tag ? $tag : 0;
        $this->request_tag = $tag;

        $router = $request->getAttribute('route');
        $this->router = $router;

        $bid = $router->getArgument('bid');
        $this->compony_id = $bid;

        $pl_name = $router->getArgument('pl_name');
        $this->request_plugin = $pl_name;

        $post_datas = $request->getParsedBody();
        $this->post_datas = $post_datas;

        $query_datas = $request->getQueryParams();
        $this->query_datas = $query_datas;

        if ($request->isGet()) {
            $openid = $query_datas['openid'];
            $this->client_openid = $openid;
        } else {
            $openid = $post_datas['openid'];
            $this->client_openid = $openid;
        }

        if (isset($query_datas['mod'])) {
            $this->module = $query_datas['mod'];
        }
        if (isset($query_datas['act'])) {
            $this->action = $query_datas['act'];
        }

        return $this;
    }

    public function build_json_data($status,$desc,$data=[])
    {
        $json_data = ['status'=>$status,'desc'=>$desc,'data'=>$data,'tag'=>$this->request_tag,'t'=>time()];
        return $json_data;
    }

    public function info()
    {
        $params =  get_class_vars(get_class($this));
        foreach ($params as $key => $val) {
            echo "<p>".$key." : ".$val."</p>";
        }
    }


}