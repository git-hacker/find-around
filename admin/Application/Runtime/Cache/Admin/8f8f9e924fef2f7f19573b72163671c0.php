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
<script type="text/javascript" src="/api/Public/Admin/js/ajax-operate.js"></script>
<!--主页面-->
<div id="main-content" class="content">
    <ul class="breadcrumb">
        <li><a href="<?php echo U('Index/main');?>">首页</a></li>
        <li class="active"><a href="">文章管理</a></li>
        <li class="active">文章列表</li>
    </ul>

    <div class="page-header page-header1 clearfix">
        <h3>文章管理</h3>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="<?php echo U('Article/ArticleList');?>">文章列表</a>
            </li>
            <li>
                <a href="<?php echo U('Article/addArticle');?>">发布文章</a>
            </li>
        </ul>
    </div>
    <div class="search-content">
        <form action="<?php echo U('Article/ArticleList');?>" method="post" class="search-form form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="title">文章标题</label>
                <input class="earch-input form-control" id="title" type="text" name="title" value="<?php echo ($request['title']); ?>" placeholder="文章标题"/>　
            </div>
            <button type="submit" class="btn derive">查询</button>
        </form>
    </div>
    <div class="content-box-table content-box-content">
        <form action="<?php echo U('Article/deleteArticle');?>" method="post" class="batch-form">
            <table class="table table-striped table-framed table-hover">
                <thead>
                    <tr>
                        <th width="8%">
                            <input class="check-all" type="checkbox" />&nbsp;&nbsp;编号
                        </th>
                        <th width="15%">发布时间
                        </th>
                        <th>文章标题</th>
                        <th>文章链接</th>
                        <th>文章二维码(微信扫描分享)</th>
                        <th width="10%">操作</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php if(empty($list)): ?><tr><td colspan="20"><span style="font-size:14px;">暂无数据</span></td></tr><?php endif; ?>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><input type="checkbox" value="<?php echo ($vo['article_id']); ?>" name="article_id[]"/>&nbsp;&nbsp;<?php echo ($vo['article_id']); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo['ctime'])); ?></td>
                            <td><?php echo ($vo['title']); ?></td>
                            <td><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/test/'.'index.php/Home/Index/index/article_id/'; echo ($vo['article_id']); ?>" target="_blank"><?php echo 'http://'.$_SERVER['HTTP_HOST'].'/test/'.'index.php/Home/Index/index/article_id/'; echo ($vo['article_id']); ?></a></td>
                            <td><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'] ?>/test/<?php echo ($vo['code']); ?>" target="_blank"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'] ?>/test/<?php echo ($vo['code']); ?>" alt="" width="50px" height="50px"></a></td>
                            <td>
                                <a href="<?php echo U('Article/editArticle',array('article_id'=>$vo['article_id']));?>" title="详情" class="modify">
                                    <span class="icon glyphicon glyphicon-edit"></span>
                                </a>&nbsp;
                                <a href="#" title="删除" class="delete-delete">
                                    <span class="icon glyphicon glyphicon-remove"></span>
                                </a><input type="hidden" value="<?php echo U('Article/deleteArticle',array('article_id'=>$vo['article_id']));?>">
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <div class="bulk-actions fl">
                                <input type="button" class="btn delete-batch" value="批量删除">　
                            </div>
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