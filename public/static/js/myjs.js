//定义构造函数
var Upfile = function(ele,opt,num,value){
    var save_name = $('#upload_img_list').attr('name')
    if(value){
        var str = Math.random().toString(36).slice(-6);
        $('#upload_img_list').html('<dd class="item_img" id="' + str + '"><div class="operate"><i onclick=UPLOAD_IMG_DEL("' + str + '") class="close layui-icon"></i></div><img src="' + value + '" class="img" ><input type="hidden" name="'+save_name+'" value="' + value + '" /></dd>');
    }
    var duotu = false
    if(num != 1){
        duotu = true
    }



    this.defaults = {
        //elem:'#uploadPic' //绑定元素
        elem:$(ele) //绑定元素
        ,url:'/admin/Asset/upload'    //上传接口
        ,method:'post'
        ,multiple:duotu
        ,before: function(obj){
            //预读本地文件示例，不支持ie8
            layer.msg('图片上传中...', {
                icon: 16,
                shade: 0.01,
                time: 0
            })
        }
        ,done:function(res){
            layer.close(layer.msg());//关闭上传提示窗口
            var img_num = $(".item_img").length
            if(img_num >= num){
                return layer.msg('超出上传限制，限制为'+num);
            }
            var str = Math.random().toString(36).slice(-6);
            //如果上传失败
            if(res.code != 1){
                return layer.msg('上传失败');
            }
            if (duotu == true) {//调用多图上传方法,其中res.imgid为后台返回的一个随机数字
                $('#upload_img_list').append('<dd class="item_img" id="' + str + '"><div class="operate"><i class="toleft layui-icon"></i><i class="toright layui-icon"></i><i onclick=UPLOAD_IMG_DEL("' + str + '") class="close layui-icon"></i></div><img src="' + res.data.url + '" class="img" ><input type="hidden" name="'+save_name+'[]" value="' + res.data.url + '" /></dd>');
            }else{//调用单图上传方法,其中res.imgid为后台返回的一个随机数字
                $('#upload_img_list').html('<dd class="item_img" id="' + str + '"><div class="operate"><i onclick=UPLOAD_IMG_DEL("' + str + '") class="close layui-icon"></i></div><img src="' + res.data.url + '" class="img" ><input type="hidden" name="'+save_name+'" value="' + res.data.url + '" /></dd>');
            }
            //上传成功
        }
        ,error:function(res){
            //上传失败
            console.log(JSON.stringify(res));
        }
    }
    this.options = $.extend({}, this.defaults ,opt);
};

//定义方法
Upfile.prototype = {
    init:function(){
        var _this = this;
        return layui.use('upload',function(){
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render(_this.options);
        });
    }
};

//在插件中使用对象
$.fn.upfile = function(num,value,options){
    var upfile = new Upfile(this,options,num,value);
    return upfile.init();
}


//图片删除
function UPLOAD_IMG_DEL(divs) {
    $("#"+divs).remove();
}

/*
多图上传变换左右位置
*/
$("body").on("click", ".toleft", function () {
    var item = $(this).parent().parent(".item_img");
    var item_left = item.prev(".item_img");
    if ($("#upload_img_list").children(".item_img").length >= 2) {
        if (item_left.length == 0) {
            item.insertAfter($("#upload_img_list").children(".item_img:last"))
        } else {
            item.insertBefore(item_left)
        }
    }
});
$("body").on("click", ".toright", function () {
    var item = $(this).parent().parent(".item_img");
    var item_right = item.next(".item_img");
    if ($("#upload_img_list").children(".item_img").length >= 2) {
        if (item_right.length == 0) {
            item.insertBefore($("#upload_img_list").children(".item_img:first"))
        } else {
            item.insertAfter(item_right)
        }
    }
});
function encodeSearchParams(obj) {
    const params = []
    Object.keys(obj).forEach((key) => {
        let value = obj[key]
        // 如果值为undefined我们将其置空
        if (typeof value === 'undefined') {
            value = ''
        }
        // 对于需要编码的文本（比如说中文）我们要进行编码
        params.push([key, encodeURIComponent(value)].join('='))
    })
    return params.join('&')
}
