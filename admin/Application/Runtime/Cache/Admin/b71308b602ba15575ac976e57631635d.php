<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link rel="stylesheet" href="/api/Public/Admin/css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/api/Public/Admin/css/toocms.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/api/Public/Admin/css/invalid.css" type="text/css" media="screen" />
<script type="text/javascript" src="/api/Public/Common/js/jquery-1.9.1.min.js"></script>
<!--<script type="text/javascript" src="/api/Public/Admin/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="/api/Public/Admin/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/holder.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/global.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/Validformextend.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/layer/layer.js"></script>
</head>
<body>
<script type="text/javascript" src="/api/Public/Admin/js/ajax-operate.js"></script>
<!--主页面-->
<div id="main-content" class="content">
    <!--<ul class="breadcrumb">
        <li><a href="<?php echo U('Index/main');?>">首页</a></li>
        <li class=""><a href="">轮播管理</a></li>
        <li class="active">添加轮播</li>
    </ul>-->

    <div class="page-header page-header1 clearfix">
        <h3>轮播管理</h3>
        <ul class="nav nav-tabs">
            <li>
                <a href="<?php echo U('Inpic/inpiclist');?>">轮播列表</a>
            </li>
            <li class="active">
                <a href="<?php echo U('Inpic/addinpic');?>">添加轮播</a>
            </li>
        </ul>
    </div>

        <!--表格内容-->
        <div class="content-box-content">
            <!--表单 start-->
            <form action="<?php echo U('Inpic/addinpic');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                
                <div class="form-group" id="">
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>跳转：</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="href"  placeholder="请输入跳转链接">
                    </div>
                </div>
                
                <div class="form-group" id="">
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>描述：</label>
                    <div class="col-sm-9">
                        <textarea name="desc" id="" cols="80" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group" id="">
                    <script>
                        function PreviewImage1(imgFile)
                        {
                            var filextension=imgFile.value.substring(imgFile.value.lastIndexOf("."),imgFile.value.length);
                            filextension=filextension.toLowerCase();
                            if ((filextension!='.jpg')&&(filextension!='.gif')&&(filextension!='.jpeg')&&(filextension!='.png')&&(filextension!='.bmp'))
                            {
                                alert("对不起，系统仅支持标准格式的照片，请您调整格式后重新上传，谢谢 !");
                                imgFile.focus();
                            }
                            else
                            {
                                var path;
                                if(document.all)//IE
                                {
                                    imgFile.select();
                                    path = document.selection.createRange().text;
                                    document.getElementById("imgPreview1").innerHTML="";
                                    document.getElementById("imgPreview1").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果
                                }
                                else//FF
                                {
                                    path=window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
                                    //path = imgFile.files[0].getAsDataURL();// FF 3.0
                                    document.getElementById("imgPreview1").innerHTML = "<img id='img1'src='"+path+"' style='width:100px;height:100px'/>";
                                    //document.getElementById("img1").src = path;
                                }
                            }
                        }
                    </script>
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>文章封面：</label>
                    <div class="col-sm-9">
                        <input type="file" name="pic" id="" onchange="PreviewImage1(this)"/>
                        <div id="imgPreview1"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="submit" class="btn btn-default btn-primary" value="添加">
                    </div>
                </div>
            </form>
            <!--表单 end-->
        </div>
    </div>
</div>
<script  src="/api/Public/Common/kindeditor/kindeditor-min.js"></script>
<script  src="/api/Public/Common/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript" src="/api/Public/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/api/Public/Common/js/common.js"></script>
<script type="text/javascript" src="/api/Public/Common/js/ajaxfileupload.js"></script>
<script type="text/javascript">
<!--
var uploadPicurl="<?php echo U('Supply/uploadPic');?>";//ajax图片上传
//-->
</script>
</body>
</html>