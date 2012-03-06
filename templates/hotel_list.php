<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="hotel.php?act=list">酒店</a> <span class="divider">/</span></li>
<li class="active">所有</li>
</ul>

<p class="pull-right">
<a href="hotel.php?act=add" class="btn">添加酒店</a>
</p>
<table class="table table-bordered table-striped table-list">
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
        <td><label class="checkbox inline"><input type="checkbox" name="hotel_id[]" value="<?php echo $hotel['id'];?>" /><?php echo $hotel['id'];?></label></td>
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


