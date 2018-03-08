> 前不久写了个工具型微信小程序（Find周边），里面用到了语音识别技术。现将实现细节整理如下：

**接口预览**  

通过阅读了解[科大讯飞接口文档](http://aiui.xfyun.cn/help/devDoc#3-3-3)、[小程序接口开发文档](https://mp.weixin.qq.com/debug/wxadoc/dev/api)以及对后端ThinkPhp框架的学习，我整理了如下开发步骤:  

- 注册科大讯飞账号(**国人的骄傲，全球领先的语音识别技术**)
- 进入AIUI开放平台在应用管理创建应用并记录APPID和ApiKey
- 进入应用配置，配置符合自己的情景模式、识别方式和技能
- 进行小程序开发录制需要识别的音频（下有详述）
- 后端转码录制的音频（科大讯飞支持pcm、wav），提交给识别接口（下有详述）
- 小程序接到识别结果进行接下来业务

**音频录制接口**  

* wx.startRecord()和wx.stopRecord()  

> wx.startRecord()和wx.stopRecord()接口也可以满足需求，但从1.6.0 版本开始不再被微信团队维护。建议使用能力更强的 wx.getRecorderManager 接口。该接口获取到的音频格式为silk。  
**silk是webm格式通过base64编码后的结果，我们解码后需要将webm转换成pcm、wav**

* wx.getRecorderManager()  
> 相对wx.startRecord()接口，该接口提供的能力更为强大([详情](https://mp.weixin.qq.com/debug/wxadoc/dev/api/getRecorderManager.html))，可以暂停录音也可以继续录音，根据自己需求设置编码码率，录音通道数，采样率。最让人开心的是可以指定音频格式，有效值 aac/mp3。不好的是wx.getRecorderManager()在1.6.0才开始被支持。当然如果你要兼容低端微信用户需要使用wx.startRecord()做兼容处理。

* 事件监听细节

```
// wxjs:

const recorderManager = wx.getRecorderManager()
recorderManager.onStart(() => {
    //开始录制的回调方法
})
//录音停止函数
recorderManager.onStop((res) => {
  const { tempFilePath } = res;
  //上传录制的音频
  wx.uploadFile({
    url: app.d.hostUrl + '/Api/Index/wxupload', //仅为示例，非真实的接口地址
    filePath: tempFilePath,
    name: 'viceo',
    success: function (res) {
        console.log(res);
    }
  })
})

Page({
    //按下按钮--录音
  startHandel: function () {
    console.log("开始")
    recorderManager.start({
      duration: 10000
    })
  },
  //松开按钮
  endHandle: function () {
    console.log("结束")
    //触发录音停止
    recorderManager.stop()
  }
})

//wxml:
<view bindtouchstart='startHandel' bindtouchend='endHandle' class="tapview">
    <text>{{text}}</text>
</view>
```

**音频转换**

我这边后端使用php的开源框架[thinkphp](http://www.thinkphp.cn/),当然node、java、python等后端语言都可以，你根据自己的喜好和能力来。想做好音频转码我们就要借助音视频转码工具ffmpeg、avconv，它们都依赖于gcc。安装过程大家可以自行百度，或者关注我后面的文章。

```
<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
	
    //音频上传编解码
    public function wxupload(){
        $upload_res=$_FILES['viceo'];
        $tempfile = file_get_contents($upload_res['tmp_name']);
        $wavname = substr($upload_res['name'],0,strripos($upload_res['name'],".")).".wav";
        $arr = explode(",", $tempfile);
        $path = 'Aduio/'.$upload_res['name'];
        
        if ($arr && !empty(strstr($tempfile,'base64'))){
            //微信模拟器录制的音频文件可以直接存储返回
        	file_put_contents($path, base64_decode($arr[1]));
        	$data['path'] = $path;
        	apiResponse("success","转码成功！",$data);
        }else{
            //手机录音文件
            $path = 'Aduio/'.$upload_res['name'];
            $newpath = 'Aduio/'.$wavname;
        	file_put_contents($path, $tempfile);
            chmod($path, 0777);
            $exec1 = "avconv -i /home/wwwroot/mapxcx.kanziqiang.top/$path -vn -f wav /home/wwwroot/mapxcx.kanziqiang.top/$newpath";
            exec($exec1,$info,$status);
            chmod($newpath, 0777);
	        if ( !empty($tempfile) && $status == 0 ) {
	        	$data['path'] = $newpath;
	        	apiResponse("success","转码成功！",$data);
	        }
        }
        apiResponse("error","发生未知错误！");
    }
    //json数据返回方法封装
    function apiResponse($flag = 'error', $message = '',$data = array()){
        $result = array('flag'=>$flag,'message'=>$message,'data'=>$data);
        print json_encode($result);exit;
    }
}

```

**调用识别接口**

当我们把文件准备好之后，接下来我们就可以将base64编码之后的音频文件通过api接口请求传输过去。期间我们要注意严格按照文档中所说的规范传输，否则将造成不可知的结果。


```
<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
	}
	//封装数据请求方法
	public function httpsRequest($url,$data = null,$xparam){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        $Appid = "";//开放平台的appid
        $Appkey = "";//开放平台的Appkey
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
    //请求接口数据处理
    public function getVoice($path){
        $d = base64_encode($path);
        $url = "https://api.xfyun.cn/v1/aiui/v1/voice_semantic";
        $xparam = base64_encode( json_encode(array('scene' => 'main','userid'=>'user_0001',"auf"=>"16k","aue"=>"raw","spx_fsize"=>"60" )));
    	$data = "data=".$d;
    	$res = $this->httpsRequest($url,$data,$xparam);
    	if(!empty($res) && $res['code'] == 00000){
    	    apiResponse("success","识别成功！",$res);
    	}else{
    	    apiResponse("error","识别失败！");
    	}
    }
    //数据返回封装
    function apiResponse($flag = 'error', $message = '',$data = array()){
        $result = array('flag'=>$flag,'message'=>$message,'data'=>$data);
        print json_encode($result);exit;
    }
}
```
到这里基本就完成了。以上代码是经过整理之后的，并不一定能够满足各位的实际开发需求。如果发现不当之处欢迎微信交流（xiaoqiang0672）。

想看实际案例的可以微信扫码
-
![小程序码](https://user-gold-cdn.xitu.io/2018/2/7/1616f10526c061ec?w=258&h=258&f=jpeg&s=44125)