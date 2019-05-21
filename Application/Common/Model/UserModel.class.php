<?php
/**
 * Created by PhpStorm.
 * User: 王柏建
 * Date: 2016/5/27
 * Time: 1:20
 */
namespace Common\Model;
use Think\Model;
class UserModel extends Model{

    //获取用户
    public static function getUser($where){
        return M('user')->where($where)->find();
    }

    //添加用户
    public static function addUser($data){
        return M('user')->add($data);
    }

    //根据id删除用户
    public static function deleteUser($id){
        return M('user')->where(array('user_id'=>$id))->delete();
    }
    //编辑用户
    public static function editUser($user_id,$data){
        return M('user')->where(array('user_id'=>$user_id))->save($data);
    }

    //通过条件修改用户
    public static function editUserByWhere($where,$data){
        return M('user')->where($where)->save($data);
    }

    //获取会员分页
    public static function getUserInPage($page,$per_num){
        $count      = M('user')->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$per_num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $user['page']       = $Page->show();// 分页显示输出
        $user['user'] = M('user')->page($page.','.$per_num)->order("user_id desc")->select();
        return $user;
    }

    //获取会员分页
    public static function getUserByWhereInPage($page,$per_num,$where,$map){
        $count      = M('user')->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,$per_num);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        //分页跳转的时候保证查询条件
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $user['page']       = $Page->show();// 分页显示输出
        $user['user'] = M('user')->where($where)->page($page.','.$per_num)->order("user_id desc")->select();
        return $user;
    }
}