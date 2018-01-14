<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user
    -scalable=no">
    <link rel="stylesheet" type="text/css" href="/api/Public/Home/css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="/api/Public/Home/css/ding.css">
    <link rel="stylesheet" type="text/css" href="/api/Public/Home/css/xq_slide.css">

    
    <title>1-1首页</title>
  </head>
  
  <body class="f9" >
     <div class="top">
        <div class="backdiv white hg40">
          <img src="/api/Public/Home/img/back1.png" class="backimg">
          <span>我的课程</span>
        </div> 
      </div>
      <div class="pd50">
            <div class="maindiv">
              <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><div class="weui-flex main" linkto="<?php echo U('Teac/userorder',array('oid'=>$user['id']));?>">
                <div><div class="placeholder imgbox">
                  <img src="Uploads/<?php echo ($user['headpic']); ?>" alt="">
                </div></div>
                <div class="weui-flex__item"><div class="placeholder">
                  <p class="hg80 mgleft"><?php echo ($user['nick_name']); ?></p>
                </div></div>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
      </div>
  </body>

    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    
<script>

</script>

</html>