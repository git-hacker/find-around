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
  

  <body class="f6" >
     <div class="top">
        <div class="backdiv white hg40">
          <img src="/api/Public/Home/img/back1.png" class="backimg">
          <div>课程预约</div>
        </div>
      </div>
      <div class="pd60">
          <div>
            <p class="pt"><?php echo ($user['kname']); ?></p>
            <p class="pf">共<?php echo ($user['ktime']); ?>课时</p>
          </div>
          <div class="white userpd10">
          
            <div class="weui-flex mb10">
            <div><div class="placeholder userheadbox"> 
               <img src="Uploads/<?php echo ($user['headpic']); ?>" alt="">
            </div></div>
            <div class="weui-flex__item"><div class="placeholder userpd10">
                <p class="myp1"><span><?php echo ($user['nick_name']); ?></span><img src="/api/Public/Home/img/nv.png" alt=""></p>
                <p class="myp2"><?php echo ($user['tel']); ?></p>
            </div></div>
            <div><div class="placeholder"></div></div>
            </div>
            <div class="usertime">
                <span>预约时间</span>
                <span><?php echo ($user['infotime']); ?>--<?php echo ($user['htime']); ?></span>             
            </div>
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