a<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="staff.php?act=group_list">组织架构</a> <span class="divider">/</span></li>
<li class="active">所有</li>
</ul>


<p class="pull-right">
<a href="staff.php?act=group_add" class="btn">添加部门</a>
</p>


<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>名称</th>
        <th>主要职能</th>
        <th>电话</th>
        <th>操作</th>
    </tr></thead> <tbody><?php if(!empty($staff_groups)):?>

    <?php foreach($staff_groups as $staff_group):?>
    <tr>
        <td><?php echo $staff_group['id'];?></td>
        <td><?php echo $staff_group['name'];?></td>
        <td><?php echo $config['staff_targets'][$staff_group['target']];?></td>
        <td><?php echo $staff_group['phone'];?></td>
        <td>
        <a href="staff.php?act=group_view&id=<?php echo $staff_group['id'];?>" class="btn btn-info">详情</a>
        <a href="staff.php?act=group_edit&id=<?php echo $staff_group['id'];?>" class="btn">编辑</a>
        <a href="staff.php?act=group_delete&id=<?php echo $staff_group['id'];?>" class="btn btn-danger">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="staff.php?act=group_add">赶快建立编制!</a></td>
    </tr>
    <?php endif;?></tbody>
</table>