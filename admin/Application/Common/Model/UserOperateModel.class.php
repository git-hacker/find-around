<?php
namespace Common\Model;
use Think\Model;

/**
 * Class UserOperateModel
 * @package Api\Model
 * 会员操作  注册 登录
 * 发送邮件 发送短信
 */
class UserOperateModel extends Model{
    protected $tableName = 'user_operate';

    /**
     * 查询一条数据
     */
    public function findUserOperate($where){
        if(empty($where)){
            return false;
        }
        $result = $this->where($where)->find();
        return $result;
    }

    /**
     *发送短信验证码
     *注册时  登录时
     * @param $mobile 电话
     * @param $type 操作类型   bind 绑定  newBind新绑定
     * @return array
     */
    public function sendVerify($mobile,$type,$port){
        //验证号码合法性
        if(!preg_match(C('MOBILE'),$mobile)){
            return array('error'=>'貌似没这手机号哟~');exit;
        }

        //操作类型  type activate注册   retrieve找回  bind绑定手机号
        if($type == 'bind'){
//            $body = '【众享通赢】您的找回密码的验证码为:';
            $member_obj = M('Member');
            //验证手机号是否存在
            $member = $member_obj->where(array('m_account'=>$mobile))->find();
        }elseif($type == 'newBind'){
//            $body = '【众享通赢】您的注册验证码为: ';
            $member = true;
        }else {
//            $body = '【众享通赢】您的验证码为:';
            $member = true;
        }
        if($member){
            //是否进行过此操作
            $operate = $this->where(array('way'=>$mobile,'type'=>$type,'port'=>$port))->find();
            $vc = getVc('num',4);//获取标识
            $expire_time = time()+600;//过期时间
            if($operate){
                /**每天只能进行三次操作**/
                if($operate['ctime'] > strtotime(date('Y-m-d')) && $operate['ctime'] < strtotime(date('Y-m-d 23:59:59')) && intval($operate['times'])%10 == 0){
                    if($type == 'retrieve'){
                        return array('error'=>'每天只能进行五次找回密码操作');exit;
                    }elseif($type == 'activate'){
                        return array('error'=>'获取验证码次数超限，明天请重试！');exit;
                    }
                }else{
                    /**后一天操作  次数置一 否则次数加一**/
                    if($operate['ctime'] < strtotime(date('Y-m-d'))){
                        $times = 1;
                    }else{
                        $times = intval($operate['times']) + 1;
                    }
                    //修改记录
                    $res = $this->where(array('id'=>$operate['id']))->data(array('vc'=>$vc,'expire_time'=>$expire_time,'times'=>$times,'ctime'=>time()))->save();
                }
            }else{
                //添加记录
                $res = $this->data(array('way'=>$mobile,'vc'=>$vc,'times'=>1,'expire_time'=>$expire_time,'type'=>$type,'ctime'=>time(),'port'=>$port))->add();
            }
            if($res){
                //拼接发信内容
                $body = $vc;
//                $body .= '(若非本人操作请忽略)';
                //发送短信
                $send_msg_obj = D('SendMsg','Service');
                $result = $send_msg_obj->sendMsg($mobile,$body);
                if(empty($result['error'])){
                    return array('success'=>$result['success']);exit;
                }else{
                    return array('error'=>$result['error']);exit;
                }
            }else{
                return array('error'=>'操作失败，验证码发送太频繁');exit;
            }
        }else{
            return array('error'=>'您输入的手机号码不存在');exit;
        }
    }
}