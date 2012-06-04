<ul class="breadcrumb">
  <li><a href="/">首页</a> <span class="divider">/</span></li>
  <li><a href="driver.php?act=list">车辆管理</a> <span class="divider">/</span></li>
  <li class="active"><?php echo $driver['name'];?>的日程</li>
</ul>
<h4><?php echo $driver['name'];?>   <?php echo $driver['car_plate_num'];?></h4>
<?php
$current_date = time();
if(isset($_GET['ym']))
{
    $current_date = strtotime(sprintf('%04d-%02d-%02d', substr($_GET['ym'], 0, 4), substr($_GET['ym'], 4), 1));
}
$next_date = $start_date = strtotime(date('Y-m-01', $current_date));
$end_date = strtotime(date('Y-m-t', $current_date));
$month_days = array();
if($prefix=date('w', $start_date))
{
    $start_date = strtotime(sprintf('-%d days', $prefix), $start_date);
}
if($suffix=7-date('w', $end_date))
{
    $end_date = strtotime(sprintf('+%d days', $suffix), $end_date);
}
$next_date = $start_date;
while($next_date<$end_date)
{
    $month_days []= $next_date;
    $next_date+=86400;
}
//当前月份的项目安排
$plans = $db->fetchAll(sprintf('
select *,contact.name as contact_name
from plan
left join contact on contact.id=plan.contact_id
where (plan.start_date between "%1$s" and "%2$s"
or plan.seeoff_date  between "%1$s" and "%2$s")
', date('Y-m-01', $current_date), date('Y-m-t', $current_date)));
?>
<div class="row">
  <div class="span2"></div>
  <div class="span4">
  <a href="driver.php?act=view&id=<?php echo $id;?>&ym=<?php echo date('Ym', strtotime('-1 month', $current_date))?>">上个月</a>
  <?php echo date('Y年n月', $current_date)?>
  <a href="driver.php?act=view&id=<?php echo $id;?>&ym=<?php echo date('Ym', strtotime('+1 month', $current_date))?>">下个月</a>
  </div>
  <div class="span4"></div>
  <div class="span2"></div>
</div>
<table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>日</th>
          <th>一</th>
          <th>二</th>
          <th>三</th>
          <th>四</th>
          <th>五</th>
          <th>六</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(array_chunk($month_days, 7) as $dates):?>
        <tr>
            <?php foreach($dates as $date):?>
          <td data-date="<?php echo date('Y-m-d', $date);?>"><?php echo date('j', $date);?></td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>

<h4>可安排</h4>
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
          <td><a href="plan.php?act=view&id=<?php echo $plan['id'];?>">安排给<?php echo $driver['name'];?></a></td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
        <tr>
          <td colspan="100">很好，暂时不需要用车</td>
        </tr>
        <?php endif;?>
      </tbody>
    </table>
<div class="row">
  <div class="span12">
    <h3>使用说明</h3>
    <ol>
      <li>点击安排给xxx按钮后，分配该订单给xxx并返回所有车辆安排页面</li>
      <li>包车开始时间为需要用车的第一天，包车结束时间为需要用车的最后一天</li>
      <li>点击形成、客人后，新页面打开该团具体信息</li>
      <li>表格中包车报价、司机底价为订单表中一楼的字段，包车报价由顾问确定，司机底价由车辆计调确定</li>
      <li>可安排订单，按照到达日期顺序</li>
    </ol>
  </div>
</div>
    <dl>
  <dt>加入时间</dt>
  <dd><?php echo $driver['created'];?></dd>
  <dt>生日</dt>
  <dd><?php echo $driver['dob'];?></dd>
  <dt>民族</dt>
  <dd><?php echo $driver['nationality'];?></dd>
  <dt>年龄</dt>
  <dd><?php echo $driver['age'];?></dd>
  <dt>车型</dt>
  <dd><?php echo @$config['car_types'][$driver['car_type']];?></dd>
  <dt>容量</dt>
  <dd><?php echo $driver['car_capacity'];?></dd>
  <dt>星级</dt>
  <dd><?php echo $driver['star'];?></dd>
  <dt>电话</dt>
  <dd><?php echo $driver['phone'];?></dd>
  <dt>介绍</dt>
  <dd><?php echo $driver['description'];?></dd>
</dl>