<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <td>日期</td>
        <td>住宿地</td>
        <td>安排情况</td>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($plan['tours'])):?>
      <?php foreach($plan['tours'] as $i=>$plan_tour):?>
      <tr>
        <td><?php echo $plan_tour['the_date'];?></td>
        <td><?php echo $plan_tour['destination'];?></td>
        <td><table class="plan_tour_rooms table table-bordered table-striped">
            <thead>
              <tr>
                <td>酒店</td>
                <td>房型</td>
                <td>容纳人数</td>
                <td>价格</td>
                <td>备注</td>
              </tr>
            </thead>
            <tbody>
              <?php $tourist_capacity=0;
              $sum_price=0;
              foreach(getPlanTourRooms($plan_tour['id']) as $plan_tour_room):
              $tourist_capacity+=$plan_tour_room['tourist_cnt'];
              $sum_price+=$plan_tour_room['price'];
              ?>
              <tr>
                <td><a href="hotel.php?act=view&id=<?php echo $plan_tour_room['hotel_id'];?>"><?php echo $plan_tour_room['hotel_name'];?></a></td>
                <td class="room_type_<?php echo $plan_tour_room['type'];?>"><?php echo $config['room_types'][$plan_tour_room['type']];?></td>
                <td><?php echo $plan_tour_room['tourist_cnt'];?></td>
                <td><?php echo $plan_tour_room['price'];?></td>
                <td><?php echo $plan_tour_room['memo'];?></td>
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
          <?php if($plan['room_status']=='assignning'):?>
          <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn btn_assign_room"/>
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