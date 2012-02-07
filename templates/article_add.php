<h3><?php echo $title_for_layout;?></h3>
<form method="post" action="">
<dl>
    <dt>标题</dt>
    <dd><input type="text" id="article_title" name="article[title]" value="" /></dd>
    <dt>缩略语</dt>
    <dd><input type="text" id="article_slug" name="article[slug]" value="" /></dd>
     <dt>内容</dt>
    <dd><textarea id="article_content" name="article[content]" rows="3" cols="70"></textarea></dd>
</dl>
<input type="submit" />
</form>