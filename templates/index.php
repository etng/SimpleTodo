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
<?php else:?>
<div class="row">
  <div class="span6"></div>
  <div class="span6"></div>
</div>
<div class="row">
  <div class="span12">
  <h3>使用说明</h3>
<ol>
  <li>请先到系统设置->组织架构添加用户组，并为不同的用户组设定不同的权限和主要职能</li>
  <li>产品管理->行程模版分类、行程模版添加常用行程，方便使用</li>
  <li>产品管理->目的地添加常用目的地</li>
  <li>系统设置>默认值设定常用默认值如司机的默认归属地等</li>
  <li>最后添加日程等</li>
</ol>
  </div>
</div>
<div class="row">
  <div class="span6"><h3>最新订单</h3><table class="table table-bordered table-striped">
      <thead><tr>
          <th>编号</th>
          <th>金额</th>
          <th>时间</th>
          <th>业务状态</th>
          <th>车辆状态</th>
          <th>酒店状态</th>
          <th>操作</th>
      </tr></thead> <tbody>
        <?php foreach($latest_plans as $plan):?>
        <td><?php echo $plan['id'];?></td>
        <td><?php echo $plan['price'];?></td>
        <td><?php echo $plan['created'];?></td>
        <td><?php echo $market_staff_options[$plan['market_staff_id']];?><br /><?php echo $plan_statuss[$plan['status']]['text'];?></td>
        <td><?php echo $car_staff_options[$plan['car_staff_id']];?><br /><?php echo $car_statuss[$plan['car_status']]['text'];?></td>
        <td><?php echo $room_staff_options[$plan['room_staff_id']];?><br /><?php echo $room_statuss[$plan['room_status']]['text'];?></td>
        <td><a href="plan.php?act=view&id=<?php echo $plan['id'];?>" class="btn btn-info">详情</a></td>
        <?php endforeach;?>
      </tbody>
  </table></div>
  <div class="span6"><h3>服务器信息</h3><table class="table table-bordered table-striped">
      <thead><tr>
          <th>项目</th>
          <th>内容</th>
      </tr></thead> <tbody>
      <tr><td><b>服务器系统</b></td><td><?php echo PHP_OS;?></td></tr>
      <tr><td><b>PHP版本</b></td><td><?php echo PHP_VERSION;?></td></tr>
      <tr><td><b>服务器软件</b></td><td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td></tr>
      <tr><td><b>数据库软件</b></td><td>MySQL <?php echo $db->version();?></td></tr>
      </tbody>
  </table></div>
</div>
<?php endif;?>
