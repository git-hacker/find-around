<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<link rel="stylesheet" href="/api/Public/Admin/css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/api/Public/Admin/css/toocms.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/api/Public/Admin/css/invalid.css" type="text/css" media="screen" />
<script type="text/javascript" src="/api/Public/Common/js/jquery-1.9.1.min.js"></script>
<!--<script type="text/javascript" src="/api/Public/Admin/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="/api/Public/Admin/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/holder.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/global.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="/api/Public/Admin/js/Validformextend.js"></script>
</head>
<body>
<script type="text/javascript" src="/api/Public/Common/Highcharts/highcharts.js"></script>
<script type="text/javascript" src="/api/Public/Common/Highcharts/exporting.js"></script>
<!-- 统计图主题 可自行开发 -->
<script type="text/javascript" src="/api/Public/Common/Highcharts/highcharts-theme.js"></script>
<!--时间-->
<script type="text/javascript" src="/api/Public/Common/DatePicker/lhgcore.js"></script>
<script type="text/javascript" src="/api/Public/Common/DatePicker/lhgcalendar.js"></script>
<script type="text/javascript">
    /** 折线图 **/
    $(function () {
        $('#line-container').highcharts({
            chart: {type: 'spline'},
            title: {text: '', x: -20 ,style: {color: '#1B3243',fontWeight: 'bold',fontSize: '25px'}},
            subtitle: { text: "<?php echo ($day_date_flag); ?>" ,x: -20,y:22},
            xAxis: { categories: [<?php echo ($x_date); ?>], labels: { align: 'center', step: <?php echo ($step); ?> }},
            yAxis: {
                title: {
                    text: "<?php echo ($title); ?>"
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: "#808080"
                }]
            },
            tooltip: {crosshairs: true,shared: true},
            plotOptions: {spline: {marker: { radius: 4,lineColor: '#666666',lineWidth: 1 }}},
            series: [<?php echo ($day_line); ?>]
        });
        $('#line-container-1').highcharts({
            chart: {type: 'spline'},
            title: {text: '', x: -20 ,style: {color: '#1B3243',fontWeight: 'bold',fontSize: '25px'}},
            subtitle: { text: "<?php echo ($month_date_flag); ?>" ,x: -20,y:22},
            xAxis: { categories: [<?php echo ($month_x_date); ?>], labels: { align: 'center' }},
            yAxis: {
                title: {
                    text: "<?php echo ($title); ?>"
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: "#808080"
                }]
            },
            tooltip: {crosshairs: true,shared: true},
            plotOptions: {spline: {marker: { radius: 4,lineColor: '#666666',lineWidth: 1 }}},
            series: [<?php echo ($month_line); ?>]
        });
    });
</script>
<!--主页面-->
<div id="main-content" class="content">
    <?php if(!empty($group)): ?><div class="notification information png_bg">
            <div>
                您属于【<?php echo ($group); ?>】组，可能部分功能没有使用权限！
            </div>
        </div><?php endif; ?>
    <h3 class="page-title">
        <span class="icon glyphicon glyphicon-home"></span>
        首页
    </h3>

    <div class="content-box">
        <!--表格内容-->
        <div class="content-box-content">
            <div class="main-time">
                <form action="<?php echo U('Index/main');?>" method="post" class="form1">
                    <span><input type="text" id="start-time" name="start_time" class="text-input" style="width:270px;"  value="<?php echo ($start_time); ?>" placeholder="起始时间" onclick="J.calendar.get({to:'end-time,min'});" onfocus="this.blur()"/><i class="icon glyphicon glyphicon-calendar start-time-icon"></i></span>　
                    <span class="text-input"><input type="text" id="end-time" name="end_time"class="text-input" style="width:270px;" value="<?php echo ($end_time); ?>" placeholder="结束时间" onclick="J.calendar.get({to:'start-time,max'});"  onfocus="this.blur()" /><i class="icon glyphicon glyphicon-calendar end-time-icon"></i></span>　
                    <input class="button atrous" type="submit" value="确定" />
                </form>
            </div>
            <!--折线图-->
            <div id="line-container" class="line-container"></div>
            <!--月 图-->
            <div class="main-time">
                <form action="<?php echo U('Index/main');?>" method="post" class="form2">
                    选择年份：<?php echo ($year_sel); ?>
                    <input class="button atrous" type="submit" value="确定" />
                </form>
            </div>
            <div id="line-container-1" class="line-container"></div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="content-box-column">

    </div>

    <div class="clear"></div>
    <div id="footer" class="footer">
        <small><a href="#">返回顶部</a> </small>
    </div>
</div>
<script type="text/javascript" src="/api/Public/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/api/Public/Common/js/common.js"></script>
<script type="text/javascript" src="/api/Public/Common/js/ajaxfileupload.js"></script>
<script type="text/javascript">
<!--
var uploadPicurl="<?php echo U('Supply/uploadPic');?>";//ajax图片上传
//-->
</script>
</body>
</html>