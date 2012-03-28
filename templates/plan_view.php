  <style type="text/css">
  div.tourist_detail
  {
    width: 200px;
    float: left;
    padding: 5px 10px;
    height: 350px;
  }

</style>
<?php
function getPlanTourRooms($plan_tour_id)
{
  global $db;
  return $db->fetchAll('select plan_tour_room.*,hotel.name as hotel_name from plan_tour_room left join hotel on plan_tour_room.hotel_id=hotel.id where plan_tour_room.plan_tour_id=' . $plan_tour_id);
}
function getPlanTourCars($plan_tour_id)
{
  global $db;
  return $db->fetchAll('select plan_tour_car.*,driver.name as driver_name from plan_tour_car left join driver on plan_tour_car.driver_id=driver.id where plan_tour_car.plan_tour_id=' . $plan_tour_id);
}
?>
<ul class="breadcrumb">
  <li><a href="/">首页</a> <span class="divider">/</span></li>
  <li><a href="plan.php?act=list">计划</a> <span class="divider">/</span></li>
  <li class="active">查看 #<?php echo $plan['id']?></li>
</ul>
<?php $plan['contact'] = $contact;?>
<dl>
<dt>业务跟进</dt>
          <dd>
          <?php echo $market_staff_options[$plan['market_staff_id']];?>
           </dd>
        <dt>当前状态</dt>
          <dd>
          <?php echo $statuss[$plan['status']]['text'];?>
           </dd>
        <?php if($next_statuss = $statuss[$plan['status']]['next']):?>
          <dt>操作</dt>
          <dd>
           <?php foreach(explode(',', $next_statuss) as $next_status):$next_status_info = $statuss[$next_status];?>
          <a class="btn" href="plan.php?act=set-status&status=<?php echo $next_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_status_info['action_text']?></a>
          <?php endforeach;?>

          </dd>
        <?php endif;?>
        </dl>
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
  </ul>

  <div class="tab-content">
      <?php if($plan['schedule_status']=='locked'):?>

    <div class="tab-pane" id="tab_car_assignment">
 <h4>请<?php echo $car_staff_options[$plan['car_staff_id']];?> 安排 <?php echo $plan['tourist_cnt'];?> 人旅行司机及车辆</h4>
    <div>客户留言:　<?php echo $plan['car_request']?></div>
    <dl>
        <dt>当前状态</dt>
          <dd>
          <?php echo $car_statuss[$plan['car_status']]['text'];?>
           </dd>
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
          <thead><tr>
            <td>日期</td>
            <td>线路</td>
            <td>安排情况</td>
          </tr></thead>
          <tbody><?php if(!empty($plan['tours'])):?>
          <?php foreach($plan['tours'] as $i=>$plan_tour):?>
          <tr>
            <td><?php echo $plan_tour['the_date'];?></td>
            <td><?php echo $plan_tour['name'];?></td>
            <td>
 <table class="plan_tour_cars table table-bordered table-striped">
   <thead><tr>
    <td>司机</td>
    <td>车型</td>
    <td>容纳人数</td>
    <td>价格</td>
    <td>备注</td>
  </tr></thead>
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
  </tr><?php endforeach;?>
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
            <?php endif;?>
            </td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td colspan="100">咦，没有安排日程！</td>
          </tr>
          <?php endif;?></tbody>
        </table>

    </div>
    <div class="tab-pane" id="tab_hotel_assignment">
    <h4>请<?php echo $room_staff_options[$plan['room_staff_id']];?> 安排 <?php echo $plan['tourist_cnt'];?> 人的住宿事宜</h4>
    <div>客户留言:　<?php echo $plan['room_request']?></div>
    <dl>
        <dt>当前状态</dt>
          <dd>
          <?php echo $room_statuss[$plan['room_status']]['text'];?>
           </dd>
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
          <thead><tr>
            <td>日期</td>
            <td>住宿地</td>
            <td>安排情况</td>
          </tr></thead>
          <tbody><?php if(!empty($plan['tours'])):?>
          <?php foreach($plan['tours'] as $i=>$plan_tour):?>
          <tr>
            <td><?php echo $plan_tour['the_date'];?></td>
            <td><?php echo $plan_tour['destination'];?></td>
            <td>
            <table class="plan_tour_rooms table table-bordered table-striped">
               <thead><tr>
                <td>酒店</td>
                <td>房型</td>
                <td>容纳人数</td>
                <td>价格</td>
                <td>备注</td>
              </tr></thead>
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
  </tr><?php endforeach;?>
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
            <?php endif;?>
            </td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td colspan="100">咦，没有安排日程！</td>
          </tr>
          <?php endif;?></tbody>
        </table>
     </div>
         <?php endif;?>

    <div class="tab-pane" id="tab_contact">
      <dl>
        <dt>姓名</dt><dd><?php echo $contact['name'];?></dd>
        <dt>电话</dt><dd><?php echo $contact['phone'];?></dd>
        <dt>Email</dt><dd><?php echo $contact['email'];?></dd>
        <dt>论坛帐号</dt><dd><?php echo $contact['forum_uid'];?></dd>
      </dl>
      <input type="button" value="更新联系人信息" class="btn btn_update_contact"/>
    </div>
    <div class="tab-pane" id="tab_tourist">
      共<?php echo $plan['tourist_cnt']?>人<br />
      <div id="toutists">
      <?php foreach($plan['tourists'] as $tourist):?>
        <div class="tourist_detail" data-tourist_id="<?php echo $tourist['id'];?>">
        <a href="<?php echo empty($tourist['card_photo'])?'#':$tourist['card_photo'];?>" rel="facebox"><img src="<?php echo empty($tourist['card_photo'])?$default_card_photo_url:$tourist['card_photo'];?>" style="width:200px,height:150px !important;"></a>
        <dl>
          <dt>姓名：</dt><dd><?php echo $tourist['name'];?></dd>
          <dt>电话：</dt><dd><?php echo $tourist['phone'];?></dd>
          <dt>证件类型：</dt><dd><?php echo $config['id_card_types'][$tourist['card_type']];?></dd>
          <dt>证件号码：</dt><dd><?php echo $tourist['card_number'];?></dd>
        </dl>
        <input type="button" value="修改游客信息" class="btn btn_update_tourist"/>
        </div>
      <?php endforeach;?>
        <div class="tourist_detail">
          <input type="button" value="新增游客信息" class="btn btn_add_tourist"/>
        </div>
      </div><!-- #toutists -->
      <div style="clear:both;"></div>
    </div>

    <div class="tab-pane" id="tab_request">
      <form method="post" action="?act=update-request" enctype="multipart/form-data">
      <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />

