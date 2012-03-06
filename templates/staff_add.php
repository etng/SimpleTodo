<h3><?php echo $title_for_layout;?></h3>
<form method="post" action="">
<dl>
    <dt>所属组</dt><dd>
    <select id="staff_group_id" name="staff[group_id]">
        <option value="" selected="selected">--请选择--</option>
        <?php foreach($staff_groups as $staff_group):?>
        <option value="<?php echo $staff_group['id'];?>"><?php echo $staff_group['name'];?></option>
        <?php endforeach;?>
    </select>
    </dd>
    <dt>用户名</dt><dd><input type="text" id="staff_username" name="staff[username]" value="" /></dd>
    <dt>密码</dt><dd><input type="text" id="staff_password" name="staff[password]" value="" /></dd>
    <dt>姓名</dt><dd><input type="text" id="staff_name" name="staff[name]" value="" /></dd>
    <dt>电话</dt><dd><input type="text" id="staff_phone" name="staff[phone]" value="" /></dd>
    <dt>Email</dt><dd><input type="text" id="staff_email" name="staff[email]" value="" /></dd>
    <dt>权限</dt><dd>
    <?php $last_cate='';$i=0;foreach($config['privileges'] as $privilege=>$text):$cate=current(explode('.', $privilege));if($cate!=$last_cate){$last_cate=$cate;$i=0;echo "<br><br>";}$i++;?>
<label><input type="checkbox" id="staff_privilege_<?php echo $privilege;?>" name="staff[privilege][]" value="<?php echo $privilege;?>" checked="true" /><?php echo $text;?></label>
    <?php if($i%4==0){echo "<br>";}endforeach;?>
<input type="button" value="全选" class="btn_select_all_staff_privilege" />
<input type="button" value="反选" class="btn_select_inverse_staff_privilege" />
<input type="button" value="不选" class="btn_select_none_staff_privilege" />
    </dd>
     <dt>备注</dt><dd><textarea id="staff_memo" name="staff[memo]" rows="3" cols="70"></textarea></dd>
</dl>
<input type="submit" />
</form>
<script type='text/javascript'>
$(document).ready(function(){
    $('input.btn_select_none_staff_privilege').live('click', function(){
        var checkboxes = $(this).parent('dd').find('input:checkbox');
        checkboxes.attr('checked', false);
    });
    $('input.btn_select_all_staff_privilege').live('click', function(){
        var checkboxes = $(this).parent('dd').find('input:checkbox');
        checkboxes.attr('checked', true);
    });
    $('input.btn_select_inverse_staff_privilege').live('click', function(){
        var checkboxes = $(this).parent('dd').find('input:checkbox');
        checkboxes.each(function(idx, checkbox){
            var checkbox=$(checkbox);
            checkbox.attr('checked', !checkbox.attr('checked'));
        });
    });
});
</script>