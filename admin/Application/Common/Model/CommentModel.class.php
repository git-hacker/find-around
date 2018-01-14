<?php
namespace Common\Model;
use Think\Model;

/**
 * Class CommentModel
 * @package Api\Model
 * 评论
 */
class CommentModel extends Model {
    protected $tableName = 'comment';


    /**
     * 查询多条数据
     */
    public function selectComment($where = array(), $order = '', $page_size = '', $fields = '', $parameter = array(), $is_manage = false){
        if(empty($where['status'])) {
            $where['status'] = array('neq','9');
        } if($page_size == '') {
            $list = $this->where($where)->order($order)->field($fields)->select();
            if($is_manage) {
                $result = array('list'=>$this->manage($list));
            } else {
                $result = array('list'=>$list);
            }
        } else {

            $count = $this->where($where)->count();
            $page  = new \Think\HPage($count,$page_size);
            $page->parameter = $parameter;
            $page->setConfig('theme',$this->setPageTheme());
            $page_info = $page->show();
            $list = $this->where($where)->order($order)->field($fields)->limit($page->firstRow,$page_size)->select();
            if($is_manage) {
                $result = array('page'=>$page_info,'list'=>$this->manage($list));
            } else {
                $result = array('page'=>$page_info,'list'=>$list);
            }
        }
        return $result;
    }

    /**
     * 添加会员
     */
    public function addComment($data){
        if(empty($data)){
            return false;
        }
        $result = $this->data($data)->add();
        return $result;
    }

    /**
     * 查询一条数据
     */
    public function findComment($where,$field){
        if($where['status'] == '' || empty($where['status'])){
            $where['status'] = array('neq','9');
        }
        $result = $this->where($where)->field($field)->find();
        return $result;
    }
    /**
     * 编辑会员
     */
    public function editComment($where,$data){
        if(empty($where) || empty($data)){
            return false;
        }
        $result = $this->where($where)->data($data)->save();
        return $result;
    }
    /**
     * 删除会员
     */
    public function deleteComment($where){
        if(empty($where)){
            return false;
        }
        $result = $this->where($where)->delete();
        return $result;
    }

    /**
     * 分页样式
     */
    private function setPageTheme(){
        $theme = "<ul class='pagination'><li>%TOTAL_ROW%</li><li>%UP_PAGE%</li>%LINK_PAGE%<li>%DOWN_PAGE%</li></ul>";
        return $theme;
    }
}
