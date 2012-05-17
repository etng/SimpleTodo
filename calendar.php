<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
case 'sitemap':
    checkPrivilege();
    $title_for_layout = "我的计划";
    include('templates/calendar.php');
    break;
case 'hr':
default:
    checkPrivilege();
    $_GET['act']='hr';
    $title_for_layout = "我的日程";
    include('templates/calendar.php');
    break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');
