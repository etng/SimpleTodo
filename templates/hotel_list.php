<h3><?php echo $title_for_layout;?></h3>


<table>
    <tr>
        <td>编号</td>
        <td>名称</td>
        <td>所在地</td>
        <td>联系电话</td>
        <td>操作</td>
    </tr> <?php if(!empty($hotels)):?>

    <?php foreach($hotels as $hotel):?>
    <tr>
        <td><?php echo $hotel['id'];?></td>
        <td><?php echo $hotel['name'];?></td>
        <td><a href="destination.php?act=view&id=<?php echo $hotel['destination_id'];?>"><?php echo $hotel['destination_name'];?></a></td>
        <td><?php echo $hotel['phone'];?></td>
        <td><?php echo $hotel['created'];?></td>
        <td>
        <a href="hotel.php?act=view&id=<?php echo $hotel['id'];?>">详情</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="hotel.php?act=add">先谈两家酒店来合作</a></td>
    </tr>
    <?php endif;?>
</table>