<h3><?php echo $article['title']; ?></h3>
<hr />
<dl>
    <dt>更新时间</dt>    <dd><?php echo $article['created']; ?></dd>
    <dt>阅读次数</dt>    <dd><?php echo $article['hits']; ?></dd>
</dl>
<hr />
<div><?php echo $article['content']; ?></div>