<dl>
   <dt>车辆要求</dt>
      <dd><textarea id="car_request" name="plan[car_request]" rows="3" cols="70"><?php echo $plan['car_request']?></textarea></dd>
       <dt>房间要求</dt>
      <dd><textarea id="room_request" name="plan[room_request]" rows="3" cols="70"><?php echo $plan['room_request']?></textarea></dd>
       <dt>其他要求</dt>
      <dd><textarea id="other_request" name="plan[other_request]" rows="3" cols="70"><?php echo $plan['other_request']?></textarea></dd>
</dl>
      <input type="submit" value="更新要求" class="btn btn-primary"  />
      </form>
    </div>
    <div class="tab-pane active" id="tab_schedule">
<form method="post" action="plan.php?act=update-schedule" enctype="multipart/form-data">
      <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />

<div>
<h4><label class="checkbox inline"><input type="hidden" name="plan[need_receive]" value="0" /><input type="checkbox" id="plan_need_receive" name="plan[need_receive]" value="1"<?php echo 1==@$plan['need_receive'] && print(' checked="true"');?> />需要接站</label></h4>
<div id="receive_detail_container"<?php echo 0==@$plan['need_receive'] && print(' style="display:none;"');?>> <dl>
             <dt>集合日期</dt><dd><input type="text" id="arrive_date" name="plan[arrive_date]" value="<?php echo $plan['arrive_date'];?>" size="10" /></dd>
             <dt>集合地点</dt><dd>
              <select id="arrive_destination" name="plan[arrive_destination]">
        <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
        <option value="<?php echo $city;?>"<?php echo $city==@$plan['arrive_destination'] && print(' selected="true"');?>><?php echo $city;?></option>
        <?php endforeach;?>
    </select></dd>
             <dt>集合方式</dt><dd><input type="text" id="arrive_method" name="plan[arrive_method]" value="<?php echo $plan['arrive_method'];?>" size="6" />
              <select id="arrive_method_selector">
        <option value="" selected="selected">自定义</option>
        <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
        <option value="<?php echo $method;?>"<?php echo $method==@$plan['arrive_method'] && print(' selected="true"');?>><?php echo $method;?></option>
        <?php endforeach;?>
    </select></dd>
