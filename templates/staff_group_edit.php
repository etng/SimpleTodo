<h3><?php echo $title_for_layout;?></h3>
<form method="post" action="">
<dl>
    <dt>名称</dt><dd><input type="text" id="staff_group_name" name="staff_group[name]" value="<?php echo $staff_group['name'];?>" /></dd>
    <dt>办公室电话</dt><dd><input type="text" id="staff_group_phone" name="staff_group[phone]" value="<?php echo $staff_group['phone'];?>" /></dd>
    <dt>权限</dt><dd>
    <?php $last_cate='';$i=0;foreach($config['privileges'] as $privilege=>$text):$cate=current(explode('.', $privilege));if($cate!=$last_cate){$last_cate=$cate;$i=0;echo "<br><br>";}$i++;?>
<label class="inline checkbox"><input type="checkbox" id="staff_group_privilege_<?php echo $privilege;?>" name="staff_group[privilege][]" value="<?php echo $privilege;?>"  <?php in_array($privilege, $staff_group['privileges']) && print(' checked="true"');?> /><?php echo $text;?></label>
    <?php if($i%4==0){echo "<br>";}endforeach;?>
<input type="button" value="全选" class="btn_select_all_staff_group_privilege" />
<input type="button" value="反选" class="btn_select_inverse_staff_group_privilege" />
<input type="button" value="不选" class="btn_select_none_staff_group_privilege" />
    </dd>
     <dt>备注</dt><dd><textarea id="staff_group_memo" name="staff_group[memo]" rows="3" cols="70"><?php echo $staff_group['memo'];?></textarea></dd>
</dl>
<input type="submit" />
</form>
<script type='text/javascript'>
$(document).ready(function(){
    $('input.btn_select_none_staff_group_privilege').live('click', function(){
        var checkboxes = $(this).parent('dd').find('input:checkbox');
        checkboxes.attr('checked', false);
    });
    $('input.btn_select_all_staff_group_privilege').live('click', function(){
        var checkboxes = $(this).parent('dd').find('input:checkbox');
        checkboxes.attr('checked', true);
    });
    $('input.btn_select_inverse_staff_group_privilege').live('click', function(){
        var checkboxes = $(this).parent('dd').find('input:checkbox');
        checkboxes.each(function(idx, checkbox){
            var checkbox=$(checkbox);
            checkbox.attr('checked', !checkbox.attr('checked'));
        });
    });
});
</script>