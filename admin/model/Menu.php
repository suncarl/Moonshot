<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/7/27
 * Time: 下午7:56
 */

namespace admin\model;


class Menu extends AdminModel
{

    public function getNav()
    {
        $map = [
            'status'=> 1,
            'parentid' => 0
        ];
        $res = $this->db->table('sys_menu')->orderBy('listorder','desc')->where($map)->get();
        $res = reset($res);
        foreach ($res as $key => $val ) {
            $res[$key] = (array)$val;
        }
        return $res;
    }
}