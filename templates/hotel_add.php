<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="hotel.php?act=list">酒店</a> <span class="divider">/</span></li>
<li class="active">添加</li>
</ul>


<form method="post" action="">
<dl>
    <dt>所在地</dt>
    <dd><select name="hotel[destination_id]" id="hotel_destination_id">
        <?php foreach($destination_options as $id=>$destination):?>
            <option value="<?php echo $id;?>"><?php echo $destination;?></option>
        <?php endforeach;?>
    </select></dd>
    <dt>名称</dt>
    <dd><input type="text" id="hotel_name" name="hotel[name]" value="" /></dd>
    <dt>星级</dt>
    <dd>
    <?php $i=0;while($i++<5):?>
    <label class="inline radio"><input type="radio" id="hotel_star_<?php echo $i;?>" name="hotel[star]" value="<?php echo $i;?>" /><?php echo $i;?></label>
    <?php endwhile;?>
    <!-- <input type="text" id="hotel_star" name="hotel[star]" value="" />
 -->    </dd>
    <dt>电话</dt>
    <dd><input type="text" id="hotel_phone" name="hotel[phone]" value="" /></dd>
    <dt>传真</dt>
    <dd><input type="text" id="hotel_fax" name="hotel[fax]" value="" /></dd>
    <dt>网站</dt>
    <dd><input type="text" id="hotel_website" name="hotel[website]" value="" /></dd>
    <dt>地址</dt>
    <dd><input type="text" id="hotel_address" name="hotel[address]" value="" /></dd>
     <dt>介绍</dt>
    <dd><textarea id="hotel_description" name="hotel[description]" rows="3" cols="70"></textarea></dd>
</dl>
<input type="submit" class="btn btn-primary" />
</form>