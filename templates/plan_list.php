<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="plan.php?act=list">计划</a> <span class="divider">/</span></li>
<li class="active"><?php echo empty($plan_statuss[$cur_status])?'所有':$plan_statuss[$cur_status]['text'];?></li>
</ul>

<p class="pull-right"><?php if(checkPrivilege('plan', 'add')):?><a href="plan.php?act=add" class="btn">添加计划</a><?php endif;?></p>
<div>
<a href="plan.php?act=list&st=all"<?php $cur_status==='all' && print ' class="active"';?>>所有</a>
<?php
foreach($plan_statuss as $plan_status=>$plan_status_config):?>
<a href="plan.php?act=list&st=<?php echo $plan_status;?>"<?php $plan_status===$cur_status && print ' class="active"';?>><?php echo $plan_status_config['text'];?></a>
<?php endforeach;?>
</div>

<div class="row">
<div class="span12">
<table class="table table-bordered table-striped">
    <thead><tr>
        <th>到达日期</th>
        <th>客人(昵称)</th>
        <th>人数</th>
        <th>顾问</th>
        <th>跟单</th>
        <th>行程(天数)</th>
        <th>订单状态</th>
        <th>司机状态</th>
        <th>酒店状态</th>
        <th>操作</th>
    </tr></thead> <tbody><?php if(!empty($plans)):?>

    <?php foreach($plans as $plan):?>
    <tr>
        <td><?php echo date('Y-n-j', strtotime($plan['arrive_date']));?></td>
        <td><?php echo $plan['contact_name'];?>(<?php echo $plan['forum_uid'];?>)</td>
        <td><?php echo $plan['tourist_cnt'];?>人</td>
        <td><?php echo $consult_staff_options[$plan['consult_staff_id']];?></td>
        <td><?php echo @$market_staff_options[$plan['market_staff_id']];?></td>
        <td><?php echo $plan['schedule_template_name'];?>(<?php echo $plan['schedule_days'];?>天)</td>
        <td><?php echo $plan_statuss[$plan['status']]['text'];?></td>

        <td><?php echo @$car_staff_options[$plan['car_staff_id']];?><?php echo $car_statuss[$plan['car_status']]['text'];?></td>
        <td><?php echo @$room_staff_options[$plan['room_staff_id']];?><?php echo $room_statuss[$plan['room_status']]['text'];?></td>
        <td>
        <a href="plan.php?act=view&id=<?php echo $plan['id'];?>" class="btn btn-info">详情</a>
        <a href="plan.php?act=delete&id=<?php echo $plan['id'];?>" class="btn btn-danger">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100">凡事预则立不预则废，<a href="plan.php?act=add">要旅行，早计划</a></td>
    </tr>
    <?php endif;?></tbody>
</table></div>
</div>

<div class="row">
    <div class="span2">
        <!-- <div class="btn-group" style="margin: 9px 0;">
          <button class="btn btn-select-all">全选</button>
          <button class="btn btn-select-inverse">反选</button>
          <button class="btn btn-select-none">不选</button>
        </div> -->
    </div>
    <div class="span10">
        <?php include(dirname(__file__). '/_pager.php');?>
    </div>
</div>

<div class="row">
  <div class="span12">
  <h3>使用说明</h3>
<ol>
  <li>点击顾问、跟单后，列出相应列表</li>
  <li>点击到达日期，列出当天到达列表</li>
  <li>点击客人名称、形成，列出行程详单</li>
</ol>
  </div>
</div>