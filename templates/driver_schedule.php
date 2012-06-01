<?php
$query = $db->select()->from('driver')
        ->clearField()
        ->addField('driver.*')
        ->order_by('driver.id', 'DESC')
        ;
$drivers = $query->execute();
$nationalities = $db->fetchCol('select distinct nationality from driver ');
$current_date = time();
if(isset($_GET['ym']))
{
    $current_date = strtotime(sprintf('%04d-%02d-%02d', substr($_GET['ym'], 0, 4), substr($_GET['ym'], 4), 1));
}
$plans_in_this_month = $db->fetchAll(sprintf('
select *,contact.name as contact_name
from plan
left join contact on contact.id=plan.contact_id
where car_status="assignned" and (plan.start_date between "%1$s" and "%2$s"
or plan.seeoff_date  between "%1$s" and "%2$s")
', date('Y-m-01', $current_date), date('Y-m-t', $current_date)));
$plan_tours = $db->fetchAll(sprintf('SELECT
plan.id AS plan_id,plan_tour_car.driver_id,plan_tour.the_date,
tour.name AS tour_name, tour.destination AS tour_destination, tour.attractions,
plan.start_date,plan_tour.need_car_cnt,
plan.schedule_days, contact.name AS contact_name,contact.forum_uid
FROM plan_tour_car
LEFT JOIN plan_tour ON plan_tour.id=plan_tour_car.plan_tour_id
LEFT JOIN tour ON tour.id=plan_tour.tour_id
LEFT JOIN plan ON plan.id=plan_tour_car.plan_id
LEFT JOIN contact ON contact.id=plan.contact_id
WHERE plan_tour.the_date BETWEEN "%1$s" AND "%2$s"', date('Y-m-01', $current_date), date('Y-m-t', $current_date)));
//var_dump($plan_tours);
$schedule = array();
foreach($plan_tours as $plan_tour)
{
    $title = "{$plan_tour['the_date']} {$plan_tour['tour_name']}";
    $content = nl2br("客人信息：{$plan_tour['contact_name']}({$plan_tour['forum_uid']})" . PHP_EOL .
        "相关景点：{$plan_tour['attractions']}");
    $url="plan.php?act=view&id={$plan_tour['plan_id']}";
    $schedule[$plan_tour['driver_id']][$plan_tour['the_date']] = compact('title' , 'content', 'url');
}
?>

<div class="filter">
    <div class="row">
  <div class="span4"><h4>过滤</h4></div>
  <div class="span8"></div>
</div>
<div class="row">
  <div class="span2">车型</div>
  <div class="span10 filter-car_type"><a href="#" class="active">所有</a><?php foreach($config['car_types'] as $car_type=>$text):?>
  <a href="#<?php echo $car_type;?>"><?php echo $text;?></a>
  <?php endforeach;?></div>
</div>
<div class="row">
  <div class="span2">民族</div>
  <div class="span10 filter-nationality"><a href="#" class="active">所有</a><?php foreach($nationalities as $nationality): /* @var Type $row */?>
  <a href="#<?php echo $nationality;?>"><?php echo $nationality;?></a>
  <?php endforeach;?></div>
</div>
<div class="row">
  <div class="span2"></div>
  <div class="span4">
  <a href="driver.php?act=schedule&ym=<?php echo date('Ym', strtotime('-1 month', $current_date))?>">上个月</a>
  <?php echo date('Y年n月', $current_date)?>
  <a href="driver.php?act=schedule&ym=<?php echo date('Ym', strtotime('+1 month', $current_date))?>">下个月</a>
  </div>
  <div class="span4"><a href="plan.php?act=list_need_driver">所有未安排订单</a></div>
  <div class="span2"></div>
</div>
<table class="table table-bordered table-striped table-filter-car"><thead>
    <tr>
        <td>&nbsp;</td>
        <td>司机/日期</td>
        <?php foreach(range(1, date('t', $current_date)) as $d):?>
        <td><?php echo $d;?></td>
        <?php endforeach;?>
    </tr></thead>
  <tbody>
    <?php if(!empty($drivers)):$i=0;?>
    <?php foreach($drivers as $driver):?>
    <tr data-car_type="<?php echo $driver['car_type'];?>" data-nationality="<?php echo $driver['nationality'];?>" data-driver_id="<?php echo @$driver['id'];?>">
    <td><?php echo ++$i;?></td>
    <td><a href="driver.php?act=view&id=<?php echo $driver['id'];?>"><?php echo $driver['name'];?></a></td>
        <?php foreach(range(1, date('t', $current_date)) as $d):
        $the_date = date('Y-m-', $current_date) . str_pad($d, 2, 0, STR_PAD_LEFT);;
        $driver_id = $driver['id'];
        ?>
        <td class="driver_<?php echo @$driver['id'];?> date_<?php echo $d;?>">
        <?php if(isset($schedule[$driver_id][$the_date])):$detail=$schedule[$driver_id][$the_date];?>
        <a href="<?php echo $detail['url'];?>" rel="popover" title="<?php echo $detail['title'];?>" data-content="<?php echo $detail['content'];?>"><?php echo $d;?></a>
        <?php else:?>
        <?php endif;?>
        </td>
        <?php endforeach;?>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="100"><a href="driver.php?act=add">先谈两个师傅来合作</a></td>
    </tr>
    <?php endif;?>
  </tbody>
</table>
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
    <h3>图例</h3>
    <ol>
      <li><i class="icon-play"></i>代表客人到达拉萨</li>
      <li><span class="schedule_days" class="width:50px">&nbsp;&nbsp;&nbsp;&nbsp;</span>代表已经安排需要车辆的日程</li>
      <li><i class="icon-stop"></i>代表客人到达拉萨</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="span12">
    <h3>使用说明</h3>
    <ol>
      <li>此页面每页50项</li>
      <li>点击团名后进入订单详情</li>
      <li>点击司机名称，进入司机选择订单</li>
    </ol>
  </div>
</div>

<script type="text/javascript">
  <!--
jQuery(function($){
        $trs = $('table.table-filter-car').find('tbody tr');
        filters={'car_type':'', 'nationality':''};
        $.each(filters, function(k, v){
            $('.filter-'+k+' a').click(function(e){
                $a = $(this);
                $a.parent().find('a').removeClass('active');
                $a.addClass('active');
                filters[k]=$a.attr('href').substr(1);
                $trs.show().filter(function() {
                   $tr = $(this);
                    var flag=true;
                    $.each(filters, function(k, v){
                        if(flag && v.length)
                        {
                            if($tr.data(k)!=v)
                            {
                                flag=false;
                            }
                        }
                    });
                    return !flag;
                }).hide();
                e.preventDefault();
            });
        });
});
  //-->
  </script>