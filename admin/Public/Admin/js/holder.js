var JPlaceHolder = {
    //检测浏览器是否支持�placeholder 属性
    check : function(){
        return 'placeholder' in document.createElement('input');
    },
    //不支持的话创建虚拟的 �placeholder
    init : function(){
        if(!this.check()){
            this.create();
        }
    },
    //�创建span标签 浮动在input上 形成placeholder假象
    create : function(){
        jQuery(':input[placeholder]').each(function(index, element) {
            var self = $(this), txt = self.attr('placeholder'), pos = self.position();
            //虚拟span标签
            var holder = $('<span></span>').text(txt).css({position:'absolute', left:pos.left, top:pos.top, padding:'7px 0 0 10px', fontSize:'14px',color:'#aaa'}).appendTo(self.parent());
            //文本框事件
            self.focus(function(e) { holder.hide();}).blur(function(e) {if(!self.val()){holder.show();}});holder.click(function(e) {holder.hide();self.focus();});
        });
    }
};
jQuery(function(){
    JPlaceHolder.init();   
});