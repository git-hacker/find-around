/**
 * 隐藏notification提示框
 */
function hideNotification(){
    $('.notification').slideUp(400);
}
/**
 * 显示提示框
 */
function showNotification(type,txt){
    $('.'+type).find('div').html(txt);
    $('.'+type).slideDown(400);
    setTimeout(hideNotification,2500);
}
/**
 * 登陆
 */
function ajaxLogin(redirect){
    var a_name = $("input[name='a_name']").val();
    var a_pass = $("input[name='a_pass']").val();
    var code = $("input[name='code']").val();
    if(a_name == ''){
        $('.notification').find('div').html('请输入用户名');
        $('.notification').show();
        $("input[name='a_name']").focus();
        return;
    }if(a_pass == ''){
        $('.notification').find('div').html('请输入密码');
        $('.notification').show();
        $("input[name='a_pass']").focus();
        return;
    }if(code == ''){
        $('.notification').find('div').html('请输入验证码');
        $('.notification').show();
        $("input[name='code']").focus();
        return;
    }else{
        $.ajax({
            url :redirect,type:'post',data:{a_name:a_name,a_pass:a_pass,code:code},dataType:'JSON',
            success:function(data){
                if(data.error != null){
                    $('.notification').find('div').html(data.error);
                    $('.notification').show();
                }else{
                    window.location.href = $('.form').attr('action');
                }
            }
        });
    }
}
/**
 * 分类ajax操作
 */
