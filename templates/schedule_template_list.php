<ul class="breadcrumb">
<li><a href="/"><i class="icon-home"></i>首页</a> <span class="divider">/</span></li>
<li class="active"><a href="schedule_template.php?act=list">日程模版</a> <span class="divider">/</span></li>
<li>所有</li>
</ul>
<p class="pull-right">
<?php if(checkPrivilege('schedule_template', 'add')):?>
    <a href="schedule_template.php?act=add" class="btn  "><i class="icon-plus-sign"></i>添加</a>
<?php endif;?>
 </p>

 <form action="?act=batch" method="post">
<table class="table table-bordered table-striped table-list">
    <thead><tr><th>编号</th>
                        <th>分类</th>
                    <th>名称</th>
                    <th>代号</th>
                            <th>备注</th>
            <th>操作</th>
    </tr> </thead>
    <tbody>
    <?php if(!empty($schedule_templates)):?>
    <?php foreach($schedule_templates as $schedule_template):?>
    <tr>
    <td>
    <label class="checkbox inline"><input type="checkbox" name="hotel_id[]" value="<?php echo $schedule_template['id'];?>" /><?php echo $schedule_template['id'];?></label></td>

        <td><a href="schedule_template_cate.php?act=view&id= <?php echo $schedule_template['cate_id'];?>"><?php echo $schedule_template['cate_name'];?></a></td>

        <td><?php echo $schedule_template['name'];?></td>

        <td><?php echo $schedule_template['code'];?></td>

        <td><?php echo $schedule_template['memo'];?></td>
            <td>
                <?php if(checkPrivilege('schedule_template', 'view')):?>
            <a href="schedule_template.php?act=view&id=<?php echo $schedule_template['id'];?>" class="btn btn-info">详情</a>
        <?php endif;?>
                <?php if(checkPrivilege('schedule_template', 'edit')):?>
            <a href="schedule_template.php?act=edit&id=<?php echo $schedule_template['id'];?>" class="btn "><i class="icon-pencil"></i>编辑</a>
        <?php endif;?>
                <?php if(checkPrivilege('schedule_template', 'delete')):?>
            <a href="schedule_template.php?act=delete&id=<?php echo $schedule_template['id'];?>" class="btn btn-danger"><i class="icon-trash"></i>删除</a>
        <?php endif;?>
                </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100">
        暂时还没有找到相关的日程模版        </td>
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
    <div class="span4">
    <input type="hidden" name="act" value="" />
    <div class="btn-group" style="margin: 9px 0;">
        <?php if(checkPrivilege('schedule_template', 'delete')):?>
        <button onclick="this.form.act='delete;this.form.submit();' class="btn btn-danger"><i class="icon-trash"></i>删除</button>
    <?php endif;?>
    </div>
    </div>
    <div class="span6">
        <?php include(dirname(__file__). '/_pager.php');?>
    </div>
</div>
</form>