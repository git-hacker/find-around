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
      <div style="padding:30px 0px 50px;">
            <div class="bigimgbox">
              <img src="Uploads/<?php echo ($kc['pic']); ?>" alt="">
              <div class="imgboxfoot">
                <span><?php echo ($kc['name']); ?></span>
                <span class="spanright" linkto="<?php echo U('Jkc/kcinfo',array('kid'=>$kc['id']));?>">教程详情<img class="comeimg" src="/api/Public/Home/img/come2.png" alt=""></span>
              </div>
            </div>
            <div class="weui-cell hg40 colo88 f1">
              <img class="timeimg" src="/api/Public/Home/img/time.png" >
              <span class="">选择时间(可多选)</span>
            </div>
            <div class="timebox">
              <div class="weui-flex">
                <div><div class="placeholder ">
                <form action="" class="radiobox">
                <?php if(is_array($week)): $i = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><div>
                  <input class="radio1" type="radio" name="radio1" value="<?php echo ($obj["time"]); ?>">
                  <div class="weekdiv">
                    <div >
                      <div>
                        <span>
                          <?php echo ($obj["month"]); ?>月<?php echo ($obj["day"]); ?>日
                        </span>
                        <span>
                          周<?php echo ($obj["week"]); ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </form>
                </div></div>
                <div class="weui-flex__item"><div class="placeholder time2box">
                  <?php if(is_array($house)): $i = 0; $__LIST__ = $house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><div class="">
                    <div class="timeobj" hid="<?php echo ($obj["id"]); ?>">
                     <span><?php echo ($obj["name"]); ?></span>
                     </div>
                  </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div></div>
              </div>
            </div>
        </div>
      </div>
      <div class="foot putkc">
         提交审核
      </div>
  </body>

    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    
<script>
  $(".timeobj").on('click',function () {
    if (!curindex) {
      layer.msg("请先选择日期！");
      return;
    }
    $(this).toggleClass("on");
    var curid = $(this).attr("hid");
    var value = $(this).text();

    if (!obj[curindex]) {
      obj[curindex] = {};
    }
    if (obj[curindex][curid]) {
      delete obj[curindex][curid];
    }else{
      obj[curindex][curid] = $.trim(value);
    }
    console.log(obj);
  });
  var obj = {};
  var curindex;
  $(".radio1").on('click',function () {
    curindex = $(this).val();
    $(".timeobj").removeClass("on");
    var curobj = obj[curindex];
    for(var index in curobj){
      $("[hid='"+index+"']").addClass('on');
    }
  });

  $(".putkc").on('click',function () {
    var i = 0;
    for(var index in obj){
      var outobj = obj[index];
      for(var ind in outobj){
        if (outobj[ind]) {
          i++;
        }
      }
    }
    if (i == 0) {
      layer.msg("请选择课程时间！");
      return;
    }
    var kid = "<?php echo ($kc['id']); ?>";
    requestUrl("<?php echo U('Jkc/addkc');?>",{kid:kid,obj:obj},function (res) {
      layer.msg( res.message );
      if (res.flag == "success") {

      }else{

      }
    })
  });
</script>

</html>