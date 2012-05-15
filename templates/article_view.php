<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="article.php?act=list">文章</a> <span class="divider">/</span></li>
<li class="active">查看#<?php echo $article['id']; ?></li>
</ul>

<h3><?php echo $article['title']; ?></h3>
<hr />
<dl>
    <dt>更新时间</dt>    <dd><?php echo $article['created']; ?></dd>
    <dt>阅读次数</dt>    <dd><?php echo $article['hits']; ?></dd>
</dl>
<hr />
<div><?php echo $article['content']; ?></div>