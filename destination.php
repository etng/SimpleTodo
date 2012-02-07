<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        $title_for_layout = "添加目的地";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated=$created = now();
            $id = $db->insert('destination', array_merge($_POST['destination'], compact('created', 'updated')));
            header('location:destination.php?act=view&id='.intval($id));
            die();
        }
        include('templates/destination_add.php');
        break;
    case 'edit':
        $title_for_layout = "编辑目的地";
        $id = intval($_GET['id']);
        $destination = $db->find('destination', $id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated= now();
            $db->update('destination', array_merge($_POST['destination'], compact('updated')), compact('id'));
            header('location:destination.php?act=view&id='.intval($id));
            die();
        }
        include('templates/destination_edit.php');
        break;
    case 'view':
        $title_for_layout = "目的地详情";
        $id = intval($_GET['id']);
        $destination = $db->find('destination', $id);
        include('templates/destination_view.php');
        break;
    case 'delete':
        $id = intval($_GET['id']);
        $destination = $db->delete('destination', compact('id'));
        header('location:destination.php');
        die();
        break;
    case 'list':
    default:
        $title_for_layout = "目的地";
        $where = array();
        $s_where = $where?' where '.implode(' and ', $where):'';
        $destinations = $db->fetchAll('select * from destination '.$s_where.' order by id desc');
        include('templates/destination_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');