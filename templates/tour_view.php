<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="tour.php?act=list">线路</a> <span class="divider">/</span></li>
<li class="active">查看#<?php echo $tour['id']; ?></li>
</ul>

<dl class="dlist">
    <dt>名称</dt>    <dd><?php echo $tour['name']; ?></dd>
    <dt>主要看点</dt>    <dd><?php echo $tour['attractions']; ?></dd>
    <dt>住宿地</dt>    <dd><?php echo $destination_options[$tour['destination_id']]; ?></dd>
    <dt>公里数</dt>    <dd><?php echo $tour['distance']; ?></dd>
    <dt>市场价</dt>    <dd><?php echo $tour['market_price']; ?></dd>
    <dt>价格</dt>    <dd><?php echo $tour['price']; ?></dd>
</dl>
<hr />
<div><?php echo $tour['description']; ?></div>