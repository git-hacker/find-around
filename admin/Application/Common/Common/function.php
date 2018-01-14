<?php
/*************************** 公共函数 **********************/
/**
 *  1.时间转化
 *  2.图片路径转换
 *  3.object 转 array
 *  4.
 */

/******************************数组操作*******************************/


/**
 * array_slice(array,offset,length,preserve)
 * array 必需。规定输入的数组。
 * offset必需。数值。规定取出元素的开始位置。如果是正数，则从前往后开始取，如果是负值，从后向前取 offset 绝对值。
 * length 可选。数值。规定被返回数组的长度。如果 length 为正，则返回该数量的元素。
 * 如果 length 为负，则序列将终止在距离数组末端这么远的地方。如果省略，则序列将从 offset 开始直到 array 的末端。
 * preserve 可选。可能的值：true - 保留键 false - 默认 - 重置键
 *
 */

/**
 * 数组分页函数  核心函数  array_slice
 * 用此函数之前要先将数据库里面的所有数据按一定的顺序查询出来存入数组中
 * $count   每页多少条数据
 * $page   当前第几页
 * $array   查询出来的所有数组
 * order 0 - 不变     1- 反序
 */

function page_array($count,$page,$array,$order){
	global $countpage; #定全局变量
	$page=(empty($page))?'1':$page; #判断当前页面是否为空 如果为空就表示为第一页面
	$start=($page-1)*$count; #计算每次分页的开始位置
	if($order==1){
		$array=array_reverse($array);
	}
	$totals=count($array);
	$countpage=ceil($totals/$count); #计算总页面数
	$pagedata=array();
	$pagedata=array_slice($array,$start,$count);
	return $pagedata;  #返回查询数据
}
/**
 * 分页及显示函数
 * $countpage 全局变量，照写
 * $url 当前url
 */
function show_array($countpage,$url){
	$page=empty($_GET['page'])?1:$_GET['page'];
	if($page > 1){
		$uppage=$page-1;

	}else{
		$uppage=1;
	}

	if($page < $countpage){
		$nextpage=$page+1;

	}else{
		$nextpage=$countpage;
	}

	$str='<div style="border:1px; width:300px; height:30px; color:#9999CC">';
	$str.="<span>共  {$countpage}  页 / 第 {$page} 页</span>";
	$str.="<span><a href='$url?page=1'>   首页  </a></span>";
	$str.="<span><a href='$url?page={$uppage}'> 上一页  </a></span>";
	$str.="<span><a href='$url?page={$nextpage}'>下一页  </a></span>";
	$str.="<span><a href='$url?page={$countpage}'>尾页  </a></span>";
	$str.='</div>';
	return $str;
}

/**
 *方法名称：json 转换成数组
 *方法功能：
 *不为空参数：
 *可为空参数：
 *提交参数：
 * @param $json_value
 * @return array*
 *
 */

function json_array($json_value){
	$value_object = json_decode($json_value);
	$value_array  =  object_array($value_object);
	return $value_array;
}



/*****************END*************数组操作************END*******************/


/**
 * @param string $flag 'char'标记 获取字符串   'num' 标记获取数字
 * @param int $num 验证标识的个数
 * @return string
 */
function getVc($flag = '', $num = 0){
    /**获取验证标识**/
    $arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',1,2,3,4,5,6,7,8,9,0);
    $vc = '';
    //字符串
    if($flag == 'char'){
        for($i = 0; $i < $num; $i++){
            $index = rand(0,61);
            $vc .= $arr[$index];
        }
        $vc .= time();
    }elseif($flag == 'num'){  //数字
        for($i = 0; $i < $num; $i++){
            $index = rand(52,61);
            $vc .= $arr[$index];
        }
    }
    return $vc;
}
/**
 * 获得天数 return day_num
 */
function getDayNum($year,$month){
	if(in_array($month,array('01','03','05','07','08','10','12'))){
		$day_num = 31;
	}elseif(in_array($month,array('04','06','09','11'))){
		$day_num = 30;
	}else{
		if ($year%4==0 && ($year%100!=0 || $year%400==0)) {
			$day_num = 29;
		}else{
			$day_num = 28;
		}
	}
	return $day_num;
}
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen));
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129)
                {
                    $tmpstr.= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        //if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}
/**
 * @param $mobile
 * @return mixed
 * @param $mobile
 * 隐藏手机号中间四位
 */
function hide_mobile($mobile) {
    return str_replace(substr($mobile,3,4),'****',$mobile);
}
/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}
/**
 * @param $str
 * @return array|null
 * 从字符串中提取数字转换成数组
 */
