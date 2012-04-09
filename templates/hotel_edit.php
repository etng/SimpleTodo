<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="hotel.php?act=list">酒店</a> <span class="divider">/</span></li>
<li class="active">修改</li>
</ul>


<form method="post" action="">
<dl>
    <dt>所在地</dt>
    <dd><select name="hotel[destination_id]" id="hotel_destination_id">
        <?php foreach($destination_options as $id=>$destination):?>
            <option value="<?php echo $id;?>"<?php $id==@$hotel['destination_id'] && print(' selected="true"');?>><?php echo $destination;?></option>
        <?php endforeach;?>
    </select></dd>
    <dt>名称</dt>
    <dd><input type="text" id="hotel_name" name="hotel[name]" value="<?php echo $hotel['name']?>" /></dd>
    <dt>星级</dt>
    <dd>
    <?php $i=0;while($i++<5):?>
    <label class="inline radio"><input type="radio" id="hotel_star_<?php echo $i;?>" name="hotel[star]" value="<?php echo $i;?>"<?php $i==@$hotel['star'] && print(' checked="true"');?> /><?php echo $i;?></label>
    <?php endwhile;?>
   </dd>
    <dt>优先级</dt>
    <dd><input type="text" id="hotel_priority" name="hotel[priority]" value="<?php echo 100-$hotel['priority']?>" /></dd>
    <dt>电话</dt>
    <dd><input type="text" id="hotel_phone" name="hotel[phone]" value="<?php echo $hotel['phone']?>" /></dd>
    <dt>传真</dt>
    <dd><input type="text" id="hotel_fax" name="hotel[fax]" value="<?php echo $hotel['fax']?>" /></dd>
    <dt>网站</dt>
    <dd><input type="text" id="hotel_website" name="hotel[website]" value="<?php echo $hotel['website']?>" /></dd>
    <dt>地址</dt>
    <dd><input type="text" id="hotel_address" name="hotel[address]" value="<?php echo $hotel['address']?>" /></dd>
     <dt>介绍</dt>
    <dd><textarea id="hotel_description" name="hotel[description]" rows="3" cols="70"><?php echo $hotel['description']?></textarea></dd>
</dl>
<input type="submit" class="btn btn-primary" />
</form>