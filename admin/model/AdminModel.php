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

    public $redis = null;

    public function __construct($service)
    {
        $this->service = $service;
        $this->db = $service->getDb();
        $this->cache = $service->getCache();
        $this->redis = $service->getRedis();
    }

    /**
     * 获得配置
     * @param $name
     * @return array
     */
    public function getConfig($name)
    {
        $map = [
            'name'=> $name
        ];
        $res = $this->db->table('sys_config')->where($map)->first();
        if ($res && isset($res->config)) {
            $res = json_decode($res->config,true);

        }
        return $res;
    }

    public function str()
    {
        echo __CLASS__;
    }

}