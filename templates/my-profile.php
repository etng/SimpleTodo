
<h3>修改个人资料</h3>
<form method="post" action="" id="frm_edit_profile">
  <dl>
    <dt>用户名</dt>
    <dd><?php echo $_SESSION['staff']['username'];?></dd>
    <dt>姓名</dt>
    <dd><?php echo $_SESSION['staff']['name'];?></dd>
    <dt>电话</dt>
    <dd>
      <input type="text" id="staff_phone" name="staff[phone]" value="<?php echo $staff['phone'];?>" />
    </dd>
    <dt>Email</dt>
    <dd>
      <input type="text" id="staff_email" name="staff[email]" value="<?php echo $staff['email'];?>" />
    </dd>
    <dt>备注</dt>
    <dd>
      <textarea id="staff_memo" name="staff[memo]" rows="3" cols="70"><?php echo $staff['memo'];?></textarea>
    </dd>
  </dl>
  <input type="submit" value="提交更改" class="btn btn-primary" />
</form>
