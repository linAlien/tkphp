<?php
/**
 * Created by PhpStorm.
 * User: 王柏建
 * Date: 2016/10/09
 * Time: 11:32
 */
namespace Common\Model;
use Think\Model;
class SystemModel extends Model{
    public static function checkSystemList(){
        return  M('system')->select();
    }

    public static function addSystem($data){

        return  M('system')->add($data);

    }
    public static function editSystem($data){
        return  M('system')->save($data);
    }

}