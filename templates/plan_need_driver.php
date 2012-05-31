<ul class="breadcrumb">
  <li><a href="/">首页</a> <span class="divider">/</span></li>
  <li><a href="plan.php?act=list">车辆管理</a> <span class="divider">/</span></li>
  <li class="active">所有未安排订单</li>
</ul>

<div class="row">
  <div class="span12">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>到达日期</th>
          <th>客人(昵称)</th>
          <th>车辆</th>
          <th>用车时间</th>
          <th>行程</th>
          <th>报价</th>
          <th>底价</th>
          <th>要求</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($plans)):?>
        <?php foreach($plans as $plan):?>
        <tr>
          <td><a href="plan.php?<?php echo http_update_query("arrive_date={$plan['arrive_date']}");?>"><?php echo date('Y-n-j', strtotime($plan['arrive_date']));?></a></td>
          <td><a href="plan.php?act=view&id=<?php echo $plan['id'];?>"><?php echo $plan['contact_name'];?>(<?php echo $plan['forum_uid'];?>)</a></td>
          <td><?php echo $plan['need_car_cnt'];?>车</td>
          <td><?php echo $plan['need_car_cnt'];?></td>
          <td><?php echo $plan['schedule_name'];?></td>
          <td><?php echo $plan['price_per_car'];?>x<?php echo $plan['need_car_cnt']?></td>
          <td><?php echo $plan['cost_per_car'];?>x<?php echo $plan['need_car_cnt']?></td>
          <td><?php echo $plan['car_request'];?></td>
          <td><a href="plan.php?act=view&id=<?php echo $plan['id'];?>#tab_car_assignment">选择司机</a></td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr>
          <td colspan="100">凡事预则立不预则废，<a href="plan.php?act=add">要旅行，早计划</a></td>
        </tr>
        <?php endif;?>
      </tbody>
    </table>
  </div>
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
      <li>点击选择司机，将进入订单详情中的车辆安排界面</li>
    </ol>
  </div>
</div>
