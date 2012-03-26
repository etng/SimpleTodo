<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="destination.php?act=list">目的地</a> <span class="divider">/</span></li>
<li class="active">查看#<?php echo $destination['id']; ?></li>
</ul>

<h3><?php echo $destination['name']; ?></h3>
<hr />
<dl>
    <dt>更新时间</dt>    <dd><?php echo $destination['created']; ?></dd>
    <dt>阅读次数</dt>    <dd><?php echo $destination['hits']; ?></dd>
</dl>
<hr />
<div><?php echo $destination['description']; ?></div>