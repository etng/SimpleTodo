<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="staff.php?act=group_list">组织架构</a> <span class="divider">/</span></li>
<li class="active">查看<?php echo $staff_group['id'];?></li>
</ul>

<dl>
    <dt>名称</dt><dd><?php echo $staff_group['name'];?></dd>
    <dt>主要职能</dt><dd><?php echo $config['staff_targets'][$staff_group['target']];?></dd>
    <dt>电话</dt><dd><?php echo $staff_group['phone'];?></dd>
    <dt>权限</dt><dd> <ul>
    <?php foreach($staff_group['privileges'] as $privilege):?>
        <li><?php echo $config['privileges'][$privilege];?></li>
    <?php endforeach;?>
     </ul>
    </dd>
    <dt>备注</dt> <dd><?php echo $staff_group['memo'];?></dd>
</dl>
</form>
