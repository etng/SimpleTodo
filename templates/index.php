<?php if(empty($_SESSION['staff']['name'])):?>

<h3>请先登录</h3>
<form method="post" action="auth.php?act=login" id="frm_staff_login">
<dl>
        <dt>用户名</dt><dd><input type="text" id="staff_name" name="staff[name]" value=""/></dd>
        <dt>密码</dt><dd><input type="password" id="staff_password" name="staff[password]" value=""/></dd>
    </dl><input type="submit" value="登录" />
</form>
<script type='text/javascript'>
$(document).ready(function(){

    $('#frm_staff_login').live('submit', function(){
        $('#staff_password').val(hex_md5($('#staff_name').val()+$('#staff_password').val()));
    });
});
</script>
<?php endif;?>
