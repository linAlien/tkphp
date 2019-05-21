<?php
/**
 * Created by PhpStorm.
 * User: MBENBEN
 * Date: 2016/10/12
 * Time: 17:43
 */

namespace Admin\Controller;
use Common\Model\CommonModel;
use Think\Controller;

class LoginController extends Controller
{
    public function getAllnum(){
        $a = file_get_contents('http://47.106.174.74/mp/v1/robot/?showAvailable=1');
        $a = json_decode($a,true);
        $a = $a['data'];
        dump($a);
        $num = 0;
        for($i=0;$i<count($a['entries']);$i++){
            $num += $a['entries'][$i]['available'];
        }

        dump($num);
    }
    public function login(){
        $this->display('login/login');
    }
    public function reg(){
        $this->display('login/reg');
    }

    public function doLogin()
    {
        if($_POST['username'] && $_POST['password']){
//            if(!$this->checkCode(I('post.code'))){
//                $res = getRes(0,-4,'code error');
//                //$this->error("验证码错误！");
//                $this->ajaxReturn($res,'json');exit;
//            }
            $account = I('post.username');
            $password= I('post.password');
            $where['admin_account'] =$account;
            $where['admin_password'] =$password;
            $admin =M("admin")->where($where)->find();
            if($admin){
                if($admin['admin_state'] == 0){
                    $res = getRes(0,-1,'此账号已经被管理员禁用!');
                    //$this->error("此账号已经被管理员禁用!");
                }
                else{
                    session('admin',$admin);
                    $res = getRes(1,1,'登录成功');
                    //$this->success("登录成功！",U('index/index'));
                }
            }
            else{
                $res = getRes(0,-2,'账号密码错误');
                //$this->error("账号密码错误！");
            }
        }
        else{
            $res = getRes(0,-2,'账号密码错误');
        }
        $this->ajaxReturn($res,'json');
    }

    public function doRegister()
    {
        if($_POST['username'] && $_POST['password']){
//            if(!$this->checkCode(I('post.code'))){
//                $res = getRes(0,-4,'code error');
//                //$this->error("验证码错误！");
//                $this->ajaxReturn($res,'json');exit;
//            }
            $account = I('post.username');
            $password= I('post.password');
            $where['admin_account'] =$account;
            $admin =M("admin")->where($where)->find();
            if($admin){
                    $res = getRes(-1,1,'已经有这个账号了');
            }
            else{
                $data['admin_account'] = $account;
                $data['admin_password'] = $password;
                CommonModel::addByWhere('admin',$data);
                $res = getRes(1,1,'注册成功~');
            }
        }
        else{
            $res = getRes(0,-2,'请输入完整！');
        }
        $this->ajaxReturn($res,'json');
    }
    //验证码
    public function code(){
        $Verify = new \Think\Verify();
        $Verify->entry();
    }

    public function checkCode($code){
        $Verify = new \Think\Verify();
        return $Verify->check($code);
    }
    //退出系统
  public function outSys(){
      if(session('admin')){
          session('admin',null);
          $this->success('退出成功~',U('login'));
      }
  }
}
