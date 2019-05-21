<?php
namespace Api\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class KefuController extends Controller {


    //增加编辑客服
    public function addAndEditKefu(){
        $data = getParameters('get',['kefu_wechat','kefu_name','kefu_qrcode']);
        if(empty($data['kefu_wechat'])){
            $res = getRes(0,0,"param error");
        }
        else{
            $data['kefu_createtime'] = date("Y-m-d H:i:s");
            $data['kefu_state'] = 1;
            $kefu = CommonModel::getOneByWhere('kefu',array("kefu_wechat"=>$data['kefu_wechat'],"kefu_state"=>1));
            if($kefu){ //编辑
                unset($data['kefu_createtime']);
                CommonModel::editByWhere('kefu','kefu_wechat',$data['kefu_wechat'],$data);
                $res = getRes(1,2,"edit success");
            }
            else{ //添加
                M('kefu')->add($data);
                $res = getRes(1,1,"add success");
            }
        }
        $this->ajaxReturn($res,'json');
    }

    //编辑客服
    public function deleteKefu(){
        $data = getParameters('get',['kefu_wechat']);
        if(empty($data['kefu_wechat'])){
            $res = getRes(0,0,"param error");
        }
        else{
            CommonModel::editByWhere('kefu','kefu_wechat',$data['kefu_wechat'],array("kefu_state"=>0));
            $res = getRes(1,1,"success");
        }
        $this->ajaxReturn($res,'json');
    }

}