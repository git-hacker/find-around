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
<script type="text/javascript" src="/api/Public/Admin/js/menu.simpla.jquery.js"></script>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-inner">
            <ul class="nav nav-list" id="left-menu">
                <li>
                    <a href="<?php echo U('Inpic/inpiclist');?>" target="main"  class="nav-top-item no-submenu active">
                        <span class="icon glyphicon glyphicon-home"></span>
                        <span class="hidden-minibar">首页</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="nav-top-item">
                        <span class="icon glyphicon glyphicon-book"></span>
                        <span class="hidden-minibar">轮播管理</span>
                        <span class="arrow glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo U('Inpic/addinpic');?>" target="main">添加图片</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Inpic/inpiclist');?>" target="main">轮播列表</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="nav-top-item">
                        <span class="icon glyphicon glyphicon-user"></span>
                        <span class="hidden-minibar">课程管理</span>
                        <span class="arrow glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo U('Kc/kclist');?>" target="main">课程列表</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Kc/addkc');?>" target="main">添加课程</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Kc/jkclist');?>" target="main">课程审核</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Kc/houlist');?>" target="main">时段列表</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="nav-top-item">
                        <span class="icon glyphicon glyphicon-th"></span>
                        <span class="hidden-minibar">约课管理</span>
                        <span class="arrow glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo U('Vorder/vorderlist');?>" target="main">约课列表</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="nav-top-item">
                        <span class="icon glyphicon glyphicon-comment"></span>
                        <span class="hidden-minibar">教练管理</span>
                        <span class="arrow glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo U('Teac/teaclist');?>" target="main">教练列表</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Teac/addteac');?>" target="main">添加教练</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="nav-top-item">
                        <span class="icon glyphicon glyphicon-briefcase"></span>
                        <span class="hidden-minibar">用户管理</span>
                        <span class="arrow glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo U('User/userlist');?>" target="main">用户列表</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="nav-top-item">
                        <span class="icon glyphicon glyphicon-user"></span>
                        <span class="hidden-minibar">管理员信息</span>
                        <span class="arrow glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo U('Admin/adminList');?>" target="main">管理员列表</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Admin/editPass');?>" target="main">修改密码</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>