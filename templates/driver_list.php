<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="driver.php?act=list">司机</a> <span class="divider">/</span></li>
<li class="active">所有</li>
</ul>

<p class="pull-right">
<a href="driver.php?act=add" class="btn">添加司机</a>
</p>

<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>所在地</th>
        <th>姓名</th>
        <th>民族</th>
        <th>年龄</th>
        <th>电话</th>
        <th>车型</th>
        <th>车牌号</th>
        <th>车容量</th>
        <th>操作</th>
    </tr> </thead><tbody><?php if(!empty($drivers)):?>

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
        <a href="driver.php?act=view&id=<?php echo $driver['id'];?>" class="btn btn-info">详情</a>
        <a href="driver.php?act=edit&id=<?php echo $driver['id'];?>" class="btn">编辑</a>
        <a href="driver.php?act=delete&id=<?php echo $driver['id'];?>" class="btn btn-danger">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="driver.php?act=add">先谈两个师傅来合作</a></td>
    </tr>
    <?php endif;?></tbody>
</table>

<div class="row">
    <div class="span2">
        <div class="btn-group" style="margin: 9px 0;">
          <button class="btn btn-select-all">全选</button>
          <button class="btn btn-select-inverse">反选</button>
          <button class="btn btn-select-none">不选</button>
        </div>
    </div>
    <div class="span4"> &nbsp;
    </div>
    <div class="span6">
        <?php include(dirname(__file__). '/_pager.php');?>
    </div>
</div>
