<?php if(!empty($pager)):?>
<div class="pagination pagination-right">
 <?php if($pager['total_page']>1):?>
第<?php echo $pager['cur_page']; ?>/<?php echo $pager['total_page']; ?>页
    <ul>
        <?php if($pager['has_first']):?>
        <li><a href="?page=1">第一页</a></li>
        <?php endif; ?>
        <?php if($pager['has_prev']):?>
        <li><a href="?page=<?php echo $pager['cur_page']-1; ?>">上一页</a></li>
        <?php endif;?>
        <?php foreach(range($pager['start_page'], $pager['end_page']) as $page):?>
            <?php if($page!=$pager['cur_page']):?>
            <li><a href="?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php else:?>
            <li class="active"><a href="#"><?php echo $page; ?></a></li>
            <?php endif;?>
        <?php endforeach;?>
        <?php if($pager['has_next']):?>
        <li><a href="?page=<?php echo $pager['cur_page']+1; ?>">下一页</a></li>
        <?php endif;?>
        <?php if($pager['has_last']):?>
        <li><a href="?page=<?php echo $pager['total_page']; ?>">最后页</a></li>
        <?php endif;?>
    </ul>
    <?php endif;?>
</div>
<?php endif;?>