<?php
require "lib/common.php";
$statuss = parse_ini_file(APP_ROOT . '/data/status.ini', true);
$contacts = parse_ini_file(APP_ROOT . '/data/contact.ini', true);
$default_status = key($statuss);
ob_start();
$tours = $db->fetchAll('select * from tour');
switch(@$_GET['act'])
{
   case 'sitemap':
       checkPrivilege();
        $title_for_layout = "我的计划";
        $plans = $db->fetchAll('select * from plan order by id desc');
        include('templates/plan_list.php');
        break;
   case 'hr':
   default:
        $_GET['act']='hr';
        checkPrivilege();
        $slug = trim(strip_tags(@$_GET['act']));
        if(!$slug)
        {
            $slug = 'aboutus';
        }
        $article = $db->fetchRow('select * from article where slug="' . $slug . '"');
        $title_for_layout = "关于我们";
        $title_for_layout .= " - ". $article['title'];
        include('templates/about.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');