<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="tour.php?act=list">线路</a> <span class="divider">/</span></li>
<li class="active">添加</li>
</ul>

<form method="post" action="">
<dl>
    <dt>名称</dt>
    <dd><input type="text" id="tour_name" name="tour[name]" value="" /></dd>
    <dt>住宿地</dt>
    <dd><input type="text" id="tour_destination" name="tour[destination]" value="" /></dd>
    <dt>公里数</dt>
    <dd><input type="text" id="tour_distance" name="tour[distance]" value="" /></dd>
    <dt>市场价</dt>
    <dd><input type="text" id="tour_market_price" name="tour[market_price]" value="" /></dd>
    <dt>价格</dt>
    <dd><input type="text" id="tour_price" name="tour[price]" value="" /></dd>
     <dt>介绍</dt>
    <dd><textarea id="tour_description" name="tour[description]" rows="3" cols="70"></textarea></dd>
</dl>
<input type="submit" class="btn btn-primary" />
</form>