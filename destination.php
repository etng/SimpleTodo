<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
case 'add':
    checkPrivilege();
    $title_for_layout = "添加目的地";
    if(isHttpPost())
    {
        $updated=$created = now();
        if(empty($_POST['destination']['slug']))
        {
            $_POST['destination']['slug']=$_POST['destination']['name'];
        }
        $id = $db->insert('destination', array_merge($_POST['destination'], compact('created', 'updated')));
        header('location:destination.php?act=view&id='.intval($id));
        die();
    }
    include('templates/destination_add.php');
    break;
case 'edit':
    checkPrivilege();
    $title_for_layout = "编辑目的地";
    $id = intval($_GET['id']);
    $destination = $db->find('destination', $id);
    if(isHttpPost())
    {
        $updated= now();
        $db->update('destination', array_merge($_POST['destination'], compact('updated')), compact('id'));
        header('location:destination.php?act=view&id='.intval($id));
        die();
    }
    include('templates/destination_edit.php');
    break;
case 'view':
    checkPrivilege();
    $title_for_layout = "目的地详情";
    $id = intval($_GET['id']);
    $destination = $db->find('destination', $id);
    include('templates/destination_view.php');
    break;
case 'delete':
    checkPrivilege();
    $id = intval($_GET['id']);
    $destination = $db->delete('destination', compact('id'));
    header('location:destination.php');
    die();
    break;
case 'list':
default:
    $_GET['act']='list';
    checkPrivilege();
    $title_for_layout = "目的地";

    $query = $db->select()->from('destination')
        ->order_by('destination.id', 'DESC')
        ;
    $total = $query->count();
    $pager = makePager($total, current_staff('preference_perpage', 10));
    $query->limit($pager['limit'], $pager['offset']);
    $destinations = $query->execute();

    include('templates/destination_list.php');
    break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');
