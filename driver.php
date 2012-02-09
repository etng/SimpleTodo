<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        $title_for_layout = "添加司机";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
        $created = now();
            $driver_id = $db->insert('driver', array_merge($_POST['driver'], compact('created')));
            header('location:driver.php?act=view&id='.intval($driver_id));
            die();
        }
        include('templates/driver_add.php');
        break;
    case 'view':
        $title_for_layout = "司机详情";
        $id = intval($_GET['id']);
        $driver = $db->find('driver', $id);
        include('templates/driver_view.php');
        break;
    case 'list':
    default:
        $title_for_layout = "司机";
        $where = array();
        $s_where = $where?' where '.implode(' and ', $where):'';
        $drivers = $db->fetchAll('select driver.*,destination.name as destination_name from driver left join destination on destination.id=driver.destination_id '.$s_where.' order by driver.id desc');
        include('templates/driver_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');