<?php

namespace Home\Controller;
use Think\Controller;

/**
 * Class NewsController
 * @package Admin\Controller
 */
class UserController extends AdminBasicController {
    public function _initialize(){
        $this -> checkLogin();
        $this -> user = D('User');

    }

    /**
     * 用户列表
     */
    public function userlist(){
        $w['status'] = array('neq',9);
        
        if($_REQUEST['nick_name']){
            $w['uname'] = array('LIKE','%'.$_REQUEST['nick_name'].'%');
        }

        $list = $this -> user -> where($w) -> order('addtime desc') -> select();
        $this->assign("list",$list);
        $this->display();
    }
}