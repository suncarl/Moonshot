<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/10
 * Time: 上午2:31
 */

namespace libs\asyncme;

/**
 * Class Plugins
 * @package libs\asyncme
 * 插件的基类，虚类
 */
abstract class Plugins
{
    //组件的根地址
    public $plugin_root;

    //个性化的需求参数
    public $custom;

    //运行的参数数组，内部传递
    public $args;
    //构造函数
    public function __construct($root,$custom='')
    {
        $this->plugin_root = $root;
        $this->custom = $custom;
        $this->args = [];
    }



    //正式运行
    //运行的结果通过
    public function real_run()
    {
        $this->before();
        $this->run();
        $this->after();
    }

    //运行主入口
    abstract function run();
    //运行之前
    abstract public function before();
    //运行之后
    abstract public function after();
    //安装的虚函数
    abstract public function install();
    //卸载
    abstract public function uninstall();
    //更新
    abstract public function upgrade();
    //备份
    abstract public function backup();
}