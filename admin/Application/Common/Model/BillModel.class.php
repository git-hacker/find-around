<?php
namespace Common\Model;
use Think\Model;

/**
 * Class MemberModel
 * @package Common\Model
 */
class BillModel extends Model {

    /**
     * @var array
     * 自动完成   新增时
     */
    protected $_auto = array(
        //array('password','md5',self::MODEL_INSERT,'function') , // 对password字段在新增的时候使md5函数处理
        array('ctime', 'time', 2, 'function'), // 对ctime字段在插入的时候写入当前时间戳
        array('utime', 'time', 3, 'function'), // 对utime字段在修改的时候写入当前时间戳
    );
    /**
     * 查询多条数据
     *
     */
    public function selectBill($where = array(), $order = '', $page_size = '', $parameter = array())
    {
        if ($page_size == '') {
            $result = $this->where($where)->order($order)->select();
        } else {
            $count = $this->where($where)->count();
            $page = new \Think\Page($count, $page_size);
            $page->parameter = $parameter;
            $page->setConfig('theme', $this->setPageTheme());
            $page_info = $page->show();
            $list = $this->where($where)
                ->order($order)
                ->limit($page->firstRow, $page_size)
                ->select();
            $result = array('page' => $page_info, 'list' => $list);
        }
        return $result;
    }
    /**
     * 分页样式
     */
    private function setPageTheme()
    {
        $theme = "<ul class='pagination'><li>%TOTAL_ROW%</li><li>%UP_PAGE%</li>%LINK_PAGE%<li>%DOWN_PAGE%</li></ul>";
        return $theme;
    }
}
