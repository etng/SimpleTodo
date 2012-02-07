<h3><?php echo $title_for_layout;?></h3>

<dl>
    <dt>名称</dt>
    <dd><?php echo $hotel['name'];?></dd>
    <dt>加入时间</dt>
    <dd><?php echo $hotel['created'];?></dd>
    <dt>所在地</dt>
    <dd><?php echo $hotel['destination'];?></dd>
    <dt>地址</dt>
    <dd><?php echo $hotel['address'];?></dd>
     <dt>星级</dt>
    <dd><?php echo $hotel['star'];?></dd>
    <dt>电话</dt>
    <dd><?php echo $hotel['phone'];?></dd>
    <dt>传真</dt>
    <dd><?php echo $hotel['fax'];?></dd>
    <dt>网站</dt>
    <dd><?php echo $hotel['website'];?></dd>
    <dt>介绍</dt>
    <dd><?php echo $hotel['description'];?></dd>
    <dt>报价</dt>
    <dd>
<table>
    <tr>
        <td>日期</td>
        <td>房型</td>
        <?php foreach($price_fields as $price_field=>$text):?>
        <td><?php echo $text;?></td>
         <?php endforeach;?>
    </tr>
    <?php foreach($price_trends as $the_date=>$room_type_prices):?>
    <?php foreach($room_type_prices as $room_type=>$prices):?>
    <tr>
        <td><?php echo $the_date;?></td>
        <td><?php echo $config['room_types'][$room_type];?></td>
        <?php foreach($price_fields as $price_field=>$text):?>
        <td><?php echo $prices[$price_field];?></td>
         <?php endforeach;?>
    </tr>
    <?php endforeach;?>
    <?php endforeach;?>
</table>
            <input type="button" value="添加报价" class="btn_add_price"/>
             <div id="price_add_form" style="display:none">
            <form method="post" action="hotel.php?act=add-price"><input type="hidden" name="price[hotel_id]" value="<?php echo $hotel['id'];?>" />
            <dl>
                <dt>起止日期</dt><dd>
                <label><input type="text" name="start_date" id="price_start_date" value="" size="10" /></label> 至
                <label><input type="text" name="end_date" id="price_end_date" value="" size="10" /></label>
                </dd>
                <dt>供应价</dt><dd>
                <label>对外价<input type="text" name="price[public_price]" id="price_public_price" value="" size="5" /></label>
                <label>成本价<input type="text" name="price[cost]" id="price_cost" value="" size="5" /></label>
                </dd>
                <dt>销售价</dt><dd>
                <label>最低价<input type="text" name="price[min_price]" id="price_min_price" value="" size="5" /></label>
                <label>默认价<input type="text" name="price[default_price]" id="price_default_price" value="" size="5" /></label>
                <label>最高价<input type="text" name="price[max_price]" id="price_max_price" value="" size="5" /></label>
                </dd>
                <dt>房型</dt><dd><select name="price[room_type]" id="price_room_type">
                    <?php foreach($config['room_types'] as $room_type=>$text):?>
                    <option value="<?php echo $room_type;?>"><?php echo $text;?></option>
                    <?php endforeach;?>
                </select></dd>
                 <dt>备注</dt>
                    <dd><textarea name="price[memo]" id="price_memo" rows="3" cols="70"></textarea></dd>
                    </dl><input type="submit" value="提交" />
                </form>
             </div>
    </dd>
</dl>
<script type='text/javascript'>
$(document).ready(function(){
    $('input.btn_add_price').live('click', function(){
        jQuery.facebox({ div: '#price_add_form' });
        var ts=+new Date();
        $.each(['price_start_date', 'price_end_date', 'price_public_price', 'price_cost', 'price_min_price', 'price_default_price', 'price_max_price'], function(i, id){
            $( "#facebox #"+id).attr('id', id+'_'+ts);
        });
        $( "#price_start_date"+'_'+ts).datepicker({
            onSelect: function( selectedDate ) {
				var instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				$( "#price_end_date"+'_'+ts).datepicker( "option", 'minDate', date );
			},
            minDate: "+1d",
            maxDate: "+1Y"
        });
        $( "#price_end_date"+'_'+ts).datepicker({
            onSelect: function( selectedDate ) {
				var instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				$( "#price_start_date"+'_'+ts).datepicker( "option", 'maxDate', date );
			},
            minDate: "+1d",
            maxDate: "+1Y"
        });
        var ratio_setting = {
//            'price_public_price': 1,
            'price_cost': 0.5,
            'price_min_price': 0.75,
            'price_default_price': 0.8,
            'price_max_price': 0.9
        };
        $( "#price_public_price"+'_'+ts).change(function(){
            var public_price = $(this).val();
            $.each(ratio_setting, function(field, ratio)
            {
                var new_price = Math.ceil(public_price*ratio/10)*10;
                $('#'+field+'_'+ts).val(new_price);
            });
        });
    });
});
</script>
