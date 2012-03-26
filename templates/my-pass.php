
<h3>修改密码</h3>
<form method="post" action="" id="frm_edit_pass">
<dl>
        <dt>用户名</dt><dd><?php echo $_SESSION['staff']['username'];?></dd>
        <dt>姓名</dt><dd><?php echo $_SESSION['staff']['name'];?></dd>
        <dt>旧密码</dt><dd><input type="password" id="old_password" name="staff[old_password]" value=""/></dd>
        <dt>新密码</dt><dd><input type="password" id="new_password" name="staff[new_password]" value=""/></dd>
        <dt>确认新密码</dt><dd><input type="password" id="new_password_confirm" name="staff[new_password_confirm]" value=""/></dd>
    </dl><input type="submit" value="修改密码" class="btn btn-primary" />
</form>
<script type='text/javascript'>
$(document).ready(function(){

    $('#frm_edit_pass').live('submit', function(){
        var staff_name = "<?php echo $_SESSION['staff']['username'];?>";
        $('#old_password').val(hex_md5(staff_name+$('#old_password').val()));
        if($('#new_password').val()!=$('#new_password').val())
        {
            return false;
        }
        $('#new_password').val(hex_md5(staff_name+$('#new_password').val()));
        $('#new_password_confirm').val(hex_md5(staff_name+$('#new_password_confirm').val()));
    });
});
</script>