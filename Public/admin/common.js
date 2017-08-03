$(".table-border .td-status").on('click',function(){
	  var id = $(this).attr('attr-id');
    var status = $(this).attr("attr-status");
     data = {};
    if(status==1){
       data['status'] =-1;
    }else{
       data['status'] =1;
    }
    data['id'] = id;
    posturl = SCOPE.set_status_url;
    jump_url = SCOPE.jump_url;
    layer.confirm('确认要修改吗？',function(index){
			    $.post(
					   posturl,
					   data,
					   function(s){
					       if(s.status == 1) {
					          layer.msg(s.message,{icon:1,time:2000});
					          window.location.href=jump_url;
					         }else {
					            layer.msg(s.message,{icon:2,time:2000});
					           }
					     }
				    ,"JSON");
				});
});
//表单添加
$("#smart-button-submit").click(function(){
    var data = $("#smart-form").serializeArray();
    postData = {};
    $(data).each(function(i){
       postData[this.name] = this.value;
    });
    console.log(postData);
    // 将获取到的数据post给服务器
    url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    $.post(url,postData,function(result){
        if(result.status == 1) {
             layer.msg(result.message,{icon:1,time:2000});
			 window.location.href=jump_url;
        }else if(result.status == 0) {
          layer.msg(result.message,{icon:2,time:2000});
        }
    },"JSON");
});
//删除操作
$('.table-border #smart-delete').on('click',function(){
   var id = $(this).attr('attr-id');
    postdata = {};
    postdata['id'] = id;
    postdata['online'] =-1;
    posturl = SCOPE.set_online_url;
    jump_url = SCOPE.jump_url;
    layer.confirm('确认要删除吗？',function(index){
          $.post(
             posturl,
             postdata,
             function(s){
                 if(s.status == 1) {
                    layer.msg("ok",{icon:1,time:2000});
                    window.location.href=jump_url;
                   }else {
                      layer.msg(s.message,{icon:2,time:1000});
                     }
               }
            ,"JSON");
        });
});
//批量删除
$('.page-container .btn-danger').click(function() {
    var data = $("#smart-listorder").serializeArray();
    postData = {};
    $(data).each(function(i){
       postData[this.name] = this.value;
    });
    console.log(postData);
    // 将获取到的数据post给服务器
    url = SCOPE.listorder_url;
    jump_url = SCOPE.jump_url;
    $.post(url,postData,function(result){
        if(result.status == 1) {
             layer.msg(result.message,{icon:1,time:5000});
             window.location.href=jump_url;
        }else if(result.status == 0) {
          layer.msg(result.message,{icon:2,time:2000});
        }
    },"JSON");
});
//编辑

