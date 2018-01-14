//异步登陆
function ajaxLogin(redirect,chart){
    var account = $("input[name='account']").val(), password = $("input[name='password']").val(),verify = $("input[name='verify']").val();
    if(account == ''){
        $('.notification').find('div').html('请输入用户名');
        $('.notification').show();
        $("input[name='account']").focus();
        return;
    }if(password == ''){
        $('.notification').find('div').html('请输入密码');
        $('.notification').show();
        $("input[name='password']").focus();
        return;
    }if(verify == ''){
        $('.notification').find('div').html('请输入验证码');
        $('.notification').show();
        $("input[name='verify']").focus();
        return;
    }else{
        $('.submit-btn').val('登录中...');
        $('.submit-btn').attr('disabled',true);
        $.ajax({
            url :redirect, type:'post', data:{account:account,password:password,verify:verify}, dataType:'JSON',
            success:function(data){
                if(data.error != null){
                    $('.notification').find('div').html(data.error);
                    $('.notification').show();
                    document.getElementById('verify_img').src = chart + '/' + new Date().getTime();
                    $('.submit-btn').val('登　　录');
                    $('.submit-btn').attr('disabled',false);
                }else{
                    window.location.href = $('.form').attr('action');
                }
            }
        });
    }
}

/**
 * 显示提示框
 */
function showNotification(type,txt){
    if(type == 'error'){
        $('.n-'+type).find('div').html(txt);
        $('.n-'+type).slideDown(400);
    }else{
        $('.'+type).find('div').html(txt);
        $('.'+type).slideDown(400);
    }
    setTimeout(function(){
        $('.notification').slideUp(400);
    },2500);
}

//判断分类 是否允许操作
function ajaxJudge(redirect,cate_id,self_id,obj){
    $.ajax({
        url: redirect,type: 'post',data: {cate_id:cate_id,self_id:self_id},dataType: 'JSON',
        success: function (data) {
            if(data.error != null){
                showNotification('error',data.error);
                $(obj).find('option:first').attr('selected', 'selected').parent('select');
            }
        }
    });
}

//是否显示操作
function  ajaxIsShow(redirect,id,flag,obj){
    $.ajax({
        url: redirect,type: 'post',data: {id:id,flag:flag},dataType: 'JSON',
        success: function (data) {
            if(data.error != null){
                showNotification('error',data.error);
            }else{
                $(obj).parent().find('.is-show-operate').show();
                $(obj).hide();
            }
        }
    });
}

//配送
function ajaxDispatch(redirect,order_id,obj,url){
    $.ajax({
        url: redirect,type: 'post',data: {order_id:order_id},dataType: 'JSON',
        success: function (data) {
            if(data.error != null){
                showNotification('error',data.error);
            }else{
                $(obj).parent().html('<span style="color: green"><img src="'+url+'"></span>');return;
            }
        }
    });
}
//ajax获取未配送的订单信息  在头部提示
function ajaxGetOrder(redirect,obj){
    $.ajax({
        url: redirect,type: 'post',data: {},dataType: 'JSON',
        success: function (data) {
            if(data.error != null){
                obj.html('暂无新订单');
            }else{
                window.location.reload();
            }
        }
    });
}

//修改排序
function ajaxEditSort(redirect,id,sort){
    $.ajax({
        url: redirect,type: 'post',data: {id:id,sort:sort},dataType: 'JSON',
        success: function (data) {
            if(data.error != null){
                showNotification('error',data.error);
            }else{
                showNotification('success',data.success);
            }
        }
    });
}
//修改商品信息
function ajaxEditGood(redirect,g_id,g_stock,g_price){
    $.ajax({
        url: redirect,type: 'post',data: {g_id:g_id,g_stock:g_stock,g_price:g_price},dataType: 'JSON',
        success: function (data) {
            if(data.error != null){
                showNotification('error',data.error);
            }else{
                showNotification('success',data.success);
            }
        }
    });
}

//审核操作  2014-8-16  add by <黑暗中的武者>
function  ajaxCheck(redirect,id,flag,obj){
    $.ajax({
        url: redirect,type: 'post',data: {id:id,flag:flag},dataType: 'JSON',
        success: function (data) {
            if(data.error != null){
                showNotification('error',data.error);
            }else{
                $(obj).parent().find('.check-operate').show();
                $(obj).hide();
            }
        }
    });
}