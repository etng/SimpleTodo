<ul class="breadcrumb">
  <li><a href="/"><i class="icon-home"></i>首页</a> <span class="divider">/</span></li>
  <li class="active"><a href="<?php echo $table['name'];?>.php?act=list"><?php echo $table['comment'];?></a> <span class="divider">/</span></li>
  <li>所有</li>
</ul>
<p class="pull-right">
  <?php foreach($actions['any'] as $act=>$act_config):?>
  [?php if(checkPrivilege('<?php echo $table['name'];?>', '<?php echo $act; ?>')):?] <a href="<?php echo $table['name'];?>.php?act=<?php echo $act; ?>" class="btn <?php echo $act_config['class']; ?>"><?php echo $act_config['label']; ?></a> [?php endif;?]
  <?php endforeach;?>
</p>
<form action="?act=batch" method="post">
  <table class="table table-bordered table-striped table-list">
    <thead>
      <tr>
        <th>编号</th>
        <?php foreach($table['fields'] as $field):?>
        <?php if($field->primary && $field->name=='id')continue;?>
        <?php if($field->data_type=='text')continue;?>
        <th><?php echo $field->comment;?></th>
        <?php endforeach;?>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>

    [?php if(!empty($<?php echo $table['name'];?>s)):?]
    [?php foreach($<?php echo $table['name'];?>s as $<?php echo $table['name'];?>):?]
    <tr>
      <td><label class="checkbox inline">
          <input type="checkbox" name="ids[]" value="[?php echo $<?php echo $table['name'];?>['id'];?]" />
          [?php echo $<?php echo $table['name'];?>['id'];?]</label></td>
      <?php foreach($table['fields'] as $field):?>
      <?php if($field->primary && $field->name=='id')continue;?>
      <?php if($field->data_type=='text')continue;?>
      <td>[?php echo $<?php echo $table['name'];?>['<?php echo $field->name;?>'];?]</td>
      <?php endforeach;?>
      <td><?php foreach($actions['object'] as $act=>$act_config):?>
        [?php if(checkPrivilege('<?php echo $table['name'];?>', '<?php echo $act; ?>')):?] <a href="<?php echo $table['name'];?>.php?act=<?php echo $act; ?>&id=[?php echo $<?php echo $table['name'];?>['id'];?]" class="btn <?php echo $act_config['class']; ?>"><?php echo $act_config['label']; ?></a> [?php endif;?]
        <?php endforeach;?></td>
    </tr>
    [?php endforeach;?]
    [?php else:?]
    <tr>
      <td colspan="100"> 暂时还没有找到相关的<?php echo $table['comment'];?></td>
    </tr>
    [?php endif;?]
      </tbody>

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
      <input type="hidden" name="bact" value="" />
      <div class="btn-group" style="margin: 9px 0;">
        <?php foreach($actions['batch'] as $act=>$act_config):?>
        [?php if(checkPrivilege('<?php echo $table['name'];?>', '<?php echo $act; ?>')):?]
        <button onclick="this.form.bact.value='<?php echo $act; ?>';this.form.submit();" class="btn <?php echo $act_config['class']; ?>"><?php echo $act_config['label']; ?></button>
        [?php endif;?]
        <?php endforeach;?>
      </div>
    </div>
    <div class="span6"> [?php include(dirname(__file__). '/../_pager.php');?] </div>
  </div>
</form>
