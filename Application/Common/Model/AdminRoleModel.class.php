<?php
/**
 * Created by PhpStorm.
 * User: 王柏建
 * Date: 2016/10/09
 * Time: 11:32
 */
namespace Common\Model;
use Think\Model;
class AdminRoleModel extends Model{

    //获取管理员角色
    public static function getAdminRole(){
        return M('role')->select();
    }

    //通过id获取角色
    public static function getRoleById($role_id){
        return M('role')->where(array('role_id'=>$role_id))->find();
    }

    //添加角色
    public static function addAdminRole($data){
        return M('role')->add($data);
    }

    //通过id删除角色
    public static function deleteAdminRoleById($role_id){
        return M('role')->where(array('role_id'=>$role_id))->delete();
    }

    //编辑角色
    public static function editAdminRole($role_id,$data){
        return M('role')->where(array('role_id'=>$role_id))->save($data);
    }

}