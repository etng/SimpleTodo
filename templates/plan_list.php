<h3><?php echo $title_for_layout;?></h3>
<table>
    <tr>
        <td>编号</td>
        <td>金额</td>
        <td>时间</td>
        <td>状态</td>
        <td>操作</td>
    </tr> <?php if(!empty($plans)):?>

    <?php foreach($plans as $plan):?>
    <tr>
        <td><?php echo $plan['id'];?></td>
        <td><?php echo $plan['price'];?></td>
        <td><?php echo $plan['created'];?></td>
        <td><?php echo $statuss[$plan['status']]['text'];?></td>
        <td>
        <a href="plan.php?act=view&id=<?php echo $plan['id'];?>">详情</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100">凡事预则立不预则废，<a href="plan.php?act=add">要旅行，早计划</a></td>
    </tr>
    <?php endif;?>
</table>