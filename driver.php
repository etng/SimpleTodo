<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
case 'add':
    checkPrivilege();
    $title_for_layout = "添加司机";
    if(isHttpPost())
    {
        $created = now();
        if(empty($_POST['driver']['age']))
        {
            $_POST['driver']['age'] = dob2age($_POST['driver']['dob']);
        }
        $driver_id = $db->insert('driver', array_merge($_POST['driver'], compact('created')));
        header('location:driver.php?act=view&id='.intval($driver_id));
        die();
    }
    include('templates/driver_add.php');
    break;
case 'view':
    checkPrivilege();
    $title_for_layout = "司机详情";
    $id = intval($_GET['id']);
    $driver = $db->find('driver', $id);
    include('templates/driver_view.php');
    break;
case 'edit':
    checkPrivilege();
    $title_for_layout = "编辑司机";
    $id = intval($_GET['id']);
    $driver = $db->find('driver', $id);
    if(isHttpPost())
    {
        if(empty($_POST['driver']['age']))
        {
            $_POST['driver']['age'] = dob2age($_POST['driver']['dob']);
        }
        $updated= now();
        $db->update('driver', array_merge($_POST['driver'], compact('updated')), compact('id'));
        header('location:driver.php?act=view&id='.intval($id));
        die();
    }
    include('templates/driver_edit.php');
    break;
case 'delete':
    checkPrivilege();
    $id = intval($_GET['id']);
    $db->delete('driver', compact('id'));
    header('location:driver.php');
    die();
    break;
case 'schedule':
    checkPrivilege();
    $title_for_layout = "所有车辆安排";
    include('templates/driver_schedule.php');
    break;
case 'list':
default:
    $_GET['act']='list';
    checkPrivilege();
    $title_for_layout = "司机";

    $query = $db->select()->from('driver')
        ->clearField()
        ->addField('driver.*')
        ->addField('destination.name as destination_name')
        ->leftJoin('driver', 'destination_id', 'destination', 'id')
        ->order_by('driver.id', 'DESC')
        ;
    $total = $query->count();
    $pager = makePager($total, current_staff('preference_perpage', 10));
    $query->limit($pager['limit'], $pager['offset']);
    $drivers = $query->execute();

    include('templates/driver_list.php');
    break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');
