<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="destination.php?act=list">目的地</a> <span class="divider">/</span></li>
<li class="active">所有</li>
</ul>


<p class="pull-right"><?php if(checkPrivilege('destination', 'add')):?><a href="destination.php?act=add" class="btn"><i class="icon-eidt"></i>添加目的地</a><?php endif;?></p>
<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>名称</th>
        <th>需要边防证</th>
        <th>发布时间</th>
        <th>更新时间</th>
        <th>操作</th>
    </tr> </thead><tbody><?php if(!empty($destinations)):?>

    <?php foreach($destinations as $destination):?>
    <tr>
        <td><?php echo $destination['id'];?></td>
        <td><?php echo $destination['name'];?></td>
        <td><?php echo $destination['need_passport']?'是':'否';?></td>
        <td><?php echo $destination['created'];?></td>
        <td><?php echo $destination['updated'];?></td>
        <td>
        <a href="destination.php?act=view&id=<?php echo $destination['id'];?>" class="btn btn-info">详情</a>
        <a href="destination.php?act=edit&id=<?php echo $destination['id'];?>" class="btn">编辑</a>
        <a href="destination.php?act=delete&id=<?php echo $destination['id'];?>" class="btn btn-danger">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="destination.php?act=add">发目的地</a></td>
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
