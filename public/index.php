<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/10
 * Time: 上午12:56
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define("APPLICATION_ENV","product");

define('NG_ME',"9527");

defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ?
    getenv('APPLICATION_ENV') :
    'local'));

if (APPLICATION_ENV === 'local') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ERROR);
}

require '../vendor/autoload.php';

$config = [];

$settings = ['settings'=>$config];

$c = new \Slim\Container($settings);

$app = new \Slim\App($c);

$request = $this->container->get('request');
var_dump($request);

$container = $app->getContainer();

$routers = glob('../routers/*.router.php');
if ( $routers ) {
    foreach ( $routers as $router) {
        require $router;
    }
}
$app->run();