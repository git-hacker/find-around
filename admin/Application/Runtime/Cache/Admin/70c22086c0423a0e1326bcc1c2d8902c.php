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
<script type="text/javascript" src="/api/Public/Admin/js/layer/layer.js"></script>
</head>
<body>
<script type="text/javascript" src="/api/Public/Admin/js/ajax-operate.js"></script>
<!--主页面-->
<div id="main-content" class="content">
    <div class="page-header page-header1 clearfix">
        <h3>约课管理</h3>
        <ul class="nav nav-tabs">
            <li class="active">
                <a>约课列表</a>
            </li>
        </ul>
    </div>
    <div class="search-content">
        <form action="<?php echo U('Vorder/vorderlist');?>" method="post" class="search-form form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="title">教练名称</label>
                <input class="earch-input form-control" id="title" type="text" name="tname" value="<?php echo ($_REQUEST['tname']); ?>" placeholder="教练名称"/>　
            </div>
            <div class="form-group">
                <label class="sr-only" for="title">课程名称</label>
                <input class="earch-input form-control" id="title" type="text" name="kname" value="<?php echo ($_REQUEST['kname']); ?>" placeholder="课程名称"/>　
            </div>
            <div class="form-group">
                <label class="sr-only" for="title">用户手机</label>
                <input class="earch-input form-control" id="title" type="text" name="tel" value="<?php echo ($_REQUEST['tel']); ?>" placeholder="用户手机"/>　
            </div>
            <button type="submit" class="btn derive">查询</button>
        </form>
    </div>
    <div class="content-box-table content-box-content">
        <form>
            <table class="table table-striped table-framed table-hover">
                <thead>
                    <tr>
                        <th width="8%">
                            编号
                        </th>
                        <th>姓名
                        </th>
                        <th>手机号</th>
                        <th>课程名</th>
                        <th>教练名</th>
                        <th>课时</th>
                        <th>创建时间</th>
                        <th>开课时间</th>
                        <th>状态</th>
                        <th width="10%">操作</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php if(empty($list)): ?><tr><td colspan="20"><span style="font-size:14px;">暂无数据</span></td></tr><?php endif; ?>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo['id']); ?></td>
                            <td><?php echo ($vo['nick_name']); ?></td>
                            <td><?php echo ($vo['tel']); ?></td>
                            <td>
                                <?php echo ($vo['kname']); ?>
                            </td>
                            <td>
                                <?php echo ($vo['tname']); ?>
                            </td>
                            <td>
                                <?php echo ($vo['ktime']); ?>课时
                            </td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo['ctime'])); ?></td>
                            <td><?php echo ($vo['infotime']); echo ($vo['weekday']); echo ($vo['htime']); ?></td>
                            <td>
                                <?php if($vo['status'] == 0): ?>待确认
                                    <?php elseif($vo['status'] == 1): ?>
                                    已预约
                                    <?php else: ?>
                                    已取消<?php endif; ?>
                            </td>
                            <td>
                                <?php if($vo['status'] == 0): ?><a class="resetpass modify" data-id="<?php echo ($vo['id']); ?>" status="1" title="确认">
                                        <span class="icon glyphicon glyphicon-refresh"></span>
                                    </a><?php endif; ?>
                                <?php if($vo['status'] != 4): ?><a title="取消" data-id="<?php echo ($vo['id']); ?>" status="4" class="modify">
                                        <span class="icon glyphicon glyphicon-remove"></span>
                                    </a><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <div class="fr">
                                <?php echo ($page); ?>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $(".modify").on('click',function () {
           var id = $(this).data("id");
           var status = $(this).attr("status");
           if (!confirm("您确定要修改吗？")){
            return;
           }
           $.ajax({
                url:"<?php echo U('Vorder/cancelorder');?>",
                data:{id:id,status:status},
                dataType:"json",
                type:"post",
                success:function ( res ) {
                    layer.msg(res.message);
                    if (res.flag=="success") {
                        location.reload();
                    }
                }
            });
        });
    });
</script>
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