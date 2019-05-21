<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class DataController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    //返回表格数据
    public function getData(){
        $get = $_GET;
        $page = $get['page'];
        $limit = $get['limit'];
        $table = $get['table'];
        unset($get['m']);
        unset($get['c']);
        unset($get['a']);
        unset($get['page']);
        unset($get['limit']);
        unset($get['table']);
        if($get){ //如果还有剩下说明是条件
            $where = $this->doWhere($get);
        }
        else{
            $where = [];
        }
        $where[$table.'_state'] = 1;//存在
        $data = CommonModel::getInPageByWhere($table,$page,$limit,$where,$table."_id desc")["data"];
        $res["code"] = 0;
        $res["msg"] = "";
        $res["count"] = count($data);
        $res["data"] = $data?$data:'';
        $this->ajaxReturn($res,"json");
    }

    //删除数据
    public function deleteData($table,$id){
        $id = explode(",",$id);//将id弄成数组
        foreach($id as $k=>$v){
            if($v){
                CommonModel::editByWhere($table,$table."_id",$v,array($table."_state"=>0));
            }
        }
        $res = getRes(1,0,'SUCCESS');
        $this->ajaxReturn($res,'json');
    }

    //添加数据
    public function addData(){
        $table = I('get.table');
        $post = $_POST;
        foreach($post as $k=>$v){
            if(is_array($v)){
                $post[$k] = ",".implode(",",$v).",";
            }
        }
        $post[$table.'_createtime'] = date("Y-m-d H:i:s");
        $post[$table.'_state'] = 1;
        CommonModel::addByWhere($table,$post);
        $res = getRes(1,0,'success');
        $this->ajaxReturn($res,'json');
    }

    //编辑数据
    public function editData(){
        $table = I('get.table');
        $post = $_POST;
        foreach($post as $k=>$v){
            if(is_array($v)){
                $post[$k] = ",".implode(",",$v).",";
            }
        }
        CommonModel::editByWhere($table,$table."_id",I("post.".$table."_id"),$post);
        $res = getRes(1,0,'success');
        $this->ajaxReturn($res,'json');
    }

    //处理条件
    private function doWhere($get){
        $where = [];
        foreach($get as $k=>$v){
            if($v!==null && $v!==""){   //避免匹配空值
                if(strpos($k,'#') !== false){ //非等
                    //切割字符串，取出条件
                    $arr = explode("#",$k);
                    $condition = $arr[1];
                    $w = $arr[0];
                    if(is_array($v)){  //处理多选
                        $v = ",".implode(",",$v).",";
                    }
                    if($condition=="like"){
                        $where[$w] = array($condition,"%".$v."%");
                    }
                    else{
                        $where[$w] = array($condition,$v);
                    }
                }
                else{
                    $where[$k] = $v;
                }
            }
        }
        return $where;
    }

}