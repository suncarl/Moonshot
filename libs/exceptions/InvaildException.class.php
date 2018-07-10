<?php

/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/10
 * Time: 上午11:03
 */
namespace  libs\exceptions;

class InvaildException extends \Exception
{
    /**
     * @var array
     */
    public $raw = [];

    /**
     * InvalidDecryptException constructor.
     * @param string $message
     * @param integer $code
     * @param array $raw
     */
    public function __construct($message, $code = 0, $raw = [])
    {
        parent::__construct($message, intval($code));
        $this->raw = $raw;
    }
}