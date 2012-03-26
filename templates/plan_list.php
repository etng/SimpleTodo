<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="plan.php?act=list">计划</a> <span class="divider">/</span></li>
<li class="active">所有</li>
</ul>

<p class="pull-right"><?php if(checkPrivilege('plan', 'add')):?><a href="plan.php?act=add" class="btn">添加计划</a><?php endif;?></p>

<div class="row">
<div class="span2"><dl>
    <dt>状态</dt>
    <dd><ul class="unstyled"> <li>
    <a href="plan.php?act=list">所有</a>
    </li>
    <?php foreach($statuss as $status=>$status_info):?>
    <li class="<?php (@$_GET['st']==$status) && print('active')?>">
    <a href="plan.php?act=list&st=<?php echo $status;?>"><?php echo $status_info['text']?></a>
    </li><?php endforeach;?>
</ul></dd>
</dl></div>
<div class="span10">
<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>金额</th>
        <th>时间</th>
        <th>状态</th>
        <th>车辆状态</th>
        <th>酒店状态</th>
        <th>操作</th>
    </tr></thead> <tbody><?php if(!empty($plans)):?>

    <?php foreach($plans as $plan):?>
    <tr>
        <td><?php echo $plan['id'];?></td>
        <td><?php echo $plan['price'];?></td>
        <td><?php echo $plan['created'];?></td>
        <td><?php echo $statuss[$plan['status']]['text'];?></td>
        <td><?php echo $car_statuss[$plan['car_status']]['text'];?></td>
        <td><?php echo $room_statuss[$plan['room_status']]['text'];?></td>
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