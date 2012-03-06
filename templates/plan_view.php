<h3><?php echo $title_for_layout;?></h3>

<dl><dt>联系人</dt>
    <dd>
    <dl>
        <dt>姓名</dt><dd><?php echo $contact['name'];?></dd>
        <dt>电话</dt><dd><?php echo $contact['phone'];?></dd>
        <dt>Email</dt><dd><?php echo $contact['email'];?></dd>
    </dl>
    </dd>
    <dt>人数</dt>
    <dd><?php echo $plan['tourist_cnt']?><br />
    <?php foreach($plan['tourists'] as $tourist):?>
    <a href="<?php echo empty($tourist['card_photo'])?'#':$tourist['card_photo'];?>" rel="facebox"><img src="<?php echo $tourist['card_photo'];?>" width="200" title="姓名：<?php echo $tourist['name'];?>
    电话：<?php echo $tourist['phone'];?>
    证件类型：<?php echo $config['id_card_types'][$tourist['card_type']];?>
    证件号码：<?php echo $tourist['card_number'];?>
    "></a>
    <?php endforeach;?>
    </dd>
 <dt>车辆要求</dt>
    <dd><?php echo $plan['car_request']?></dd>
     <dt>房间要求</dt>
    <dd><?php echo $plan['room_request']?></dd>
    <dt>出发日期</dt>
    <dd><?php echo $plan['start_date']?></dd>

    <dt>日程安排</dt>
    <dd><table class="table table-bordered table-striped">
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
        <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn_assign_car"/>
        <?php endif;?>
        </td>
        <td><?php echo $plan_tour['room_tourist_cnt'];?>
        <?php if($plan['room_status']=='assignning'):?>
        <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn_assign_room"/>
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
    <dt>操作进程</dt>
    <dd><table class="table table-bordered table-striped">
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
</table> </dd>

    <dt>备忘</dt>
    <dd><table class="table table-bordered table-striped">
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
</table> <input type="button" value="添加备忘" class="btn_add_note"/>

 <div id="add_note_form" style="display:none">
 <h4>请留下你想说的话</h4>
<form method="post" action="plan.php?act=add-note">
<input type="hidden" name="note[plan_id]" value="<?php echo $plan['id']?>" />
<dl>
     <dt>内容</dt>
        <dd><textarea name="note[content]" id="note_content" rows="3" cols="70"></textarea></dd>
        </dl><input type="submit" value="提交" />
    </form>
 </div>
</dd>




<dt>订单状态</dt><dd><dl>
<dt>当前状态</dt>
    <dd>
    <?php echo $statuss[$plan['status']]['text'];?>
   </dd>
<?php if($next_statuss = $statuss[$plan['status']]['next']):?>
    <dt>操作</dt>
    <dd>
   <?php foreach(explode(',', $next_statuss) as $next_status):$next_status_info = $statuss[$next_status];?>
    <a href="plan.php?act=set-status&status=<?php echo $next_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_status_info['action_text']?></a>
    <?php endforeach;?>

    </dd>
<?php endif;?>
</dl></dd>
<dt>房间状态</dt><dd><dl>
<dt>当前状态</dt>
    <dd>
    <?php echo $room_statuss[$plan['room_status']]['text'];?>
   </dd>
<?php if($next_room_statuss = $room_statuss[$plan['room_status']]['next']):?>
    <dt>操作</dt>
    <dd>
   <?php foreach(explode(',', $next_room_statuss) as $next_room_status):$next_room_status_info = $room_statuss[$next_room_status];?>
    <a href="plan.php?act=set-room-status&status=<?php echo $next_room_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_room_status_info['action_text']?></a>
    <?php endforeach;?>

    </dd>
<?php endif;?>
</dl></dd>

<dt>车辆状态</dt><dd><dl>
<dt>当前状态</dt>
    <dd>
    <?php echo $car_statuss[$plan['car_status']]['text'];?>
   </dd>
<?php if($next_car_statuss = $car_statuss[$plan['car_status']]['next']):?>
    <dt>操作</dt>
    <dd>
   <?php foreach(explode(',', $next_car_statuss) as $next_car_status):$next_car_status_info = $car_statuss[$next_car_status];?>
    <a href="plan.php?act=set-car-status&status=<?php echo $next_car_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_car_status_info['action_text']?></a>
    <?php endforeach;?>

    </dd>
<?php endif;?>
</dl></dd>

    <dt>费用相关</dt>

    <dd>
    <dl>
         <dt>应付费用</dt>
        <dd><?php echo $plan['price']?></dd>
                 <dt>已付费用</dt>
        <dd><?php echo $plan['paid']?></dd>
                 <dt>余额</dt>
        <dd><?php echo $plan['balance']?>
        <?php if($plan['balance']!=0):?>
            <input type="button" value="添加支付记录" class="btn_add_payment"/>
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
                    </dl><input type="submit" value="提交" />
                </form>
             </div>
            <script type='text/javascript'>
            $(document).ready(function(){
                $('input.btn_add_payment').live('click', function(){
                    jQuery.facebox({ div: '#payment_add_form' });
                });
            });
            </script>
        <?php endif;?>

        </dd>
         <dt>支付记录</dt>
    <dd><table class="table table-bordered table-striped">
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
</table> </dd>
        </dl>

    </dd>

</dl>

 <div id="room_assign_form" style="display:none">
<h4>已安排酒店情况</h4>
 <table class="plan_tour_rooms">
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
</table>

<script id="planTourRoomTemplate" type="text/x-jquery-tmpl">
    <tr>
        <td><a href="hotel.php?act=view&id=${hotel_id}">${hotel_name}</a></td>
        <td class="room_type_${type}">${type_name}</td>
        <td>${tourist_cnt}</td>
        <td>${price}</td>
        <td>${memo}</td>
    </tr>
</script>
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
        </dl><input type="submit" value="提交" />
    </form>
 </div>

 <div id="car_assign_form" style="display:none">
 <h4>已安排车辆情况</h4>
 <table class="plan_tour_cars">
     <thead><tr>
        <td>司机</td>
        <td>车型</td>
        <td>容纳人数</td>
        <td>价格</td>
        <td>备注</td>
    </tr></thead>
    <tbody></tbody>
    <tfoot>
        <td colspan="2"> </td>
        <td class="tourist_capacity"></td>
        <td class="sum_price"></td>
        <td></td>
    </tfoot>
</table>

<script id="planTourCarTemplate" type="text/x-jquery-tmpl">
    <tr>
        <td><a href="driver.php?act=view&id=${driver_id}">${driver_name}</a></td>
        <td class="car_type_${type}">${type_name}</td>
        <td>${tourist_cnt}</td>
        <td>${price}</td>
        <td>${memo}</td>
    </tr>
</script>

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
        </dl><input type="submit" value="提交" />
    </form>
 </div>





<script type='text/javascript'>
function refreshCarPrice(plan_tour_id, driver_id, car_type)
{
    //@todo ajax get room price on that day
    return parseInt(Math.random(1)*10)*20;
}
$(document).ready(function(){

    window.room_types = <?php echo json_encode($config['room_types']);?>;
    window.car_types = <?php echo json_encode($config['car_types']);?>;
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
