<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Sign/Public/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/lib/respond.min.js"></script>
<![endif]-->
<link href="/Sign/Public/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Sign/Public/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/Sign/Public/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Sign/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Sign/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台登录 - 智能云锁</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class=""></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" enctype="multipart/form-data"  method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input  class="input-text size-L" type="text" name="code" placeholder="验证码"  style="width:150px;">
          <img id="verifyImg" src='/Sign/admin.php?c=Login&a=verify' onclick="fleshVerify()" />
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="">
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="login.check()">登录</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 智能云锁 </div>
<script type="text/javascript" src="/Sign/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/common.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/login.js"></script>
<script type="text/javascript">
    function fleshVerify(){
    var time = new Date().getTime();
        document.getElementById('verifyImg').src= '/Sign/admin.php?c=Login&a=verify&time='+time;
    }
</script>
<!--/此乃百度统计代码，请自行删除
</body>
</html>