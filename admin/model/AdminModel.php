<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/27
 * Time: 上午12:20
 */

namespace admin\model;


class AdminModel
{
    public $service = null;

    public $db = null;

    public $cache = null;

    public function __construct($service)
    {
        $this->service = $service;
        $this->db = $service->getDb();
        $this->cache = $service->getCache();
    }

    public function str()
    {
        echo __CLASS__;
    }

}