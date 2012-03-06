<h3><?php echo $title_for_layout;?></h3>


<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>所属组</th>
        <th>用户名</th>
        <th>姓名</th>
        <th>电话</th>
        <th>Email</th>
        <th>操作</th>
    </tr> </thead><tbody><?php if(!empty($staffs)):?>

    <?php foreach($staffs as $staff):?>
    <tr>
        <td><?php echo $staff['id'];?></td>
        <td><a href="staff.php?act=group_view&id=<?php echo $staff['group_id'];?>"><?php echo $staff['group_name'];?></a></td>
        <td><?php echo $staff['username'];?></td>
        <td><?php echo $staff['name'];?></td>
        <td><?php echo $staff['phone'];?></td>
        <td><?php echo $staff['email'];?></td>
        <td>
        <a href="staff.php?act=view&id=<?php echo $staff['id'];?>" class="btn btn-info">详情</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="staff.php?act=add">找两个丘八</a></td>
    </tr>
    <?php endif;?></tbody>
</table>