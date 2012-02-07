<h3><?php echo $title_for_layout;?></h3>


<table>
    <tr>
        <td>编号</td>
        <td>名称</td>
        <td>住宿地</td>
        <td>公里数</td>
        <td>市场价</td>
        <td>价格</td>
        <td>操作</td>
    </tr> <?php if(!empty($tours)):?>

    <?php foreach($tours as $tour):?>
    <tr>
        <td><?php echo $tour['id'];?></td>
        <td><?php echo $tour['name'];?></td>
        <td><?php echo $tour['destination'];?></td>
        <td><?php echo $tour['distance'];?></td>
        <td><?php echo $tour['market_price'];?></td>
        <td><?php echo $tour['price'];?></td>
        <td>
        <a href="tour.php?act=view&id=<?php echo $tour['id'];?>">详情</a>
        <a href="tour.php?act=edit&id=<?php echo $tour['id'];?>">编辑</a>
        <a href="tour.php?act=delete&id=<?php echo $tour['id'];?>">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="tour.php?act=add">发线路</a></td>
    </tr>
    <?php endif;?>
</table>