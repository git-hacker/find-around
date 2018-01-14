<?php
namespace Home\Model;
use Think\Model;
/**
 * Class ConfigModel
 * @package Admin\Model
 */
class ConfigModel extends Model {
    protected $tableName = 'config';

    /**
     * @var array
     * 自动验证   使用create()方法时自动调用
     */
    protected $_validate = array(
        array('admin_email','/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/','邮箱格式不正确！',self::VALUE_VALIDATE,'regex'),
    );

    /**
     * 修改
     */
    public function editConfig($data){
        $where['conf_id'] = 1;
        $result = $this->where($where)->data($data)->save();
        return $result;
    }

    /**
     * 查询
     */
    public function findConfig(){
        $result = $this->where(array('cong_id'=>1))->find();
        return $result;
    }
}