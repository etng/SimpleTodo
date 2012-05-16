<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="tour.php?act=list">线路</a> <span class="divider">/</span></li>
<li class="active">所有</li>
</ul>

<p class="pull-right">
<a href="tour.php?act=add" class="btn">添加线路</a>
</p>
<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>名称</th>
        <th>主要看点</th>
        <th>住宿地</th>
        <th>公里数</th>
        <th>市场价</th>
        <th>价格</th>
        <th>操作</th>
    </tr> </thead><tbody><?php if(!empty($tours)):?>

    <?php foreach($tours as $tour):?>
    <tr>
        <td><?php echo $tour['id'];?></td>
        <td><?php echo $tour['name'];?></td>
        <td><?php echo $tour['attractions'];?></td>
        <td><?php echo $destination_options[$tour['destination_id']];?></td>
        <td><?php echo $tour['distance'];?></td>
        <td><?php echo $tour['market_price'];?></td>
        <td><?php echo $tour['price'];?></td>
        <td>
        <a href="tour.php?act=view&id=<?php echo $tour['id'];?>" class="btn btn-info">详情</a>
        <a href="tour.php?act=edit&id=<?php echo $tour['id'];?>" class="btn">编辑</a>
        <a href="tour.php?act=delete&id=<?php echo $tour['id'];?>" class="btn btn-danger">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="tour.php?act=add">发线路</a></td>
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
