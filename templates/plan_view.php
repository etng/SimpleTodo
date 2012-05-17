<style type="text/css">
div.tourist_detail {
	width: 200px;
	float: left;
	padding: 5px 10px;
	height: 350px;
}
</style>
<ul class="breadcrumb">
  <li><a href="/">首页</a> <span class="divider">/</span></li>
  <li><a href="plan.php?act=list">计划</a> <span class="divider">/</span></li>
  <li class="active">查看 #<?php echo $plan['id']?></li>
</ul>
<h3> [<?php echo $plan['sn'];?>]<?php echo date('Y-n-j', strtotime($plan['arrive_date']));?>&nbsp; <?php echo $plan['contact']['name'];?>一行<?php echo $plan['contact']['forum_uid'];?><?php echo $plan['tourist_cnt'];?>人&nbsp;
  &nbsp;- <?php echo $plan['schedule_name'];?>(<?php echo $plan['schedule_days'];?>天)
  &nbsp;- 酒店：<?php echo $room_statuss[$plan['room_status']]['text'];?>&nbsp;
  &nbsp;- 司机：<?php echo $car_statuss[$plan['car_status']]['text'];?>&nbsp; <br />
  顾问：<?php echo $consult_staff_options[$plan['consult_staff_id']];?>&nbsp;,
  跟单：<?php echo @$market_staff_options[$plan['market_staff_id']];?> &nbsp;<?php echo $plan_statuss[$plan['status']]['text'];?> </h3>
<div class="row">
  <?php if($next_statuss = $plan_statuss[$plan['status']]['next']):?>
  <?php foreach(explode(',', $next_statuss) as $next_status):$next_status_info = $plan_statuss[$next_status];?>
  <a class="btn" href="plan.php?act=set-status&status=<?php echo $next_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_status_info['action_text']?></a>
  <?php endforeach;?>
  <?php endif;?>
  <a class="btn" href="plan.php?act=print_contract&id=<?php echo $plan['id']?>">打印合同</a> <a class="btn" href="plan.php?act=print_schedule&id=<?php echo $plan['id']?>">打印行程单</a> <a class="btn" href="plan.php?act=print_map&id=<?php echo $plan['id']?>">打印司机发车单</a> </div>
<div class="tabbable tabs-top">
<ul class="nav nav-tabs">
  <li><a href="#tab_contact" data-toggle="tab">联系人</a></li>
  <li><a href="#tab_tourist" data-toggle="tab">游客</a></li>
  <li class="active"><a href="#tab_schedule" data-toggle="tab">日程</a></li>
  <?php if($plan['schedule_status']=='locked'):?>
  <li><a href="#tab_car_assignment" data-toggle="tab">车辆安排</a></li>
  <li><a href="#tab_hotel_assignment" data-toggle="tab">酒店安排</a></li>
  <?php endif;?>
  <li><a href="#tab_request" data-toggle="tab">要求</a></li>
  <li><a href="#tab_payment" data-toggle="tab">财务</a></li>
  <li><a href="#tab_note" data-toggle="tab">备忘</a></li>
  <li><a href="#tab_history" data-toggle="tab">日志</a></li>
  <li><a href="#tab_staff" data-toggle="tab">工作人员</a></li>
</ul>
<div class="tab-content">
<?php if($plan['schedule_status']=='locked'):?>
<div class="tab-pane" id="tab_car_assignment">
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
</div>
<div class="tab-pane" id="tab_hotel_assignment">
  <h4>请<?php echo @$room_staff_options[$plan['room_staff_id']];?> 安排 <?php echo $plan['tourist_cnt'];?> 人的住宿事宜</h4>
  <div>客户留言:　<?php echo $plan['room_request']?></div>
  <dl>
    <dt>当前状态</dt>
    <dd> <?php echo $room_statuss[$plan['room_status']]['text'];?> </dd>
    <?php if($next_room_statuss = $room_statuss[$plan['room_status']]['next']):?>
    <dt>操作</dt>
    <dd>
      <?php foreach(explode(',', $next_room_statuss) as $next_room_status):$next_room_status_info = $room_statuss[$next_room_status];?>
      <a class="btn" href="plan.php?act=set-room-status&status=<?php echo $next_room_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_room_status_info['action_text']?></a>
      <?php endforeach;?>
    </dd>
    <?php endif;?>
  </dl>
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
</div>
<?php endif;?>
<div class="tab-pane" id="tab_contact">
  <dl>
    <dt>姓名</dt>
    <dd><?php echo $plan['contact']['name'];?></dd>
    <dt>电话</dt>
    <dd><?php echo $plan['contact']['phone'];?></dd>
    <dt>Email</dt>
    <dd><?php echo $plan['contact']['email'];?></dd>
    <dt>论坛帐号</dt>
    <dd><?php echo $plan['contact']['forum_uid'];?></dd>
  </dl>
  <input type="button" value="更新联系人信息" class="btn btn_update_contact"/>
