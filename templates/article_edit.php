<ul class="breadcrumb">
  <li><a href="/">首页</a> <span class="divider">/</span></li>
  <li><a href="article.php?act=list">文章</a> <span class="divider">/</span></li>
  <li class="active">添加</li>
</ul>
<form method="post" action="">
  <dl>
    <dt>标题</dt>
    <dd>
      <input type="text" id="article_title" name="article[title]" value="<?php echo $article['title']; ?>" />
    </dd>
    <dt>缩略语</dt>
    <dd>
      <input type="text" id="article_slug" name="article[slug]" value="<?php echo $article['slug']; ?>" />
    </dd>
    <dt>内容</dt>
    <dd>
      <textarea id="article_content" name="article[content]" rows="20" cols="120"><?php echo $article['content']; ?></textarea>
    </dd>
  </dl>
  <input type="submit" class="btn btn-primary" />
</form>
