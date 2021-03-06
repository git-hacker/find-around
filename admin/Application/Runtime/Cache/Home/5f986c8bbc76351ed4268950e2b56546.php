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
          <span>个人资料</span>
        </div> 
      </div>
      <div class="pd60">
          <div class="infomain">
              <div class="weui-cell weui-cell_access" id="showIOSActionSheet">
                <div class="weui-cell__hd">
                  <p>头像</p>
                </div>
                <div class="weui-cell__bd">
                    <input type="file" style="opacity:0"/>
                </div>
                <div class="weui-cell__ft"><img src="<?php echo ($user['headpic']); ?>" class="minhead" alt=""></div>
              </div>         
              <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>昵称</p>
                </div>
                <div class="weui-cell__ft padl30 blur" key="nick_name" contenteditable="true"><?php echo ($user['nick_name']); ?></div>
              </div>
              <div class="weui-cell weui-cell_access" id="showIOSActionSheet2">
                <div class="weui-cell__bd">
                    <p>性别</p>
                </div>
                <div class="weui-cell__ft sex" sex="<?php echo ($teac['sex']); ?>">
                  <?php if($user['sex'] == 1): ?>男
                    <?php else: ?>
                    女<?php endif; ?>
                </div>
              </div>
              <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>年龄</p>
                </div>
                <div class="weui-cell__ft padl30 blur" key="age" contenteditable="true"><?php echo ($user['age']); ?></div>
              </div>
              <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>手机</p>
                </div>
                <div class="weui-cell__ft padl30 blur" key="tel" contenteditable="true"><?php echo ($user['tel']); ?></div>
              </div>
           </div>
      </div>

  </body>
  
<script type="text/javascript">
   $(".blur").on('blur',function () {
    var val = $(this).text();
    var key = $(this).attr("key");

    if (val && key) {
      console.log(val,key);
      if (key=="age" && !/^\d{1,2}$/.test(val)) {
        layer.msg("请填写合法年龄！");
        return;
      }
      if (key=="tel" && !/^1{1}\d{10}$/.test(val)) {
        layer.msg("请填写合法手机号！");
        return;
      }
      requestUrl("<?php echo U('User/setpro');?>",{key:key,val:val},function ( res ) {
        layer.msg(res.message);
      });
    }else{
      layer.msg("数据获取有误！");
    }

  });

  $(".sex").on('click',function () {
    
    var sex = $(this).attr("sex");
    sex = (sex == 1 ? 2 : 1);
    requestUrl("<?php echo U('User/setpro');?>",{key:"sex",val:sex},function ( res ) {
        layer.msg(res.message);
        if (res.flag == "success") {
          $(this).attr("sex",sex).text((sex == 1 ? "男" : "女"));
        }
    }.bind(this));
  });

  function ajax(){
      var filesize = this.files[0].size;
      if (filesize > 500*1024) {
          alert("请上传大小在500k以下的图片");
          return false;
      }
      var files = this.files;
      var picname = files[0].name;
      var reader = new FileReader();
      reader.onload = function(e){
          var src = e.target.result;
          var dataargs = {"pic": src, "pic_name": picname};
          requestUrl("<?php echo U('User/setpro');?>", dataargs, function (res) {
              layer.closeAll();
              layer.msg(res.message);
              if (res.flag == "success") {
                $(".minhead").attr("src",res.data);
              }
          }, "POST", true);

      }
      reader.readAsDataURL(files[0]);
  }
  $("input[type='file']").on('change',ajax);
</script>

</html>