<dt>接站地点等信息</dt><dd>
<textarea id="arrive_detail" name="plan[arrive_detail]" rows="3" cols="70" plcaceholder="班次、到达时间等信息"><?php echo $plan['arrive_detail'];?></textarea>
</dd>
</dl>
</div>
</div>

<div>

<h4><label class="checkbox inline"><input type="hidden" name="plan[need_seeoff]" value="0" /><input type="checkbox" id="plan_need_seeoff" name="plan[need_seeoff]" value="1"<?php echo 1==@$plan['need_seeoff'] && print(' checked="true"');?> />需要送站</label></h4>
<div id="seeoff_detail_container"<?php echo 0==@$plan['need_seeoff'] && print(' style="display:none;"');?> > <dl>

             <dt>遣散日期</dt><dd><input type="text" id="seeoff_date" name="plan[seeoff_date]" value="<?php echo $plan['seeoff_date'];?>" size="10" /></dd>
             <dt>遣散地点</dt><dd>
              <select id="seeoff_destination" name="plan[seeoff_destination]">
        <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
        <option value="<?php echo $city;?>"<?php echo $city==@$plan['seeoff_destination'] && print(' selected="true"');?>><?php echo $city;?></option>
        <?php endforeach;?>
    </select></dd>
             <dt>遣散方式</dt><dd><input type="text" id="seeoff_method" name="plan[seeoff_method]" value="<?php echo $plan['seeoff_method'];?>" size="6" />
              <select id="seeoff_method_selector">
        <option value="" selected="selected">自定义</option>
        <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
        <option value="<?php echo $method;?>"<?php echo $method==@$plan['seeoff_method'] && print(' selected="true"');?>><?php echo $method;?></option>
        <?php endforeach;?>
    </select></dd>
<dt>送站地点等信息</dt><dd>
<textarea id="seeoff_detail" name="plan[seeoff_detail]" rows="3" cols="70" plcaceholder="班次、出发时间等信息"><?php echo $plan['seeoff_detail'];?></textarea>
</dd>
</dl>
</div>
</div>

<div>
    <dl>
        <dt>主贴地址</dt>
          <dd>
          <input type="text" id="forum_url" name="plan[forum_url]" value="<?php echo $plan['forum_url'];?>" size="255" /><a href="<?php echo $plan['forum_url']?>" target="_blank">打开</a></dd>
                <dt>出发日期</dt>
                <dd><input type="text" id="start_date" name="plan[start_date]" value="<?php echo $plan['start_date'];?>" size="10" /></dd>
                 <dt>日程安排</dt>
                <dd>
                <select id="schedule_template_selector" name="plan[schedule_template_id]">
                    <option value="" selected="selected">--请选择--</option>
                    <?php foreach($schedule_templates as $schedule_template):?>
                    <option value="<?php echo $schedule_template['id'];?>"<?php echo $schedule_template['id']==@$plan['schedule_template_id'] && print(' selected="true"');?>><?php echo $schedule_template['name'];?></option>
                    <?php endforeach;?>
                </select><br />
                <textarea id="schedule_txt" name="plan[schedule_txt]" rows="8" cols="70"><?php echo $plan['schedule_txt'];?></textarea>
                <div class="btn-group">
                <input type="button" class="btn btn-reverse-schedule" value="倒排"/>
                <input type="button" class="btn btn-preview-schedule" value="预览"/>
                </div>
                <label class="checkbox inline"><input type="hidden" name="plan[need_passport]" value="0" /><input type="checkbox" id="plan_need_passport" name="plan[need_passport]" value="1"<?php echo 1==@$plan['need_passport'] && print(' checked="true"');?> />办理边防证</label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_hotel]" value="0" /><input type="checkbox" id="plan_need_hotel" name="plan[need_hotel]" value="1"<?php echo 1==@$plan['need_hotel'] && print(' checked="true"');?> />需要安排住宿</label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_car]" value="0" /><input type="checkbox" id="plan_need_car" name="plan[need_car]" value="1"<?php echo 1==@$plan['need_car'] && print(' checked="true"');?> />需要安排车辆</label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_insurance]" value="0" /><input type="checkbox" id="plan_need_insurance" name="plan[need_insurance]" value="1"<?php echo 1==@$plan['need_insurance'] && print(' checked="true"');?> />办理保险</label>
                </dd>
            </dl>
