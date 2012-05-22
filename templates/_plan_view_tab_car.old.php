 <h4>请<?php echo @$car_staff_options[$plan['car_staff_id']];?> 安排 <?php echo $plan['tourist_cnt'];?> 人旅行司机及车辆</h4>
  <div>客户留言:　<?php echo $plan['car_request']?></div>
  <dl>
    <dt>当前状态</dt>
    <dd> <?php echo $car_statuss[$plan['car_status']]['text'];?> </dd>
    <?php if($next_car_statuss = $car_statuss[$plan['car_status']]['next']):?>
    <dt>操作</dt>
    <dd>
      <?php foreach(explode(',', $next_car_statuss) as $next_car_status):$next_car_status_info = $car_statuss[$next_car_status];?>
      <a class="btn" href="plan.php?act=set-car-status&status=<?php echo $next_car_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_car_status_info['action_text']?></a>
      <?php endforeach;?>
    </dd>
    <?php endif;?>
  </dl>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <td>日期</td>
        <td>线路</td>
        <td>安排情况</td>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($plan['tours'])):?>
      <?php foreach($plan['tours'] as $i=>$plan_tour):?>
      <tr>
        <td><?php echo $plan_tour['the_date'];?></td>
        <td><?php echo $plan_tour['name'];?></td>
        <td><table class="plan_tour_cars table table-bordered table-striped">
            <thead>
              <tr>
                <td>司机</td>
                <td>车型</td>
                <td>容纳人数</td>
                <td>价格</td>
                <td>备注</td>
              </tr>
            </thead>
            <tbody>
              <?php $tourist_capacity=0;
              $sum_price=0;
              foreach(getPlanTourCars($plan_tour['id']) as $plan_tour_car):
              $tourist_capacity+=$plan_tour_car['tourist_cnt'];
              $sum_price+=$plan_tour_car['price'];
              ?>
              <tr>
                <td><a href="driver.php?act=view&id=<?php echo $plan_tour_car['driver_id'];?> "><?php echo $plan_tour_car['driver_name'];?></a></td>
                <td class="car_type_<?php echo $plan_tour_car['type'];?>"><?php echo $config['car_types'][$plan_tour_car['type']];?></td>
                <td><?php echo $plan_tour_car['tourist_cnt'];?></td>
                <td><?php echo $plan_tour_car['price'];?></td>
                <td><?php echo $plan_tour_car['memo'];?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
            <tfoot>
            <td colspan="2">合计</td>
              <td class="tourist_capacity"><?php echo $tourist_capacity;?></td>
              <td class="sum_price"><?php echo $sum_price;?></td>
              <td></td>
                </tfoot>
          </table>
          <?php if($plan['car_status']=='assignning'):?>
          <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn btn_assign_car"/>
          <?php endif;?></td>
      </tr>
      <?php endforeach;?>
      <?php else:?>
      <tr>
        <td colspan="100">咦，没有安排日程！</td>
      </tr>
      <?php endif;?>
    </tbody>
  </table>
  <script type="text/javascript">
  <!--
    jQuery(function($){
        $('input.btn_assign_car').live('click', function(){
        jQuery.facebox({ div: '#car_assign_form' });
        var ts=+new Date();
        $.each(['car_plan_tour_id', 'car_driver_id', 'car_type', 'tourist_cnt', 'car_price', 'car_memo'], function(i, id){
          $( "#facebox #"+id).attr('id', id+'_'+ts);
        });
        var plan_tour_id = $(this).data('plan_tour_id');
        $('#room_plan_tour_id'+'_'+ts).val(plan_tour_id);
        $.get('plan.php?act=get-plan-tour_cars&plan_tour_id='+plan_tour_id, function(data){
          var tourist_capacity = 0;
          var sum_price = 0;
          $.each(data, function(idx, row){
            sum_price+=parseInt(row.price);
            tourist_capacity+=parseInt(row.tourist_cnt);
            data[idx]['type_name']=car_types[row.type];
          });
          $('#facebox table.plan_tour_cars tbody').empty().append($("#planTourCarTemplate").tmpl(data));
          $('#facebox table.plan_tour_cars tfoot td.sum_price').html(sum_price);
          $('#facebox table.plan_tour_cars tfoot td.tourist_capacity').html(tourist_capacity);
        }, 'json');
         $.get('plan.php?act=get-destination-drivers&plan_tour_id='+plan_tour_id, function(drivers){
          var driver_selector = $('#car_driver_id'+'_'+ts);
          driver_selector.empty();
          $.each(drivers, function(i, driver){
            driver_selector.append(new Option(driver.name, driver.id));
          });
        }, 'json');
        $('#car_plan_tour_id'+'_'+ts).val($(this).data('plan_tour_id'));
        $('#car_driver_id'+'_'+ts+', #car_type'+'_'+ts).change(function(){
          var driver_id = $('#car_driver_id'+'_'+ts).val();
          var car_type = $('#car_type'+'_'+ts).val();
          var price = refreshCarPrice(plan_tour_id, driver_id, car_type);
          $('#car_price'+'_'+ts).val(price);
        });
      });
    });
  //-->
  </script>