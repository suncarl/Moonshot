<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/10
 * Time: 上午1:47
 */
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

if (file_exists("../config/version.inc.php")) {
    $version_config = include "version.inc.php";
    $config = array_merge($config,$version_config);
}




return $config;