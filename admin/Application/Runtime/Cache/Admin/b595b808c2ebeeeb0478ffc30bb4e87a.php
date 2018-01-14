<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>维格特健身后台管理中心</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<frameset rows="50,*"  frameborder="NO" border="0" framespacing="0">
    <frame src="<?php echo U('Index/top');?>" noresize="noresize" frameborder="NO" name="topFrame" scrolling="no" marginwidth="0" marginheight="0" target="main" />
    <frameset cols="200,*" id="frame">
        <frame src="<?php echo U('Index/left');?>" name="leftFrame" noresize="noresize" marginwidth="0" marginheight="0" frameborder="0" scrolling="no" target="main" />
        <frame src="<?php echo U('Inpic/inpiclist');?>" name="main" marginwidth="0" marginheight="0" frameborder="0" scrolling="auto" target="_self" />
    </frameset>
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>