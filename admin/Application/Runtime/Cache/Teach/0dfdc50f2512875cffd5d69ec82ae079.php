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
          <span>注册</span>
        </div>
      </div>
      <div class="pd50">
        
        <div class="weui-flex hg45 mg30">
            <div><div class="placeholder d_otherdiv"></div></div>
            <div class="weui-flex__item userdiv userimg"><div class="placeholder"><input type="tel" class="userinput account"  placeholder="请输入手机号"></div></div>
            <div><div class="placeholder d_otherdiv"></div></div>
        </div>
        <div class="weui-flex hg45 mg30">
            <div><div class="placeholder d_otherdiv"></div></div>
            <div class="weui-flex__item pasimg userdiv"><div class="placeholder"><input type="password" class="userinput password" placeholder="请输入注册密码"></div></div>
            <div><div class="placeholder d_otherdiv"></div></div>
        </div>
        <div class="weui-flex hg45 mg30">
            <div><div class="placeholder d_otherdiv"></div></div>
            <div class="weui-flex__item initdiv"><div class="placeholder register bgff0">注册</div></div>
            <div><div class="placeholder d_otherdiv"></div></div>
        </div>
        <div>
            <div class="agreement">
              <img class="w16 h16 img" src="/api/Public/Home/img/on.png">
              <span>我已同意</span>
              <span class="FC693D">注册协议</span>
            </div>
        </div>
      </div>
  </body>

    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    
<script>
  $(".register").on('click',function () {
    var account = $(".account").val();
    var password = $(".password").val();
    if (/^1{1}[3|4|5|7|8]{1}[0-9]{9}$/.test(account) && password.length >= 6) {
      requestUrl("<?php echo U('Teac/regist');?>",{account:account,password:password},function ( res ) {
        layer.msg(res.message);
        if (res.flag == "success") {
          setTimeout(function () {
            window.location.href = "<?php echo U('Index/index');?>";
          },500);
        }
      })
    }else{
      layer.msg("请输入合法的数据。");
    }
  });
</script>

</html>