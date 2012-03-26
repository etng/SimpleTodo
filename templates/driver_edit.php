<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="driver.php?act=list">司机</a> <span class="divider">/</span></li>
<li class="active">修改</li>
</ul>

<form method="post" action="">
<dl>
    <dt>所在地</dt>
    <dd><select name="driver[destination_id]" id="driver_destination_id">
        <?php foreach($destination_options as $id=>$destination):?>
            <option value="<?php echo $id;?>"<?php $id==@$driver['destination_id'] && print(' selected="true"');?>><?php echo $destination;?></option>
        <?php endforeach;?>
    </select></dd>
    <dt>姓名</dt><dd><input type="text" id="driver_name" name="driver[name]" value="<?php echo $driver['name']?>" /></dd>
    <dt>民族</dt><dd><input type="text" id="driver_nationality" name="driver[nationality]" value="<?php echo $driver['nationality']?>" /></dd>
    <dt>年龄</dt><dd><input type="text" id="driver_age" name="driver[age]" value="<?php echo $driver['age']?>" /></dd>
    <dt>电话</dt><dd><input type="text" id="driver_phone" name="driver[phone]" value="<?php echo $driver['phone']?>" /></dd>
    <dt>车型</dt><dd><select name="driver[car_type]" id="driver_car_type">
        <option value="" selected="selected">--请选择--</option>
        <?php foreach($config['car_types'] as $car_type=>$text):?>
        <option value="<?php echo $car_type;?>"<?php $car_type==@$driver['car_type'] && print(' selected="true"');?>><?php echo $text;?></option>
        <?php endforeach;?>
    </select></dd>
    <dt>容量</dt><dd><input type="text" id="driver_car_capacity" name="driver[car_capacity]" value="<?php echo $driver['car_capacity']?>" /></dd>
    <dt>车牌号</dt><dd><input type="text" id="driver_car_plate_num" name="driver[car_plate_num]" value="<?php echo $driver['car_plate_num']?>" /></dd>
    <dt>星级</dt>
    <dd>
    <?php $i=0;while($i++<5):?>
    <label class="inline radio"><input type="radio" id="driver_star_<?php echo $i;?>" name="driver[star]" value="<?php echo $i;?>"<?php $i==@$driver['star'] && print(' checked="true"');?> /><?php echo $i;?></label>
    <?php endwhile;?>
    <!-- <input type="text" id="driver_star" name="driver[star]" value="" />
 -->    </dd>
     <dt>介绍</dt>
    <dd><textarea id="driver_description" name="driver[description]" rows="3" cols="70"><?php echo $driver['description']?></textarea></dd>
</dl>
<input type="submit" class="btn btn-primary" />
</form>