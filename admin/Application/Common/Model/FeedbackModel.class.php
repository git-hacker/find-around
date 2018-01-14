<?php
namespace Common\Model;
use Think\Model;

/**
 * Class MemberModel
 * @package Common\Model
 * 反馈信息相关
 */
class FeedbackModel extends Model {
    protected $tableName = 'feedback';

    protected $_validate = array(
        array('contact','require','联系方式不能为空'),
        array('content','require','反馈内容不能为空'),
    );

    protected $_auto = array(
        array('ctime','time',self::MODEL_INSERT,'function'),
        array('utime','time',self::MODEL_UPDATE,'function'),
    );
    /**
     * 查询多条数据
     */
    public function selectFeedback($where = array(),$order = '',$page_size = '',$parameter = array()){
        if($where['status'] == ''|| empty($where['status'])){
            $where['status'] = array('neq','9');
        }if($page_size == ''){
            $result = $this->where($where)->order($order)->select();
        }else{
            $count = $this->where($where)->count();
            $page = new \Think\Page($count,$page_size);
            $page->parameter = $parameter;
            $page->setConfig('theme',$this->setPageTheme());
            $page_info =$page->show();
            $list = $this->where($where)
                ->order($order)
                ->limit($page->firstRow,$page_size)
                ->select();
            $result = array('page'=>$page_info,'list'=>$list);
        }
        return $result;
    }
    /**
     * 添加反馈内容
     */
    public function addFeedback($data){
        if(empty($data)){
            return false;
        }
        $result = $this->data($data)->add();
        return $result;
    }
    /**
     * 多条数据同时添加
     */
    public function addFeedbackAll($data){
        if(empty($data)){
            return false;
        }
        $result = $this->addAll($data);
        return $result;
    }
    /**
     * 查询一条数据
     */
    public function findFeedback($where){
        if($where['status'] == '' || empty($where['status'])){
            $where['status'] = array('neq','9');
        }
        $result = $this->where($where)->find();
        return $result;
    }
    /**
     * 编辑
     */
    public function editFeedback($where,$data){
        if(empty($where) || empty($data)){
            return false;
        }
        $result = $this->where($where)->data($data)->save();
        return $result;
    }
    /**
     * 删除
     */
    public function deleteFeedback($where){
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
