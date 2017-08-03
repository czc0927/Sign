
var login = {
    check : function() {
        // 获取登录页面中的用户名 和 密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
         var code = $('input[name="code"]').val();
         var online = $('input[name="online"]').val();
        if(!username) {
            dialog.error('用户名不能为空');
        }
        if(!password) {
            dialog.error('密码不能为空');
        }

        var url = "./admin.php?c=login&a=check";
        var data = {'username':username,'password':password,'code':code,'online':online};
        // 执行异步请求  $.post
        $.post(url,data,function(result){
            if(result.status == 0) {
                layer.msg(result.message,{icon:2,time:2000});
            }
            if(result.status == 1) {
                layer.msg(result.message,{icon:1,time:2000});
                window.location.href='./admin.php?c=index';
            }

        },'JSON');
    }
}