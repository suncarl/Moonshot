<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/10
 * Time: 上午12:56
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use libs\exceptions\InvaildException;


define("APPLICATION_ENV","debug");

define('NG_ME',"9527");

defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ?
    getenv('APPLICATION_ENV') :
    'debug'));

if (APPLICATION_ENV === 'debug') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ERROR);
}

$config = include '../config/config.debug.inc.php';

require '../vendor/autoload.php';


$settings = ['settings'=>$config];

$c = new \Slim\Container($settings);

$app = new \Slim\App($c);

$container = $app->getContainer();
//版本处理
$request = $container->get('request');
$response = $container->get('response');
$version = $request->getQueryParam('v');
if(!$version) {
    define("APP_VERSION",'v1');
    define("APP_VERSION_PATH",'');
} else {
    $version = strtolower($version);

    if (in_array($version,$config['versions'])) {
        define("APP_VERSION",'v'.$version);
        define("APP_VERSION_PATH",APP_VERSION);
    } else {
        $json_data = ['status'=>false,'data'=>'error','desc'=>'version {'.$version.'} not vaild'];
        $app->respond($response->withJson($json_data)->withHeader('Content-type', 'application/json'));
        die();
    }
}
//载入中间件
$middle_wares = glob('../middle/*.mw.php');
if ( $middle_wares ) {
    foreach ( $middle_wares as $middle_ware) {
        require $middle_ware;
    }
}
//载入通用的类库
$libs = glob('../libs/*/*.class.php');
if ( $libs ) {
    foreach ( $libs as $lib) {
        require $lib;
    }
}
//载入通用的函数
$functions = glob('../utils/*.inc.php');
if ( $functions ) {
    foreach ( $functions as $func) {
        require $func;
    }
}

$routers = glob('../routers/*.router.php');
if ( $routers ) {
    foreach ( $routers as $router) {
        require $router;
    }
}




$app->run();