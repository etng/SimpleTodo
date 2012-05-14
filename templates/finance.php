<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="finance.php">财务管理</a> <span class="divider">/</span></li>
<li class="active"><?php echo $valid_options[$is_valid];?></li>
</ul>
<div>
<div>
<?php

foreach($valid_options as $valid_option=>$text):?>
<a href="finance.php?act=list&v=<?php echo $valid_option;?>"<?php echo $valid_option===$is_valid && print ' class="active"';?>><?php echo $text;?></a>
<?php endforeach;?>
</div>
</div>
<table class="table table-bordered table-striped">
  <thead><tr>
    <th>类目</th>
    <th>时间</th>
    <th>收入</th>
    <th>支出</th>
    <th>操作人</th>
    <th>渠道</th>
    <th>审核状态</th>
    <th>审核时间</th>
    <th>审核人</th>
    <th>备注</th>
  </tr></thead>
    <tbody><?php if(!empty($plan_payments)):?>
  <?php foreach($plan_payments as $i=>$plan_payment):?>
  <tr>
    <td><?php echo $plan_payment['cate'];?></td>
    <td><?php echo $plan_payment['created'];?></td>
    <td><?php echo $plan_payment['amount']>=0?$plan_payment['amount']:'';?></td>
    <td><?php echo $plan_payment['amount']<0?$plan_payment['amount']:'';?></td>
    <td><?php echo $plan_payment['operator'];?></td>
    <td><?php echo $config['payment_vias'][$plan_payment['via']];?></td>
    <?php if($plan_payment['valid_at']!=='0000-00-00 00:00:00'):?>
    <td><?php echo @$plan_payment['is_valid']?'<i class="icon-ok"></i>':'<i class="icon-remove"></i>';?></td>
    <td><?php echo @$plan_payment['valid_at'];?></td>
    <td><?php echo @$plan_payment['valid_by_name'];?></td>
    <?php else:?>
    <td colspan="3" align="center"><form method="post" action="?act=save">
    <input type="hidden" name="payment[id]" value="<?php echo $plan_payment['id'];?>" />
    <input type="hidden" name="payment[is_valid]" id="payment_is_valid" value="0" />
    <input type="button" value="审核通过" class="btn btn_valid_payment"/>
    <input type="button" value="审核不通过" class="btn btn_invalid_payment"/>
    </form></td>
    <?php endif;?>
    <td><?php echo $plan_payment['memo'];?></td>
  </tr>
  <?php endforeach;?>

<tr>
    <td>小计</td>
    <td>&nbsp;</td>
    <td><?php echo $sum_income;?></td>
    <td><?php echo $sum_output;?></td>
    <td colspan="100">&nbsp;</td>
  </tr>
<tr>
    <td>合计</td>
    <td>&nbsp;</td>
    <td><?php echo bcadd($sum_income, $sum_output);?></td>
    <td colspan="100">&nbsp;</td>
  </tr>
   <?php else:?>
  <tr>
    <td colspan="100">咦，还没进账啊  </td>
  </tr>
  <?php endif;?></tbody>
</table>
<h4>添加记录</h4>
<?php include('_payment_add_form.php');?>

<script type="text/javascript">
<!--
    jQuery(function($){
        $('.btn_valid_payment').click(function(){
            $('#payment_is_valid').val(1);
            this.form.submit();
        });
        $('.btn_invalid_payment').click(function(){
            $('#payment_is_valid').val(0);
            this.form.submit();
        });
    });
//-->
</script>