<ul class="breadcrumb">
<li><a href="/"><i class="icon-home"></i>首页</a> <span class="divider">/</span></li>
<li><a href="schedule_template_cate.php?act=list">日程模版分类</a> <span class="divider">/</span></li>
<li class="active">#<?php echo $schedule_template_cate['id'];?></li>
</ul>

<p class="pull-right">
<?php if(checkPrivilege('schedule_template_cate', 'edit')):?>
    <a href="schedule_template_cate.php?act=edit&id=<?php echo $schedule_template_cate['id'];?>" class="btn "><i class="icon-pencil"></i>编辑</a>
<?php endif;?>
<?php if(checkPrivilege('schedule_template_cate', 'delete')):?>
    <a href="schedule_template_cate.php?act=delete&id=<?php echo $schedule_template_cate['id'];?>" class="btn btn-danger"><i class="icon-trash"></i>删除</a>
<?php endif;?>
<?php if(checkPrivilege('schedule_template_cate', 'add')):?>
    <a href="schedule_template_cate.php?act=add" class="btn  "><i class="icon-plus-sign"></i>添加</a>
<?php endif;?>
 </p>
<dl>
 <dt>编号</dt>
<dd><?php echo $schedule_template_cate['id'];?></dd>
<dt>名称</dt>
<dd><?php echo $schedule_template_cate['name'];?></dd>
<dt>介绍</dt>
<dd><?php echo $schedule_template_cate['description'];?></dd>
</dl>