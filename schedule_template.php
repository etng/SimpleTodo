<?php
require "lib/common.php";
ob_start();
$schedule_template_cate_options = $db->fetchOptions('select id,name from schedule_template_cate', 'name');

switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        $title_for_layout = "添加日程模版";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated=$created = now();
            $id = $db->insert('schedule_template', array_merge($_POST['schedule_template'], compact('created', 'updated')));
            header('location:schedule_template.php?act=view&id='.intval($id));
            die();
        }
        include('templates/schedule_template_add.php');
        break;
    case 'edit':
        checkPrivilege();
        $title_for_layout = "编辑日程模版";
        $id = intval($_GET['id']);
        $schedule_template = $db->find('schedule_template', $id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated= now();
            $db->update('schedule_template', array_merge($_POST['schedule_template'], compact('updated')), compact('id'));
            header('location:schedule_template.php?act=view&id='.intval($id));
            die();
        }
        include('templates/schedule_template_edit.php');
        break;
    case 'view':
        checkPrivilege();
        $title_for_layout = "查看日程模版";
        $id = intval($_GET['id']);
        $schedule_template = $db->fetchRow('select schedule_template.*,schedule_template_cate.name as cate_name  from schedule_template left join schedule_template_cate on schedule_template_cate.id=schedule_template.cate_id where schedule_template.id=' . $id);
        include('templates/schedule_template_view.php');
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $schedule_template = $db->delete('schedule_template', compact('id'));
        header('location:schedule_template.php');
        die();
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();
        $title_for_layout = "日程模版";
        $where = array();
        $s_where = $where?' where '.implode(' AND ', $where):'';
        $total = $db->fetchOne('SELECT COUNT(1) AS CNT FROM schedule_template ' . $s_where);
        $pager = makePager($total, 5);
        $schedule_templates = $db->fetchAll("SELECT schedule_template.*,schedule_template_cate.name as cate_name  FROM schedule_template  left join schedule_template_cate on schedule_template_cate.id=schedule_template.cate_id {$s_where} ORDER BY schedule_template.id DESC limit {$pager['offset']},{$pager['limit']}");
        include('templates/schedule_template_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');