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

$app->get('/plugin/{bid:[\w]+}/{name:[\w]+}', function (Request $request, Response $response, array $args) {
    $route = $request->getAttribute('route');
    $bid = $route->getArgument('bid');
    var_dump($bid);
    $name = $route->getArgument('name');
    var_dump($name);
});