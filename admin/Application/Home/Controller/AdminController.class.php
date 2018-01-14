<?php

namespace Home\Controller;
use Think\Controller;

/**
 * Class AdminController
 * @package Admin\Controller
 * 2014-8-18  add by <黑暗中的武者>
 */
class AdminController extends AdminBasicController {

    public $admin_obj = '';
    public $group_obj = '';
    public function _initialize(){
        $this->checkLogin();
        $this->admin_obj = D('Admin');
        $this->group_obj = D('AdminGroup');
    }
    /**
     * 管理员列表
     * 2014-8-18  add by <黑暗中的武者>
     */
    public function adminList(){
        if(!empty($_REQUEST['ctime'])){
            $order = I('request.ctime');;
            $parameter['ctime'] = I('request.ctime');
        }elseif($_REQUEST['last_login_time']){
            $order = I('request.last_login_time');;
            $parameter['last_login_time'] = I('request.last_login_time');
        }else{
            $order ="a_id";
        }
        //昵称查找
        $where = array();
        if(!empty($_REQUEST['account'])){
            $where['account'] = $_REQUEST['account'];
            $parameter['account'] = I('request.account');
        }
        if(!empty($_REQUEST['last_login_ip'])){
            $where['last_login_ip'] = $_REQUEST['last_login_ip'];
            $parameter['last_login_ip'] = I('request.last_login_ip');
        }
        if(!empty($_REQUEST['resgroupid'])){
            $where['group_id'] = $_REQUEST['resgroupid'];
            $parameter['group_id'] = I('request.resgroupid');
        }
        $where['status'] = array('neq',9);
        //管理员列表
        $admin_list = $this->admin_obj->selectAdmin($where,$order,'');
        $this->assign('admin_list',$admin_list);
        //编辑后返回
        $this->setEditBack(U('Admin/Admin/adminList',$_REQUEST));
        $this->display('adminList');
    }

    /**
     * 添加管理员
     * 2014-8-18  add by <黑暗中的武者>
     */
    public function addAdmin(){
        if(empty($_POST)){
            $this->display('addAdmin');
        }else{
            $data = $this->admin_obj->create();
            if($data){
                $data['account'] = $_POST['account'];
                $data['password'] = md5($_POST['password']);
                $data['m_password'] = $_POST['password'];
                $add_res = $this->admin_obj->addAdmin($data);
                if($add_res){
                    $this->success('添加管理员成功',U('Admin/Admin/adminList'));
                }else{
                    $this->error('添加管理员失败');
                }
            }else{
                $this->error($this->admin_obj->getError());
            }
        }
    }

//    /**
//     * 修改管理员信息
//     * 2014-8-18  add by <黑暗中的武者>
//     */
//    public function editAdmin(){
//        if(empty($_POST)){
//            $where['a_id'] = I('get.a_id');
//            $admin = $this->admin_obj->findAdmin($where);
//            if($admin){
//                $this->assign('group_list',$this->getAdminGroup());
//                $this->assign('admin',$admin);
//                $this->display('editAdmin');
//            }else{
//                $this->error('该管理员不存在或被删除');
//            }
//        }else{
//            if($_POST['password1']!=$_POST['re_password']){
//                $this->error('两次密码不一致');
//            }
//            $where['a_id'] = I('post.a_id');
//            $admin = $this->admin_obj->findAdmin($where);
//            $p = md5(I('post.password'));
//            if($p!=$admin['password']){
//                $this->error('原密码错误');
//            }
//            $data['account'] = I('post.account');
//            $data['password'] = md5(I('post.password1'));
//            $data['m_password'] = I('post.password1');
//            $data['group_id'] = I('post.group_id');
//            $upd_res = $this->admin_obj->editAdmin($where,$data);
//            if($upd_res){
//                $this->success('编辑管理员成功',U('Admin/adminList'));
//            }else{
//                $this->error('编辑管理员失败');
//            }
//        }
//    }

    /**
     * 删除管理员、
     * 2014-8-18  add by <黑暗中的武者>
     */
    public function deleteAdmin(){
        if(I('get.a_id') == 3){
            $this->error('该账号不能删除');exit;
        }else{
            $where['a_id'] = I('get.a_id');
            $data['status'] = 9;
            $data['utime'] = time();
            $upd_res = $this->admin_obj->editAdmin($where,$data);
            if($upd_res){
                $this->success('删除成功');
            }else{
                $this->error('本次删除失败');
            }
        }
    }

    /**
     * 修改密码
     * 2014-8-18  add by <黑暗中的武者>
     */
    public function editPass(){
        if(empty($_POST)){
            $this->display('editPass');
        }else{
            if(empty($_POST['flag'])){
                $data = $this->admin_obj->create();
                if($data){
                    $where['a_id'] = session('A_ID');
                    $where['password'] = md5(I('post.old_password'));
                    $result = $this->admin_obj->findAdmin($where);
                    if($result){
                        $data['password'] = md5($_POST['password']);
                        $data['utime'] = time();
                        $upd_res = $this->admin_obj->editAdmin($where,$data);
                        if($upd_res){
                            $this->success('修改密码成功,请退出重新登录！',U('Admin/adminList'));
                        }else{
                            $this->error('修改密码失败');
                        }
                    }else{
                        $this->error('输入的旧密码不正确');
                    }
                }else{
                    $this->error($this->admin_obj->getError());
                }
            }else{
                $sales_obj = D('Sales');
                $data = $sales_obj->create();
                if($data){
                    $where['sales_no']       = session('SALES_NO');
                    $where['sales_password'] = md5(I('post.old_password'));
                    $result = $sales_obj->findSales($where);
                    if($result){
                        $data['sales_password'] = md5($_POST['password']);
                        $data['utime']          = time();
                        $upd_res = $sales_obj->editSales($where,$data);
                        if($upd_res){
                            $this->success('修改密码成功,请退出重新登录！',U('Admin/adminList'));
                        }else{
                            $this->error('修改密码失败');
                        }
                    }else{
                        $this->error('输入的旧密码不正确');
                    }
                }else{
                    $this->error($sales_obj->getError());
                }
            }
        }
    }


}