function findNumToArr($str){
    $str = trim($str);
    if(empty($str)){
        return null;
    }else{
        $result = '';
        for($i=0; $i<strlen($str); $i++){
            if(is_numeric($str[$i])){
                $result .= $str[$i];
            }else{
                $result .= ',';
            }
        }
        $arr = explode(',',$result);
        foreach($arr as $k=>$v){
            if( !$v ){
                unset($arr[$k]);
            }
        }
        return $arr;
    }
}


/**剥离转义
 * @param $string
 *
 * @return array|string
 */
function sstripslashes($string){
	if(is_array($string)){
		foreach($string as $key => $val){
			$string[$key] = sstripslashes($val);
		}
	}else{
		$string = stripslashes($string);
	}
	return $string;
}
/**
 * 过滤掉html标签 2013-8-3 15:06:38
 * */
function filterHtml($str){
	if(is_array($str)){
		foreach($str as $key => $val){
			$str[$key] = sstripslashes(preg_replace("/(\<[^\<]*\>|\r|\n|\s|\&nbsp;|\[.+?\])/is", '', $val));
		}
	}else{
		$str = preg_replace("/(\<[^\<]*\>|\r|\n|\s|\&nbsp;|\[.+?\])/is", '', $str);
	}
	return $str;
}

/**获得图片缩略图文件名
 * @param $filename
 *
 * @return string
 */
function getThumb($filename){
	$dir=substr($filename,0,6);
	$name=substr($filename,7,17);
	return $dir.'/thumb_'.$name;
}

/**
 * 删除文件
 * @param $filename
 * @param $dirname
 *
 * @return bool
 */
function delPicFile($filename,$dirname){
	if(!empty($filename)){
		unlink('./Uploads/'.$dirname.'/'.$filename);
		$dir  = substr($filename,0,6);
		$file = substr($filename,7,17);
		unlink('./Uploads/'.$dirname.'/'.$dir.'/'.C('THUMB_PREFIX').$file);
	}
	return true;
}

/**合并数组,重组数组键值，删除空元素,会丢失数组的字符键值，只保存重组后的数字键值
 * @param $arr1
 * @param $arr2
 *
 * @return array
 */
function arrMerge($arr1,$arr2){
	if(empty($arr1))return $arr2;
	if(empty($arr2))return $arr1;
	if(!is_array($arr1))$arr1[]=$arr1;
	if(!is_array($arr2))$arr2[]=$arr2;
	foreach($arr1 as $k=>$v){
		if(!empty($v))$arr[]=$v;
	}
	foreach($arr2 as $k=>$v){
		if(!empty($v))$arr[]=$v;
	}
	return $arr;
}

/**
 * @param $dir
 * @param $file
 *
 * @return string
 */
function getAbsolutelyUrl($dir,$file){
	return C('API_URL').'/Uploads/'.$dir.'/'.$file;
}

/**API返回信息格式函数
 * @param        $message
 * @param string $flag
 */
function apiResponse($flag = '', $message = '',$data = ''){
    $response = array('flag' => $flag,'message' => $message,'data' => $data);
    print json_encode($response);exit;
}


/**
 * 格式化价格
 */
function priceFormat($price) {
    return '￥' . $price . '元';
}
/**
 * 创建像这样的查询: "IN('a','b')";
 * @access   public
 * @param    mix      $item_list      列表数组或字符串
 * @param    string   $field_name     字段名称
 * @return   void
 */
function db_create_in($item_list, $field_name = ''){
	if (empty($item_list)) {
		return $field_name . " IN ('') ";
	}
	else {
		if (!is_array($item_list)) {
			$item_list = explode(',', $item_list);
		}
		$item_list = array_unique($item_list);
		$item_list_tmp = '';
		foreach ($item_list AS $item) {
			if ($item !== '') {
				$item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
			}
		}
		if (empty($item_list_tmp)) {
			return $field_name . " IN ('') ";
		}
		else {
			return $field_name . ' IN (' . $item_list_tmp . ') ';
		}
	}
}

/**上传*/
    function uploadPic($pic,$pic_name){
        $temp = explode('.', $pic_name);
        $ext = uniqid() . '.' . end($temp);
        $base64 = substr(strstr($pic, ","), 1);
        $image_res = base64_decode($base64);
        $pic_link = "Uploads/Member/" . date('Y-m-d') . '/' . $ext;
        $saveRoot = "Uploads/Member/" . date('Y-m-d') . '/';
        //检查目录是否存在  循环创建目录
        if (!is_dir($saveRoot)) {
            mkdir($saveRoot, 0777, true);
        }
        $res = file_put_contents($pic_link, $image_res);
        if ($res) {
            return $pic_link;
        }else{
            return "error";
        }
    }

/**
 * 数组去重
 */
