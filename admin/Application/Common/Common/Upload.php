<?php
    /**
     * 异步上传图片
     * 2014-6-09
     * @param string $file_name  上传到服务器后的文件名 不填自动生成
     * @param string $folder    上传的Uploads中的文件夹
     * @param string $maxsize   上传限制
     * @param string $type  文件类型  数组形式
     * @param string $thumb_width  缩略图最大宽度
     * @param string $thumb_height 缩略图最大高度
     * @param string $thumb_pre 缩略图前缀
     * @param bool $is_thumb  是否生成缩略图  默认为false
     * @param bool $is_water  是否添加水印  水印图为Public/common/images中名为water.png的图片  默认为false
     */
    function ajaxUploadFile($file_name = '',$folder = '',$maxsize = '',$type = '',$thumb_width = '',$thumb_height = '',$thumb_pre = '',$is_thumb = false,$is_water = false){
        if($folder == ''){
            echo "{ error: 上传路径不正确 }";//错误信息
            return;
        }
        $save_path = "./Uploads/".$folder."/".date('Ym')."/";
        $upInfo = getUpLoadFiles($file_name,$save_path,$maxsize,$type,$thumb_width,$thumb_height,$thumb_pre,$is_thumb,$is_water);
        if(!is_array($upInfo)){
            //错误信息
            echo "{ error: '".$upInfo."' }";
            return;
        }else{
            if(!is_array($type)){
                //原图完整地址 因服务器不同 这里的路径可能需要更改
                $img = __ROOT__.$upInfo[0]['savepath'].$upInfo[0]['savename'];
                //原图小路径
                $data_img = date('Ym')."/".$upInfo[0]['savename'];
                if($is_thumb){
                    //缩略图完整地址
                    $thumb_img = __ROOT__.$upInfo[0]['savepath'].'thumb_'.$upInfo[0]['savename'];
                    //缩略图小路径
                    $data_thumb_img = date('Ym')."/thumb_".$upInfo[0]['savename'];
                }else{
                    $thumb_img = '';
                    $data_thumb_img = '';
                }
                //时间戳标记图片
                $flag = time();
                echo "{ img:'".$img."',thumb_img:'".$thumb_img."',data_img:'".$data_img."',data_thumb_img:'".$data_thumb_img."',flag:'".$flag."'}";
                return;
            }elseif(is_array($type)){
                //完整地址
                $file = __ROOT__.$upInfo[0]['savepath'].$upInfo[0]['savename'];
                //小路径
                $data_file = date('Ym')."/".$upInfo[0]['savename'];
                //时间戳标记图片
                $flag = time();
                echo "{ file: '".$file."',data_file:'".$data_file."',flag:'".$flag."'}";
                return;
            }
        }
    }

    /**
     * @param string $file_name
     * @param string $folder
     * @param string $maxsize
     * @param string $type
     * @param string $thumb_width
     * @param string $thumb_height
     * @param string $thumb_pre
     * @param bool $is_thumb
     * @param bool $is_water
     * @return array
     * 普通上传图片或文件
     * return  逗号隔开的小路径
     */
    function uploadFile($file_name = '',$folder = '',$maxsize = '',$type = '',$thumb_width = '',$thumb_height = '',$thumb_pre = '',$is_thumb = false,$is_water = false){
        if($folder == ''){
            return array('error'=>'上传路径不正确');
        }
        $save_path = "./Uploads/".$folder."/".date('Ym')."/";
        $upInfo = getUpLoadFiles($file_name,$save_path,$maxsize,$type,$thumb_width,$thumb_height,$thumb_pre,$is_thumb,$is_water);
        //上传错误
        if(!is_array($upInfo)){
            return array('error'=>$upInfo);exit;
        }else{
            $str = '';
            foreach($upInfo as $value){
                $str .= date('Ym')."/".$value['savename'].',';
            }
        }
        return array('success'=>substr($str,0,strlen($str)-1));exit;
    }

    /**
     * 剪切图片
     */
    function cutImg(){
        //初始化截取图片操作类
        $img_resize = new \Think\ImageResize();
        //加载上传的图片
        $url = './Uploads/HeadCache/'.trim(I('post.img_str'));
        $img_resize->load($url);
        //修改图片大小   待用...
        /*if (intval($_POST['w']) > 0 && intval($_POST['h']) > 0){
            $img_resize->resize(intval($_POST['w']), intval($_POST['w']));
        }*/
        //截取后图片的宽高
        $width = intval(I('post.id_right'))-intval(I('post.left'));
        $height = intval(I('post.id_bottom'))-intval(I('post.top'));
        //裁剪图片  宽  长  横坐标 纵坐标
        $img_resize->cut($width, $height, intval(I('post.left')), intval(I('post.top')));

        //截取后的保存路径
        $save_path = "./Uploads/Head/";
        //判断保存路径是否存在  不存在就创建
        if(!is_dir($save_path.date('Ym'))){
            if(!mkdir($save_path.date('Ym'))){
                return false;
            }
        }
        //截取后保存图片
        $cut_res = $img_resize->save($save_path . I('post.img_str'));
        if($cut_res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 参数：$name-定义文件上传命名规则
     *       $url-原图保存地址
     *       $maxsize-文件最大 大小
     *       $type-上传文件类型
     *       $width-缩略图宽
     *       $height-缩略图高
     *       $thumb_pre-缩略图前坠名
     *       $is_thumb 是否生成缩略图
     *       $is_water 是否添加水印
     * 成功返回 上传后的信息
     * 失败返回异常名称
     * */
    function getUpLoadFiles($name,$url,$maxsize,$type,$width,$height,$thumb_pre,$is_thumb = false,$is_water = false){
        $upload = new \Think\UploadFile();
        $upload->saveRule       = !empty($name) ? $name : 'uniqid'; //保存文件命名规则 如果不是规则的关键字 默认设为上传的文件名称
        $upload->savePath       = isset($url) ? $url : './Uploads'.date("Ym").'/';
        $upload->maxSize        = !empty($maxsize) ? $maxsize : 20480000;
        $upload->allowExts      = is_array($type) ? $type : array('jpg','png','jpeg','bmp','gif');
        $upload->water          = $is_water;//是否添加水印
        if($is_thumb){
            //生成缩略图
            $upload->thumb          = true;
            $upload->thumbPath      = isset($url) ? $url : './Uploads'.date("Ym").'/';
            $upload->thumbPrefix    = !empty($thumb_pre) ? $thumb_pre : C('THUMB_PREFIX');
            $upload->thumbMaxWidth  = $width;
            $upload->thumbMaxHeight = $height;
            $upload->uploadReplace  = true;
        }
        if($upload->Upload()){
            $info = $upload->getUploadFileInfo();
            return $info;
        }else{
            return $upload->getErrorMsg();
        }
    }