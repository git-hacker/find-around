<?php
namespace Common\Model;

use Think\Model;

/**
 * Class MemberModel
 * @package Common\Model
 * 会员信息相关
 */
class MemberModel extends Model
{
    protected $tableName = 'member';
    /**
     * @var array
     * 自动验证 修改用户信息
     */
    public $edit = array(
        array('nick_name', 'require', '昵称不能为空！'), //空验证  默认情况下用正则进行验证
        array('account', 'require', '账号不能为空！'), //空验证  默认情况下用正则进行验证
        array('ident', 'require', '身份证号不能为空'), //空验证  默认情况下用正则进行验证
        array('wallet', 'require', '钱包不能为空！'), //空验证  默认情况下用正则进行验证
        array('devide', 'require', '分成比例不能为空！'), //空验证  默认情况下用正则进行验证
//        array('account','','该帐号已经存在！',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT), // 在新增的时候验证account字段是否唯一
//         array('account','/^(＼d+)$|^([a-zA-Z]+)$|^([a-zA-Z].+)$|^([0-9a-zA-Z]+)$|^([＼s＼S]+)$/','账号必须是字母开头加上任意字符！',self::VALUE_VALIDATE,'regex'),
        array('ident', '15,18', '身份证号应为15-18位！', self::EXISTS_VALIDATE, 'length'),
        //  array('password','require','密码不能为空！'),
        //  array('password','6,15','密码长度应在6-15位之间！',self::EXISTS_VALIDATE,'length'),
        //array('name','','联系人姓名已经存在！',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT), // 在新增的时候验证m_nickname字段是否唯一
        //array('bind_mobile','require','电话不能为空！'), //空验证  默认情况下用正则进行验证
        //array('phone','','该电话已经存在！',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT), // 在新增的时候验证m_account字段是否唯一
        //array('name','require','联系人姓名不能为空！'), //空验证  默认情况下用正则进行验证
        // array('qq','require','QQ不能为空！'),
        //array('qq','number','非法的QQ号码！',self::EXISTS_VALIDATE,'length'),
        //array('re_m_password','require','确认密码不能为空！'),
        //array('re_m_password','6,15','确认密码长度应在6-15位之间！',self::EXISTS_VALIDATE,'length'),
        //array('re_m_password','m_password','确认密码与密码不一致！',self::EXISTS_VALIDATE,'confirm'), // 验证确认密码是否和密码一致
    );
    /**
     * @var array
     * 自动验证   使用create()方法时自动调用
     */
    protected $_validate = array(
        array('account', 'require', '账号不能为空！'), //空验证  默认情况下用正则进行验证
        array('account', '', '该帐号已经存在！', self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT), // 在新增的时候验证account字段是否唯一
        // array('account','/^(＼d+)$|^([a-zA-Z]+)$|^([a-zA-Z].+)$|^([0-9a-zA-Z]+)$|^([＼s＼S]+)$/','账号必须是字母开头加上任意字符！',self::VALUE_VALIDATE,'regex'),
        // array('account','6,32','账号长度应在6-32位之间！',self::EXISTS_VALIDATE,'length'),
        //  array('password','require','密码不能为空！'),
        //  array('password','6,15','密码长度应在6-15位之间！',self::EXISTS_VALIDATE,'length'),
        //array('name','','联系人姓名已经存在！',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT), // 在新增的时候验证m_nickname字段是否唯一
        //array('bind_mobile','require','电话不能为空！'), //空验证  默认情况下用正则进行验证
        //array('phone','','该电话已经存在！',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT), // 在新增的时候验证m_account字段是否唯一
        //array('name','require','联系人姓名不能为空！'), //空验证  默认情况下用正则进行验证
        // array('qq','require','QQ不能为空！'),
        //array('qq','number','非法的QQ号码！',self::EXISTS_VALIDATE,'length'),
        //array('re_m_password','require','确认密码不能为空！'),
        //array('re_m_password','6,15','确认密码长度应在6-15位之间！',self::EXISTS_VALIDATE,'length'),
        //array('re_m_password','m_password','确认密码与密码不一致！',self::EXISTS_VALIDATE,'confirm'), // 验证确认密码是否和密码一致
    );
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
    public function selectMember($where = array(), $order = '', $page_size = '', $parameter = array())
    {
        if ($where['status'] == '' || empty($where['status']) && $where['status'] != 0) {
            $where['status'] = array('neq', '9');
        }
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
     *
     * 添加会员
     */
    public function addMember($data)
    {
        if (empty($data)) {
            return false;
        }
        $result = $this->data($data)->add();
        return $result;
    }

    /**
     *
     * 多条数据同时添加
     */
    public function addMemberAll($data)
    {
        if (empty($data)) {
            return false;
        }
        $result = $this->addAll($data);
        return $result;
    }

    /**
     * 查询一条数据
     */
    public function findMember($where, $field)
    {
        if ($where['status'] == '' || empty($where['status'])) {
            $where['status'] = array('neq', '9');
        }
        $result = $this->where($where)->field($field)->find();
        return $result;
    }

    /**
     * 编辑会员
     */
    public function editMember($where, $data)
    {
        if (empty($where) || empty($data)) {
            return false;
        }
        $result = $this->where($where)->data($data)->save();
        return $result;
    }

    /**
     * 删除会员
     */
    public function deleteMember($where)
    {
        if (empty($where)) {
            return false;
        }
        $result = $this->where($where)->delete();
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

    /*
         * 发送邮件
         */
    public function sendEmail($user, $name, $info, $body)
    {
        $email = D('Email', 'Service');
        $result = $email->sendEmail($user, $name, $info, $body);
        return $result;
    }
}
