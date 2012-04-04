<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="driver.php?act=list">司机</a> <span class="divider">/</span></li>
<li class="active">查看#<?php echo $driver['id'];?></li>
</ul>

<dl>
    <dt>姓名</dt>
    <dd><?php echo $driver['name'];?></dd>
    <dt>加入时间</dt>
    <dd><?php echo $driver['created'];?></dd>
     <dt>生日</dt><dd><?php echo $driver['dob'];?></dd>
     <dt>民族</dt><dd><?php echo $driver['nationality'];?></dd>
     <dt>年龄</dt><dd><?php echo $driver['age'];?></dd>
     <dt>车型</dt><dd><?php echo @$config['car_types'][$driver['car_type']];?></dd>
     <dt>车牌</dt><dd><?php echo $driver['car_plate_num'];?></dd>
     <dt>容量</dt><dd><?php echo $driver['car_capacity'];?></dd>
     <dt>星级</dt><dd><?php echo $driver['star'];?></dd>
    <dt>电话</dt>
    <dd><?php echo $driver['phone'];?></dd>
    <dt>介绍</dt>
    <dd><?php echo $driver['description'];?></dd>
</dl>