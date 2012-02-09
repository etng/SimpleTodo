<h3><?php echo $title_for_layout;?></h3>
<form method="post" action="">
<dl>
    <dt>所在地</dt>
    <dd><select name="driver[destination_id]" id="driver_destination_id">
        <?php foreach($destination_options as $id=>$destination):?>
            <option value="<?php echo $id;?>"><?php echo $destination;?></option>
        <?php endforeach;?>
    </select></dd>
    <dt>姓名</dt><dd><input type="text" id="driver_name" name="driver[name]" value="" /></dd>
    <dt>民族</dt><dd><input type="text" id="driver_nationality" name="driver[nationality]" value="" /></dd>
    <dt>年龄</dt><dd><input type="text" id="driver_age" name="driver[age]" value="" /></dd>
    <dt>电话</dt><dd><input type="text" id="driver_phone" name="driver[phone]" value="" /></dd>
    <dt>车型</dt><dd><input type="text" id="driver_car_model" name="driver[car_model]" value="" /></dd>
    <dt>容量</dt><dd><input type="text" id="driver_car_capacity" name="driver[car_capacity]" value="" /></dd>
    <dt>车牌号</dt><dd><input type="text" id="driver_car_plate_num" name="driver[car_plate_num]" value="" /></dd>
    <dt>星级</dt>
    <dd>
    <?php $i=0;while($i++<5):?>
    <label><input type="radio" id="driver_star_<?php echo $i;?>" name="driver[star]" value="<?php echo $i;?>" /><?php echo $i;?></label>
    <?php endwhile;?>
    <!-- <input type="text" id="driver_star" name="driver[star]" value="" />
 -->    </dd>
     <dt>介绍</dt>
    <dd><textarea id="driver_description" name="driver[description]" rows="3" cols="70"></textarea></dd>
</dl>
<input type="submit" />
</form>