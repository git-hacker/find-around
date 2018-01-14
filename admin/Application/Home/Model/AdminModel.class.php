<?php
namespace Home\Model;
use Think\Model;

/**
 * Class AdminModel
 * @package Admin\Model
 * 管理员信息相关
 */
class AdminModel extends Model {
    protected $tableName = 'admin';
    /**
     * @var array
     * 自动验证   使用create()方法时自动调用
     */
    protected $_validate = array(
        array('account','require','账号不能为空！'), //空验证  默认情况下用正则进行验证
        array('account','','帐号名称已经存在！',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT), // 在新增的时候验证name字段是否唯一
        array('old_password','require','旧密码不能为空！'),
        array('old_password','6,15','旧密码长度应在6-15位之间！',self::EXISTS_VALIDATE,'length'),
        array('password','require','密码不能为空！'),
        array('password','6,15','密码长度应在6-15位之间！',self::EXISTS_VALIDATE,'length'),
        array('re_password','require','确认密码不能为空！'),
        array('re_password','6,15','确认密码长度应在6-15位之间！',self::EXISTS_VALIDATE,'length'),
        array('re_password','password','确认密码与密码不一致！',self::EXISTS_VALIDATE,'confirm'), // 验证确认密码是否和密码一致
        array('group_id','require','请选择组别！'),
    );
    /**
     * @var array
     * 自动完成   新增时
     */
    protected $_auto = array (
        array('password','md5',self::MODEL_INSERT,'function') , // 对password字段在新增的时候使md5函数处理
        array('ctime','time',self::MODEL_INSERT,'function'), // 对ctime字段在插入的时候写入当前时间戳
        array('utime','time',self::MODEL_UPDATE,'function'), // 对utime字段在修改的时候写入当前时间戳
    );

    /**
     * 查询多条数据
     */
    public function selectAdmin($where = array(),$order = '',$page_size = ''){
        if($where['status'] == ''|| empty($where['status'])){
            $where['status'] = array('neq',9);
        }
        if($page_size == ''){
            $result = $this->where($where)->order($order)->select();
        }else{
            $count = $this->where($where)->order($order)->count();
            $page = new \Think\Page($count,$page_size);
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
     * 添加数据
     */
    public function addAdmin($data){
        if(empty($data)){
            return false;
        }else{
            $result = $this->data($data)->add();
            return $result;
        }
    }
    /**
     * 查询一条数据
     */
    public function findAdmin($where){
        if(empty($where)){
            return false;
        }else{
            if($where['status'] == '' || empty($where['status'])){
                $where['status'] = array('neq','9');
            }
            $result = $this->where($where)->find();
            return $result;
        }
    }
    /**
     * 编辑数据
     */
    public function editAdmin($where,$data){
        if(empty($where) || empty($data)){
            return false;
        }
        $result = $this->where($where)->data($data)->save();
        return $result;
    }
    /**
     * 删除数据
     */
    public function deleteAdmin($where){
        if(empty($where)){
            return false;
        }
        $result = $this->where($where)->delete();
        return $result;
    }

    /**
     * 数据相关处理
     * 当许多地方需要将取出的原数据惊醒改变格式 或添加某些相关数据
     */
    public function manageAdminInfo(){

    }
}