<h3><?php echo $title_for_layout;?></h3>
<form method="post" action="">
<dl>
    <dt>名称</dt>
    <dd><input type="text" id="tour_name" name="tour[name]" value="<?php echo $tour['name']; ?>" /></dd>
    <dt>住宿地</dt>
    <dd><input type="text" id="tour_destination" name="tour[destination]" value="<?php echo $tour['destination']; ?>" /></dd>
    <dt>公里数</dt>
    <dd><input type="text" id="tour_distance" name="tour[distance]" value="<?php echo $tour['distance']; ?>" /></dd>
    <dt>市场价</dt>
    <dd><input type="text" id="tour_market_price" name="tour[market_price]" value="<?php echo $tour['market_price']; ?>" /></dd>
    <dt>价格</dt>
    <dd><input type="text" id="tour_price" name="tour[price]" value="<?php echo $tour['price']; ?>" /></dd>
     <dt>介绍</dt>
    <dd><textarea id="tour_description" name="tour[description]" rows="3" cols="70"><?php echo $tour['description']; ?></textarea></dd>
</dl>
<input type="submit" />
</form>