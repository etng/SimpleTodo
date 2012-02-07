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
    <dd><?php echo $plan['tourist_cnt']?></dd>
 <dt>车辆要求</dt>
    <dd><?php echo $plan['car_request']?></dd>
     <dt>房间要求</dt>
    <dd><?php echo $plan['room_request']?></dd>
    <dt>出发日期</dt>
    <dd><?php echo $plan['start_date']?></dd>

    <dt>日程安排</dt>
    <dd><table>
    <tr>
        <td>日期</td>
        <td>线路</td>
        <td>住宿</td>
        <td>路程</td>
        <td>金额</td>
        <td>人数</td>
        <td>安排车辆</td>
        <td>安排住宿</td>
        <td>小计</td>
    </tr>
    <?php if(!empty($plan['tours'])):?>
    <?php foreach($plan['tours'] as $i=>$plan_tour):?>
    <tr>
        <td><?php echo $plan_tour['the_date'];?></td>
        <td><?php echo $plan_tour['name'];?></td>
        <td><?php echo $plan_tour['destination'];?></td>
        <td><?php echo $plan_tour['distance'];?></td>
        <td><?php echo $plan_tour['price'];?></td>
        <td><?php echo $plan_tour['tourist_cnt'];?></td>
        <td><?php echo $plan_tour['car_cnt'];?> <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn_assign_car"/></td>
        <td><?php echo $plan_tour['room_cnt'];?> <input data-plan_tour_id="<?php echo $plan_tour['id'];?>" type="button" value="安排" class="btn_assign_room"/></td>
        <td><?php echo $plan_tour['price_sum'];?>/<?php echo $plan_tour['market_price_sum'];?></td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100">咦，没有安排日程！</td>
    </tr>
    <?php endif;?>
</table> </dd>
    <dt>操作进程</dt>
    <dd><table>
    <tr>
        <td>处理时间</td>
        <td>处理信息</td>
        <td>操作人</td>
    </tr>
    <?php foreach($plan['history'] as $i=>$plan_history):?>
    <tr>
        <td><?php echo $plan_history['created'];?></td>
        <td><?php echo $plan_history['operation'];?></td>
        <td><?php echo $plan_history['operator'];?></td>
    </tr>
    <?php endforeach;?>
</table> </dd>
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
    <a href="plan.php?act=set-status&status=<?php echo $next_room_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_room_status_info['action_text']?></a>
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
    <a href="plan.php?act=set-status&status=<?php echo $next_car_status;?>&id=<?php echo $plan['id']?>"><?php echo $next_car_status_info['action_text']?></a>
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
    <dd><table>
    <tr>
        <td>时间</td>
        <td>金额</td>
        <td>备注</td>
    </tr>
        <?php if(!empty($plan['payments'])):?>

    <?php foreach($plan['payments'] as $i=>$plan_payment):?>
    <tr>
        <td><?php echo $plan_payment['created'];?></td>
        <td><?php echo $plan_payment['amount'];?></td>
        <td><?php echo $plan_payment['memo'];?></td>
    </tr>
    <?php endforeach;?>
     <?php else:?>
    <tr>
        <td colspan="100">还没有预付款，请暂时不要做任何安排</td>
    </tr>
    <?php endif;?>
</table> </dd>
        </dl>

    </dd>

</dl>

 <div id="room_assign_form" style="display:none">
<form method="post" action="plan.php?act=add-room">
<input type="hidden" name="room[plan_id]" value="<?php echo $plan['id']?>" />
<input type="hidden" name="room[plan_tour_id]" id="room_plan_tour_id" value="" />
<dl>
    <dt>酒店</dt><dd><select name="room[hotel_id]" id="room_hotel_id">
        <option value="" selected="selected">--请选择--</option>
        <option value="holiday">假日酒店</option>
        <option value="hilton">希尔顿</option>
    </select></dd>
    <dt>房型</dt><dd><select name="room[type]" id="room_type">
        <option value="" selected="selected">--请选择--</option>
        <?php foreach($config['room_types'] as $room_type=>$text):?>
        <option value="<?php echo $room_type;?>"><?php echo $text;?></option>
        <?php endforeach;?>
    </select></dd>
    <dt>住宿人数</dt><dd><input type="text" name="room[touris_cnt]" id="room_touris_cnt" value="2" /></dd>
    <dt>金额</dt><dd><input type="text" name="room[price]" id="room_price" value="" /></dd>
     <dt>备注</dt>
        <dd><textarea name="room[memo]" id="room_memo" rows="3" cols="70"></textarea></dd>
        </dl><input type="submit" value="提交" />
    </form>
 </div>

 <div id="car_assign_form" style="display:none">