</div>
      <input type="submit" value="更新日程" class="btn btn-primary"  />

        <dl>
          <dt>出发日期</dt><dd><?php echo $plan['start_date']?></dd>
          <dt>日程安排</dt><dd>
          <table class="table table-bordered table-striped">
          <thead><tr>
            <td>日期</td>
            <td>线路</td>
            <td>住宿</td>
            <td>路程</td>
            <td>金额</td>
            <td>人数</td>
            <td>安排车辆</td>
            <td>安排住宿</td>
            <td>小计</td>
          </tr></thead>
          <tbody><?php if(!empty($plan['tours'])):?>
          <?php foreach($plan['tours'] as $i=>$plan_tour):?>
          <tr>
            <td><?php echo $plan_tour['the_date'];?></td>
            <td><?php echo $plan_tour['name'];?></td>
            <td><?php echo $plan_tour['destination'];?></td>
            <td><?php echo $plan_tour['distance'];?></td>
            <td><?php echo $plan_tour['price'];?></td>
            <td><?php echo $plan_tour['tourist_cnt'];?></td>
            <td><?php echo $plan_tour['car_tourist_cnt'];?>
            <?php if($plan['car_status']=='assignning'):?>
            <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn btn_assign_car"/>
            <?php endif;?>
            </td>
            <td><?php echo $plan_tour['room_tourist_cnt'];?>
            <?php if($plan['room_status']=='assignning'):?>
            <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn btn_assign_room"/>
            <?php endif;?>
            </td>
            <td><?php echo $plan_tour['price_sum'];?>/<?php echo $plan_tour['market_price_sum'];?></td>
          </tr>
          <?php endforeach;?>
          <?php else:?>
          <tr>
            <td colspan="100">咦，没有安排日程！</td>
          </tr>
          <?php endif;?></tbody>
        </table> </dd>
        </dl>
