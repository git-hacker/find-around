<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="/api/Public/Admin/css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/api/Public/Admin/css/toocms.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/api/Public/Admin/css/invalid.css" type="text/css" media="screen" />
    <script type="text/javascript" src="/api/Public/Common/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript">
        var timerID = null, timerRunning = false;
        function stop_clock (){
            if(timerRunning)
                clearTimeout(timerID);
            timerRunning = false;}
        function start_clock () {
            stop_clock();
            showtime();}
        function showtime () {
            var now = new Date(), year = now.getFullYear(), month = now.getMonth(), day = now.getDate(), hours = now.getHours(), minutes = now.getMinutes(), seconds = now.getSeconds();
            var monthValue = year+"/"+(month+1)+"/"+day+"";
            document.getElementById('month').innerHTML = monthValue;
            var timeValue = "" +((hours >= 12) ? "PM " : "AM " );
            timeValue += ((hours >12) ? hours -12 :hours);
            timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
            timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
            document.getElementById('time').innerHTML = timeValue;
            timerID = setTimeout("showtime()",1000);
            timerRunning = true;}
    </script>
</head>
<body onload="showtime()">
<header>
    <div class="row">
        <nav class="navbar" role="navigation">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <a href=""><span class="logo">维格特健身后台管理中心</span></a>
                </div>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav user-menu navbar-right">
                    <li>
                        <span href="" class="settings">
                            <!--<span class="icon glyphicon glyphicon-bullhorn"></span>-->
                            <!--<span class="txt"> ：<span id="order_notice"><a href="<?php echo U('Order/orderList');?>" target="main" style="color: #ffffff">您有<span style="color:red">【<?php echo ($order_count); ?>】</span>个新的订单！</a></span></span>-->
                        </span>
                    </li>

                    <!--<li>-->
                        <!--<span href="" class="settings">-->
                            <!--<span class="icon glyphicon glyphicon-bullhorn"></span>-->
                            <!--<span class="txt"> ：<span id="order_count">您有<span style="color:red">【<?php echo ($order_count); ?>】</span>个新的订单请注意查收</span></span>-->
                        <!--</span>-->
                    <!--</li>-->
                    <!--<li>-->
                        <!--<span href="" class="settings">-->
                            <!--<span class="icon glyphicon glyphicon-home"></span>-->
                            <!--<span class="txt">：<a href="#" target="_blank">查看网店</a></span>-->
                        <!--</span>-->
                    <!--</li>-->
                    <li>
                        <span href="" class="settings">
                            <span class="icon glyphicon glyphicon-user"></span>
                            <span class="txt">：<?php echo ($admin); ?></span>
                        </span>
                    </li>
                    <li>
                        <span href="" class="settings">
                            <span class="icon glyphicon glyphicon-calendar"></span>
                            <span class="txt"> ：<span id="month" class="txt"></span></span>
                        </span>
                    </li>
                    <li>
                        <span href="" class="settings">
                            <span class="icon glyphicon glyphicon-time"></span>
                            <span class="txt"> ：<span id="time" class="txt"></span></span>
                        </span>
                    </li>
                    <li class="last">
                        <a href="<?php echo U('Manager/logOut');?>" class="settings" target="_top" title="退出">
                            <span class="icon glyphicon glyphicon-off"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<?php if(!empty($order_count)): ?><!--<object data="/api/Public/Home/audio/prompt.mp3" type="application/x-mplayer2" width="0" height="0">
        <param name="src" value="/api/Public/Admin/audio/prompt.mp3">
        <param name="autostart" value="1">
        <param name="playcount" value="1">
    </object>--><?php endif; ?>
</body>
<script type="text/javascript">
//    $(document).ready(function(){
//        var obj = $('#order_count');
//        //每半分钟执行一次
//        setInterval(function(){
//            $.ajax({
//                url: '<?php echo U("Index/ajaxGetOrder");?>',type: 'post',data: {},dataType: 'JSON',
//                success: function (data) {
//                    if(data==0) {
//                        obj.html('暂无新订单');
//                    } else {
//                        window.location.reload();
//                    }
//                }
//            });
//        },5000);
//    });


</script>
</html>