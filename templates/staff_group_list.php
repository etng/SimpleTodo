<h3><?php echo $title_for_layout;?></h3>


<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>名称</th>
        <th>电话</th>
        <th>操作</th>
    </tr></thead> <tbody><?php if(!empty($staff_groups)):?>

    <?php foreach($staff_groups as $staff_group):?>
    <tr>
        <td><?php echo $staff_group['id'];?></td>
        <td><?php echo $staff_group['name'];?></td>
        <td><?php echo $staff_group['phone'];?></td>
        <td>
        <a href="staff.php?act=group_view&id=<?php echo $staff_group['id'];?>" class="btn btn-info">详情</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="staff.php?act=group_add">赶快建立编制!</a></td>
    </tr>
    <?php endif;?></tbody>
</table>