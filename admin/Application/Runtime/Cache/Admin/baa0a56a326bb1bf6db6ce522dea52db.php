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
</head>
<body>

<div id="main-content" class="content">
    <ul class="breadcrumb">
        <li><a href="/">首页</a></li>
        <li class="active"><a href="">管理员</a></li>
        <li class="active">修改密码</li>
    </ul>

    <div class="page-header clearfix">
        <h3>修改密码</h3>
        <ul class="nav nav-tabs">    
            <li class="active">
                <a href="<?php echo U('Admin/editPass');?>">编辑密码</a>
            </li>
        </ul>
    </div>


    <div class="content-box-content">
        <form action="<?php echo U('Admin/editPass');?>" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="old_password" class="col-sm-3 control-label">旧　密　码：</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="old_password" name="old_password">
                </div>
            </div> 
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">新　密　码：</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="password" name="password">
                </div>
            </div> 
            <div class="form-group">
                <label for="re_password" class="col-sm-3 control-label">确认新密码：</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="re_password" name="re_password">
                </div>
            </div> 

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-default btn-primary">确认修改</button>
                </div>
            </div>
        </form>
    </div>
</div>

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