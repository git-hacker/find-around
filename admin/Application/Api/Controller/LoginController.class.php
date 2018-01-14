<?php
namespace Api\Controller;
use Think\Controller;
class LoginController extends Controller {
	//获取用户 openid
    public function getOpenid(){
    	$js_code = $_POST['js_code'];
    	$appId = "wxe900513990933078";
    	$appKey = "8844c389cef08accd7ea86abfffbfb7e";
    	$url = "https://api.weixin.qq.com/sns/jscode2session?appid=$appId&secret=$appKey&js_code=$js_code&grant_type=authorization_code";
    	echo $this -> curl("",$url);

    	exit();
    }

    public function curl($data,$url){
        $ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$headers = array(
        	'content-type:'.'application/json'
        	);
		curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
        return $file_contents;
    }

	//用户登录
	public function authlogin(){
		$openid = $_POST['openid'];
		if (!$openid) {
			echo json_encode(array('status'=>0,'err'=>'授权失败！'.__LINE__));
			exit();
		}
		$con = array();
		$con['openid']=trim($openid);
		$uid = M('user')->where($con)->getField('id');
		if ($uid) {
			$userinfo = M('user')->where('id='.intval($uid))->find();
			if (intval($userinfo['del'])==1) {
				echo json_encode(array('status'=>0,'err'=>'账号状态异常！'));
				exit();
			}
			$err = array();
			$err['ID'] = intval($uid);
			$err['NickName'] = $_POST['NickName'];
			$err['HeadUrl'] = $_POST['HeadUrl'];
			echo json_encode(array('status'=>1,'arr'=>$err));
			exit();
		}else{
			$data = array();
			$data['name'] = $_POST['NickName'];
			$data['uname'] = $_POST['NickName'];
			$data['photo'] = $_POST['HeadUrl'];
			$data['sex'] = $_POST['gender'];
			$data['pwd'] = md5("123456");
			$data['openid'] = $openid;
			$data['source'] = 'wx';
			$data['addtime'] = time();
			if (!$data['openid']) {
				echo json_encode(array('status'=>0,'err'=>'授权失败！'.__LINE__));
				exit();
			}
			$res = M('user')->add($data);
			if ($res) {
				$err = array();
				$err['ID'] = intval($res);
				$err['NickName'] = $data['name'];
				$err['HeadUrl'] = $data['photo'];
				echo json_encode(array('status'=>1,'arr'=>$err));
				exit();
			}else{
				echo json_encode(array('status'=>0,'err'=>'授权失败！'.__LINE__));
				exit();
			}
		}
	}
}