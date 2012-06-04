[?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        if(isHttpPost())
        {
            $updated = $created = now();
            $id = $db->insert('<?php echo $table['name'];?>', array_merge($_POST['<?php echo $table['name'];?>'], compact('created', 'updated')));
            header('location:<?php echo $table['name'];?>.php?act=view&id='.intval($id));
            alert('添加成功!', 'success');
            die();
        }
        $title_for_layout = "添加<?php echo $table['comment'];?>";
        include('templates/<?php echo $table['name'];?>/add.php');
        break;
    case 'edit':
        checkPrivilege();
        $id = intval($_GET['id']);
        $<?php echo $table['name'];?> = $db->find('<?php echo $table['name'];?>', $id);
        if(!$<?php echo $table['name'];?>)
        {
            do404('找不到您要的<?php echo $table['comment'];?>！');
        }
        if(isHttpPost())
        {
            $updated = now();
            $db->update('<?php echo $table['name'];?>', array_merge($_POST['<?php echo $table['name'];?>'], compact('updated')), compact('id'));
            header('location:<?php echo $table['name'];?>.php?act=view&id='.intval($id));
            alert('修改成功!', 'success');
            die();
        }
        $title_for_layout = "编辑<?php echo $table['comment'];?>";
        include('templates/<?php echo $table['name'];?>/edit.php');
        break;
    case 'view':
        checkPrivilege();
        $id = intval($_GET['id']);
        $<?php echo $table['name'];?> = $db->find('<?php echo $table['name'];?>', $id);
        if(!$<?php echo $table['name'];?>)
        {
            do404('找不到您要的<?php echo $table['comment'];?>！');
        }
        $title_for_layout = "查看<?php echo $table['comment'];?>";
        include('templates/<?php echo $table['name'];?>/view.php');
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $<?php echo $table['name'];?> = $db->find('<?php echo $table['name'];?>', $id);
        if(!$<?php echo $table['name'];?>)
        {
            do404('找不到您要的<?php echo $table['comment'];?>！');
        }
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
        header('location:<?php echo $table['name'];?>.php');
        die();
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();

        $query = $db->select()->from('<?php echo $table['name'];?>')
            ->order_by('<?php echo $table['name'];?>.id', 'DESC')
            ;
        $total = $query->count();
        $pager = makePager($total, current_staff('preference_perpage', 10));
        $query->limit($pager['limit'], $pager['offset']);
        $<?php echo $table['name'];?>s = $query->execute();

        $title_for_layout = "<?php echo $table['comment'];?>";
        include('templates/<?php echo $table['name'];?>/list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');