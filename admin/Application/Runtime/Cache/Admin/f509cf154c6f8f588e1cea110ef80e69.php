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

    <div class="page-header page-header1 clearfix">
        <h3>文章管理</h3>
        <ul class="nav nav-tabs">
            <li>
                <a href="<?php echo U('Teac/teaclist');?>">教练列表</a>
            </li>
            <li class="active">
                <a href="<?php echo U('Teac/addteac');?>">添加教练</a>
            </li>
        </ul>
    </div>

        <!--表格内容-->
        <div class="content-box-content">
            <!--表单 start-->
            <form action="<?php echo U('Teac/addteac');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group" id="">
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>姓名：</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name"  placeholder="姓名">
                    </div>
                </div>
                <div class="form-group" id="">
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>手机号：</label>
                    <div class="col-sm-9">
                        <input type="tel" class="form-control" id="tel" name="account"  placeholder="手机号">
                    </div>
                </div>
                <div class="form-group" id="">
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>性别：</label>
                    <div class="col-sm-9">
                        <input type="radio" name="sex" value="1" class="sex" checked>男
                        <input type="radio" name="sex" value="2" class="sex">女
                    </div>
                </div>
                <div class="form-group" id="">
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>年龄：</label>
                    <div class="col-sm-9">
                        <input type="number" name="age" class="sex form-control">
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
                    <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>头像：</label>
                    <div class="col-sm-9">
                        <input type="file" name="pic" id="" onchange="PreviewImage1(this)"/>
                        <div id="imgPreview1"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-sm-3 control-label"><em class="prompt-red">*</em>描述：</label>
                    <div class="col-sm-9">
                        <textarea name="desc" id="content" style="width:auto;height:300px;visibility:hidden;"><?php echo ($res['content']); ?></textarea>
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
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#content', {
            resizeType : 1,
            uploadJson : '/api/Public/Common/kindeditor/php/upload_json.php',
            fileManagerJson : '/api/Public/Common/kindeditor/php/file_manager_json.php',
            allowPreviewEmoticons : false,
            items:[
                'source', '|', 'undo', 'redo', '|', 'cut', 'copy','|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'clearhtml', 'selectall', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor',
                'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough','image'
            ],
            afterBlur:function(){this.sync();}
        });
    });
</script>
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