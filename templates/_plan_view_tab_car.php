<div>客人要求:　<?php echo $plan['car_request']?></div>
<div>车型及数量:　<?php echo @$config['car_types'][$plan['need_car_type']];?>*<?php echo $plan['need_car_cnt']?></div>
 <div>包车报价：<?php echo $plan['price_per_car'];?>x<?php echo $plan['need_car_cnt']?></div>
<div>司机底价：<?php echo $plan['cost_per_car'];?>x<?php echo $plan['need_car_cnt']?></div>
<?php
$driver_ids = $db->fetchCol('select distinct driver_id from plan_tour_car where plan_id=' . $plan['id']);
$driver_ids = array_map('intval', $driver_ids);
if(!empty($driver_ids))
{
    $assigned_drivers = $db->fetchAll($sql = 'select * from driver where id in('.implode(',', $driver_ids).')');
}
?>

  <table class="table table-bordered table-striped" id="table_cars_assigned">
    <thead>
      <tr>
        <td>司机</td>
        <td>车型</td>
        <td>民族</td>
        <td>评分</td>
        <td>车号</td>
        <td>电话</td>
        <td>状态</td>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($plan['need_car_cnt'])):?>
      <?php foreach(range(0, $plan['need_car_cnt']-1) as $i):$driver=@$assigned_drivers[$i];?>
      <tr id="plan_car_<?php echo $i+1;?>" data-driver_id="<?php echo @$driver['id'];?>">

        <td><?php echo @$driver['name'];?></td>
        <td><?php echo @$config['car_types'][$driver['car_type']];?></td>
      <td><?php echo @$driver['nationality'];?></td>
      <td><?php echo @$driver['star'];?></td>
      <td><?php echo @$driver['car_plate_num'];?></td>

      <td><?php echo @$driver['phone'];?></td>

        <td>
        <?php if(!@$driver['id']):?>
          <span class="trigger"><input type="button" value="选择司机" class="btn btn_browse_car"/></span>
        <?php else:?>
          <span class="status" style="display;none">已安排
          <input type="button" value="取消" class="btn btn_cancel_car"/></span>
          <?php endif;?>
        </td>
      </tr>
      <?php endforeach;?>
      <?php else:?>
      <tr>
        <td colspan="100">整个行程无需用车</td>
      </tr>
      <?php endif;?>
    </tbody>
  </table>
    <?php if($next_car_statuss = $car_statuss[$plan['car_status']]['next']):?>

      <?php foreach(explode(',', $next_car_statuss) as $next_car_status):$next_car_status_info = $car_statuss[$next_car_status];?>
      <a class="btn" href="plan.php?act=set-car-status&status=<?php echo $next_car_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_car_status_info['action_text']?></a>
      <?php endforeach;?>    </dd>
    <?php endif;?>
<?php
$query = $db->select()->from('driver')
        ->clearField()
        ->addField('driver.*')
//        ->addField('destination.name as destination_name')
//        ->leftJoin('driver', 'destination_id', 'destination', 'id')
        ->order_by('driver.id', 'DESC')
        ;
    $drivers = $query->execute();
$nationalities = $db->fetchCol('select distinct nationality from driver ');
?>
<div id="table_browse_car" style="display:none">
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
  <table class="table table-bordered table-striped table-filter-car">
    <thead>
      <tr>
        <td>司机</td>
        <td>车型</td>
        <td>民族</td>
        <td>评分</td>
        <td>车号</td>
        <td>电话</td>
        <td>状态</td>
      </tr>
    </thead>

      <?php if(!empty($drivers)):?><tbody>
      <?php foreach($drivers as $driver):?>
      <tr data-car_type="<?php echo $driver['car_type'];?>" data-nationality="<?php echo $driver['nationality'];?>" id="driver_tr_<?php echo @$driver['id'];?>" data-driver_id="<?php echo @$driver['id'];?>">

        <td><?php echo @$driver['name'];?></td>
        <td><?php echo @$config['car_types'][$driver['car_type']];?></td>
      <td><?php echo @$driver['nationality'];?></td>
      <td><?php echo @$driver['star'];?></td>
      <td><?php echo @$driver['car_plate_num'];?></td>

      <td><?php echo @$driver['phone'];?></td>

        <td>

          <span class="trigger"><input type="button" value="选择安排" class="btn btn_select_car"/></span>

          <span class="status" style="display;none">已安排
          <input type="button" value="取消" class="btn btn_revoke_car"/></span>
        </td>
      </tr>

      <?php endforeach;?>
      </tbody>
      <?php else:?>
      <tr>
        <td colspan="100">没有车辆，无法安排</td>
      </tr>
      <?php endif;?>

  </table>
  </div>
  <script type="text/javascript">
  <!--
jQuery(function($){
    chosen_cars=<?php echo json_encode($driver_ids);?>;
    plan_id=<?php echo $plan['id'];?>;
    function update_chosen_cars()
    {
        console.log(chosen_cars);
        $.post("plan.php?act=update_chosen_cars", {'plan_id': plan_id, 'chosen_cars': chosen_cars.join(',') },
         function(response){
           console.log(response);
         }, "json");
    }
    $('input.btn_cancel_car').live('click', function(){
        $target_tr=$(this).closest('tr');
        cancel_car($target_tr);
    });
    $('input.btn_revoke_car').live('click', function(){
        $src_tr=$(this).closest('tr');
        $src_tr.find('td:last span.trigger').show();
        $src_tr.find('td:last span.status').hide();
        var driver_id = $src_tr.data('driver_id');
        cancel_car($('#table_cars_assigned tr').filter(function(){
            return $(this).data('driver_id')==driver_id;
        }));
    });
    function cancel_car($target_tr)
    {
        $target_tr.find('td:last span.trigger').show();
        $target_tr.find('td:last span.status').hide();
        $target_tr.find('td:not(:last)').html('&nbsp;');
        console.log(chosen_cars, $target_tr.data('driver_id'));
        chosen_cars = _.without(chosen_cars, $target_tr.data('driver_id'));
        console.log(chosen_cars, $target_tr.data('driver_id'));
        update_chosen_cars();
        $target_tr.data('driver_id', 0);
    }
    $('input.btn_browse_car').live('click', function(){
        $target_tr=$(this).closest('tr');
        jQuery.facebox({ div: '#table_browse_car' });
        $facebox = $('#facebox');
        $('input.btn_select_car', $facebox).click(function(){
            $tr = $(this).closest('tr');
            $tr.find('td:not(:last)').each(function(i, td){
                $target_tr.find('td:not(:last)').eq(i).html($(td).html())
            });
            $target_tr.find('td:last span.trigger').hide();
            $target_tr.find('td:last span.status').show();
            var driver_id = $tr.data('driver_id');
            $target_tr.data('driver_id', driver_id);
            chosen_cars.push(driver_id);
            update_chosen_cars();
            jQuery(document).trigger('close.facebox');
        });
        $trs = $('table.table-filter-car', $facebox).find('tbody tr');
        $trs.each(function(idx, tr){
            $tr = $(tr);
            if(_.indexOf(chosen_cars, $tr.data('driver_id'))>-1)
            {
                $tr.find('td:last span.trigger').hide();
                $tr.find('td:last span.status').show();
            }
        });
        filters={'car_type':'', 'nationality':''};
        $.each(filters, function(k, v){
            $('.filter-'+k+' a', $facebox).click(function(e){
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
});
  //-->
  </script>