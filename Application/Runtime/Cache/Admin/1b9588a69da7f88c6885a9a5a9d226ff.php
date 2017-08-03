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
<title>今日考勤</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 考勤管理 <span class="c-gray en">&gt;</span> 今日考勤 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
        <div class="row">
          <form action="./admin.php" method="get">
			<div class="text-c"> 
			 <span class="select-box inline">
				<select class="select" name="depart_id">
				 <option value="0" <?php if(0 == $depart_id): ?>selected="selected"<?php endif; ?>>部门分类</option>
                    <?php if(is_array($departs)): foreach($departs as $key=>$depart): ?><option value="<?php echo ($depart["depart_id"]); ?>" <?php if($depart["depart_id"] == $depart_id): ?>selected="selected"<?php endif; ?>><?php echo ($depart["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</span>
			    <input type="hidden" name="c" value="Attend"/>
                <input type="hidden" name="a" value="index"/>
				<input type="text" class="input-text" style="width:250px" placeholder="输入员工名称" id="" name="name" value="<?php echo ($name); ?>">
				<button type="submit" class="btn btn-success" id="sub_data"><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
			</div>
		   </form>
        </div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span> <span class="r">共有数据：<strong><?php echo ($Count); ?></strong> 条</span>
			</div>
			 <form id="smart-listorder">
	           <table class="table table-border table-bordered table-bg">
		         <thead>
			<tr>
				<th scope="col" colspan="9">考勤列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="60">员工编号</th>
				<th width="70">姓名</th>
				<th width="55">部门</th>
				<th width="70">职位</th>
				<th width="100">上班时间</th>
				<th width="100">下班时间</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
		 <?php if(is_array($attends)): $i = 0; $__LIST__ = $attends;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($vo["attend_id"]); ?>" name="listorder[<?php echo ($vo["attend_id"]); ?>]"></td>
			    <td><?php echo ($vo["sno"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["departname"]); ?></td>
				<td><?php echo ($vo["position"]); ?></td>
				<td><?php echo (date("Y-m-d H:i",$vo["wordtime"])); ?></td>
				<td><?php echo (date("Y-m-d H:i",$vo["clostime"])); ?></td>
				<td>
		          <a title="删除" attr-id="<?php echo ($vo["attend_id"]); ?>" id="smart-delete" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</form>
	<div class="pages">
         <?php echo ($pageRes); ?>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Sign/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/common.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Sign/Public/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript">

 var SCOPE = {
        'jump_url' : './admin.php?c=Attend&a=index',
        'set_online_url':'./admin.php?c=Attend&a=setonline',
        'listorder_url' : './admin.php?c=Attend&a=listorder',
    }
</script>

</body>
</html>