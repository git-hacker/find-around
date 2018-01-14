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
  
  <body class="f1" >
      <div class="">
        <div class="weui-flex myinfodiv" linkto="<?php echo U('Teac/selfinfo');?>">
            <div>
	            <div class="placeholder headbox1">
	            	<?php if(empty($teac['headpic'])): ?><img class="headbox" src="/api/Public/Home/img/head.png" alt="">
	              		<?php else: ?>
	              		<img class="headbox" src="<?php echo ($teac["headpic"]); ?>" alt=""><?php endif; ?>
	              <img class="headlogo" src="/api/Public/Home/img/head2.png" alt="">
	            </div></div>
	            <div class="weui-flex__item"><div class="placeholder headbox2">
	              <p class="myp1"><span><?php echo ($teac["name"]); ?></span><img src="/api/Public/Home/img/nan.png" alt=""></p>
	              <p class="myp2"><?php echo ($teac["account"]); ?></p>
	            </div>
            </div>
            <div><div class="placeholder headbox3"><img src="/api/Public/Home/img/back2.png" alt=""></div></div>
        </div>

        <div class="" linkto="<?php echo U('Teac/myuser');?>" style="padding: 10px;color: #FC7247;">
          我的课程
        </div>
        
        <?php if(is_array($jkc)): $i = 0; $__LIST__ = $jkc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jkcobj): $mod = ($i % 2 );++$i;?><div class="mymaindiv" style="margin-top:0px">
            <div class="weui-cell hg30 f9">
                <p class="c86"><?php echo ($jkcobj['infotime']); ?></p>
            </div>
            <div>
              <div class="maindiv white" style="padding:10px;">
                <div class="weui-flex main2">
                  <div><div class="placeholder imgbox2">
                    <img src="/api/Public/Home/img/dian2.png" alt="">
                  </div></div>
                  <div class="weui-flex__item boederleftb"><div class="placeholder">
                    <p class="hg30"><?php echo ($jkcobj['name']); ?></p>
                    <p class="hg30 p2"><?php echo ($jkcobj['htime']); ?></p>
                  </div></div>
                  <div><div class="placeholder lookdiv" linkto="<?php echo U('Jkc/kcinfo',array('kid'=>$jkcobj['kid']));?>"><p class="look mgt15">查看</p></div></div>
                </div>
              </div>
            </div> 
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
  </body>
  
    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    

</html>