<?php
/**
 * Created by PhpStorm.
 * User: Feng
 * Date: 2018/2/23
 * Time: 11:13
 */

namespace Common\Model;
use Think\Model;

class CommonModel extends Model{

    //获取一条数据
    static function getOneByWhere($table,$where=""){
        return M($table)->where($where)->find();
    }

    //根据排序获取一条记录
    static function getOneByOrder($table,$where="",$order=""){
        return M($table)->where($where)->order($order)->find();
    }

    //获取所有数据 不分页
    static function getByWhere($table,$where="",$order=""){
        return M($table)->where($where)->order($order)->select();
    }
    //根据条件获取所有数据 分页
    static function getInPageByWhere($table,$page,$per_num,$where="",$order=""){
        $count = M($table)->where($where)->count();
        $Page = new \Think\Page($count,$per_num);   // 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $data['page'] = $Page->show();
        $data['data'] = M($table)->where($where)->page($page.','.$per_num)->order($order)->select();

        return $data;
    }
    //获取所有数据 分页
    static function getInPage($table,$page,$per_num){
        $count = M($table)->count();
        $Page = new \Think\Page($count,$per_num);   // 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('theme',"<ul class='pagination'></li><li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li><li>%END%</li><li><a> %HEADER%  %NOW_PAGE%/%TOTAL_PAGE% 页</a></ul>");
        $data['page'] = $Page->show();
        $data['data'] = M($table)->page($page.','.$per_num)->select();

        return $data;
    }
    //添加
    static function addByWhere($table,$data){
        return M($table)->add($data);
    }

    //编辑
    static function editByWhere($table,$idName,$idVal,$data){
        return M($table)->where(array($idName=>$idVal))->save($data);
    }
    //删除
    static function deleteByWhere($table,$idName,$idVal){
        return M($table)->where(array($idName=>$idVal))->delete();
    }
}