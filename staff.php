<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        $title_for_layout = "添加员工";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $created = now();
            $_POST['staff']['privileges'] = implode(',', $_POST['staff']['privilege']);
            unset($_POST['staff']['privilege']);
            $password = md5(md5($_POST['staff']['username'].$_POST['staff']['password']).$_POST['staff']['username']);
            $staff_id = $db->insert('staff', $record = array_merge($_POST['staff'], compact('created', 'password')));
            header('location:staff.php?act=view&id='.intval($staff_id));
            die();
        }
        include('templates/staff_add.php');
        break;
    case 'view':
        checkPrivilege();
        $title_for_layout = "员工详情";
        $id = intval($_GET['id']);
        $staff = $db->find('staff', $id);
        include('templates/staff_view.php');
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();
        $title_for_layout = "员工";
        $where = array();
        $s_where = $where?' where '.implode(' and ', $where):'';
        $staffs = $db->fetchAll('select staff.* from staff '.$s_where.' order by id desc');
        include('templates/staff_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');