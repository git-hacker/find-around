<?php
namespace Common\Model;
use Think\Model;

/**
 * Class GoodsModel
 * @package Common\Model
 * 商品相关
 */
class GoodsModel extends Model {
    protected $tableName = 'Goods';

    /**
     * @var array
     * 自动验证   使用create()方法时自动调用
     */
    protected $_validate = array(
        array('g_name','require','商品名称不能为空！'), //空验证  默认情况下用正则进行验证
        array('g_name','','商品名称已经存在！',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT), // 在新增的时候验证account字段是否唯一
        array('g_price','require','商品价格不能为空！'),
        array('type_id','require','商品类别不能为空！'),
        array('unit','require','商品单位不能为空！'),
        array('stock','require','商品库存不能为空！'),
        array('desc','require','商品描述不能为空！'),
    );
    /**
     * @var array
     * 自动完成   新增时
     */
    protected $_auto = array (
        array('ctime','time',self::MODEL_INSERT,'function'), // 对ctime字段在插入的时候写入当前时间戳
        array('utime','time',self::MODEL_UPDATE,'function'), // 对utime字段在修改的时候写入当前时间戳
    );
    /**
     * 查询多条数据
     *
     */
    public function selectGoods($where = array(),$order = '',$page_size = '',$parameter = array()){
        if($where['status'] == ''|| empty($where['status']) && $where['status']!=0){
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
     *
     * 添加会员
     */
    public function addGoods($data){
        if(empty($data)){
            return false;
        }
        $result = $this->data($data)->add();
        return $result;
    }
    /**
     *
     * 多条数据同时添加
     */
    public function addGoodsAll($data){
        if(empty($data)){
            return false;
        }
        $result = $this->addAll($data);
        return $result;
    }
    /**
     * 查询一条数据
     */
    public function findGoods($where,$field){
        if($where['status'] == '' || empty($where['status'])){
            $where['status'] = array('neq','9');
        }
        $result = $this->where($where)->field($field)->find();
        return $result;
    }
    /**
     * 编辑会员
     */
    public function editGoods($where,$data){
        if(empty($where) || empty($data)){
            return false;
        }
        $result = $this->where($where)->data($data)->save();
        return $result;
    }
    /**
     * 删除会员
     */
    public function deleteGoods($where){
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
