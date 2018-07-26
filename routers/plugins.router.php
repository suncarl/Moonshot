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
use \Slim\Http\UploadedFile;
use libs\exceptions\InvaildException;

use libs\asyncme\RequestHelper;
use libs\asyncme\Service;
use libs\asyncme\ResponeHelper;

$app->any('/plugin/{bid:[\w]+}/{pl_name:[\w]+}', function (Request $request, Response $response, array $args) {

    $asyRequest = new RequestHelper($request);


    $plugin_name = strtolower($asyRequest->request_plugin);
    $plugin_class = ucfirst($asyRequest->request_plugin);

    $response_output = 'json';
    $response_data = '';
    try {

        if (!file_exists(NG_ROOT.'/plugins/'.$plugin_name.'/'.$plugin_class.'.php')) {
            throw new InvaildException($plugin_class.' not invaild');
        }

        $pl_service = new Service($asyRequest->compony_id,$asyRequest->service_id);
        $pl_service->setCache($this->redis);
        $pl_service->setDb($this->db);



        $pl_class = 'plugins\\'.$plugin_name.'\\'.$plugin_class;

        $pl = new $pl_class(NG_ROOT.'/plugins/'.$plugin_name.'/');
        $pl->setService($pl_service);
        $pl_respone = $pl->run($asyRequest);
        if ($pl_respone) {
            $response_output = $pl_respone->getType();
            $response_data = $pl_respone->getData();
            $json_data = $asyRequest->build_json_data($pl_respone->getStatus(),$pl_respone->getMessage(),$pl_respone->getData());
        } else {
            $json_data = $asyRequest->build_json_data(false,'nothing');
        }


    } catch (InvaildException $e){
        $json_data = $asyRequest->build_json_data(false,$e->getMessage());
    }

    switch ($response_output) {
        case 'json' :
            return $response->withJson($json_data);
        case 'html' :
            return $response->getBody()->write($response_data);
        case 'redirect' :
            return $response->withRedirect($response_data,301);
        default :
            return $response->withJson($json_data);
    }


});