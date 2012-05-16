<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="finance.php">财务管理</a> <span class="divider">/</span></li>
<li class="active"><?php echo $valid_options[$is_valid];?></li>
</ul>
<div>
<div>
<?php

foreach($valid_options as $valid_option=>$text):?>
<a href="finance.php?act=list&v=<?php echo $valid_option;?>"<?php $valid_option===$is_valid && print ' class="active"';?>><?php echo $text;?></a>
<?php endforeach;?>
</div>
</div>
<?php $show_plan=true;include('_plan_payment_list.php');?>
<?php if(0):?>
<h4>添加记录</h4>
<?php include('_payment_add_form.php');?>

<?php else:?>
<?php endif;?>