function unique_arr($array2D,$stkeep=false,$ndformat=true)
{
	// 判断是否保留一级数组键 (一级数组键可以为非数字)
	if($stkeep) $stArr = array_keys($array2D);
	// 判断是否保留二级数组键 (所有二级数组键必须相同)
	if($ndformat) $ndArr = array_keys(end($array2D));
	//降维,也可以用implode,将一维数组转换为用逗号连接的字符串
	foreach ($array2D as $v){
		$v = join(",",$v);
		$temp[] = $v;
	}
	//去掉重复的字符串,也就是重复的一维数组
	$temp = array_unique($temp);
	//再将拆开的数组重新组装
	foreach ($temp as $k => $v)
	{
		if($stkeep) $k = $stArr[$k];
		if($ndformat)
		{
			$tempArr = explode(",",$v);
			foreach($tempArr as $ndkey => $ndval) $output[$k][$ndArr[$ndkey]] = $ndval;
		}
		else $output[$k] = explode(",",$v);
	}
	return $output;
}
/**
 * 手机星号
 * @param  $mobilephone 手机号号码
 */
function mobiletosecret($mobilephone){
	if(preg_match('/^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/',$mobilephone)){
		return substr($mobilephone,0,4)."****".substr($mobilephone,8,3);
	}else{
		return false;
	}
}
/**
 * 姓名星号
 * @param  $name 
 */
function strosecret($name){
		return mb_substr($name,0,2,"utf-8")."***".mb_substr($name,-2,2,"utf-8");
}
/**
 * 生成订单号 
 */
function get_sn() {
        return date('YmdHis').rand(1000, 9999);
}
/**
 * checkData
 * POST提交
 */
function checkData($parameter=null){
	if(!empty($parameter)){
		$parameter = explode(',',$parameter);
		foreach($parameter as $v){
			if((!isset($_POST[$v]))||(empty($_POST[$v]))){
				if($_POST[$v]!==0 && $_POST[$v]!=='0')
					apiResponse('error','参数'.$v.'不存在或为空');
			}
		}
	}
	$data = I('post.');
	unset($data['_URL_'],$data['token']);
	return $data;
}
/*****************BEGIN***********array()操作函数***************BEGIN**************************/

/**
 * 数组转换成字符串  2013-8-27 16:08:25
 * @param array $arr 要转换的数组
 * @return string $str 字符串   逗号分隔
 */
function arrayToString($arr=array()){
	//判断是否为字符串
	if(!is_array($arr)) return '';
	//记录循环次数
	$number = 0;
	//传入数组长度
	$length = count($arr);
	//返回的字符串
	$str='';
	//遍历数组
	foreach ($arr as $val){
		if($number==($length-1)){
			$str .= $val;
		}else{
			$str .= $val.',';
		}
		$number++;
	}
	return $str;
}

/**
 *方法名称：
 *方法功能：对象转化为数组
 ** @param $array
 * @return array*
 *
 */
function object_array($array) {
	if(is_object($array)) {
		$array = (array)$array;
	} if(is_array($array)) {
		foreach($array as $key=>$value) {
			$array[$key] = object_array($value);
		}
	}
	return $array;
}





/*****************END***********array()操作函数**END***************************************/


/*****************BEGIN***********日期&&时间操作函数***************BEGIN**************************/

/**
 * 按年-月-日返回时间
 */
function time_y_m_d($time){
	return date('Y-m-d',$time);
}

function time_ymdhm($time){
	return date('Y-m-d h:m',$time);
}

/**
 *方法描述：截取一段字符串中的汉字
 *@param $content  字符串
 * @param $int_begain 起始位置
 * @param $int_over 结束位置
 * @param $codetype 字符串类型
 * @return string
 *
 */
function mb_sub_str($content,$int_begain,$int_over,$codetype){
	if($codetype == ''){
		$codetype = 'utf-8';
	}
	return mb_substr($content,$int_begain,$int_over,$codetype);
}

/**
 *方法描述：数据库中 字符串型图片地址 转换成数组后 取第一张图片
 *@param $str_pic
 * @param $file_path  服务器上存储的文件夹路径 如 Uploads/Release
 * @return string 图片的路径
 *
 */

function pic_str_fir($str_pic,$file_path){
		$str_arr_pic =  explode(',',$str_pic);
		$pic_http_path  = 'http://'.$_SERVER['HTTP_HOST'].$file_path.$str_arr_pic[0];
		return $pic_http_path;
}

/**
 *方法功能：
 *不为空参数：获取图片地址，添加路径后，再以array return
 ** @param $str_pic  数据库中数据
 * @param $file_path  图片路径
 * @return string*
 *
 */
function pic_arr_all($str_pic,$file_path){
	$str_pic =  array_filter(explode(',', $str_pic));
	foreach($str_pic as $k=>$v ){
		$array_pic =  'http://'.$_SERVER['HTTP_HOST'].$file_path.$v;
	}
	return $array_pic;
}

/**
 *方法功能：获取图片地址，添加路径后，再以string 型输出
 ** @param $str_pic
 * @param $file_path 图片路径
 *
 */
