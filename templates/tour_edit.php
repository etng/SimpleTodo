<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="tour.php?act=list">线路</a> <span class="divider">/</span></li>
<li class="active">编辑#<?php echo $tour['id']; ?></li>
</ul>

<form method="post" action="">
<dl>
    <dt>名称</dt>
    <dd><input type="text" id="tour_name" name="tour[name]" value="<?php echo $tour['name']; ?>" /></dd>
    <dt>住宿地</dt>
    <dd><select id="tour_destination_id" name="tour[destination_id]">
        <?php foreach($destination_options as $id=>$destination):?>
            <option value="<?php echo $id;?>"<?php $id==@$tour['destination_id'] && print(' selected="true"');?>><?php echo $destination;?></option>
        <?php endforeach;?>
    </select>
    </dd>
    <dt>公里数</dt>
    <dd><input type="text" id="tour_distance" name="tour[distance]" value="<?php echo $tour['distance']; ?>" /></dd>
    <dt>市场价</dt>
    <dd><input type="text" id="tour_market_price" name="tour[market_price]" value="<?php echo $tour['market_price']; ?>" /></dd>
    <dt>价格</dt>
    <dd><input type="text" id="tour_price" name="tour[price]" value="<?php echo $tour['price']; ?>" /></dd>
     <dt>介绍</dt>
    <dd><textarea id="tour_description" name="tour[description]" rows="3" cols="70"><?php echo $tour['description']; ?></textarea></dd>
</dl>
<input type="submit" class="btn btn-primary" />
</form>