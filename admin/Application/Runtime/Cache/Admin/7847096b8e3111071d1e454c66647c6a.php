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
        <h3>时段管理</h3>
        <ul class="nav nav-tabs">
            <li class="addbtn">
                <a>添加时段</a>
            </li>
        </ul>
    </div>

    <div class="content-box-table content-box-content">
        <form method="post" class="batch-form">
            <table class="table table-striped table-framed table-hover">
                <thead>
                    <tr>
                        <th width="8%">
                            编号
                        </th>
                        <th width="15%">时段名称
                        </th>
                        <th>备注</th>
                        <th width="10%">操作</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php if(empty($list)): ?><tr><td colspan="20"><span style="font-size:14px;">暂无数据</span></td></tr><?php endif; ?>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo['id']); ?></td>
                            <td><?php echo ($vo['name']); ?></td>
                            <td><?php echo ($vo['remark']); ?></td>
                            <td>
                                <a href="#" title="删除" class="delete-delete">
                                    <span class="icon glyphicon glyphicon-remove"></span>
                                </a><input type="hidden" value="<?php echo U('Kc/deletehou',array('id'=>$vo['id']));?>">
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

<div class="addtime" style="display:none;">
    <div class="form-group" id="">
        <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>时段名：</label>
        <div class="col-sm-9">
            <input type="text" class="form-control name" id="title" name="name"  placeholder="名称">
        </div>
    </div>
    <div class="form-group" id="">
        <label for="title" class="col-sm-3 control-label"><em class="prompt-red">*</em>备注：</label>
        <div class="col-sm-9">
            <input type="text" class="form-control remark" id="title" name="remark"  placeholder="备注">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <input type="button" class="btn btn-default btn-primary addhou" value="添加">
        </div>
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

    $(".addhou").on('click',function () {
        var remark = $(".remark").val();
        var name = $(".name").val();
        if (name) {
            $.ajax({
                url:"<?php echo U('Kc/addhou');?>",
                data:{name:name,remark:remark},
                dataType:"json",
                type:"post",
                success:function ( res ) {
                    if ( res.flag == "success" ) {
                        window.location.reload();
                    }else{
                        layer.msg(res.message);
                    }
                }
            })
        }else{
            layer.msg("课程时段不能为空！");
        }

    });

    $(".addbtn").on('click',function () {
        layer.open({
            title:"添加时段",
            type:1,
            area:['500px','200px'],
            content:$(".addtime")
        });
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