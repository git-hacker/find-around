<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		$this -> key = "AJ3BZ-EPVCQ-NEY5U-G5H5V-2THSH-XFFI4";//"AJ3BZ-EPVCQ-NEY5U-G5H5V-2THSH-XFFI4";
		$this -> searchurl = "https://apis.map.qq.com/ws/place/v1/search?";
		$this -> history = M('history');
	}
	//检索关键词
	public function search(){
		$data['uid'] = $_POST['uid'];
        $data['keyword'] = $this -> filter_mark($_POST['keyword']);
        $has = $this -> history -> where( $data ) -> limit(1) -> select();
		$data['lat'] = $_POST['latitude'];
		$data['lnt'] = $_POST['longitude'];
        $distinct = $_POST['distinct'];
        if (empty($distinct)) {
            $distinct = 1000;
        }
		$data['ctime'] = time();
		$data['status'] = 0;
		
		$where['keyword'] = urlencode($data['keyword']);
		$where['boundary'] = "nearby(".$data['lat'].",".$data['lnt'].",$distinct)";
		$where['key'] = $this -> key;

		if (!empty($_POST['filter'])) {
			$where['filter'] = $_POST['filter'];
		}
		$this -> searchurl = "https://apis.map.qq.com/ws/place/v1/search?keyword=".$where['keyword']."&boundary=nearby(".$data['lat'].",".$data['lnt'].",$distinct)&key=".$where['key'];
		$res1 = json_decode($this -> curl( "" , $this -> searchurl , "get" ),true);
		if ($res1['status']==110) {
			$res1['url']= $this -> searchurl;
		}elseif ($res1['status']==0 && $res1['count']>0) {
            if (!empty($has)) {
                $res = $this -> history -> where('id='.$has[0]['id'])->setInc('num');
            }else {
                $res = $this -> history -> add( $data );
            }
            if ($has[0]['status'] == 9) {
                $newdata['id'] = $has[0]['id'];
                $newdata['status'] = 0;
                $res = $this -> history -> save( $newdata );
            }
		}
		print json_encode($res1);
	}
    //删除历史记录
    public function removehis(){
        $where['uid'] = $_POST['uid'];
        $data['keyword'] = $this -> filter_mark($_POST['keyword']);
        $data['status'] = 9;
        $res = $this -> history ->where($where)->save($data);
        if (!empty($res)) {
            apiResponse("success","删除成功！");
        }else{
            apiResponse("error","删除失败！");
        }
    }   

	//添加新的标注点
	public function addMarker(){
		$data['uid'] = $_POST['uid'];
		$data['lat'] = $_POST['lat'];
		$data['lnt'] = $_POST['lnt'];
		$data['address'] = $_POST['address'];
		$data['photo'] = $_POST['photo'];
		$data['remark'] = $_POST['remark'];
		$data['keyword'] = $this -> filter_mark($_POST['keyword']);
		$data['ctime'] = time();
		$data['status'] = 0;
		$data['type'] = "";
		$markets = M('markets');

		$res = $markets -> add( $data );

		if (!empty($res)) {
			apiResponse("success","等待审核！",$data);
		}else{
			apiResponse("error","上传失败！");
		}
	}


	//去除中英文标点符号
	function filter_mark($text){ 
		if(trim($text)=='')return ''; 
		$text=preg_replace("/[[:punct:]\s]/",' ',$text); 
		$text=urlencode($text); 
		$text=preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99|%EF%BD%9E|%EF%BC%8E|%EF%BC%88)+/",' ',$text); 
		$text=urldecode($text); 
		return trim($text); 
	} 
	//获取关键热门词和历史搜索记录
	public function index(){
		$where['uid'] = $_POST['uid'];
		$sql = "SELECT `keyword`,SUM(`num`) AS num FROM `map_history` WHERE 1 GROUP BY (`keyword`) ORDER BY (`num`) DESC LIMIT 10";
		$Model = new \Think\Model();
		$res1 = $Model-> query( $sql );
        $where['status'] = array('neq','9');
        $res = $this -> history->field('keyword')->where($where)->order('ctime desc')->limit(9) -> select();
		if (!empty($res) || !empty($res1)) {
			$data = array( $res,$res1 );
			apiResponse("success","查询成功！",$data);
		}else{
			apiResponse("error","数据查找失败！");
		}
	}

	public function curl($data,$url,$type="post"){
        $ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_USERAGENT,  'Mozilla/5.0 (compatible;MSIE 5.01;Windows NT5.0)');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
        return $file_contents;
    }

	public function httpsRequest($url,$data = null,$xparam){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        $Appid = "5a49a451";
        $Appkey = "93d4311daa52485a940b09319ed921ed";
        $curtime = time();
        $CheckSum = md5($Appkey.$curtime.$xparam.$data);
        $headers = array(
        	'X-Appid:'.$Appid,
        	'X-CurTime:'.$curtime,
        	'X-CheckSum:'.$CheckSum,
        	'X-Param:'.$xparam,
        	'Content-Type:'.'application/x-www-form-urlencoded; charset=utf-8'
        	);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /*语音识别对接科大讯飞*/
    public function getTextVal(){
    	$str = "下雨了没";
    	if (!empty($_GET['name'])) {
    		$str = $_GET['name'];
    	}
    	$name = base64_encode($str);
        $url = "https://api.xfyun.cn/v1/aiui/v1/text_semantic";
        $data = "text=$name";
        $xparam = base64_encode( json_encode(array('scene' => 'main','userid'=>'user_0001' )));
        $res = $this->httpsRequest($url,$data,$xparam);
        dump($res);
    }

    public function getVoice($d){
        $url = "https://api.xfyun.cn/v1/aiui/v1/voice_semantic";
        $xparam = base64_encode( json_encode(array('scene' => 'main','userid'=>'user_0001',"auf"=>"16k","aue"=>"raw","spx_fsize"=>"60" )));
    	file_put_contents('data.txt',$d);
    	$data = "data=".$d;
    	$res = $this->httpsRequest($url,$data,$xparam);
        file_put_contents('res.txt',$res);
        // dump($res);
        // exit();
    	//$res['p'] = $p;
        return $res;
    }
    //编解码加语音识别技术
    public function wxupload(){
        $upload_res=$_FILES['viceo'];
        $tempfile = file_get_contents($upload_res['tmp_name']);
        $wavname = substr($upload_res['name'],0,strripos($upload_res['name'],".")).".wav";
        $arr = explode(",", $tempfile);
        $path = 'Aduio/'.$upload_res['name'];
        if ($arr && !empty(strstr($tempfile,'base64'))){
        	file_put_contents($path, base64_decode($arr[1]));
        	$res = $this->getVoice($arr[1]);
        }else{
            $path = 'Aduio/'.$upload_res['name'];
            $newpath = 'Aduio/'.$wavname;
        	file_put_contents($path, $tempfile);
            chmod($path, 0777);
            $exec1 = "avconv -i /home/wwwroot/mapxcx.kanziqiang.top/$path -vn -f wav /home/wwwroot/mapxcx.kanziqiang.top/$newpath";
            exec($exec1,$info,$status);
            chmod($newpath, 0777);
            //$d = base64_encode(file_get_contents("./".$newpath));
            $d = file_get_contents("./".$newpath);
	        if ( !empty($tempfile) && $status == 0 ) {
	        	$res = $this->getVoice(base64_encode($d));
	        }else{
                $res = json_encode(array('code'=>'9999','desc'=>'exec执行失败！'));
            }
        }
        echo $res;
        exit();
    }

    public function picupload(){
        // $upload_res=$this->upload();
        $upload_res=$_FILES['pic'];
        $tempfile = file_get_contents($upload_res['tmp_name']);
        $path = 'Uploads/'.uniqid().".".array_pop(explode(".", $upload_res['name']));
        $res = file_put_contents($path, $tempfile);
        if( !empty($res)){
            $this -> apiResponse("success","上传成功！","/$path");
         }else{
            $this -> apiResponse("error","上传失败！");
         }
    }

    function apiResponse($flag = 'error', $message = '',$data = array()){
        $result = array('flag'=>$flag,'message'=>$message,'data'=>$data);
        print json_encode($result);exit;
    }
}