<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/10
 * Time: 上午1:19
 */
if(!defined('NG_ME')) die();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use libs\exceptions\InvaildException;

use libs\asyncme\RequestHelper;

$app->get('/plugin/{bid:[\w]+}/{pl_name:[\w]+}', function (Request $request, Response $response, array $args) {

    $asyRequest = new RequestHelper($request);

    $json_data = [];

    $plugin_name = strtolower($asyRequest->request_plugin);
    $plugin_class = ucfirst($asyRequest->request_plugin);

    try {
        if (!file_exists(NG_ROOT.'/plugins/'.$plugin_name.'/'.$plugin_class.'.class.php')) {
            throw new InvaildException($plugin_class.' not invaild');
        }
        include NG_ROOT.'/plugins/'.$plugin_name.'/'.$plugin_class.'.class.php';

        $pl_class = 'plugins\\'.$plugin_name.'\\'.$plugin_class;

        $pl = new $pl_class(NG_ROOT.'/plugins/'.$plugin_name.'/');
        $pl->run();

    } catch (InvaildException $e){
        $json_data = $asyRequest->build_json_data(false,$e->getMessage());
    }




    return $response->withJson($json_data);

});