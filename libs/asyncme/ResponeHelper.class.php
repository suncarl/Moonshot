<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/23
 * Time: 下午5:18
 */

namespace libs\asyncme;


class ResponeHelper
{

    private $status;

    private $mess;

    private $data;

    private $reponse_type;

    private $template;


    public function __construct($status,$mess,$data,$type='json',$template='')
    {
        $this->status = $status;
        $this->mess = $mess;
        $this->data = $data;
        $this->reponse_type = $type;
        if (strtolower($type)=='template') {
            $this->template = $template;
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->mess;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getType()
    {
        return strtolower($this->reponse_type);
    }

    public function getTemplate()
    {
        return $this->template;
    }
}