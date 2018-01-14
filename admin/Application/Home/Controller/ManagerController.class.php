<?php

namespace Home\Controller;
use Think\Controller;
/**
 * Class ManagerController
 * @package Admin\Controller
 */
class ManagerController extends AdminBasicController {

    public function newLogin(){
        $session = session('A_ID');
        if(empty($session)){
            $this->display('newLogin');
        }else{
            redirect(U('Index/index'));
        }
    }

    /**
     * 登陆
     */
    public function doLogin(){
        $admin = D('Admin');
        if(empty($_POST['account'])){
            $this->ajaxMsg('error','请输入账号');
        }if(empty($_POST['password'])){
            $this->ajaxMsg('error','请输入密码');

        }if($_POST['errorNum']<3){
            $where['account'] = I('post.account');
            $find_res = $admin->findAdmin($where);
            if($find_res){
                $where1['account'] = I('post.account');
                $where1['password'] = md5(I('post.password'));
                $find_res1 = $admin->findAdmin($where1);
                if($find_res1){
                    //修改最后登录时间和ip 错误次数归零
                    $admin->editAdmin(array('a_id'=>$find_res1['a_id']),array('last_login_time'=>time(),'error_num'=>0,'last_login_ip'=>$_SERVER["REMOTE_ADDR"]));
                    ///设置session
                    session('A_ACCOUNT',$find_res1['account']);
                    session('A_ID',$find_res1['a_id']);
                    $this->ajaxMsg('success','登陆成功');
                }else{
                    $where2['account'] = I('post.account');
                    $error_num = $admin->findAdmin($where2);
                    $data['error_num'] = $error_num['error_num']+1;
                    $admin->editAdmin($where2,$data);
                    $this->ajaxMsg('error','用户名或密码错误');
                }
            }
        }if($_POST['errorNum']>=3){
            if(!$this->check_verify($_POST['verify'])){
                $this->ajaxMsg('error','验证码错误');
            }else{
                $where3['account'] = I('post.account');
                $where3['password'] = md5(I('post.password'));
                $find_res3 = $admin->findAdmin($where3);
                if($find_res3){
                    //修改最后登录时间和ip 错误次数归零
                    $admin->editAdmin(array('a_id'=>$find_res3['a_id']),array('last_login_time'=>time(),'error_num'=>0,'last_login_ip'=>$_SERVER["REMOTE_ADDR"]));
                    ///设置session
                    session('A_ACCOUNT',$find_res3['account']);
                    session('A_ID',$find_res3['a_id']);
                    $this->ajaxMsg('success','登陆成功');
                }else{
                    $where4['account'] = I('post.account');
                    $error_num1 = $admin->findAdmin($where4);
                    $data1['error_num'] = $error_num1['error_num']+1;
                    $admin->editAdmin($where4,$data1);
                    $this->ajaxMsg('error','用户名或密码错误');
                }
            }
        }
    }
    /**
     * 异步校验用户名
     */
    public function checkAccount(){
        $admin = D('Admin');
        $where['account'] = I('post.account');
        $find_res = $admin->findAdmin($where);
        if($find_res){
            $today=date('Y-m-d');
            $oldtime=date('Y-m-d',$find_res['last_login_time']);
            if($today==$oldtime){
            }else{
                $where1['account'] = I('post.account');
                $find_res['last_login_time']=time();
                $find_res['error_num']=0;
                $admin->editAdmin($where1,$find_res);
            }
            $this->ajaxMsg('success',$find_res['error_num']);
        }else{
            $this->ajaxMsg('error','该账户不存在！');
        }
    }
    /**
     * 退出登录
     */
    public function logOut(){
        session('A_ACCOUNT',null);
        session('A_ID',null);
        session('A_GROUP',null);
        redirect(U('Manager/newLogin'));
    }

    /**
     * 生成验证码
     */
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->entry();
    }

    /**
     * @param $code
     * @param string $id
     * @return bool
     * 验证码检验
     */
    public function check_verify($code,$id=''){
        $verify = new \Think\Verify();
        return $verify->check($code,$id);
    }
}