<form method="post" action="plan.php?act=add-car">
<input type="hidden" name="car[plan_id]" value="<?php echo $plan['id']?>" />
<input type="hidden" name="car[plan_tour_id]" id="car_plan_tour_id" value="" />
<dl>
    <dt>司机</dt><dd><select name="car[driver_id]" id="car_driver_id">
        <option value="" selected="selected">--请选择--</option>
        <option value="huangshifu">黄司机</option>
        <option value="zhangshifu">张师傅</option>
    </select></dd>
    <dt>车型</dt><dd><select name="car[type]" id="car_type">
        <option value="" selected="selected">--请选择--</option>
        <option value="1">吉普</option>
        <option value="2">桑塔纳</option>
        <option value="3">越野</option>
    </select></dd>
    <dt>容纳人数</dt><dd><input type="text" name="car[touris_cnt]" id="car_touris_cnt" value="2" /></dd>
    <dt>金额</dt><dd><input type="text" name="car[price]" id="car_price" value="" /></dd>
     <dt>备注</dt>
        <dd><textarea name="car[memo]" id="car_memo" rows="3" cols="70"></textarea></dd>
        </dl><input type="submit" value="提交" />
    </form>
 </div>
<script type='text/javascript'>
function refreshRoomPrice(plan_tour_id, hotel_id, room_type)
{
    //@todo ajax get room price on that day
    return parseInt(Math.random(1)*10)*20;
}
function refreshCarPrice(plan_tour_id, driver_id, car_type)
{
    //@todo ajax get room price on that day
    return parseInt(Math.random(1)*10)*20;
}
$(document).ready(function(){

    $('input.btn_assign_room').live('click', function(){
        jQuery.facebox({ div: '#room_assign_form' });
        var ts=+new Date();
        $.each(['room_plan_tour_id', 'room_hotel_id', 'room_type', 'touris_cnt', 'room_price', 'room_memo'], function(i, id){
            $( "#facebox #"+id).attr('id', id+'_'+ts);
        });
        $('#room_plan_tour_id'+'_'+ts).val($(this).data('plan_tour_id'));
        $('#room_hotel_id'+'_'+ts+', #room_type'+'_'+ts).change(function(){
            var hotel_id = $('#room_hotel_id'+'_'+ts).val();
            var room_type = $('#room_type'+'_'+ts).val();
            var plan_tour_id = $('#room_plan_tour_id'+'_'+ts).val();
            var price = refreshRoomPrice(plan_tour_id, hotel_id, room_type);
            console.log($(this), price);
            $('#room_price'+'_'+ts).val(price);
        });
    });
    $('input.btn_assign_car').live('click', function(){
        jQuery.facebox({ div: '#car_assign_form' });
        var ts=+new Date();
        $.each(['car_plan_tour_id', 'car_driver_id', 'car_type', 'touris_cnt', 'car_price', 'car_memo'], function(i, id){
            $( "#facebox #"+id).attr('id', id+'_'+ts);
        });
        $('#car_plan_tour_id'+'_'+ts).val($(this).data('plan_tour_id'));
        $('#car_driver_id'+'_'+ts+', #car_type'+'_'+ts).change(function(){
            var driver_id = $('#car_driver_id'+'_'+ts).val();
            var car_type = $('#car_type'+'_'+ts).val();
            var plan_tour_id = $('#car_plan_tour_id'+'_'+ts).val();
            var price = refreshCarPrice(plan_tour_id, driver_id, car_type);
            console.log($(this), price);
            $('#car_price'+'_'+ts).val(price);
        });
    });

});
</script>
