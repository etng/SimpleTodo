<?php
$perpage_options = array(5,10,20,25,30,50);
$preference = empty($staff['preference'])?array():json_decode($staff['preference'], true);
?>
<h3>修改个人偏好</h3>
<form method="post" action="" id="frm_edit_profile">
<dl>
    <dt>每页显示数目</dt><dd>
    <select id="staff_preference_perpage" name="staff[preference][perpage]">
        <option value="" selected="selected">--请选择--</option>
        <?php foreach($perpage_options as $perpage):?>
        <option value="<?php echo $perpage;?>"<?php $perpage==@$preference['perpage'] && print(' selected="true"');?>><?php echo $perpage;?></option>
        <?php endforeach;?>
    </select>
    </dd>
</dl>
<input type="submit" value="提交更改" />
</form>
