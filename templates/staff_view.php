<h3><?php echo $title_for_layout;?></h3>

<dl>
    <dt>用户名</dt><dd><?php echo $staff['username'];?></dd>
    <dt>姓名</dt><dd><?php echo $staff['name'];?></dd>
    <dt>电话</dt><dd><?php echo $staff['phone'];?></dd>
    <dt>Email</dt><dd><?php echo $staff['email'];?></dd>
    <dt>权限</dt><dd> <ul>
    <?php foreach($staff['privileges'] as $privilege):?>
        <li><?php echo $config['privileges'][$privilege];?></li>
    <?php endforeach;?>
     </ul>
    </dd>
    <dt>备注</dt> <dd><?php echo $staff['memo'];?></dd>
</dl>
</form>
