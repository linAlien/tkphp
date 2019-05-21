<?php
/**
 * Created by PhpStorm.
 * User: 王柏建
 * Date: 2016/5/27
 * Time: 1:20
 */
namespace Admin\Model;
use Think\Model;
class ApiModel extends Model{

    //添加api
    public static function addApi($data){
        return M('api')->add($data);
    }

    //获取api
    public static function getApiByWhere($where){
        return M('api')->where($where)->order('api_id desc')->select();
    }

    //编辑api
    public static function editApi($where,$data){
        return M('api')->where($where)->save($data);
    }

    //通过条件删除api
    public static function deleteApiByWhere($where){
        return M('api')->where($where)->delete();
    }
}