</div>
<div class="tab-pane" id="tab_tourist"> 共<?php echo $plan['tourist_cnt']?>人<br />
  <div id="toutists">
    <?php foreach($plan['tourists'] as $tourist):?>
    <div class="tourist_detail" data-tourist_id="<?php echo $tourist['id'];?>"> <a href="<?php echo empty($tourist['card_photo'])?'#':$tourist['card_photo'];?>" rel="facebox"><img src="<?php echo empty($tourist['card_photo'])?$default_card_photo_url:$tourist['card_photo'];?>" style="width:200px,height:150px !important;"></a>
      <dl>
        <dt>姓名：</dt>
        <dd><?php echo $tourist['name'];?></dd>
        <dt>电话：</dt>
        <dd><?php echo $tourist['phone'];?></dd>
        <dt>证件类型：</dt>
        <dd><?php echo $config['id_card_types'][$tourist['card_type']];?></dd>
        <dt>证件号码：</dt>
        <dd><?php echo $tourist['card_number'];?></dd>
      </dl>
      <input type="button" value="修改游客信息" class="btn btn_update_tourist"/>
    </div>
    <?php endforeach;?>
    <div class="tourist_detail">
      <input type="button" value="新增游客信息" class="btn btn_add_tourist"/>
    </div>
  </div>
  <!-- #toutists -->
  <div style="clear:both;"></div>
</div>
<div class="tab-pane" id="tab_request">
  <form method="post" action="?act=update-request" enctype="multipart/form-data">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <?php include('_plan_request_form.php')?>
    <input type="submit" value="更新要求" class="btn btn-primary"  />
  </form>
