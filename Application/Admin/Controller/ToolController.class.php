<?php
namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;
class ToolController extends Controller {
    public function _initialize()
    {
        if (!session('admin')) {
            $this->error('操作失败!', U('login/login'), 3);
        }
    }

    //上传图片接口
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     'Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->uploadOne($_FILES['file']);
        if(!$info) {// 上传错误提示错误信息
            $msg = $this->error($upload->getError());
            $path = false;
            $res = getRes(0,0,$msg);
        }else{// 上传成功
            $path = "Uploads/".$info['savepath'].$info['savename'];
            $res = getRes(1,0,"success",array("src"=>$path));
        }
        $this->ajaxReturn($res,'json');
    }
}