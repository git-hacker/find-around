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
          <span>发布课程</span>
        </div> 
      </div>
      <div class="pd50">
            <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kc): $mod = ($i % 2 );++$i;?><div class="maindiv">
              <div class="weui-flex main">
                <div><div class="placeholder imgbox">
                  <img src="Uploads/<?php echo ($kc["pic"]); ?>" alt="">
                </div></div>
                <div class="weui-flex__item"><div class="placeholder">
                  <p class="hg40"><?php echo ($kc["name"]); ?></p>
                  <p class="hg40 p2">共<?php echo ($kc["ktime"]); ?>课时</p>
                </div></div>
                <div><div class="placeholder lookdiv" linkto="<?php echo U('Jkc/addjkc',array('kid'=>$kc['id']));?>"><p class="look mgt25">发布</p></div></div>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
  </body>

    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    

</html>