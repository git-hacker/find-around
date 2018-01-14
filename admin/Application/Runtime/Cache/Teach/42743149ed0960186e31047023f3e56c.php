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
  
<body class="" >
     <div class="top">
        <div class="backdiv white hg40 bb">
          <img src="/api/Public/Home/img/back1.png" class="backimg">
          <span>课程详情</span>
        </div> 
      </div>
      <div class="pd50">
           <div class="weui-cell hg40 bgw">
            <?php echo ($res["name"]); ?>
            </div>
            <div class="imgbox3" style="padding:0px 10px">
              <?php echo ($res["desc"]); ?>
            </div>
      </div>
  </body>

    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    

</html>