</div>
<div class="tab-pane active" id="tab_schedule">
  <form method="post" action="plan.php?act=update-detail-schedule" enctype="multipart/form-data">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>出发日期</dt>
      <dd><?php echo $plan['start_date']?></dd>
      <dt>日程安排</dt>
      <dd>
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>天数</td>
              <td>日期</td>
              <td>行程</td>
              <td>住宿</td>
              <td>酒店名称</td>
              <td>间数</td>
              <td>住宿费用</td>
              <td>备注</td>
              <td>车辆安排</td>
            </tr>
          </thead>
          <tbody>
            <?php
                    $room_price_sum=$car_price_sum=0;
          $car_days=array();

          if(!empty($plan['tours'])):?>
            <?php $i=0;foreach($plan['tours'] as $id=>$plan_tour):$plan_tour['day'] = 'D' . (++$i);?>
            <tr class="dest_<?php echo $plan_tour['destination_id'];?>">
              <td><?php echo $plan_tour['day'];?></td>
              <td><?php echo $plan_tour['the_date'];?></td>
              <td><?php echo $plan_tour['name'];?></td>
              <td><?php echo $plan_tour['destination'];?></td>
              <td><?php
            $current_hotel_id = $plan_tour['hotel_id'];
            settype($hotel_options[$plan_tour['destination_id']], 'array');
            if($current_hotel_id==0)
            {
                if(!empty($hotel_options[$plan_tour['destination_id']]))
                {
                    reset($hotel_options[$plan_tour['destination_id']]);
                    $current_hotel_id=key($hotel_options[$plan_tour['destination_id']]);
                }
                else
                {
                    $current_hotel_id = -1;
                }
            }
            ?>
                <?php if(hasPrivilege('assignHotel')):?>
                <select data-dest-id="<?php echo $plan_tour['destination_id'];?>" data-the_date="<?php echo $plan_tour['the_date'];?>" name="plan_tour[<?php echo $id;?>][hotel_id]" class="input-medium plan_tour_hotel_selector">
                  <option value="-1">自理</option>
                  <?php foreach($hotel_options[$plan_tour['destination_id']] as $hotel_id=>$hotel_name):?>
                  <option value="<?php echo $hotel_id;?>"<?php $hotel_id==@$current_hotel_id && print(' selected="true"');?>><?php echo $hotel_name;?></option>
                  <?php endforeach;?>
                </select>
                <input type="hidden"  name="plan_tour[<?php echo $id;?>][hotel_id]" value="<?php echo $plan_tour['hotel_id'];?>" />
                <?php else:?>
                <?php echo $current_hotel_id==-1?'自理':@$hotel_options[$plan_tour['destination_id']][$current_hotel_id];?>
                <?php endif;?></td>
              <td class="room_cnt"><?php echo $plan_tour['need_room_cnt'];?></td>
              <td><?php if(!hasPrivilege('assignHotel')):?>
                <span  class="room_price_sum"><?php echo $plan_tour['room_price_sum'];?></span>
                <?php else:?>
                <input type="text" name="plan_tour[<?php echo $id;?>][room_price_sum]" class="input-mini room_price_sum" value="<?php echo $plan_tour['room_price_sum'];?>" />
                <?php endif;?></td>
              <td><?php if(hasPrivilege('assignHotel')):?>
                <textarea  name="plan_tour[<?php echo $id;?>][memo]" class="input-small" rows="3" cols="20"><?php echo $plan_tour['memo'];?></textarea>
                <?php else:?>
                <?php echo $plan_tour['memo'];?>
                <?php endif;?></td>
              <td><input type="text" size="2" class="input-mini need_car_cnt"  id="plan_tour_<?php echo $id;?>_need_car_cnt" name="plan_tour[<?php echo $id;?>][need_car_cnt]" value="<?php echo $plan_tour['need_car_cnt'];?>" />
                <label class="checkbox">
                  <input type="checkbox" class="do_not_need_car"<?php if(!$plan_tour['need_car_cnt']):?> checked="true"<?php endif;?> />
                  无需车辆</label>
                <?php if($plan_tour['need_car_cnt'] && ($plan['car_status']=='assignning')):?>
                <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn btn_assign_car"/>
                <?php endif;?></td>
            </tr>
            <?php
          $room_price_sum+=$plan_tour['room_price_sum'];
          $car_price_sum+=$plan_tour['car_price_sum'];
          if($plan_tour['need_car_cnt'])
          {
            $car_days[]=$plan_tour['day'];
          }
          endforeach;?>
            <?php else:?>
            <tr>
              <td colspan="100">咦，没有安排日程！</td>
            </tr>
            <?php endif;?>
          </tbody>
        </table>
      </dd>
    </dl>
    <input type="submit" value="更新日程细节" class="btn btn-primary"  />
  </form>
  <div class="row" id="plan_sum">
    <div class="span12"> 住宿费用小计： <span class="room_price_sum"><?php echo $room_price_sum;?></span><br />
      <?php if($car_days):?>
      包车费用小计：<span class=""><?php echo $car_price_sum;?></span>， 时间： <?php echo implode('-', $car_days)?>共计<?php echo count($car_days)?>天<br />
      <?php endif;?>
    </div>
  </div>
  <div class="row">
    <div class="span12">
      <h3>使用说明</h3>
      <ol>
        <li>每日酒店默认为该目的地默认酒店，并提供酒店列表</li>
        <li>点击每天日程中酒店名称位置后，跳出该住宿目的地可以安排的酒店列表，选择后自动更新酒店价格</li>
      </ol>
    </div>
  </div>
  <style type="text/css">
    .need_room_cnt, .need_car_cnt{width: auto;}
</style>
  <script type="text/javascript">
