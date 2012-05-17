<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="assets/css/docs.css" />
<link rel="stylesheet" type="text/css" href="assets/js/google-code-prettify/prettify.css" />
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="shortcut icon" href="assets/ico/favicon.ico" />
<link rel="apple-touch-icon" href="assets/ico/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="72x72" href="assets/ico/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="assets/ico/apple-touch-icon-114x114.png" />
<link rel="stylesheet" type="text/css" href="assets/js/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="assets/js/facebox.css" />
<link rel="stylesheet" type="text/css" href="assets/js/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="assets/js/jquery.colorpicker.css" />
<link rel="stylesheet" type="text/css" href="assets/js/fancybox/jquery.fancybox.css" />
<link rel="stylesheet" type="text/css" href="assets/css/ui.daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="assets/css/enhanced.css" />
<link rel="stylesheet" type="text/css" href="assets/js/fullcalendar.print.css" media="print" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery-ui-1.8.16.custom.css"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.ui.1.8.16.ie.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="assets/css/global.css" media="all" />
<style type='text/css'></style>
<script type="text/javascript" src="assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-transition.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-alert.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-scrollspy.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-tab.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-button.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-carousel.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="assets/js/application.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui-1.8.19.custom.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui-i18n.js"></script>
<script type="text/javascript" src="assets/js/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.autogrow.js"></script>
<script type="text/javascript" src="assets/js/jshash/md5-min.js"></script>
<script type="text/javascript" src="assets/js/fullcalendar.min.js"></script>
<script type="text/javascript" src="assets/js/facebox.js"></script>
<script type="text/javascript" src="assets/js/jquery.qtip.js"></script>
<script type="text/javascript" src="assets/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="assets/js/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="assets/js/jquery.colorpicker.js"></script>
<script type="text/javascript" src="assets/js/underscore-min.js"></script>
<script type="text/javascript" src="assets/js/date.js"></script>
<script type="text/javascript" src="assets/js/daterangepicker.jQuery.js"></script>
<script type="text/javascript" src="assets/js/jquery.bgiframe-2.1.3-pre.js"></script>
<script type="text/javascript" src="assets/js/enhance.min.js"></script>
<script type="text/javascript" src="assets/js/fileinput.jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="assets/js/global.js"></script>
<title><?php echo $title_for_layout;?>-<?php echo $config['site']['name'];?></title>
</head>
<?php $nav = include(APP_ROOT . '/data/nav.php');?>
<body data-spy="scroll" data-target=".subnav" data-offset="50">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="/"><?php echo $config['site']['name'];?></a>
      <div class="nav-collapse">
        <ul class="nav nav-pills">
          <li class=""><a href="<?php echo $base_url;?>/" title="<?php echo $config['site']['name'];?> 首页">首页</a></li>
          <?php foreach($nav as $item):?>
          <?php if(!empty($item['children'])):?>
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo url_for($item['u']['c'], $item['u']['a']);?>"><?php echo $item['title'];?><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <?php foreach($item['children'] as $sub_item):?>
            <?php if($sub_item=='divider'):?>
            <li class="divider"></li>
            <?php else:?>
            <li>
              <?php if(checkPrivilege($sub_item['u']['c'], $sub_item['u']['a'])):?>
            <li class=""><a href="<?php echo url_for($sub_item['u']['c'], $sub_item['u']['a'], $sub_item['u']);?>"><?php echo $sub_item['title'];?></a></li>
            <?php endif;?>
            </li>
            <?php endif;?>
            <?php endforeach;?>
          </ul>
          </li>
          <?php else:?>
          <?php if(checkPrivilege($item['u']['c'], $item['u']['a'])):?>
          <li class=""><a href="<?php echo url_for($item['u']['c'], $item['u']['a']);?>"><?php echo $item['title'];?></a></li>
          <?php endif;?>
          <?php endif;?>
          <?php endforeach;?>
        </ul>
        <form class="navbar-search pull-left" action="">
          <input type="text" class="search-query span2" placeholder="搜索">
        </form>
        <ul class="nav pull-right">
          <?php if(!empty($_SESSION['staff']['name'])):?>
          <li><a href="my.php?act=edit-profile">当前用户</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown"> <a href="my.php?act=edit-profile" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['staff']['name'];?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="my.php?act=edit-profile">资料更新</a></li>
              <li><a href="my.php?act=edit-pass">修改密码</a></li>
              <li><a href="my.php?act=edit-preference">偏好设置</a></li>
              <li class="divider"></li>
              <li><a href="auth.php?act=logout">退出</a></li>
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
    <?php if(!empty($_SESSION['last_notice'])):?>
    <div class="alert alert-<?php echo $_SESSION['last_notice']['type'];?>"><?php echo $_SESSION['last_notice']['content'];?></div>
    <?php endif;?>
    <div id="switcher"></div>
    <div id="loading" style="display:none">loading...</div>
    <?php echo $content_for_layout;?> </div>
  ﻿
  <div class="footer">
    <?php if($config['site']['legal_notice']):?>
    <div class="alert alert-info"> 本站内容纯属虚构，如果有巧合，纯属对号入座！ </div>
    <?php endif;?>
    <p class="pull-right"><a href="#">回到顶部</a></p>
    <p class="cp"> <a href="/" title="<?php echo $config['site']['name'];?> 首页">首页</a>| <a href="about.php">关于我们</a>| <a href="about.php?act=contact">联系我们</a>| <a href="about.php?act=hr">诚聘英才</a>| <a href="about.php?act=tos">隐私条款</a> </p>
    <p class="cp"> © <?php echo date('Y');?> <?php echo $_SERVER['HTTP_HOST'];?> </p>
  </div>
  <!--footer--> 
</div>
</body>
</html>
