<?php
namespace Api\Controller;
use Think\Controller;
class ReportController extends Controller {
	public function _initialize(){
		$this -> report = M('Report');
	}

	public function setReport(){
		$data['uid'] = $_POST['uid'];
		$data['lat'] = $_POST['lat'];
		$data['lnt'] = $_POST['lnt'];
		$data['pic'] = $_POST['pic'];
		$data['content'] = $_POST['content'];
		$data['ctime'] = time();
		$data['utime'] = time();
		$data['status'] = 0;
		$res = $this -> report -> add( $data );

		if (!empty($res)) {
			apiResponse("success","等待审核！",$data);
		}else{
			apiResponse("error","上传失败！");
		}
	}

}