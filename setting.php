<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'save':
        checkPrivilege();
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            foreach($_POST['setting'] as $var=>$val)
            {
              $val = json_encode($val);
              $db->replace('setting', $a = compact('var', 'val'));
            }
        }
        header('location:setting.php');
        break;
    case 'list':
    default:
        checkPrivilege();
        $title_for_layout = "系统配置";
        include('templates/setting.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');