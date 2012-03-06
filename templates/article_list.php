<h3><?php echo $title_for_layout;?></h3>

<p class="pull-right"><?php if(checkPrivilege('article', 'add')):?><a href="article.php?act=add" class="btn"><i class="icon-eidt"></i>发文章</a><?php endif;?></p>
<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>标题</th>
        <th>发布时间</th>
        <th>更新时间</th>
        <th>操作</th>
    </tr> </thead>
    <tbody>
    <?php if(!empty($articles)):?>

    <?php foreach($articles as $article):?>
    <tr>
        <td><?php echo $article['id'];?></td>
        <td><?php echo $article['title'];?></td>
        <td><?php echo $article['created'];?></td>
        <td><?php echo $article['updated'];?></td>
        <td>
        <a href="article.php?act=view&id=<?php echo $article['id'];?>" class="btn btn-info">详情</a>
        <a href="article.php?act=edit&id=<?php echo $article['id'];?>" class="btn">编辑</a>
        <a href="article.php?act=delete&id=<?php echo $article['id'];?>" class="btn btn-danger">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="article.php?act=add">发文章</a></td>
    </tr>

    <?php endif;?></tbody>
</table>