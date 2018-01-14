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
        <h3>用户管理</h3>
        <ul class="nav nav-tabs">
            <li class="active">
                <a>用户列表</a>
            </li>
        </ul>
    </div>
    <div class="search-content">
        <form action="<?php echo U('User/userlist');?>" method="post" class="search-form form-inline" role="form">
            <div class="form-group">
                <label class="sr-only" for="title">用户名称</label>
                <input class="earch-input form-control" id="title" type="text" name="nick_name" value="<?php echo ($_REQUEST['nick_name']); ?>" placeholder="用户名称"/>　
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
                        <th>年龄</th>
                        <th>性别</th>
                        <th>加入时间</th>
                        <th>省市</th>

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
                                <?php echo ($vo['age']); ?>
                            </td>
                            <td>
                            <?php if($vo['sex'] == 1): ?>男
                                <?php else: ?>
                                女<?php endif; ?>
                            </td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo['ctime'])); ?></td>
                            <td><?php echo ($vo['provance']); ?></td>
                            <td>
                                <?php if($vo['status'] == 0): ?><a class="resetpass modify" data-id="<?php echo ($vo['id']); ?>" title="确认">
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
<div id="sou" style="text-align:center;display:none;">
    <div style="padding:20px;">
        <form>
        <div><input type="number" class="num text-input form-control" placeholder="上课次数"/></div>
        <div>
            <select class="tid form-control" name="tid" placeholder="请选择教练">
                <option value="">请选择教练</option>
                <?php if(is_array($teaclist)): $i = 0; $__LIST__ = $teaclist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$teac): $mod = ($i % 2 );++$i;?><option value="<?php echo ($teac['id']); ?>"><?php echo ($teac['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <div class="kcdiv">
            
        </div>
        <div>
            <button type="button" class="btn commit">确认</button>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var id ;
    $(document).ready(function(){
        $(".modify").on('click',function () {
        id = $(this).data("id");
        var index = layer.open({
            type:1,
            title: '请输入课程内容',
            content: $('#sou'),
            area:["300px","220px"]
        });
        });
    });

    $(".commit").on('click',function () {
        var kid = $(".kid").val();
        var tid = $(".tid").val();
        var num = $(".num").val();
        if (kid && tid && num) {
            $.ajax({
                "url":"<?php echo U('User/buykc');?>",
                "type":"post",
                "data":{"kid":kid,"tid":tid,"uid":id,"num":num},
                "dataType":"json",
                "success":function ( res ) {
                    if (res.flag == "success") {
                        layer.closeAll();
                        layer.msg(res.message);
                    }else{
                        layer.msg(res.message);
                    }
                }
            });
        }else{
            layer.msg("请填写完整信息！");
        }
    });

    $(".tid").on('change',function () {
            var tid = $(this).val();
            if (!tid) {
                layer.msg("请先选择教练！");
                $(".kcdiv").html("");
            }
            $.ajax({
                url:"<?php echo U('User/getkc');?>",
                data:{tid:tid},
                dataType:"json",
                type:"post",
                success:function ( res ) {
                    if ( res.flag == "success" ) {
                        var jkc = res.data;
                        console.log(jkc);
                        var str = '<select class="kid form-control" name="kid" placeholder="请选择课程">';
                        for(var index in jkc){
                            var obj = jkc[index];
                            str += '<option value="'+obj['kid']+'">'+obj['name']+'</option>';
                        }
                        str += '</select>';
                        $(".kcdiv").html( str );
                    }else{
                        layer.msg(res.message);
                    }
                }
            })
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