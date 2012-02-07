<h3><?php echo $title_for_layout;?></h3>
<form method="post" action="">
<dl>
    <dt>名称</dt>
    <dd><input type="text" id="destination_name" name="destination[name]" value="" /></dd>
    <dt>缩略语</dt>
    <dd><input type="text" id="destination_slug" name="destination[slug]" value="" /></dd>
     <dt>介绍</dt>
    <dd><textarea id="destination_description" name="destination[description]" rows="3" cols="70"></textarea></dd>
</dl>
<input type="submit" />
</form>