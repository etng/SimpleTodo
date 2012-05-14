<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="plan.php?act=list">计划</a> <span class="divider">/</span></li>
<li class="active"><?php echo empty($plan_statuss[$cur_status])?'所有':$plan_statuss[$cur_status]['text'];?></li>
</ul>

<p class="pull-right"><?php if(checkPrivilege('plan', 'add')):?><a href="plan.php?act=add" class="btn">添加计划</a><?php endif;?></p>

<div class="row">
<div class="span12">
<table class="table table-bordered table-striped">
    <thead><tr>
        <th>到达日期</th>
        <th>客人(昵称)</th>
        <th>人数</th>
        <th>顾问</th>
        <th>行程(天数)</th>
        <th>订单状态</th>
        <th>司机状态</th>
        <th>酒店状态</th>
        <th>操作</th>
    </tr></thead> <tbody><?php if(!empty($plans)):?>

    <?php foreach($plans as $plan):?>
    <tr>
        <td><?php echo $plan['arrive_date'];?></td>
        <td><?php echo $plan['contact_name'];?>(<?php echo $plan['forum_uid'];?>)</td>
        <td><?php echo $plan['tourist_cnt'];?></td>
        <td><?php echo @$market_staff_options[$plan['market_staff_id']];?> <?php echo $plan_statuss[$plan['status']]['text'];?></td>
        <td><?php echo @$car_staff_options[$plan['car_staff_id']];?><?php echo $car_statuss[$plan['car_status']]['text'];?></td>
        <td><?php echo @$room_staff_options[$plan['room_staff_id']];?><?php echo $room_statuss[$plan['room_status']]['text'];?></td>
        <td><?php echo @$consult_staff_options[$plan['consult_staff_id']];?></td>
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