<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="destination.php?act=list">目的地</a> <span class="divider">/</span></li>
<li class="active">添加</li>
</ul>
<form method="post" action="">
<dl>
    <dt>名称</dt>
    <dd><input type="text" id="destination_name" name="destination[name]" value="" /></dd>
    <dt>缩略语</dt>
    <dd><input type="text" id="destination_slug" name="destination[slug]" value="" /></dd>
     <dt>介绍</dt>
    <dd><textarea id="destination_description" name="destination[description]" rows="3" cols="70"></textarea></dd>
</dl>
<input type="submit" class="btn btn-primary" />
</form>