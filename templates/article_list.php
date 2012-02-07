<h3><?php echo $title_for_layout;?></h3>


<table>
    <tr>
        <td>编号</td>
        <td>标题</td>
        <td>发布时间</td>
        <td>更新时间</td>
        <td>操作</td>
    </tr> <?php if(!empty($articles)):?>

    <?php foreach($articles as $article):?>
    <tr>
        <td><?php echo $article['id'];?></td>
        <td><?php echo $article['title'];?></td>
        <td><?php echo $article['created'];?></td>
        <td><?php echo $article['updated'];?></td>
        <td>
        <a href="article.php?act=view&id=<?php echo $article['id'];?>">详情</a>
        <a href="article.php?act=edit&id=<?php echo $article['id'];?>">编辑</a>
        <a href="article.php?act=delete&id=<?php echo $article['id'];?>">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="article.php?act=add">发文章</a></td>
    </tr>
    <?php endif;?>
</table>