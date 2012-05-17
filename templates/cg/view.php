<ul class="breadcrumb">
  <li><a href="/"><i class="icon-home"></i>首页</a> <span class="divider">/</span></li>
  <li><a href="<?php echo $table['name'];?>.php?act=list"><?php echo $table['comment'];?></a> <span class="divider">/</span></li>
  <li class="active">#[?php echo $<?php echo $table['name'];?>['id'];?]</li>
</ul>
<p class="pull-right">
  <?php foreach($actions['object'] as $act=>$act_config):if($act=='view')continue;?>
  [?php if(checkPrivilege('<?php echo $table['name'];?>', '<?php echo $act; ?>')):?] <a href="<?php echo $table['name'];?>.php?act=<?php echo $act; ?>&id=[?php echo $<?php echo $table['name'];?>['id'];?]" class="btn <?php echo $act_config['class']; ?>"><?php echo $act_config['label']; ?></a> [?php endif;?]
  <?php endforeach;?>
  <?php foreach($actions['any'] as $act=>$act_config):?>
  [?php if(checkPrivilege('<?php echo $table['name'];?>', '<?php echo $act; ?>')):?] <a href="<?php echo $table['name'];?>.php?act=<?php echo $act; ?>" class="btn <?php echo $act_config['class']; ?>"><?php echo $act_config['label']; ?></a> [?php endif;?]
  <?php endforeach;?>
</p>
<dl>
  <?php foreach($table['fields'] as $field):?>
  <dt><?php echo $field->comment;?></dt>
  <dd>[?php echo $<?php echo $table['name'];?>['<?php echo $field->name;?>'];?]</dd>
  <?php endforeach;?>
</dl>
