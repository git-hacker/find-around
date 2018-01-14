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
    
      <div>
        <div class="weui-flex myinfodiv" linkto="<?php echo U('User/selfinfo');?>">
            <div><div class="placeholder headbox1">
              <img class="headbox" src="Uploads/<?php echo ($user['headpic']); ?>" alt="">
              <img class="headlogo" src="/api/Public/Home/img/head2.png" alt="">
            </div></div>
            <div class="weui-flex__item"><div class="placeholder headbox2">
              <p class="myp1"><span><?php echo ($user['name']); ?></span>
              <?php if($user['name'] == 1): ?><img src="/api/Public/Home/img/nv.png" alt="">
                <?php else: ?>
                <img src="/api/Public/Home/img/nan.png" alt=""><?php endif; ?>
              </p>
              <p class="myp2"><?php echo ($user['tel']); ?></p>
            </div></div>
            <div><div class="placeholder headbox3"><img src="/api/Public/Home/img/back2.png" alt=""></div>
            </div>
        </div>
        <?php if(is_array($orderlist)): $i = 0; $__LIST__ = $orderlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?><div class="mymaindiv">
            <div class="weui-cell hg30 f9">
                <p class="c86"><?php echo ($order['infotime']); ?></p>
            </div>
            <div class="maindiv white">
              <div class="weui-flex main2">
                <div><div class="placeholder imgbox2">
                  <img src="/api/Public/Home/img/dian2.png" alt="">
                </div></div>
                <div class="weui-flex__item boederleftb"><div class="placeholder">
                  <p class="hg30"><?php echo ($order['kname']); ?>--<?php echo ($order['tname']); ?></p>
                  <p class="hg30 p2"><?php echo ($order['weekday']); echo ($order['htime']); ?></p>
                </div></div>
                
                <div><div class="placeholder lookdiv">
                  <?php if($order['status'] == 0): ?><p class="look mgt15 lookrm" oid="<?php echo ($order['id']); ?>">取消</p></div>
                    <?php elseif($order['status'] == 1): ?>
                    已预约
                    <?php else: ?>
                    已取消<?php endif; ?>
                </div>
                
              </div>
            </div> 
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
        
      </div>

  </body>
  
<script type="text/javascript">
  $(".lookrm").on('click',function () {
    var oid = $(this).attr("oid");
    if (!confirm("您确定要取消该课程吗？")) {
      return;
    }
    requestUrl("<?php echo U('User/cancelorder');?>",{oid:oid},function ( res ) {
      layer.msg(res.message);
      if ( res.flag == "success" ) {
        setTimeout(function () {
          location.reload();
        },500);
      }
    })
  });
</script>

</html>