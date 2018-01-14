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
        <h3>轮播管理</h3>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="<?php echo U('Inpic/inpiclist');?>">轮播列表</a>
            </li>
            <li>
                <a href="<?php echo U('Inpic/addinpic');?>">添加轮播</a>
            </li>
        </ul>
    </div>
    <!--<div class="search-content">
        <form action="<?php echo U('Article/ArticleList');?>" method="post" class="search-form form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="title">文章标题</label>
                <input class="earch-input form-control" id="title" type="text" name="title" value="<?php echo ($request['title']); ?>" placeholder="文章标题"/>　
            </div>
            <button type="submit" class="btn derive">查询</button>
        </form>
    </div>-->
    <div class="content-box-table content-box-content">
        <form action="<?php echo U('Inpic/deleteInpic');?>" method="post" class="batch-form">
            <table class="table table-striped table-framed table-hover">
                <thead>
                    <tr>
                        <th width="8%">
                            编号
                        </th>
                        <th width="15%">发布时间
                        </th>
                        <th>图片描述</th>
                        <th>图片链接</th>
                        <th>图片</th>
                        <th width="10%">操作</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php if(empty($list)): ?><tr><td colspan="20"><span style="font-size:14px;">暂无数据</span></td></tr><?php endif; ?>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo['id']); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo['ctime'])); ?></td>
                            <td><?php echo ($vo['desc']); ?></td>
                            <td><a href="<?php echo ($vo['href']); ?>"><?php echo ($vo['href']); ?></a></td>
                            <td><img src="Uploads/<?php echo ($vo['pic']); ?>" alt="" height="30px"></td>
                            <td>
                                <a href="<?php echo U('Inpic/deleteinpic',array('id'=>$vo['id']));?>" title="删除" class="delete-delete">
                                    <span class="icon glyphicon glyphicon-remove"></span>
                                </a>
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
        //排序修改
        $("select[name='z_id']").change(function(){
            $('.search-form').submit();
        });
        //批量修改积分
        $('.edit-score-batch').click(function(){
            $('.batch-form').attr('action','<?php echo U("Article/editScoreBatch");?>');
            $('.batch-form').submit();
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