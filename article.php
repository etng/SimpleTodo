<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        $title_for_layout = "添加文章";
        if(isHttpPost())
        {
            $updated=$created = now();
            $id = $db->insert('article', array_merge($_POST['article'], compact('created', 'updated')));
            header('location:article.php?act=view&id='.intval($id));
            die();
        }
        include('templates/article_add.php');
        break;
    case 'edit':
        checkPrivilege();
        $title_for_layout = "编辑文章";
        $id = intval($_GET['id']);
        $article = $db->find('article', $id);
        if(isHttpPost())
        {
            $updated= now();
            $db->update('article', array_merge($_POST['article'], compact('updated')), compact('id'));
            header('location:article.php?act=view&id='.intval($id));
            die();
        }
        include('templates/article_edit.php');
        break;
    case 'view':
        checkPrivilege();
        $title_for_layout = "文章详情";
        $id = intval($_GET['id']);
        $article = $db->find('article', $id);
        include('templates/article_view.php');
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $db->delete('article', compact('id'));
        header('location:article.php');
        die();
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();
        $title_for_layout = "文章";

        $db->select()->from('article')
        ->order_by('article.id', 'DESC')
        ;
        $total = $query->count();
        $pager = makePager($total, current_staff('preference_perpage', 10));
        $query->limit($pager['limit'], $pager['offset']);
        $articles = $query->execute();

        include('templates/article_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');