</form>




      </div>

      <div class="tab-pane" id="tab_history">
        <h3>操作进程</h3>
        <table class="table table-bordered table-striped">
          <thead><tr>
            <th>处理时间</th>
            <th>处理信息</th>
            <th>操作人</th>
          </tr></thead>
          <tbody><?php foreach($plan['history'] as $i=>$plan_history):?>
          <tr>
            <td><?php echo $plan_history['created'];?></td>
            <td><?php echo $plan_history['operation'];?></td>
            <td><?php echo $plan_history['operator'];?></td>
          </tr>
          <?php endforeach;?></tbody>
        </table>
      </div>
      <div class="tab-pane" id="tab_note">
        <h3>备忘</h3>
        <table class="table table-bordered table-striped">
          <thead><tr>
            <th>时间</th>
            <th>留言人</th>
            <th>内容</th>
          </tr></thead>
          <tbody><?php foreach($plan['notes'] as $i=>$plan_note):?>
          <tr>
            <td><?php echo $plan_note['created'];?></td>
            <td><?php echo $plan_note['staff_name'];?></td>
            <td><?php echo $plan_note['content'];?></td>
          </tr>
          <?php endforeach;?></tbody>
        </table>
        <input type="button" value="添加备忘" class="btn btn_add_note"/>
      </div>
      <div class="tab-pane" id="tab_payment">

    <dl>
    <dt>应付费用</dt><dd><?php echo $plan['price']?></dd>
    <dt>已付费用</dt><dd><?php echo $plan['paid']?></dd>
    <dt>余额</dt><dd><?php echo $plan['balance']?><?php if($plan['balance']!=0):?><input type="button" value="添加支付记录" class="btn btn_add_payment"/><?php endif;?></dd>
    <dt>支付记录</dt><dd><table class="table table-bordered table-striped">
          <thead><tr>
            <th>时间</th>
            <th>操作人</th>
            <th>金额</th>
            <th>备注</th>
          </tr></thead>
            <tbody><?php if(!empty($plan['payments'])):?>
          <?php foreach($plan['payments'] as $i=>$plan_payment):?>
          <tr>
            <td><?php echo $plan_payment['created'];?></td>
            <td><?php echo $plan_payment['operator'];?></td>
            <td><?php echo $plan_payment['amount'];?></td>
            <td><?php echo $plan_payment['memo'];?></td>
          </tr>
          <?php endforeach;?>
           <?php else:?>
          <tr>
            <td colspan="100">还没有预付款，请暂时不要做任何安排</td>
          </tr>
          <?php endif;?></tbody>
        </table></dd>
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
      console.log($( "#facebox #update_tourist_"+k));
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
      console.log(data, $("#planTourCarTemplate").tmpl(data));
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
  <h4>更新游客信息</h4><div class="close">&times;</div>
  <form method="post" enctype="multipart/form-data" action="plan.php?act=update-tourist">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <input type="hidden" id="update_tourist_id" name="tourist[id]" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>姓名</dt><dd><input type="text" id="update_tourist_name" name="tourist[name]" value=""/></dd>
      <dt>电话</dt><dd><input type="text" id="update_tourist_phone" name="tourist[phone]" value=""/></dd>
      <dt>证件类型</dt><dd>
      <select id="update_tourist_card_type" name="tourist[card_type]">
      <?php foreach($config['id_card_types'] as $card_type=>$text):?>
      <option value="<?php echo $card_type;?>"><?php echo $text;?></option>
      <?php endforeach;?>
      </select></dd>
      <dt>证件号码</dt><dd><input type="text" id="update_tourist_card_number" name="tourist[card_number]" value=""/></dd>
      <dt>证件照片</dt><dd>
      <label>网址：<input type="text" id="update_tourist_card_photo_url" name="tourist[card_photo_url]" size="80"   value=""/></label><br />
      <label>上传：<input type="file" id="update_tourist_card_photo_file" name="tourist_card_photo_file[]" /></label></dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>
</div>

<div id="update_contact_form" style="display:none">
  <h4>更新联系人信息</h4><div class="close">&times;</div>
  <form method="post" action="plan.php?act=update-contact">
    <input type="hidden" name="plan_id" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>姓名</dt><dd><input type="text" id="plan_contact_name" name="plan[contact][name]" value="<?php echo $plan['contact']['name']?>" /></dd>
      <dt>电话</dt><dd><input type="text" id="plan_contact_phone" name="plan[contact][phone]" value="<?php echo $plan['contact']['phone']?>" /></dd>
      <dt>Email</dt><dd><input type="text" id="plan_contact_email" name="plan[contact][email]" value="<?php echo $plan['contact']['email']?>" /></dd>
      <dt>论坛帐号</dt><dd><input type="text" id="plan_contact_forum_uid" name="plan[contact][forum_uid]" value="<?php echo $plan['contact']['forum_uid']?>" /></dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>
</div><!-- #update_contact_form -->