<!--
    function updateHotel($tr, hotel_id)
    {
        var $selector = $tr.find('.plan_tour_hotel_selector');
        var the_date = $selector.data('the_date');
        var $room_cnt = $('.room_cnt', $tr);
        var room_cnt = $room_cnt.html();
        if(hotel_id<1)
        {
            $('input.room_price_sum', $tr).val(0);
        }
        else
        {
            $.get('plan.php?act=hotel-daily-price&hotel_id='+hotel_id+'&the_date='+the_date, function(response)
            {
                if(response.status)
                {
                    var room_price = response.price;
                    $('input.room_price_sum', $tr).val(room_price*room_cnt);
                }
                else
                {
                    alert(response.message);
                }
            }, 'json');
        }
        $selector.val(hotel_id);
    }
    jQuery(function($){
    $('.plan_tour_hotel_selector').change(function(){
        var $selector = $(this);
        var hotel_id = $selector.val();
        var dest_id = $selector.data('dest-id');
        $selector.closest('table').find('.plan_tour_hotel_selector').each(function(k, v){
            $this = $(v);
            if($this.data('dest-id')==dest_id)
            {
                updateHotel($this.closest('tr'), hotel_id);
            }
        });
        var total_room_price =0;
        $('input.room_price_sum').each(function(k, v){
            var p = parseFloat($(v).val());
            if(isNaN(p))
            {
                p=0;
            }
            total_room_price+=p;
        });
        $('#plan_sum .room_price_sum').html(total_room_price);
    });
    });
//-->
</script>
  <form method="post" action="plan.php?act=update-schedule" enctype="multipart/form-data">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <?php include('_plan_schedule_form.php')?>
    <input type="submit" value="更新日程" class="btn btn-primary"  />
  </form>
</div>
<div class="tab-pane" id="tab_history">
  <h3>操作进程</h3>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>处理时间</th>
        <th>处理信息</th>
        <th>操作人</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($plan['history'] as $i=>$plan_history):?>
      <tr>
        <td><?php echo $plan_history['created'];?></td>
        <td><?php echo $plan_history['operation'];?></td>
        <td><?php echo $plan_history['operator'];?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<div class="tab-pane" id="tab_note">
  <h3>备忘</h3>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>时间</th>
        <th>留言人</th>
        <th>内容</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($plan['notes'] as $i=>$plan_note):?>
      <tr>
        <td><?php echo $plan_note['created'];?></td>
        <td><?php echo $plan_note['staff_name'];?></td>
        <td><?php echo $plan_note['content'];?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <input type="button" value="添加备忘" class="btn btn_add_note"/>
</div>
<div class="tab-pane" id="tab_staff">
  <h3>工作人员</h3>
  <form method="post" action="plan.php?act=update-staff" enctype="multipart/form-data">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <?php include('_plan_staff_form.php')?>
    <input type="submit" value="更新人员安排" class="btn btn-primary"  />
  </form>
</div>
<div class="tab-pane" id="tab_payment">
  <dl>
    <dt>应付费用</dt>
    <dd><?php echo $plan['price']?></dd>
    <dt>已付费用</dt>
    <dd><?php echo $plan['paid']?></dd>
    <dt>余额</dt>
    <dd><?php echo $plan['balance']?>
      <?php if($plan['balance']!=0 || true):?>
      <input type="button" value="添加支付记录" class="btn btn_add_payment"/>
      <?php endif;?>
    </dd>
    <dt>支付记录</dt>
    <dd>
      <?php $show_plan=false;$plan_payments=$plan['payments'];include('_plan_payment_list.php');?>
    </dd>
  </dl>
