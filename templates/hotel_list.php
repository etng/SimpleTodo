<h3><?php echo $title_for_layout;?></h3>


<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>名称</th>
        <th>所在地</th>
        <th>联系电话</th>
        <th>加入时间</th>
        <th>操作</th>
    </tr></thead> <tbody><?php if(!empty($hotels)):?>

    <?php foreach($hotels as $hotel):?>
    <tr>
        <td><?php echo $hotel['id'];?></td>
        <td><?php echo $hotel['name'];?></td>
        <td><a href="destination.php?act=view&id=<?php echo $hotel['destination_id'];?>"><?php echo $hotel['destination_name'];?></a></td>
        <td><?php echo $hotel['phone'];?></td>
        <td><?php echo $hotel['created'];?></td>
        <td>
        <a href="hotel.php?act=view&id=<?php echo $hotel['id'];?>" class="btn btn-info">详情</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="hotel.php?act=add">先谈两家酒店来合作</a></td>
    </tr>
    <?php endif;?></tbody>
</table>