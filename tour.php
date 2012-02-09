<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        $title_for_layout = "添加线路";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated=$created = now();
            $id = $db->insert('tour', array_merge($_POST['tour'], compact('created', 'updated')));
            header('location:tour.php?act=view&id='.intval($id));
            die();
        }
        include('templates/tour_add.php');
        break;
    case 'edit':
        checkPrivilege();
        $title_for_layout = "编辑线路";
        $id = intval($_GET['id']);
        $tour = $db->find('tour', $id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated= now();
            $db->update('tour', array_merge($_POST['tour'], compact('updated')), compact('id'));
            header('location:tour.php?act=view&id='.intval($id));
            die();
        }
        include('templates/tour_edit.php');
        break;
    case 'view':
        checkPrivilege();
        $title_for_layout = "线路详情";
        $id = intval($_GET['id']);
        $tour = $db->find('tour', $id);
        include('templates/tour_view.php');
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $tour = $db->delete('tour', compact('id'));
        header('location:tour.php');
        die();
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();
        $title_for_layout = "线路";
        $where = array();
        $s_where = $where?' where '.implode(' and ', $where):'';
        $tours = $db->fetchAll('select * from tour '.$s_where.' order by id desc');
        include('templates/tour_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');