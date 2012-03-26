<?php
require "lib/common.php";
ob_start();
$staff_groups = $db->fetchAll('select * from staff_group');
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
    case 'group_add':
        checkPrivilege();
        $title_for_layout = "添加部门";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $created = now();
            $_POST['staff_group']['privileges'] = implode(',', $_POST['staff_group']['privilege']);
            unset($_POST['staff_group']['privilege']);
            $staff_group_id = $db->insert('staff_group', $record = array_merge($_POST['staff_group'], compact('created')));
            header('location:staff.php?act=group_view&id='.intval($staff_group_id));
            die();
        }
        include('templates/staff_group_add.php');
        break;
    case 'view':
        checkPrivilege();
        $title_for_layout = "员工详情";
        $id = intval($_GET['id']);
        $staff = $db->find('staff', $id);
        $staff['group'] = $db->fetchRow('select * from staff_group where id=' . $staff['group_id']);
        $staff['group_name'] = $staff['group']['name'];
        $staff['privileges'] = $staff['privileges']?explode(',', $staff['privileges']):array();
        $staff['group']['privileges'] = $staff['group']['privileges']?explode(',', $staff['group']['privileges']):array();
        include('templates/staff_view.php');
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $db->delete('staff', compact('id'));
        header('location:staff.php');
        die();
        break;
    case 'group_delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $db->delete('staff_group', compact('id'));
        header('location:staff.php?act=group_list');
        die();
        break;
    case 'edit':
        checkPrivilege();
        $title_for_layout = "修改员工资料";
        $id = intval($_GET['id']);
        $staff = $db->find('staff', $id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $new_staff = $_POST['staff'];
            $new_staff['privileges'] = implode(',', $_POST['staff']['privilege']);
            unset($new_staff['password']);
            if(!empty($_POST['staff']['password']))
            {
                $new_staff['password'] = md5(md5($_POST['staff']['username'].$_POST['staff']['password']).$_POST['staff']['username']);
            }
            $db->update('staff', $new_staff, compact('id'));
            header('location:staff.php?act=view&id='.intval($id));
            die();
        }
        $staff['group'] = $db->fetchRow('select * from staff_group where id=' . $staff['group_id']);
        $staff['group_name'] = $staff['group']['name'];
        $staff['privileges'] = $staff['privileges']?explode(',', $staff['privileges']):array();
        $staff['group']['privileges'] = $staff['group']['privileges']?explode(',', $staff['group']['privileges']):array();
        include('templates/staff_edit.php');
        break;
    case 'group_view':
        checkPrivilege();
        $title_for_layout = "部门详情";
        $id = intval($_GET['id']);
        $staff_group = $db->find('staff_group', $id);
        $staff_group['privileges'] = $staff_group['privileges']?explode(',', $staff_group['privileges']):array();
        include('templates/staff_group_view.php');
        break;
    case 'group_edit':
        checkPrivilege();
        $title_for_layout = "修改部门";
        $id = intval($_GET['id']);
        $staff_group = $db->find('staff_group', $id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $new_staff_group = $_POST['staff_group'];
            $new_staff_group['privileges'] = implode(',', $_POST['staff_group']['privilege']);
            $db->update('staff_group', $new_staff_group, compact('id'));
            header('location:staff.php?act=group_view&id='.intval($id));
            die();
        }
        $staff_group['privileges'] = $staff_group['privileges']?explode(',', $staff_group['privileges']):array();
        include('templates/staff_group_edit.php');
        break;
    case 'group_list':
        checkPrivilege();
        $title_for_layout = "部门列表";
        $where = array();
        $s_where = $where?' where '.implode(' and ', $where):'';
        $staff_groups = $db->fetchAll('select staff_group.* from staff_group '.$s_where.' order by staff_group.id desc');
        include('templates/staff_group_list.php');
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();
        $title_for_layout = "员工";
        $where = array();
        $s_where = $where?' where '.implode(' and ', $where):'';
        $staffs = $db->fetchAll('select staff.*,staff_group.name as group_name from staff left join staff_group on staff_group.id=staff.group_id '.$s_where.' order by staff.id desc');
        include('templates/staff_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');