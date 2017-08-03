<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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

<title>编辑成员 - 成员管理 - H-ui.admin v2.4</title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="smart-form">
	    <div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>编号：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="<?php echo ($Folks["sno"]); ?>" placeholder="" id="name" name="name" disabled="true">
				</div>
		</div>
		<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="<?php echo ($Folks["name"]); ?>" placeholder="" id="name" name="name">
				</div>
		</div>
		<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
				<div class="formControls col-xs-8 col-sm-9 skin-minimal">
					<div class="radio-box">
						<input name="sex" value="0" type="radio" id="sex-1" <?php if($Folks["sex"] == 0 ): ?>checked="checked"<?php endif; ?> >
						<label for="sex-1">男</label>
					</div>
					<div class="radio-box">
						<input type="radio" value="1" id="sex-2" name="sex" <?php if($Folks["sex"] == 1 ): ?>checked="checked"<?php endif; ?> >
						<label for="sex-2">女</label>
					</div>
				</div>
		</div>
		<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>电话：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="<?php echo ($Folks["telephone"]); ?>" placeholder="" id="telephone" name="telephone">
				</div>
		</div>
		<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">所在家庭：</label>
				<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
					<select class="select" size="1" name="depart_id">
						<option value="" selected>请选择家庭</option>
						 <?php if(is_array($departs)): $i = 0; $__LIST__ = $departs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$depart): $mod = ($i % 2 );++$i;?><option value="<?php echo ($depart["depart_id"]); ?>"><?php echo ($depart["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					</span> 
				</div>
		</div>
		<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>家庭身份：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="<?php echo ($Folks["position"]); ?>" placeholder="" id="position" name="position">
				</div>
		</div>
		 <input type="hidden" name="staff_id" value="<?php echo ($Folks["staff_id"]); ?>"/>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				 <button type="button" class="btn btn-primary radius" id="smart-button-submit">提交</button>
		    </div>
	    </div>
	</form>
</article>

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
<script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
 var SCOPE = {
        'save_url' : './admin.php?c=Folks&a=add',
        'jump_url' : './admin.php?c=Folks&a=index',
    }
</script> 
</body>
</html>