<div id="add_tourist_form" style="display:none">
  <h4>添加游客</h4><div class="close">&times;</div>
  <form method="post" enctype="multipart/form-data" action="plan.php?act=add-tourist">
  <input type="hidden" name="tourist[plan_id]" value="<?php echo $plan['id']?>" />
  <dl>
    <dt>姓名</dt><dd><input type="text" id="tourist_name_new" name="tourist[name][new]" value=""/></dd>
    <dt>电话</dt><dd><input type="text" id="tourist_phone_new" name="tourist[phone][new]" value=""/></dd>
    <dt>证件类型</dt><dd>
    <select id="tourist_card_type_new" name="tourist[card_type][new]">
    <?php foreach($config['id_card_types'] as $card_type=>$text):?>
    <option value="<?php echo $card_type;?>"><?php echo $text;?></option>
    <?php endforeach;?>
    </select></dd>
    <dt>证件号码</dt><dd><input type="text" id="tourist_card_number_new" name="tourist[card_number][new]" value=""/></dd>
    <dt>证件照片</dt><dd>
    <label>网址：<input type="text" id="tourist_card_photo_url_new" name="tourist[card_photo_url][new]" size="80"   value=""/></label><br />
    <label>上传：<input type="file" id="tourist_card_photo_file_new" name="tourist_card_photo_file[new]" /></label></dd>
  </dl>
  <input type="submit" value="提交" class="btn" />
  </form>
</div>

<div id="add_note_form" style="display:none">
  <h4>请留下你想说的话</h4><div class="close">&times;</div>
  <form method="post" action="plan.php?act=add-note">
  <input type="hidden" name="note[plan_id]" value="<?php echo $plan['id']?>" />
  <dl>
    <dt>内容</dt><dd><textarea name="note[content]" id="note_content" rows="3" cols="70"></textarea></dd>
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
  <dt>酒店</dt><dd><select name="room[hotel_id]" id="room_hotel_id">
    <option value="" selected="selected">--请选择--</option>
  </select></dd>
  <dt>房型</dt><dd><select name="room[type]" id="room_type">
    <option value="" selected="selected">--请选择--</option>
    <?php foreach($config['room_types'] as $room_type=>$text):?>
    <option value="<?php echo $room_type;?>"><?php echo $text;?></option>
    <?php endforeach;?>
  </select></dd>
  <dt>住宿人数</dt><dd><input type="text" name="room[tourist_cnt]" id="room_tourist_cnt" value="2" /></dd>
  <dt>金额</dt><dd><input type="text" name="room[price]" id="room_price" value="" /></dd>
   <dt>备注</dt>
    <dd><textarea name="room[memo]" id="room_memo" rows="3" cols="70"></textarea></dd>
    </dl><input type="submit" value="提交" class="btn"  />
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
  <dt>车型</dt><dd><select name="car[type]" id="car_type">
    <option value="" selected="selected">--请选择--</option>
    <?php foreach($config['car_types'] as $car_type=>$text):?>
    <option value="<?php echo $car_type;?>"><?php echo $text;?></option>
    <?php endforeach;?>
  </select></dd>
  <dt>司机</dt><dd><select name="car[driver_id]" id="car_driver_id">
    <option value="" selected="selected">--请选择--</option>
  </select></dd>
  <dt>容纳人数</dt><dd><input type="text" name="car[tourist_cnt]" id="car_tourist_cnt" value="2" /></dd>
  <dt>金额</dt><dd><input type="text" name="car[price]" id="car_price" value="" /></dd>
   <dt>备注</dt>
    <dd><textarea name="car[memo]" id="car_memo" rows="3" cols="70"></textarea></dd>
    </dl><input type="submit" value="提交" class="btn"  />
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
  <form method="post" action="plan.php?act=add-payment"><input type="hidden" name="payment[plan_id]" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>金额</dt><dd><input type="text" name="payment[amount]" id="payment_amount" value="" /></dd>
      <dt>支付方式</dt><dd><select name="payment[via]" id="payment_via">
      <option value="alipay" selected="selected">支付宝</option>
      <option value="cash">现金</option>
      <option value="tenpay">财付通</option>
      <option value="netbank">网上银行</option>
      </select></dd>
      <dt>备注</dt>
      <dd><textarea name="payment[memo]" id="payment_memo" rows="3" cols="70"></textarea></dd>
    </dl>
    <input type="submit" value="提交" />
  </form>
</div>