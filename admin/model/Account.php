<?php
/**
 * Created by PhpStorm.
 * User: xiequan
 * Date: 2018/8/2
 * Time: 下午1:55
 */

namespace admin\model;


class Account extends AdminModel
{
    /*
     * 通过用户名获取用户
     */
    public function getAdminWithName($company_id,$accout)
    {
        $map = [
            'company_id'=> $company_id,
            'account' => $accout
        ];
        $res = $this->db->table('sys_admin_account')->where($map)->first();
        $res = (array)$res;

        return $res;
    }

    /**
     * 检查密码真伪
     * @param $pass
     * @param $sys_pass
     * @param string $sys_slat
     * @return bool
     */
    public function checkPass($pass,$sys_pass,$sys_slat='')
    {
        $check_pass = md5($pass.$sys_slat);
        return $check_pass==$sys_pass;
    }

}