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
    <div class="pd50"> 
       <div class="weui-flex hg45">
        <div><div class="placeholder d_otherdiv"></div></div>
        <div class="weui-flex__item userimg userdiv"><div class="placeholder"><input type="tel" class="userinput account"  placeholder="请输入账号"></div></div>
        <div><div class="placeholder d_otherdiv"></div></div>
       </div>
        <div class="weui-flex hg45 mg30">
          <div><div class="placeholder d_otherdiv"></div></div>
          <div class="weui-flex__item pasimg userdiv"><div class="placeholder"><input type="password" class="userinput password" placeholder="请输入密码"></div></div>
          <div><div class="placeholder d_otherdiv"></div></div>
        </div>
      <div class="weui-flex hg45 pd50">
        <div><div class="placeholder d_otherdiv"></div></div>
        <div class="weui-flex__item initdiv"><div class="placeholder loginbtn">登录</div></div>
        <div><div class="placeholder d_otherdiv"></div></div>
       </div>
    </div>
    <div class="foot" linkto="<?php echo U('Teac/register');?>">
                  立即注册
    </div>
</body>

    <script type="text/javascript" src="/api/Public/Home/js/jquery.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/public.js"></script>
    <script type="text/javascript" src="/api/Public/Home/js/layer/layer.js"></script>
    <script type="text/javascript" src="/api/Public/Home/slide/js/xq_slide.js"></script>
    
<script>
  
  $(".loginbtn").on('click',function ( ) {
    var account = $(".account").val();
    var password = $(".password").val();
    if (/^1{1}[3|4|5|7|8]{1}[0-9]{9}$/.test(account) && password.length >= 6) {
      requestUrl("<?php echo U('Teac/log');?>",{account:account,password:password},function ( res ) {
        layer.msg(res.message);
        if (res.flag == "success") {
          setTimeout(function () {
            window.location.href = "<?php echo U('Index/index');?>";
          },500);
        }
      })
    }else{
      layer.msg("请输入合法的信息。");
    }
  });
</script>


</html>