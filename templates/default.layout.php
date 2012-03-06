<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/docs.css" rel="stylesheet">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon" href="assets/ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/ico/apple-touch-icon-114x114.png">


<link rel="stylesheet" type="text/css" href="scripts/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="scripts/facebox.css" />
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar.css" />
<link href="scripts/jquery.colorpicker.css" rel="stylesheet" type="text/css"/>
<link href="scripts/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar.print.css" media="print" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" type="text/css" media="all" />
<!-- <link rel="stylesheet" href="assets/css/common.css" type="text/css" media="all" />
 --><style type='text/css'>
</style>


    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/google-code-prettify/prettify.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/application.js"></script>
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
<body data-spy="scroll" data-target=".subnav" data-offset="50">

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/"><?php echo $config['site']['name'];?></a>
          <div class="nav-collapse">
            <ul class="nav">
                <li class=""><a href="<?php echo $base_url;?>/" title="<?php echo $config['site']['name'];?> 首页">首页</a></li>
                <li class=""><a href="calendar.php">我的日程</a></li>
                <li class=""><?php if(checkPrivilege('plan', 'list')):?><a href="plan.php">我的计划</a><?php endif;?></li>
                <li class=""><?php if(checkPrivilege('plan', 'add')):?><a href="plan.php?act=add">添加计划</a><?php endif;?></li>
                <!-- <li class=""><?php if(checkPrivilege('hotel', 'add')):?><a href="hotel.php?act=add">添加酒店</a><?php endif;?></li>
 -->                <li class=""><?php if(checkPrivilege('hotel', 'list')):?><a href="hotel.php">酒店</a><?php endif;?></li>
                <!-- <li class=""><?php if(checkPrivilege('article', 'add')):?><a href="article.php?act=add">添加文章</a><?php endif;?></li>
 -->                <li class=""><?php if(checkPrivilege('article', 'list')):?><a href="article.php">文章</a><?php endif;?></li>
                <!-- <li class=""><?php if(checkPrivilege('destination', 'add')):?><a href="destination.php?act=add">添加目的地</a><?php endif;?></li>
 -->                <li class=""><?php if(checkPrivilege('destination', 'list')):?><a href="destination.php">目的地</a><?php endif;?></li>
                <!-- <li class=""><?php if(checkPrivilege('tour', 'add')):?><a href="tour.php?act=add">添加线路</a><?php endif;?></li>
 -->                <li class=""><?php if(checkPrivilege('tour', 'list')):?><a href="tour.php">线路</a><?php endif;?></li>
                <!-- <li class=""><?php if(checkPrivilege('driver', 'add')):?><a href="driver.php?act=add">添加司机</a><?php endif;?></li>
 -->                <li class=""><?php if(checkPrivilege('driver', 'list')):?><a href="driver.php">司机</a><?php endif;?></li>
                <!-- <li class=""><?php if(checkPrivilege('staff', 'add')):?><a href="staff.php?act=add">添加员工</a><?php endif;?></li>
 -->                <li class=""><?php if(checkPrivilege('staff', 'list')):?><a href="staff.php">员工</a><?php endif;?></li>
                <li class=""><?php if(checkPrivilege('staff', 'list_group')):?><a href="staff.php?act=group_list">组织架构</a><?php endif;?></li>
            </ul>
          <form class="navbar-search pull-left" action="">
            <input type="text" class="search-query span2" placeholder="搜索">
          </form>
          <ul class="nav pull-right">
          <?php if(!empty($_SESSION['staff']['name'])):?>
          <li><a href="#"><?php echo $_SESSION['staff']['name'];?></a></li>
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['staff']['name'];?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">设置</a></li>
                <li><a href="#">个人资料</a></li>
                <li><a href="#">修改密码</a></li>
                <li class="divider"></li>
                <li><a href="auth.php?act=logout">退出登录</a></li>
              </ul>
            </li>
            <?php else:?>
          <li><a href="auth.php?act=login">登录</a></li>
            <?php endif;?>
          </ul>
          </div>
        </div>
      </div>
    </div>


<div class="container">
 <div id="main">




<div class="alert alert-success">
以下内容纯属虚构，如果有巧合，纯属对号入座！
 <?php if(!empty($_SESSION['last_notice'])):?>
<?php echo $_SESSION['last_notice'];?>
 <?php endif;?>
</div>


<div id="switcher"></div>
<div id="loading" style="display:none">loading...</div>
<?php echo $content_for_layout;?>
</div>

 ﻿<div class="footer">
    <p class="pull-right"><a href="#">回到顶部</a></p>
    <p class="cp">
        <a href="/" title="<?php echo $config['site']['name'];?> 首页">首页</a>|
		<a href="about.php">关于我们</a>|
		<a href="about.php?act=contact">联系我们</a>|
		<a href="about.php?act=hr">诚聘英才</a>|
		<a href="about.php?act=tos">隐私条款</a>
	</p>
    <p class="cp"> © <?php echo date('Y');?> <?php echo $_SERVER['HTTP_HOST'];?> </p>
</div><!--footer-->
</div>


</body>
</html>
