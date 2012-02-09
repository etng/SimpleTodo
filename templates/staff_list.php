<h3><?php echo $title_for_layout;?></h3>


<table>
    <tr>
        <td>编号</td>
        <td>用户名</td>
        <td>姓名</td>
        <td>电话</td>
        <td>Email</td>
        <td>操作</td>
    </tr> <?php if(!empty($staffs)):?>

    <?php foreach($staffs as $staff):?>
    <tr>
        <td><?php echo $staff['id'];?></td>
        <td><?php echo $staff['username'];?></td>
        <td><?php echo $staff['name'];?></td>
        <td><?php echo $staff['phone'];?></td>
        <td><?php echo $staff['email'];?></td>
        <td>
        <a href="staff.php?act=view&id=<?php echo $staff['id'];?>">详情</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="staff.php?act=add">找两个丘八</a></td>
    </tr>
    <?php endif;?>
</table>