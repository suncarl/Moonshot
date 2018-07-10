<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/10
 * Time: 上午11:37
 */

namespace libs\asyncme;


class Service
{

    public $service_id;

    public function __construct($sid)
    {
        $this->service_id = $sid;
    }
}