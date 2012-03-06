<h3><?php echo $title_for_layout;?></h3>

<dl>
    <dt>名称</dt><dd><?php echo $staff_group['name'];?></dd>
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
