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
        <h3>课程审核管理</h3>
        <ul class="nav nav-tabs">
            <li class="active">
                <a>课程列表</a>
            </li>
        </ul>
    </div>
    <div class="search-content">
        <form action="<?php echo U('Kc/jkclist');?>" method="post" class="search-form form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="title">课程名</label>
                <input class="earch-input form-control" id="title" type="text" name="name" value="<?php echo ($request['name']); ?>" placeholder="课程名"/>　
            </div>
            <button type="submit" class="btn derive">查询</button>
        </form>
    </div>
    <div class="content-box-table content-box-content">
        <form class="batch-form">
            <table class="table table-striped table-framed table-hover">
                <thead>
                    <tr>
                        <th>
                            编号
                        </th>
                        <th>
                            课程名
                        </th>
                        <th>
                            课时
                        </th>
                        <th>课时</th>
                        <th>创建时间</th>
                        <th>修改时间</th>
                        <th>申请时间</th>

                        <th>教练</th>
                        <th>状态</th>
                        <th width="10%">操作</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php if(empty($list)): ?><tr><td colspan="20"><span style="font-size:14px;">暂无数据</span></td></tr><?php endif; ?>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo['id']); ?></td>
                            <td><?php echo ($vo['name']); ?></td>
                            <td><?php echo ($vo['ktime']); ?>课时</td>
                            <td><?php echo ($vo['datestr']); echo ($vo['htime']); ?></td>


                            <td><?php echo (date('Y-m-d H:i:s',$vo['ctime'])); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo['utime'])); ?></td>
                            <td><?php echo ($vo['infotime']); ?></td>

                            <td><?php echo ($vo['tname']); ?></td>
                            <td>
                                <?php if($vo['status'] == 0): ?>待审核
                                <?php elseif($vo['status'] == 1): ?>
                                已发布
                                <?php elseif($vo['status'] == 4): ?>
                                已下线<?php endif; ?>
                            </td>
                            <td>
                                <?php if($vo['status'] == 0): ?><a data-id="<?php echo ($vo['id']); ?>" title="通过" class="modify" status="1">
                                        <span class="icon glyphicon glyphicon-refresh"></span>
                                    </a>
                                    <?php else: ?>
                                    <a title="不通过" class="modify" data-id="<?php echo ($vo['id']); ?>" status="0">
                                        <span class="icon glyphicon glyphicon-edit"></span>
                                    </a><?php endif; ?>
                                <a href="#" title="删除" class="delete-delete">
                                    <span class="icon glyphicon glyphicon-remove"></span>
                                </a><input type="hidden" value="<?php echo U('Article/deleteArticle',array('article_id'=>$vo['article_id']));?>">
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
    $(".modify").on('click',function() {
        var id = $(this).data("id");
        var status = $(this).attr("status");
        console.log(id,status);
        if ( id && status ) {
            $.ajax({
                url:"<?php echo U('Kc/savekc');?>",
                data:{id:id,status:status},
                dataType:"json",
                type:"post",
                success:function ( res ) {
                    layer.msg(res.message);
                    if (res.flag == "success") {
                        setTimeout(function () {
                            window.location.reload();
                        },500);
                    }
                }
            })
        }
    })
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