<?php
/**
 * Created by PhpStorm.
 * User: 王柏建
 * Date: 2016/10/09
 * Time: 11:32
 */
namespace Common\Model;
use Think\Model;
class AdminModel extends Model{

    //获取管理员
    public static function getAdmin(){
        return M('admin')->select();
    }

    //添加管理员
    public static function addAdmin($data){
        return M('admin')->add($data);
    }

    //通过角色id来获取管理员
    public static function getAdminByRoleId($admin_role){
        return M('admin')->where(array("admin_role"=>$admin_role))->select();
    }

    //通过账号名获取管理员
    public static function getAdminByAccount($admin_account){
        return M('admin')->where(array('admin_account'=>$admin_account))->find();
    }

    //删除管理员
    public static function deleteAdmin($admin_id){
        return M('admin')->where(array('admin_id'=>$admin_id))->delete();
    }

    //编辑管理员
    public static function editAdmin($admin_id,$data){
        return M('admin')->where(array('admin_id'=>$admin_id))->save($data);
    }

    //通过id获取管理员
    public static function getAdminById($admin_id){
        return M('admin')->where(array("admin_id"=>$admin_id))->find();
    }

    //通过账号名搜索管理员
    public static function searchAdminByAccount($admin_account){
        return M('admin')->where(array('admin_account'=>array('like',"%".$admin_account."%")))->select();
    }
}