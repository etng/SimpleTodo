<h3><?php echo $title_for_layout;?></h3>


<table>
    <tr>
        <td>编号</td>
        <td>所在地</td>
        <td>姓名</td>
        <td>民族</td>
        <td>年龄</td>
        <td>电话</td>
        <td>车型</td>
        <td>车牌号</td>
        <td>车容量</td>
        <td>操作</td>
    </tr> <?php if(!empty($drivers)):?>

    <?php foreach($drivers as $driver):?>
    <tr>
        <td><?php echo $driver['id'];?></td>
        <td><a href="destination.php?act=view&id=<?php echo $driver['destination_id'];?>"><?php echo $driver['destination_name'];?></a></td>
        <td><?php echo $driver['name'];?></td>
        <td><?php echo $driver['nationality'];?></td>
        <td><?php echo $driver['age'];?></td>
        <td><?php echo $driver['phone'];?></td>
        <td><?php echo @$config['car_types'][$driver['car_type']];?></td>
        <td><?php echo $driver['car_plate_num'];?></td>
        <td><?php echo $driver['car_capacity'];?></td>
        <td>
        <a href="driver.php?act=view&id=<?php echo $driver['id'];?>">详情</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="driver.php?act=add">先谈两个师傅来合作</a></td>
    </tr>
    <?php endif;?>
</table>