//删除分类
function ajaxDelCate(cate_id,redirect,obj){
    if(confirm('确定要删除此分类吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {cate_id:cate_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//添加分类
function ajaxAddCate(redirect){
    var cate_name = $("input[name='cate_name']").val();
    var parent_id = $("select[name='parent_id']").val();
    var cate_sort = $("input[name='cate_sort']").val();
    var cate_keywords = $("input[name='cate_keywords']").val();
    var cate_desc = $("input[name='cate_desc']").val();
    if(cate_name == ''){
        $('#cate-name-error').html('请输入分类名称');
        $('#cate-name-error').show();
        $("input[name='cate_name']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',
            data: {cate_name:cate_name,parent_id:parent_id,cate_sort:cate_sort,cate_keywords:cate_keywords,cate_desc:cate_desc},
            dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    $(".text-input").val('');
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//编辑分类
function ajaxEditCate(redirect){
    var cate_id = $("input[name='cate_id']").val();
    var cate_name = $("input[name='cate_name']").val();
    var parent_id = $("select[name='parent_id']").val();
    var cate_sort = $("input[name='cate_sort']").val();
    var cate_keywords = $("input[name='cate_keywords']").val();
    var cate_desc = $("input[name='cate_desc']").val();
    if(cate_name == ''){
        $('#cate-name-error').html('请输入分类名称');
        $('#cate-name-error').show();
        $("input[name='cate_name']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',
            data: {cate_id:cate_id,cate_name:cate_name,parent_id:parent_id,cate_sort:cate_sort,cate_keywords:cate_keywords,cate_desc:cate_desc},
            dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 * 商铺相关ajax操作
 */
//添加商铺
function ajaxAddShop(redirect){
    var shop_name = $("input[name='shop_name']").val();
    var shop_tel = $("input[name='shop_tel']").val();
    var shop_address = $("input[name='shop_address']").val();
    var shop_cate = $("input[name='cate_id']").val();
    var s_pic_str = $("input[name='s_pic_str']").val();
    var s_sort = $("input[name='s_sort']").val();
    var shop_discount = $("textarea[name='shop_discount']").val();
    var shop_desc = $("textarea[name='shop_desc']").val();
    if(shop_name == ''){
        $('#shop-name-error').html('请输入商铺名称');
        $('#shop-name-error').show();
        $("input[name='shop_name']").focus();
        return;
    }if(shop_address == ''){
        $('#shop-address-error').html('请输入商铺地址');
        $('#shop-address-error').show();
        $("input[name='shop_address']").focus();
        return;
    }if(shop_cate == 0){
        $('#shop-cate-error').html('请选择商铺分类');
        $('#shop-cate-error').show();
        return;
    }if(s_pic_str == ''){
        $('#shop-pic-error').html('请上传商铺门头照片');
        $('#shop-pic-error').show();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',
            data: {s_name:shop_name,s_tel:shop_tel,s_address:shop_address,s_cate_id:shop_cate,
                   s_sort:s_sort,s_pic:s_pic_str,s_discount:shop_discount,s_desc:shop_desc},
            dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    $('.success').find('div').html(data.success);
                    $('.success').slideDown(400,function(){
                        $('.box1').hide();
                        $('.box2').show();
                    });
                    $(".text-input").val('');
                    $('#vip_img img').hide();
                    $('#s-id').val(data.s_id);
                    setTimeout(hideNotification,2500);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//ajax上传商铺图片
function ajaxImgUpload(redirect){
    $("#loading")
    .ajaxStart(function(){$(this).show();})
    .ajaxComplete(function(){$(this).hide();});
    $.ajaxFileUpload({
        url:redirect,secureuri:false,fileElementId:'shop_pic',dataType: 'json',data:{},
        success: function (data){
            if(data.error != null){
                $('#load').hide();
                $('.n-error').find('div').html(data.error);
                $('.n-error').slideDown(400);
                setTimeout(hideNotification,2500);
                return;
            }else{
                $('#load').hide();
                $('#vip_img img').hide();
                $("<img src='"+data.show_shop_pic+"' class='"+data.flag+"' title='"+data.shop_pic+"' width='200' height='150' style='cursor:pointer;margin-left:0px;'>").
                    appendTo($('#vip_img')).click(function(){

                    });
                $("input[name='s_pic_str']").val(data.shop_pic);
                $('#shop-pic-error').hide();
            }
        },
        error: function (data, status, e){alert(e);}
    })
}
//获取分类
function ajaxGetCategory(redirect,obj){
    $.ajax({
        url :redirect,type:'post',data:{cate_id:obj.value},dataType:'JSON',
        success:function(data){
            //移除该对象后面的元素
            $(obj).nextAll('select').remove();
            if(data.category == ''){
                $("input[name='cate_id']").val(obj.value);
                $('#shop-cate-error').hide();
            }else{
                $("input[name='cate_id']").val(0);
                $(data.category).appendTo($('#cate')).change(function(){
                    ajaxGetCategory(redirect,this);
                });
            }
        }
    });
}
//编辑商铺
function ajaxEditShop(redirect){
    var s_id = $("input[name='s_id']").val();
    var shop_name = $("input[name='shop_name']").val();
    var shop_tel = $("input[name='shop_tel']").val();
    var shop_address = $("input[name='shop_address']").val();
    var shop_cate = $("input[name='cate_id']").val();
    var s_pic_str = $("input[name='s_pic_str']").val();
    var s_sort = $("input[name='s_sort']").val();
    var shop_discount = $("textarea[name='shop_discount']").val();
    var shop_desc = $("textarea[name='shop_desc']").val();
    if(shop_name == ''){
        $('#shop-name-error').html('请输入商铺名称');
        $('#shop-name-error').show();
        $("input[name='shop_name']").focus();
        return;
    }if(shop_address == ''){
        $('#shop-address-error').html('请输入商铺地址');
        $('#shop-address-error').show();
        $("input[name='shop_address']").focus();
        return;
    }if(shop_cate == 0){
        $('#shop-cate-error').html('请选择商铺分类');
        $('#shop-cate-error').show();
        return;
    }if(s_pic_str == ''){
        $('#shop-pic-error').html('请上传商铺门头照片');
        $('#shop-pic-error').show();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',
            data: {s_id:s_id,s_name:shop_name,s_tel:shop_tel,s_address:shop_address,
                   s_sort:s_sort,s_cate_id:shop_cate,s_pic:s_pic_str,s_discount:shop_discount,s_desc:shop_desc},
            dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//修改积分
function ajaxEditScore(redirect){
    var s_id = $("input[name='s_id']").val();
    var change_measure = $("input[name='change_measure']").val();
    var change_rule = $("select[name='change_rule']").val();
    var change_cause = $("input[name='change_cause']").val();
    var old_score = $(".shop_score").html();
    if(change_measure == ''){
        $('#change-measure-error').html('请输入积分改变量');
        $('#change-measure-error').show();
        $("input[name='change_measure']").focus();
        return;
    }if(change_rule == 0){
        $('#change-rule-error').html('请输入积分改规则');
        $('#change-rule-error').show();
        return;
    }if(change_rule != 0){
        $('#change-rule-error').hide();
    }if(change_cause == ''){
        $('#change-cause-error').html('请输入积分改原因');
        $('#change-cause-error').show();
        $("input[name='change_cause']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {s_id:s_id,change_measure:change_measure,change_rule:change_rule,change_cause:change_cause},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    if(change_rule == 2){
                        $(".shop_score").html(parseInt(old_score)+parseInt(change_measure));
                    }if(change_rule == 1){
                        $(".shop_score").html(parseInt(old_score)-parseInt(change_measure));
                    }
                    $(".change-cause").val('');
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//发送站内信
function ajaxSendMsg(obj){
    var redirect = obj.next('input').val();
    var s_id = $("#send-to-id").val();
    var msg_title = $("#facebox input[name='msg_title']").val();
    var msg_content = $("#facebox textarea[name='msg_content']").val();
    if(msg_title == ''){
        $('#facebox #send-msg-error').html('请输入发信标题');
        $('#facebox #send-msg-error').show();
        $("#facebox input[name='msg_title']").focus();
        return;
    }if(msg_content == ''){
        $('#facebox #send-msg-error').html('请输入发信内容');
        $('#facebox #send-msg-error').show();
        $("textarea[name='msg_content']").focus();
        return;
    }else{
        $('#facebox #send-msg-error').hide();
        $.ajax({
            url: redirect,type: 'post',data: {s_id:s_id,msg_content:msg_content,msg_title:msg_title},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    $('#facebox').fadeOut('normal');//隐藏发信弹出层
                    $('#facebox_overlay').fadeOut('normal');
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//验证通过
function ajaxCheckShop(redirect,type_icon){
    var s_id = $("input[name='s_id']").val();
    if(confirm('确定该商铺通过验证码？')){
        $.ajax({
            url: redirect,type: 'post',data: {s_id:s_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    $('.type-icon').attr('src',type_icon);
                    $('.check-shop-btn').remove();
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//获取排行榜之最
function ajaxGetChart(obj){
    var rank_id = obj.val();
    $.ajax({
        url: obj.next('input').val(),type: 'post',data: {rank_id:rank_id},dataType: 'JSON',
        success: function (data) {
            if(data.error == null){
                $('#facebox #chart-select').empty();
                $.each(data.success,function (key, chart) {
                    $('#facebox #chart-select').append("<option value='"+chart.chart_id+':'+chart.chart_name+"'>"+chart.chart_name+"</option>");
                });
            }
        }
    });
}
//移出排行榜
function ajaxOutChart(redirect,obj){
    var s_id = $("input[name='s_id']").val();
    if(confirm('确定要将该商铺移出排行榜吗？')){
        $.ajax({
            url: redirect,type: 'post',data: {s_id:s_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    $('#chart-icon').hide();
                    $('.out-chart').hide();
                    $('.in-chart').show();
                    $('#chart-p').hide();
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//加入排行榜
function ajaxInChart(obj){
    var s_id = $("input[name='s_id']").val();
    var chart = $('#facebox #chart-select').val();
    if(chart == null){
        $('#facebox #in-chart-error').html('请选择排行榜');
        $('#facebox #in-chart-error').show();
        return;
    }else{
        var arr = chart.split(':');
        $('#facebox #in-chart-error').hide();
        $.ajax({
            url: obj.next('input').val(),type: 'post',data: {s_id:s_id,chart_id:arr[0]},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    $('#facebox').fadeOut('normal');//隐藏发信弹出层
                    $('#facebox_overlay').fadeOut('normal');
                    $('#chart-icon').show();
                    $('.out-chart').show();
                    $('.in-chart').hide();
                    $('#chart-span').html(arr[1]);
                    $('#chart-p').show();
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//开通商铺
function openShop(obj,type_icon){
    var s_id = $("input[name='s_id']").val();
    var s_account = $("#facebox input[name='s_account']").val();
    var s_password = $("#facebox input[name='s_password']").val();
    if(s_account == ''){
        $('#facebox #open-shop-error').html('请输入账号');
        $('#facebox #open-shop-error').show();
        return;
    }if(s_password == ''){
        $('#facebox #open-shop-error').html('请输入密码');
        $('#facebox #open-shop-error').show();
        return;
    }else{
        $('#facebox #open-shop-error').hide();
        $.ajax({
            url: obj.next('input').val(),type: 'post',data: {s_id:s_id,s_account:s_account,s_password:s_password},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    $('.type-icon').attr('src',type_icon);
                    $('.open-shop-btn').remove();
                    $('#facebox').fadeOut('normal');//隐藏发信弹出层
                    $('#facebox_overlay').fadeOut('normal');
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//删除商铺
function ajaxDelShop(s_id,redirect,obj){
    if(confirm('确定要删除此商铺吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {s_id:s_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 * 商铺类型ajax操作
 */
//添加商铺类型
function ajaxAddType(redirect){
    var type_name = $("input[name='type_name']").val();
    if(type_name == ''){
        $('#type-name-error').html('请输入商铺类型名称');
        $('#type-name-error').show();
        $("input[name='type_name']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {type_name:type_name},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    $("input[name='type_name']").val('');
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//删除商铺类型
function ajaxDelType(type_id,redirect,obj){
    if(confirm('确定要删除此类型吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {type_id:type_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//修改商铺类型
function ajaxEditType(redirect,obj){
    var type_name = obj.val();
    var type_id = obj.next('input').val();
    if(type_name == ''){
        $('.n-error').find('div').html("未输入类型名称");
        $('.n-error').slideDown(400);
        setTimeout(hideNotification,2500);
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {type_id:type_id,type_name:type_name},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 * 属性
 */
//添加类型下属性
function ajaxAddAttr(redirect){
    var attr_name = $("input[name='attr_name']").val();
    var type_id_name = $("select[name='type_id_name']").val();
    var attr_index = $("input[name='attr_index']:checked").val();
    var attr_values = $("input[name='attr_values']").val();
    if(attr_name == ''){
        $('#attr-name-error').html('请输入属性名称');
        $('#attr-name-error').show();
        $("input[name='attr_name']").focus();
        return;
    }if(attr_values == ''){
        $('#attr-values-error').html('请输入可选值');
        $('#attr-values-error').show();
        $("input[name='attr_values']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {attr_name:attr_name,type_id_name:type_id_name,attr_index:attr_index,attr_values:attr_values},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    $(".text-input").val('');
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//修改类型下属性
function ajaxEditAttr(redirect){
    var attr_id = $("input[name='attr_id']").val();
    var attr_name = $("input[name='attr_name']").val();
    var type_id_name = $("select[name='type_id_name']").val();
    var attr_index = $("input[name='attr_index']:checked").val();
    var attr_values = $("input[name='attr_values']").val();
    if(attr_name == ''){
        $('#attr-name-error').html('请输入属性名称');
        $('#attr-name-error').show();
        $("input[name='attr_name']").focus();
        return;
    }if(attr_values == ''){
        $('#attr-values-error').html('请输入可选值');
        $('#attr-values-error').show();
        $("input[name='attr_values']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',
            data: {attr_id:attr_id,attr_name:attr_name,type_id_name:type_id_name,attr_index:attr_index,attr_values:attr_values},
            dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//删除类型下属性
function ajaxDelAttr(attr_id,redirect,obj){
    if(confirm('确定要删除此属性吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {attr_id:attr_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 * 排行榜
 */
//添加排行榜
function ajaxAddRank(redirect){
    var rank_name = $("input[name='rank_name']").val();
    if(rank_name == ''){
        $('#rank-name-error').html('请输入排行榜名称');
        $('#rank-name-error').show();
        $("input[name='rank_name']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {rank_name:rank_name},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    $(".text-input").val('');
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//删除排行榜
function ajaxDelRank(rank_id,redirect,obj){
    if(confirm('确定要删除此排行榜吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {rank_id:rank_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//编辑排行榜名称
function ajaxEditRank(redirect,obj){
    var rank_name = obj.val();
    var rank_id = obj.next('input').val();
    if(rank_name == ''){
        $('.n-error').find('div').html("未输入排行榜名称");
        $('.n-error').slideDown(400);
        setTimeout(hideNotification,2500);
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {rank_id:rank_id,rank_name:rank_name},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 * 排行榜内容
 */
//添加排行榜之最
function ajaxAddChart(redirect){
    var chart_name = $("input[name='chart_name']").val();
    var rank_id_name = $("select[name='rank_id_name']").val();
    if(chart_name == ''){
        $('#chart-name-error').html('请输入排行榜之最名称');
        $('#chart-name-error').show();
        $("input[name='chart_name']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {chart_name:chart_name,rank_id_name:rank_id_name},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    $(".text-input").val('');
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//删除排行榜之最
function ajaxDelChart(chart_id,redirect,obj){
    if(confirm('确定要删除此排行榜之最吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {chart_id:chart_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
//编辑排行榜之最名称
function ajaxEditChart(redirect){
    var chart_id = $("input[name='chart_id']").val();
    var chart_name = $("input[name='chart_name']").val();
    var rank_id_name = $("select[name='rank_id_name']").val();
    if(chart_name == ''){
        $('#chart-name-error').html('请输入排行榜之最名称');
        $('#chart-name-error').show();
        $("input[name='chart_name']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {chart_id:chart_id,chart_name:chart_name,rank_id_name:rank_id_name},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 *删除每日推荐
 */
function ajaxDelRec(rec_id,redirect,obj){
    if(confirm('确定要删除此每日推荐吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {rec_id:rec_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 *添加友情链接
 */
function ajaxAddFr(redirect){
    var fr_name = $("input[name='fr_name']").val();
    var fr_url = $("input[name='fr_url']").val();
    var fr_order = $("input[name='fr_order']").val();
    if(fr_name == ''){
        $('#fr-name-error').html('请输入友情链接名称');
        $('#fr-name-error').show();
        $("input[name='fr_name']").focus();
        return;
    }if(fr_url == ''){
        $('#fr-url-error').html('请输入友情链接地址');
        $('#fr-url-error').show();
        $("input[name='fr_url']").focus();
        return;
    }else{
        $.ajax({
            url: redirect,type: 'post',data: {fr_name:fr_name,fr_url:fr_url,fr_order:fr_order},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    $(".text-input").val('');
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}
/**
 *删除友情链接
 */
function ajaxDelFr(fr_id,redirect,obj){
    if(confirm('确定要删除此友情链接吗?')){
        $.ajax({
            url: redirect,type: 'post',data: {fr_id:fr_id},dataType: 'JSON',
            success: function (data) {
                if(data.error == null){
                    showNotification('success',data.success);
                    var tr = obj.parentNode.parentNode;
                    var t_body=tr.parentNode;
                    t_body.removeChild(tr);
                }else{
                    showNotification('error',data.error);
                }
            }
        });
    }
}

/**
 *网站设置
 */
function ajaxSaveSys(redirect){
    $.ajax({
        url: redirect,type: 'post',data:$('.sys_form').serialize(),dataType: 'JSON',
        success: function (data) {
            if(data.error == null){
                showNotification('success',data.success);
            }else{
                showNotification('error',data.error);
            }
        }
    });
}
