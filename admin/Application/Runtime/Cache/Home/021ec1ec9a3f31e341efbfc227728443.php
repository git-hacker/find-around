<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user
    -scalable=no">
    <link rel="stylesheet" type="text/css" href="/api/Public/Home/css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="/api/Public/Home/css/ding.css">
    <link rel="stylesheet" type="text/css" href="/api/Public/Home/css/xq_slide.css">
    
    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    
    <title>1-1首页</title>
  </head>
  <body class="f6" >
    
     <div class="top">
        <div class="backdiv white hg40">
          <img src="/api/Public/Home/img/back1.png" class="backimg">
          <span><?php echo ($kc['tname']); ?>的课程</span>
        </div> 
      </div>
      <div style="padding:30px 0px 50px;">
            <div class="bigimgbox">
              <img src="Uploads/<?php echo ($kc['pic']); ?>" alt="">
              <div class="imgboxfoot">
                <span><?php echo ($kc['name']); ?></span>
                <span class="spanright"><?php echo ($kc['datestr']); echo ($kc['week']); echo ($kc['htime']); ?></span>
              </div>
            </div>
            <div class="imgbox3" style="padding:0px 10px">
              <?php echo ($kc["desc"]); ?>
            </div>
      </div>
      <div class="foot addorder">
         预约
      </div>

  </body>
  
  <script type="text/javascript">
    $('.addorder').on('click',function () {
      var kid = "<?php echo ($kc['id']); ?>";
      var tid = "<?php echo ($kc['tid']); ?>";
      var tname = "<?php echo ($kc['tname']); ?>";
      var ktime = "<?php echo ($kc['ktime']); ?>";
      var kname = "<?php echo ($kc['name']); ?>";
      var htime = "<?php echo ($kc['htime']); ?>";
      var weekday = "<?php echo ($kc['week']); ?>";
      var infotime = "<?php echo ($kc['infotime']); ?>";

      var dataobj = {
        kid:kid,
        tid:tid,
        tname:tname,
        ktime:ktime,
        kname:kname,
        htime:htime,
        weekday:weekday,
        infotime:infotime
      };
      requestUrl("<?php echo U('Order/addorder');?>",dataobj,function (res) {
        layer.msg(res.message);
      })

    });
  </script>
  
</html>