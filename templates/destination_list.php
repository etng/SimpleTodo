<h3><?php echo $title_for_layout;?></h3>


<table>
    <tr>
        <td>编号</td>
        <td>名称</td>
        <td>发布时间</td>
        <td>更新时间</td>
        <td>操作</td>
    </tr> <?php if(!empty($destinations)):?>

    <?php foreach($destinations as $destination):?>
    <tr>
        <td><?php echo $destination['id'];?></td>
        <td><?php echo $destination['name'];?></td>
        <td><?php echo $destination['created'];?></td>
        <td><?php echo $destination['updated'];?></td>
        <td>
        <a href="destination.php?act=view&id=<?php echo $destination['id'];?>">详情</a>
        <a href="destination.php?act=edit&id=<?php echo $destination['id'];?>">编辑</a>
        <a href="destination.php?act=delete&id=<?php echo $destination['id'];?>">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="destination.php?act=add">发目的地</a></td>
    </tr>
    <?php endif;?>
</table>