</div>
<script type='text/javascript'>
function refreshCarPrice(plan_tour_id, driver_id, car_type)
{
  //@todo ajax get room price on that day
  return parseInt(Math.random(1)*10)*20;
}
$(document).ready(function(){

    <?php include(dirname(__file__) .'/plan_edit.js.php');?>

  window.room_types = <?php echo json_encode($config['room_types']);?>;
  window.car_types = <?php echo json_encode($config['car_types']);?>;
  window.plan_tourists = <?php echo json_encode($plan['tourists']);?>;
  window.need_room_cnt = <?php echo intval($plan['need_room_cnt']);?>;
  window.need_car_cnt = <?php echo intval($plan['need_car_cnt']);?>;
  $('input:checkbox.do_not_need_room').change(function(){
        var txt_need_room_cnt = $(this).closest('td').find('input.need_room_cnt');
        if(this.checked)
      {
        txt_need_room_cnt.val(0).hide();
      }
      else
      {
        txt_need_room_cnt.val(window.need_room_cnt).show().focus().select();
      }
  });

  $('#plan_need_hotel').change(function(){
        var txt_need_room_cnt = $('#plan_need_room_cnt');
        if(!this.checked)
      {
        txt_need_room_cnt.val(0).hide();
      }
      else
      {
        txt_need_room_cnt.val(1).show().focus().select();
      }
  });
  $('#plan_need_car').change(function(){
        var txt_need_car_cnt = $('#plan_need_car_cnt');
        if(!this.checked)
      {
        txt_need_car_cnt.val(0).hide();
      }
      else
      {
        txt_need_car_cnt.val(1).show().focus().select();
      }
  });

    $('input:checkbox.do_not_need_car').change(function(){
        var txt_need_car_cnt = $(this).closest('td').find('input.need_car_cnt');
        if(this.checked)
      {
        txt_need_car_cnt.val(0).hide();
      }
      else
      {
        txt_need_car_cnt.val(window.need_car_cnt).show().focus().select();
      }
  });
  $('input:checkbox.do_not_need_room,input:checkbox.do_not_need_car').trigger('change');
  $('input.btn_assign_room').live('click', function(){
    jQuery.facebox({ div: '#room_assign_form' });
    var ts=+new Date();
    $.each(['room_plan_tour_id', 'room_hotel_id', 'room_type', 'tourist_cnt', 'room_price', 'room_memo'], function(i, id){
      $( "#facebox #"+id).attr('id', id+'_'+ts);
    });
    var plan_tour_id = $(this).data('plan_tour_id');
    $('#room_plan_tour_id'+'_'+ts).val(plan_tour_id);
    $.get('plan.php?act=get-plan-tour_rooms&plan_tour_id='+plan_tour_id, function(data){
      var tourist_capacity = 0;
      var sum_price = 0;
      $.each(data, function(idx, row){
        sum_price+=parseInt(row.price);
        tourist_capacity+=parseInt(row.tourist_cnt);
        data[idx]['type_name']=room_types[row.type];
      });
      $('#facebox table.plan_tour_rooms tbody').empty().append($("#planTourRoomTemplate").tmpl(data));
      $('#facebox table.plan_tour_rooms tfoot td.sum_price').html(sum_price);
      $('#facebox table.plan_tour_rooms tfoot td.tourist_capacity').html(tourist_capacity);
    }, 'json');
     $.get('plan.php?act=get-destination-hotels&plan_tour_id='+plan_tour_id, function(hotels){
      var hotel_selector = $('#room_hotel_id'+'_'+ts);
      hotel_selector.empty();
      $.each(hotels, function(i, hotel){
        hotel_selector.append(new Option(hotel.name, hotel.id));
      });
    }, 'json');

    $('#room_hotel_id'+'_'+ts+', #room_type'+'_'+ts).change(function(){
      var hotel_id = $('#room_hotel_id'+'_'+ts).val();
      var room_type = $('#room_type'+'_'+ts).val();
      $.get('plan.php?act=get-room-price&plan_tour_id='+plan_tour_id+'&hotel_id='+hotel_id+'&room_type='+room_type, function(price_info){
        $('#room_price'+'_'+ts).val(price_info.default_price);
      }, 'json');
    });
  });
  $('input.btn_add_note').click(function(){
     jQuery.facebox({ div: '#add_note_form' });
  });
  $('input.btn_add_tourist').click(function(){
     jQuery.facebox({ div: '#add_tourist_form' });
  });
  $('input.btn_update_tourist').click(function(){
     jQuery.facebox({ div: '#update_tourist_form' });
     var cur_tourist = plan_tourists[$(this).closest('div').data('tourist_id')];
    $.each(cur_tourist, function(k, v){
      if(k=='card_photo')
      {
        $( "#facebox #update_tourist_"+k+'_url').val(v);
      }
      else
      {
        $( "#facebox #update_tourist_"+k).val(v);
      }
    });
  });
  $('input.btn_update_contact').click(function(){
     jQuery.facebox({ div: '#update_contact_form' });
  });
  $('input.btn_add_payment').live('click', function(){
  jQuery.facebox({ div: '#payment_add_form' });
});
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
</script>
<div id="update_tourist_form" style="display:none">
  <h4>更新游客信息</h4>
  <div class="close">&times;</div>
  <form method="post" enctype="multipart/form-data" action="plan.php?act=update-tourist">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <input type="hidden" id="update_tourist_id" name="tourist[id]" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>姓名</dt>
      <dd>
        <input type="text" id="update_tourist_name" name="tourist[name]" value=""/>
      </dd>
      <dt>电话</dt>
      <dd>
        <input type="text" id="update_tourist_phone" name="tourist[phone]" value=""/>
      </dd>
      <dt>证件类型</dt>
      <dd>
        <select id="update_tourist_card_type" name="tourist[card_type]">
          <?php foreach($config['id_card_types'] as $card_type=>$text):?>
          <option value="<?php echo $card_type;?>"><?php echo $text;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>证件号码</dt>
      <dd>
        <input type="text" id="update_tourist_card_number" name="tourist[card_number]" value=""/>
      </dd>
      <dt>证件照片</dt>
      <dd>
        <label>网址：
          <input type="text" id="update_tourist_card_photo_url" name="tourist[card_photo_url]" size="80"   value=""/>
        </label>
        <br />
        <label>上传：
          <input type="file" id="update_tourist_card_photo_file" name="tourist_card_photo_file[]" />
        </label>
      </dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>
</div>
<div id="update_contact_form" style="display:none">
  <h4>更新联系人信息</h4>
  <div class="close">&times;</div>
  <form method="post" action="plan.php?act=update-contact">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>姓名</dt>
      <dd>
        <input type="text" id="plan_contact_name" name="plan[contact][name]" value="<?php echo $plan['contact']['name']?>" />
      </dd>
      <dt>电话</dt>
      <dd>
        <input type="text" id="plan_contact_phone" name="plan[contact][phone]" value="<?php echo $plan['contact']['phone']?>" />
      </dd>
      <dt>Email</dt>
      <dd>
        <input type="text" id="plan_contact_email" name="plan[contact][email]" value="<?php echo $plan['contact']['email']?>" />
      </dd>
      <dt>论坛帐号</dt>
      <dd>
        <input type="text" id="plan_contact_forum_uid" name="plan[contact][forum_uid]" value="<?php echo $plan['contact']['forum_uid']?>" />
      </dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>
</div>
<!-- #update_contact_form -->

<div id="add_tourist_form" style="display:none">
  <h4>添加游客</h4>
  <div class="close">&times;</div>
  <form method="post" enctype="multipart/form-data" action="plan.php?act=add-tourist">
    <input type="hidden" name="tourist[plan_id]" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>姓名</dt>
      <dd>
        <input type="text" id="tourist_name_new" name="tourist[name][new]" value=""/>
      </dd>
      <dt>电话</dt>
      <dd>
        <input type="text" id="tourist_phone_new" name="tourist[phone][new]" value=""/>
      </dd>
      <dt>证件类型</dt>
      <dd>
        <select id="tourist_card_type_new" name="tourist[card_type][new]">
          <?php foreach($config['id_card_types'] as $card_type=>$text):?>
          <option value="<?php echo $card_type;?>"><?php echo $text;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>证件号码</dt>
      <dd>
        <input type="text" id="tourist_card_number_new" name="tourist[card_number][new]" value=""/>
      </dd>
      <dt>证件照片</dt>
      <dd>
        <label>网址：
          <input type="text" id="tourist_card_photo_url_new" name="tourist[card_photo_url][new]" size="80"   value=""/>
        </label>
        <br />
        <label>上传：
          <input type="file" id="tourist_card_photo_file_new" name="tourist_card_photo_file[new]" />
        </label>
      </dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>
</div>
<div id="add_note_form" style="display:none">
  <h4>请留下你想说的话</h4>
  <div class="close">&times;</div>
  <form method="post" action="plan.php?act=add-note">
    <input type="hidden" name="note[plan_id]" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>内容</dt>
      <dd>
        <textarea name="note[content]" id="note_content" rows="3" cols="70"></textarea>
      </dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>
</div>
<div id="room_assign_form" style="display:none"> 
  <!-- <h4>已安排酒店情况</h4>
 <table class="plan_tour_rooms table table-bordered table-striped">
   <thead><tr>
    <td>酒店</td>
    <td>房型</td>
    <td>容纳人数</td>
    <td>价格</td>
    <td>备注</td>
  </tr></thead>
  <tbody></tbody>
  <tfoot>
    <td colspan="2">合计</td>
    <td class="tourist_capacity"></td>
    <td class="sum_price"></td>
    <td></td>
  </tfoot>
</table> -->
  <h4>安排酒店</h4>
  <form method="post" action="plan.php?act=add-room">
    <input type="hidden" name="room[plan_id]" value="<?php echo $plan['id']?>" />
    <input type="hidden" name="room[plan_tour_id]" id="room_plan_tour_id" value="" />
    <dl>
      <dt>酒店</dt>
      <dd>
        <select name="room[hotel_id]" id="room_hotel_id">
          <option value="" selected="selected">--请选择--</option>
        </select>
      </dd>
      <dt>房型</dt>
      <dd>
        <select name="room[type]" id="room_type">
          <option value="" selected="selected">--请选择--</option>
          <?php foreach($config['room_types'] as $room_type=>$text):?>
          <option value="<?php echo $room_type;?>"><?php echo $text;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>住宿人数</dt>
      <dd>
        <input type="text" name="room[tourist_cnt]" id="room_tourist_cnt" value="2" />
      </dd>
      <dt>金额</dt>
      <dd>
        <input type="text" name="room[price]" id="room_price" value="" />
      </dd>
      <dt>备注</dt>
      <dd>
        <textarea name="room[memo]" id="room_memo" rows="3" cols="70"></textarea>
      </dd>
    </dl>
    <input type="submit" value="提交" class="btn"  />
  </form>
</div>
<div id="car_assign_form" style="display:none"> 
  <!-- <h4>已安排车辆情况</h4>
 <table class="plan_tour_cars table table-bordered table-striped">
   <thead><tr>
    <td>司机</td>
    <td>车型</td>
    <td>容纳人数</td>
    <td>价格</td>
    <td>备注</td>
  </tr></thead>
  <tbody></tbody>
  <tfoot>
    <td colspan="2">合计</td>
    <td class="tourist_capacity"></td>
    <td class="sum_price"></td>
    <td></td>
  </tfoot>
</table> -->
  <h4>安排车辆</h4>
  <form method="post" action="plan.php?act=add-car">
    <input type="hidden" name="car[plan_id]" value="<?php echo $plan['id']?>" />
    <input type="hidden" name="car[plan_tour_id]" id="car_plan_tour_id" value="" />
    <dl>
      <dt>车型</dt>
      <dd>
        <select name="car[type]" id="car_type">
          <option value="" selected="selected">--请选择--</option>
          <?php foreach($config['car_types'] as $car_type=>$text):?>
          <option value="<?php echo $car_type;?>"><?php echo $text;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>司机</dt>
      <dd>
        <select name="car[driver_id]" id="car_driver_id">
          <option value="" selected="selected">--请选择--</option>
        </select>
      </dd>
      <dt>容纳人数</dt>
      <dd>
        <input type="text" name="car[tourist_cnt]" id="car_tourist_cnt" value="2" />
      </dd>
      <dt>金额</dt>
      <dd>
        <input type="text" name="car[price]" id="car_price" value="" />
      </dd>
      <dt>备注</dt>
      <dd>
        <textarea name="car[memo]" id="car_memo" rows="3" cols="70"></textarea>
      </dd>
    </dl>
    <input type="submit" value="提交" class="btn"  />
  </form>
</div>
<script id="planTourCarTemplate" type="text/x-jquery-tmpl">
  <tr>
    <td><a href="driver.php?act=view&id=${driver_id}">${driver_name}</a></td>
    <td class="car_type_${type}">${type_name}</td>
    <td>${tourist_cnt}</td>
    <td>${price}</td>
    <td>${memo}</td>
  </tr>
</script> 
<script id="planTourRoomTemplate" type="text/x-jquery-tmpl">
  <tr>
    <td><a href="hotel.php?act=view&id=${hotel_id}">${hotel_name}</a></td>
    <td class="room_type_${type}">${type_name}</td>
    <td>${tourist_cnt}</td>
    <td>${price}</td>
    <td>${memo}</td>
  </tr>
</script>
<div id="payment_add_form" style="display:none">
  <?php include('_payment_add_form.php');?>
</div>
