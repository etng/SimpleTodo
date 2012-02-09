<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="scripts/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="scripts/facebox.css" />
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar.css" />
<link href="scripts/jquery.colorpicker.css" rel="stylesheet" type="text/css"/>
<link href="scripts/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar.print.css" media="print" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" type="text/css" media="all" />
<style type='text/css'>

	body {
		margin-top: 40px;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
	}
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
	}	#switcher {
		float: 			right;
		display: 		inline-block;
	}
    .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js" type="text/javascript"></script>
<script src="scripts/jquery.autogrow.js" type="text/javascript"></script>
<!-- <script src="http://jqueryui.com/themeroller/themeswitchertool/"></script>
 --><script type="text/javascript" src="scripts/jshash/md5-min.js"></script>
<script type="text/javascript" src="scripts/fullcalendar.min.js"></script>
<script type="text/javascript" src="scripts/facebox.js"></script>
<script type="text/javascript" src="scripts/jquery.qtip.js"></script>
<script type="text/javascript" src="scripts/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox.js"></script>
<script src="scripts/jquery.colorpicker.js"></script>
<script type="text/javascript" src="scripts/global.js"></script>
<title><?php echo $title_for_layout;?> - <?php echo $config['site']['name'];?></title>

</head>
<body>
<div id="header">
    <h2><a href="/" class="logo"><span><?php echo $config['site']['name'];?><span></a></h2>
    <div id="mainMenu">
        <a href="/" title="<?php echo $config['site']['name'];?> 首页">首页</a>
        <a href="calendar.php">我的日程</a>
        <a href="plan.php">我的计划</a>
        <a href="plan.php?act=add">添加计划</a>
        <a href="hotel.php?act=add">添加酒店</a>
        <a href="hotel.php">酒店管理</a>
        <a href="article.php?act=add">添加文章</a>
        <a href="article.php">文章管理</a>
        <a href="destination.php?act=add">添加目的地</a>
        <a href="destination.php">目的地管理</a>
        <a href="tour.php?act=add">添加线路</a>
        <a href="tour.php">线路管理</a>
        <a href="driver.php?act=add">添加司机</a>
        <a href="driver.php">司机管理</a>
    </div><!--mainMenu-->
</div><!--header-->
<?php if(!empty($_SESSION['staff']['name'])):?>
<div>欢迎：<?php echo $_SESSION['staff']['name'];?> <a href="auth.php?act=logout">退出登录</a></div>
<?php endif;?>

<div id="switcher"></div>
<div id="loading" style="display:none">loading...</div>
<div class="notice">以下内容纯属虚构，如果有巧合，纯属对号入座！</div>
 <?php if(!empty($_SESSION['last_notice'])):?>
<div class="notice"><?php echo $_SESSION['last_notice'];?></div>
 <?php endif;?>
<?php echo $content_for_layout;?>
 ﻿<div id="footer">
    <div class="clear"></div>
    <p class="cp">
        <a href="/" title="<?php echo $config['site']['name'];?> 首页">首页</a>|
		<a href="about.php">关于我们</a>|
		<a href="about.php?act=contact">联系我们</a>|
		<a href="about.php?act=hr">诚聘英才</a>|
		<a href="about.php?act=tos">隐私条款</a>
	</p>
    <p class="cp"> © <?php echo date('Y');?> <?php echo $_SERVER['HTTP_HOST'];?> </p>
</div><!--footer-->

</body>
</html>
