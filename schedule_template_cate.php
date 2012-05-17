<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        $title_for_layout = "添加日程模版分类";
        if(isHttpPost())
        {
            $updated=$created = now();
            $id = $db->insert('schedule_template_cate', array_merge($_POST['schedule_template_cate'], compact('created', 'updated')));
            header('location:schedule_template_cate.php?act=view&id='.intval($id));
             alert('添加成功', 'success');
            die();
        }
        include('templates/schedule_template_cate_add.php');
        break;
    case 'edit':
        checkPrivilege();
        $title_for_layout = "编辑日程模版分类";
        $id = intval($_GET['id']);
        $schedule_template_cate = $db->find('schedule_template_cate', $id);
        if(isHttpPost())
        {
            $updated= now();
            $db->update('schedule_template_cate', array_merge($_POST['schedule_template_cate'], compact('updated')), compact('id'));
            header('location:schedule_template_cate.php?act=view&id='.intval($id));
            die();
        }
        include('templates/schedule_template_cate_edit.php');
        break;
    case 'view':
        checkPrivilege();
        $title_for_layout = "查看日程模版分类";
        $id = intval($_GET['id']);
        $schedule_template_cate = $db->find('schedule_template_cate', $id);
        include('templates/schedule_template_cate_view.php');
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $schedule_template_cate = $db->delete('schedule_template_cate', compact('id'));
        header('location:schedule_template_cate.php');
        die();
        break;
    case 'batch':
        checkPrivilege();
        switch(@$_POST['bact'])
        {
            case "delete":
                foreach($_POST['ids'] as $id)
                {
                    $db->delete('schedule_template_cate', compact('id'));
                }
                alert('删除成功', 'success');
                break;
            case "valid":
            default:
                break;
        }
        header('location:schedule_template_cate.php');
        die();
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();
        $title_for_layout = "日程模版分类";
        $where = array();
        $s_where = $where?' where '.implode(' AND ', $where):'';
        $total = $db->fetchOne('SELECT COUNT(1) AS CNT FROM schedule_template_cate ' . $s_where);
        $pager = makePager($total, 5);
        $schedule_template_cates = $db->fetchAll("SELECT * FROM schedule_template_cate {$s_where} ORDER BY id DESC limit {$pager['offset']},{$pager['limit']}");
        include('templates/schedule_template_cate_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');