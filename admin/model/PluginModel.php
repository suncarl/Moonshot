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

    public function create_table($create_sql)
    {
        return $this->db->getConnection()->statement($create_sql);
    }

    public function drop_table($table_name)
    {
        return $this->db->schema()->dropIfExists($table_name);
    }

    public function getSubMenu($parent_id)
    {
        $map = [
            'status'=> 1,
            'parentid' => $parent_id,
        ];
        $res = $this->db->table('sys_plugins_menu')->orderBy('listorder','desc')->where($map)->get();
        $res = reset($res);
        foreach ($res as $key => $val ) {
            $res[$key] = (array)$val;
            $subMenus = $this->getSubMenu($res[$key]['id']);
            $res[$key]['items'] = $subMenus;
        }
        return $res;
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
            $process = $process->select($filed);
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

    public function getPluginLists($where,$filed='',$orderby=[],$limit='')
    {
        $process = $this->db->table($this->plugin_table)->where($where);
        if($filed) {
            $process = $process->select($filed);
        }
        if($orderby && is_array($orderby)) {
            foreach ($orderby as $order_item) {
                $process = $process->orderBy($order_item[0],$order_item[1]);
            }
        }

        if($limit) {
            $process = $process->limit($limit);
        }
        $res = $process->get();
        $res = reset($res);
        if($res) {
            $res = json_decode(json_encode($res),true);
        }
        return $res;
    }

    public function getPluginInfo($where,$filed='')
    {
        $process = $this->db->table($this->plugin_table)->where($where);
        if($filed) {
            $process = $process->select($filed);
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