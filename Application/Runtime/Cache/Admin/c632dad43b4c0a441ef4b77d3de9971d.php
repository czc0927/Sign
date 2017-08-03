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

    <title>直播监控</title>
    <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="/Sign/Public/admin/lib/video-js/video-js.css" rel="stylesheet">
    <script src="videojs-contrib-media-sources.min.js"></script>
    <script src="/Sign/Public/admin/lib/video-js/video.js"></script>
    <script src="/Sign/Public/admin/lib/video-js/videojs-contrib-hls.min.js"></script>
    <script type="text/javascript" src="/Sign/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript" src="/Sign/Public/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Sign/Public/admin/common.js"></script>
</head>
<body>

<div style="padding-top:20px; padding-left:20px;">
    <video id="live-stream" class="video-js vjs-default-skin vjs-big-play-centered"
           controls autoplay preload="auto" width="1080" height="520" poster="/Sign/Public/Common/static/images/videodemo.png"
           data-setup='{"example_option":true}'>
        <source src="http://open.ys7.com/openlive/a82bd12b67e94bcbb0304b571f327003.hd.m3u8" type="application/x-mpegURL">
    </video>
</div>
<div  style="padding-left:20px;"><button type="button" class="btn btn-success-outline radius" id="photos" onclick="photos()" >截图</button>
<button type="button" style="display:none;" class="btn btn-warning-outline radius" id="quxiao" onclick="quxiao()" >取消</button>
</div>
<div class="panel panel-default" style="display:none;" >
	<div class="panel-header">截图</div>
	<div class="panel-body"></div>
</div>
<script>
    var options = {
        width: 740,
        height: 460
    }
    var player = videojs('live-stream', options);

    player.on(['loadstart', 'play', 'playing', 'firstplay', 'pause', 'ended', 'adplay', 'adplaying', 'adfirstplay', 'adpause', 'adended', 'contentplay', 'contentplaying', 'contentfirstplay', 'contentpause', 'contentended', 'contentupdate'], function(e) {
        console.warn('VIDEOJS player event: ',  e.type);
    });

     function photos(){
             var param = {};
            var url="./admin.php?c=Live&a=photos";
             $.get(url, param, function(dom) { 
                layer_show("截图",dom,520,340);
                $('.panel').show();
                 $('#quxiao').show();
                var img=document.createElement("img");  // 以 DOM 创建新元素
                img.setAttribute("class", "radius");
                img.setAttribute("src", ""+dom);
                img.setAttribute("style","padding-left:20px; height:140px; width:140px;");
                $('.panel-body').append(img);
              });
      }
      function quxiao(){
      	 $('.panel').hide();
      	  $('#quxiao').hide();
      }
</script>
</body>
</html>