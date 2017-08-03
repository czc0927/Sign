<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Sign/Public/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Sign/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Sign/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Sign/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Sign/Public/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="/Sign/Public/admin/static/h-ui/css/style.css" />
<link href="/Sign/Public/admin/lib/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
<title>员工列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 员工管理 <span class="c-gray en">&gt;</span> 员工列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
        <div class="row">
          <form action="./admin.php" method="get">
			<div class="text-c">
			 <span class="select-box inline">
				<select class="select" name="depart_id">
				 <option value="0" <?php if(0 == $depart_id): ?>selected="selected"<?php endif; ?>>部门分类</option>
                    <?php if(is_array($departs)): foreach($departs as $key=>$depart): ?><option value="<?php echo ($depart["depart_id"]); ?>" <?php if($depart["depart_id"] == $depart_id): ?>selected="selected"<?php endif; ?>><?php echo ($depart["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</span> 日期范围：
				<input type="text" name="starttime" onfocus="WdatePicker({skin:'default',minDate:'%y-%M-{%d-100}',maxDate:'%y-%M-{%d+100}'})" value="<?php echo ($starttime); ?>" id="datemin" class="input-text Wdate" style="width:120px;" >
				-
				<input type="text" name="endtime" onfocus="WdatePicker({skin:'default',minDate:'%y-%M-{%d-100}',maxDate:'%y-%M-{%d+100}'})" value="<?php echo ($endtime); ?>" id="datemax" class="input-text Wdate" style="width:120px;">
			    <input type="hidden" name="c" value="staff"/>
                <input type="hidden" name="a" value="index"/>
				<input type="text" class="input-text" style="width:250px" placeholder="输入员工名称" id="" name="name" value="<?php echo ($name); ?>">
				<button type="submit" class="btn btn-success" id="sub_data"><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
			</div>
		   </form>
        </div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加员工',SCOPE.add_url,'800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加员工</a></span> <span class="r">共有数据：<strong><?php echo ($Count); ?></strong> 条</span>
			</div>
			 <form id="smart-listorder">
	           <table class="table table-border table-bordered table-bg">
		         <thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">员工编号</th>
				<th width="100">工作照</th>
				<th width="90">姓名</th>
				<th width="110">职位</th>
				<th width="130">手机号码</th>
				<th width="130">加入时间</th>
				<th width="80">是否已启用</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		 <?php if(is_array($staffs)): $i = 0; $__LIST__ = $staffs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($vo["staff_id"]); ?>" name="listorder[<?php echo ($vo["staff_id"]); ?>]"></td>
			    <td><?php echo ($vo["sno"]); ?></td>
			    <td><div class="picbox"><a href="<?php echo ($vo["url"]); ?>" data-lightbox="gallery" data-title="客厅2"><img src="<?php echo ($vo["url"]); ?>" width="80" height="70" ></a></div></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["position"]); ?></td>
				<td><?php echo ($vo["telephone"]); ?></td>
				<td><?php echo (date("Y-m-d H:i",$vo["createtime"])); ?></td>
				<?php if($vo["status"] == -1): ?><td class="td-status" attr-id="<?php echo ($vo["staff_id"]); ?>" attr-status="<?php echo ($vo["status"]); ?>"><span class="label label-success radius" >未启用</span></td>
				<?php else: ?>
				  <td class="td-status" attr-id="<?php echo ($vo["staff_id"]); ?>" attr-status="<?php echo ($vo["status"]); ?>"><a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a></td><?php endif; ?>
				<td>
				  <a style="text-decoration:none" onclick="myselfinfo('编辑信息',SCOPE.edit_url+'&id='+'<?php echo ($vo["staff_id"]); ?>','800','500')" class="ml-5" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
		          <a title="删除" attr-id="<?php echo ($vo["staff_id"]); ?>" id="smart-delete" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</form>
	<div class="pages">
         <?php echo ($pageRes); ?>
    </div>
</div>
<script type="text/javascript" src="/Sign/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/common.js"></script>
</script>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Sign/Public/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/lib/lightbox2/2.8.1/js/lightbox.min.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript">

 var SCOPE = {
        'add_url' : './admin.php?c=Staff&a=add',
        'edit_url' : './admin.php?c=Staff&a=edit',
        'set_status_url' : './admin.php?c=Staff&a=setStatus',
        'jump_url' : './admin.php?c=Staff&a=index',
        'set_online_url':'./admin.php?c=Staff&a=setonline',
        'listorder_url' : './admin.php?c=Staff&a=listorder',
    }
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
function myselfinfo(title,url,w,h){
	layer_show(title,url,w,h);
}
/*图片-编辑*/
function picture_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
</script>
</body>
</html>