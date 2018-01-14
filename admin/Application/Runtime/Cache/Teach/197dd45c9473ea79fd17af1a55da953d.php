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
     <!--<div class="top">
        <div class="weui-cell hg40">
            <div class="weui-cell__hd"></div>
            <div class="weui-cell__bd">
                <p class="topfont">维格特健身</p>
            </div>
        </div>
      </div>-->

      <div>
      <!-- 轮播图 -->
        <div class="xq_box" style="width: 100%;height: 160px;margin: 0 auto;max-width: 100%;">
          <div class="xq_slide_out">
            <ul class="xq_slide_in">
              <?php if(is_array($inpic)): $i = 0; $__LIST__ = $inpic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?><li>
                <a href="<?php echo ($pic["href"]); ?>"><img src="Uploads/<?php echo ($pic["pic"]); ?>"></a>
              </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </div>
        </div>

        <div class="">
          <div class="weui-cell textdiv">
            <div class="weui-cell__hd"></div>
            <div class="weui-cell__bd">
                <p class="topfont ">已开放课程</p>
            </div>
            <div class="weui-cell__ft" linkto="<?php echo U('Teac/self');?>">管理</div>
          </div>
        </div>

        <div class="maindiv white">

          <?php if(empty($jkcv)): ?>暂无审核通过的课程<?php endif; ?>
          <?php if(is_array($jkcv)): $i = 0; $__LIST__ = $jkcv;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jkc): $mod = ($i % 2 );++$i;?><div class="weui-flex main">
            <div><div class="placeholder imgbox">
              <img src="Uploads/<?php echo ($jkc["headpic"]); ?>" alt="">
            </div></div>
            <div class="weui-flex__item"><div class="placeholder">
              <p class="hg40"><?php echo ($jkc["tname"]); ?>-><?php echo ($jkc["name"]); ?></p>
              <p class="hg40 p2">共<?php echo ($jkc["ktime"]); ?>课时</p>
            </div></div>
            <div><div class="placeholder lookdiv" linkto="<?php echo U('Jkc/kcinfo',array('kid'=>$jkc['kid']));?>"><p class="look mgt25">查看</p></div></div>
          </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
      <div class="foot" linkto="<?php echo U('Jkc/kclist');?>">
      发布课程
      </div>
  </body>
  
    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    
  <script type="text/javascript">
      $(function () {
        $(".xq_slide_out").xq_slide({
          type: "h", //轮播方式  h水平轮播；v垂直轮播；o透明切换
          vatical: false, //图片描述性文本 true 显示 false不显示
          choseBtn: false, //是否显示上下切换按钮
          speed: 2000, //动画间隔的时间，以毫秒为单位。
          mousestop: true, //当鼠标移上去是否停止循环,针对PC端
          showbar: true, //是否显示轮播导航bar
          openmb: true //是否开启移动端支持
        });
      });
 </script>

</html>