[?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        $title_for_layout = "添加<?php echo $table['comment'];?>";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated=$created = now();
            $id = $db->insert('<?php echo $table['name'];?>', array_merge($_POST['<?php echo $table['name'];?>'], compact('created', 'updated')));
            header('location:<?php echo $table['name'];?>.php?act=view&id='.intval($id));
            alert('添加成功!', 'success');
            die();
        }
        include('templates/<?php echo $table['name'];?>_add.php');
        break;
    case 'edit':
        checkPrivilege();
        $title_for_layout = "编辑<?php echo $table['comment'];?>";
        $id = intval($_GET['id']);
        $<?php echo $table['name'];?> = $db->find('<?php echo $table['name'];?>', $id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated= now();
            $db->update('<?php echo $table['name'];?>', array_merge($_POST['<?php echo $table['name'];?>'], compact('updated')), compact('id'));
            header('location:<?php echo $table['name'];?>.php?act=view&id='.intval($id));
            alert('修改成功!', 'success');
            die();
        }
        include('templates/<?php echo $table['name'];?>_edit.php');
        break;
    case 'view':
        checkPrivilege();
        $title_for_layout = "查看<?php echo $table['comment'];?>";
        $id = intval($_GET['id']);
        $<?php echo $table['name'];?> = $db->find('<?php echo $table['name'];?>', $id);
        include('templates/<?php echo $table['name'];?>_view.php');
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $<?php echo $table['name'];?> = $db->delete('<?php echo $table['name'];?>', compact('id'));
        header('location:<?php echo $table['name'];?>.php');
        die();
        break;
    case 'batch':
        checkPrivilege();
        switch(@$_POST['bact'])
        {
            case "delete":
                foreach($_POST['ids'] as $id)
                {
                    $db->delete('<?php echo $table['name'];?>', compact('id'));
                }
                alert('删除成功!', 'success');
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
        $title_for_layout = "<?php echo $table['comment'];?>";
        $where = array();
        $s_where = $where?' where '.implode(' AND ', $where):'';
        $total = $db->fetchOne('SELECT COUNT(1) AS CNT FROM <?php echo $table['name'];?> ' . $s_where);
        $pager = makePager($total, current_staff('preference_perpage', 10));
        $<?php echo $table['name'];?>s = $db->fetchAll("SELECT * FROM <?php echo $table['name'];?> {$s_where} ORDER BY id DESC limit {$pager['offset']},{$pager['limit']}");
        include('templates/<?php echo $table['name'];?>_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');