function pic_str_all($str_pic,$file_path){
	//多张图地址按逗号截取字符串，截取后如果存在空数组则需要过滤掉
	$str_pic =  array_filter(explode(',',$str_pic));
	foreach($str_pic as $k => $v ){
		$arr_pic[] = 'http://'.$_SERVER['HTTP_HOST'].$file_path.$v;
	}
	$pic_http_path = implode(',',$arr_pic);
return $pic_http_path;
}



function time_awaystrtotime($enddate,$startdate){
	if(empty($startdate)){
		$startdate = time();
	}
     //PHP计算两个时间差的方法
	//$startdate = "2010-12-11 11:40:00";
	//$enddate = "2012-12-12 11:45:09";
	$date = floor((strtotime($enddate) - strtotime($startdate)) / 86400);
	$hour = floor((strtotime($enddate) - strtotime($startdate)) % 86400 / 3600);
	$minute = floor((strtotime($enddate) - strtotime($startdate)) % 86400 / 60);
	$second = floor((strtotime($enddate) - strtotime($startdate)) % 86400 % 60);
	echo $date . "天<br>";
	echo $hour . "小时<br>";
	echo $minute . "分钟<br>";
	echo $second . "秒<br>";

}

/**
 *方法名称：
 *方法功能：计算过去了多久
 ** @param $enddate
 * @param $startdate
 * @return string*
 *
 */
function time_away($enddate,$startdate){
	if(empty($startdate)){
		$startdate = time();
	}
	//PHP计算两个时间差的方法
	//$startdate = "2010-12-11 11:40:00";
	//$enddate = "2012-12-17 11:45:09";
	$date = floor(($enddate - $startdate) / 86400);
	$hour = floor(($enddate - $startdate) % 86400 / 3600);
	$minute = floor(($enddate - $startdate) % 86400 %3600/ 60);
	$second = floor(($enddate - $startdate) % 86400 % 60);
	if($date<30 &&$date > 7){
		$time = '一周前';
	}elseif($date > 30){
		$time = '一个月前';
	}
	elseif($date>1&&$date <7){
		$time = $date.'天前';
	}elseif($hour<24&&$hour>1){
		$time = $hour.'小时前';
	}elseif($minute<60&&$minute>1){
		$time = $minute.'分钟前';
	}elseif($minute < 1){
		$time = '刚刚';
	}else{
		$time = '一周前';
	}
    return $time;

}

/*****************END***********日期&&时间操作函数**END***************************************/


/** 身份证号码校验 BEGIN  **/
function validation_filter_id_card($id_card){
	if(strlen($id_card) == 18){
		return idcard_checksum18($id_card);
	}elseif((strlen($id_card) == 15)){
		$id_card = idcard_15to18($id_card);
		return idcard_checksum18($id_card);
	}else{
		return false;
	}
}
// 计算身份证校验码，根据国家标准GB 11643-1999
function idcard_verify_number($idcard_base){
	if(strlen($idcard_base) != 17){
		return false;
	}
	//加权因子
	$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
	//校验码对应值
	$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
	$checksum = 0;
	for ($i = 0; $i < strlen($idcard_base); $i++){
		$checksum += substr($idcard_base, $i, 1) * $factor[$i];
	}
	$mod = $checksum % 11;
	$verify_number = $verify_number_list[$mod];
	return $verify_number;
}
// 将15位身份证升级到18位
function idcard_15to18($idcard){
	if (strlen($idcard) != 15){
		return false;
	}else{
		// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
		if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
			$idcard = substr($idcard, 0, 6) . '18'. substr($idcard, 6, 9);
		}else{
			$idcard = substr($idcard, 0, 6) . '19'. substr($idcard, 6, 9);
		}
	}
	$idcard = $idcard . idcard_verify_number($idcard);
	return $idcard;
}
// 18位身份证校验码有效性检查
function idcard_checksum18($idcard){
	if (strlen($idcard) != 18) return false;
	$idcard_base = substr($idcard, 0, 17);
	if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
		return false;
	}else{
		return true;
	}
}
/** 身份证号码校验 END  **/

/** 截取文字 **/

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){

    if(function_exists("mb_substr")){

        if($suffix)

            return mb_substr($str, $start, $length, $charset)."...";

        else

            return mb_substr($str, $start, $length, $charset);

    }elseif(function_exists('iconv_substr')) {

        if($suffix)

            return iconv_substr($str,$start,$length,$charset)."...";

        else

            return iconv_substr($str,$start,$length,$charset);

    }

    $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";

    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";

    $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";

    $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";

    preg_match_all($re[$charset], $str, $match);

    $slice = join("",array_slice($match[0], $start, $length));

    if($suffix) return $slice."…";

    return $slice;

}
function decodeUnicode($str)
{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}




