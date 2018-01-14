/********ajax上传图片********/
function ajaxUploadFile(redirect,flag){
    $("#loading").ajaxStart(function(){
        $(this).show();
    }).ajaxComplete(function(){
            $(this).hide();
        });

    $.ajaxFileUpload({
        url:redirect, secureuri:false, fileElementId:'file', dataType: 'json', type: 'post', data:{},
        success: function (data){
            if(data.error != null){
                t_show(data.error); t_hide();
                return;
            }else{
                if(flag == 'head'){
                    $('#avatar').attr('src',data.thumb_img);//截取
                    $('#avatar-browser1').attr('src',data.thumb_img);//大图预览
                    $('#avatar-browser2').attr('src',data.thumb_img);//小图预览
                    $("input[name='img_str']").val(data.data_thumb_img);
                    $('.open-file').val('选择上传图片');
                }
            }
        },
        error: function (data, status, e){
            t_show(e); t_hide();
        }
    });
}

/************删除刚刚上传的图片**************/
function delNewPhoto(obj){
    if(confirm('确定要删除吗')){
        var pic_url = $(obj).prev().find('img').attr('title');
        $("input[name='pic_str']").val($("input[name='pic_str']").val().replace(pic_url+",",""));
        $(obj).parent().remove();
    }
}