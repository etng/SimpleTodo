<ul class="breadcrumb">
<li><a href="/"><i class="icon-home"></i>首页</a> <span class="divider">/</span></li>
<li><a href="schedule_template.php?act=list">日程模版</a> <span class="divider">/</span></li>
<li class="active">#<?php echo $schedule_template['id'];?></li>
</ul>

<p class="pull-right">
<?php if(checkPrivilege('schedule_template', 'edit')):?>
    <a href="schedule_template.php?act=edit&id=<?php echo $schedule_template['id'];?>" class="btn "><i class="icon-pencil"></i>编辑</a>
<?php endif;?>
<?php if(checkPrivilege('schedule_template', 'delete')):?>
    <a href="schedule_template.php?act=delete&id=<?php echo $schedule_template['id'];?>" class="btn btn-danger"><i class="icon-trash"></i>删除</a>
<?php endif;?>
<?php if(checkPrivilege('schedule_template', 'add')):?>
    <a href="schedule_template.php?act=add" class="btn  "><i class="icon-plus-sign"></i>添加</a>
<?php endif;?>
 </p>
<dl>
 <dt>编号</dt>
<dd><?php echo $schedule_template['id'];?></dd>
<dt>分类</dt>
<dd><a href="schedule_template_cate.php?act=view&id= <?php echo $schedule_template['cate_id'];?>"><?php echo $schedule_template['cate_name'];?></a>
</dd>
<dt>名称</dt>
<dd><?php echo $schedule_template['name'];?></dd>
<dt>代号</dt>
<dd><?php echo $schedule_template['code'];?></dd>
    <dt>需要边防证</dt>    <dd><?php echo $schedule_template['need_passport']?'是':'否';?></dd>

<dt>内容</dt>
<dd><?php echo nl2br($schedule_template['content']);?></dd>
<dt>备注</dt>
<dd><?php echo nl2br($schedule_template['memo']);?></dd>
</dl>