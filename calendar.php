<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
   case 'sitemap':
        $title_for_layout = "我的计划";
        include('templates/calendar.php');
        break;
   case 'hr':
   default:
        $title_for_layout = "我的日程";
        include('templates/calendar.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');