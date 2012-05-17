<ul class="breadcrumb">
  <li><a href="/">首页</a> <span class="divider">/</span></li>
  <li><a href="staff.php?act=list">员工</a> <span class="divider">/</span></li>
  <li class="active">修改#<?php echo $staff['id']?></li>
</ul>
<form method="post" action="">
  <dl>
    <dt>所属组</dt>
    <dd>
      <select id="staff_group_id" name="staff[group_id]">
        <option value="" selected="selected">--请选择--</option>
        <?php foreach($staff_groups as $staff_group):?>
        <option value="<?php echo $staff_group['id'];?>"<?php $staff_group['id']==@$staff['group_id'] && print(' selected="true"');?>><?php echo $staff_group['name'];?></option>
        <?php endforeach;?>
      </select>
    </dd>
    <dt>用户名</dt>
    <dd>
      <input type="text" id="staff_username" name="staff[username]" value="<?php echo $staff['username']?>" />
    </dd>
    <dt>论坛ID</dt>
    <dd>
      <input type="text" id="staff_forum_uid" name="staff[forum_uid]" value="<?php echo $staff['forum_uid']?>" />
    </dd>
    <dt>密码</dt>
    <dd>
      <input type="text" id="staff_password" name="staff[password]" value="" />
    </dd>
    <dt>姓名</dt>
    <dd>
      <input type="text" id="staff_name" name="staff[name]" value="<?php echo $staff['name']?>" />
    </dd>
    <dt>电话</dt>
    <dd>
      <input type="text" id="staff_phone" name="staff[phone]" value="<?php echo $staff['phone']?>" />
    </dd>
    <dt>Email</dt>
    <dd>
      <input type="text" id="staff_email" name="staff[email]" value="<?php echo $staff['email']?>" />
    </dd>
    <dt>权限</dt>
    <dd>
      <?php $last_cate='';$i=0;foreach($config['privileges'] as $privilege=>$text):$cate=current(explode('.', $privilege));if($cate!=$last_cate){$last_cate=$cate;$i=0;echo "<br><br>";}$i++;?>
      <label class="inline checkbox">
        <input type="checkbox" id="staff_privilege_<?php echo $privilege;?>" name="staff[privilege][]" value="<?php echo $privilege;?>" <?php in_array($privilege, $staff['privileges']) && print(' checked="true"');?> />
        <?php echo $text;?></label>
      <?php if($i%4==0){echo "<br>";}endforeach;?>
      <input type="button" value="全选" class="btn_select_all_staff_privilege" />
      <input type="button" value="反选" class="btn_select_inverse_staff_privilege" />
      <input type="button" value="不选" class="btn_select_none_staff_privilege" />
    </dd>
    <dt>备注</dt>
    <dd>
      <textarea id="staff_memo" name="staff[memo]" rows="3" cols="70"><?php echo $staff['memo']?></textarea>
    </dd>
  </dl>
  <input type="submit" class="btn btn-primary" />
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