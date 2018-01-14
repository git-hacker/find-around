<?php
namespace Common\Model;
use Think\Model;

/**
 * Class MemberModel
 * @package Common\Model
 */
class ConfigModel extends Model {
    protected $tableName = 'Config';


    /**
     * 查询一条数据
     */
    public function findConfig($where){
        if($where['status'] == '' || empty($where['status'])){
            //$where['status'] = array('neq','9');
        }
        $result = $this->where($where)->find();
        return $result;
    }


}
