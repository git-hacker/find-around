<?php

namespace Home\Controller;
use Think\Controller;

/**
 * Class NewsController
 * @package Admin\Controller
 */
class KcController extends AdminBasicController {
    public $Article = '';
    public function _initialize(){
        $this->checkLogin();
        $this->kc = D('markets');
    }

    /**
     * 公司新闻列表
     */
    public function kclist(){
        $w['status'] = array('neq',9);
        $list = $this -> kc -> where($w) ->select();
        $this->assign("list",$list);
        $this->display();
    }
    /**
     * 删除新闻
     */
    public function deletekc(){

        if(empty($_REQUEST['id'])){
            $this->error('您未选择任何操作对象');
        }
        $data['id'] = array('IN',I('request.id'));
        $data['status'] = 9;
        $upd_res = $this -> kc -> save( $data );
        
        if($upd_res){
            $this->success('删除操作成功');
        }else{
            $this->error('删除操作失败');
        }
    }

    
}