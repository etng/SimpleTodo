<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="finance.php">财务管理</a> <span class="divider">/</span></li>
<li class="active">修改</li>
</ul>

<table class="table table-bordered table-striped">
  <thead><tr>
    <th>时间</th>
    <th>操作人</th>
    <th>渠道</th>
    <th>金额</th>
    <th>审核状态</th>
    <th>审核时间</th>
    <th>审核人</th>
    <th>备注</th>
  </tr></thead>
    <tbody><?php if(!empty($plan_payments)):?>
  <?php foreach($plan_payments as $i=>$plan_payment):?>
  <tr>
    <td><?php echo $plan_payment['created'];?></td>
    <td><?php echo $plan_payment['operator'];?></td>
    <td><?php echo $config['payment_vias'][$plan_payment['via']];?></td>
    <td><?php echo $plan_payment['amount'];?></td>
    <?php if($plan_payment['is_valid']):?>
    <td><?php echo @$plan_payment['is_valid'];?></td>
    <td><?php echo @$plan_payment['valid_at'];?></td>
    <td><?php echo @$plan_payment['valid_by_name'];?></td>
    <?php else:?>
    <td colspan="3" align="center"><input type="button" value="审核" class="btn btn_add_payment" data-id="<?php echo $plan_payment['id'];?>"/></td>
    <?php endif;?>
    <td><?php echo $plan_payment['memo'];?></td>
  </tr>
  <?php endforeach;?>
   <?php else:?>
  <tr>
    <td colspan="100">咦，还没进账啊  </td>
  </tr>
  <?php endif;?></tbody>
</table>