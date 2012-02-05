<h3><?php echo $title_for_layout;?></h3>

<dl>
    <dt>名称</dt>
    <dd><?php echo $hotel['name']?></dd>
    <dt>加入时间</dt>
    <dd><?php echo $hotel['created']?></dd>
    <dt>所在地</dt>
    <dd><?php echo $hotel['destination']?></dd>
    <dt>地址</dt>
    <dd><?php echo $hotel['address']?></dd>
     <dt>星级</dt>
    <dd><?php echo $hotel['star']?></dd>
    <dt>电话</dt>
    <dd><?php echo $hotel['phone']?></dd>
    <dt>传真</dt>
    <dd><?php echo $hotel['fax']?></dd>
    <dt>网站</dt>
    <dd><?php echo $hotel['website']?></dd>
    <dt>介绍</dt>
    <dd><?php echo $hotel['description']?></dd>
    <dt>报价</dt>
    <dd>

            <input type="button" value="添加报价" class="btn_add_price"/>
             <div id="price_add_form" style="display:none">
            <form method="post" action="hotel.php?act=add-price"><input type="hidden" name="price[hotel_id]" value="<?php echo $hotel['id']?>" />
            <dl>
                <dt>起止日期</dt><dd>
                <label><input type="text" name="price[start_date]" id="price_start_date" value="" size="10" /></label> 至
                <label><input type="text" name="price[end_date]" id="price_end_date" value="" size="10" /></label>
                </dd>
                <dt>供应价</dt><dd>
                <label>对外价<input type="text" name="price[public_price]" id="price_public_price" value="" size="5" /></label>
                <label>成本价<input type="text" name="price[cost]" id="price_cost" value="" size="5" /></label>
                </dd>
                <dt>销售价</dt><dd>
                <label>最低价<input type="text" name="price[min_price]" id="price_min_price" value="" size="5" /></label>
                <label>默认价<input type="text" name="price[min_default_price]" id="price_default_price" value="" size="5" /></label>
                <label>最高价<input type="text" name="price[max_price]" id="price_max_price" value="" size="5" /></label>
                </dd>
                <dt>房型</dt><dd><select name="price[room_type]" id="price_room_type">
                    <option value="std" selected="selected">标间</option>
                    <option value="tao">套间</option>
                    <option value="single">单人间</option>
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
        $( "#price_start_date" ).datepicker({
            minDate: "+1d",
            maxDate: "+1Y"
        });
        $( "#price_end_date" ).datepicker({
            minDate: "+1d",
            maxDate: "+1Y"
        });
    });
});
</script>
