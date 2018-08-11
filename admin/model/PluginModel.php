<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/27
 * Time: 下午7:56
 */

namespace admin\model;


class PluginModel extends AdminModel
{

    protected $plugin_menu_table = 'sys_plugins_menu';
    protected $plugin_table = 'sys_plugins';


    public function has_table($table_name)
    {
        return $this->db->schema()->hasTable($table_name);
    }

    public function create_table($sql)
    {
        return $this->db->getConnection()->statement($sql);
    }

    /**
     * 插件菜单表
     * @param $map
     * @return mixed
     */
    public function addPluginMenu($map)
    {
        return $this->db->table($this->plugin_menu_table)->insertGetId($map);
    }

    public function getPluginMenuCount($where)
    {
        return $this->db->table($this->plugin_menu_table)->where($where)->count();
    }

    public function getPluginMenuInfo($where,$filed=[])
    {
        $process = $this->db->table($this->plugin_menu_table)->where($where);
        if($filed) {
            $process->select($filed);
        }
        $res = $process->first();
        $res = (array)$res;
        return $res;
    }
    public function updatePluginMenu($where,$map)
    {
        return $this->db->table($this->plugin_menu_table)->where($where)->update($map);
    }

    /**
     * 插件表
     * @param $map
     * @return mixed
     */
    public function addPlugin($map)
    {
        return $this->db->table($this->plugin_table)->insertGetId($map);
    }

    public function getPluginCount($where)
    {
        return $this->db->table($this->plugin_table)->where($where)->count();
    }

    public function getPluginInfo($where,$filed='')
    {
        $process = $this->db->table($this->plugin_table)->where($where);
        if($filed) {
            $process->select($filed);
        }
        $res = $process->first();
        $res = (array)$res;
        return $res;
    }

    public function updatePlugin($where,$map)
    {
        return $this->db->table($this->plugin_table)->where($where)->update($map);
    }



}