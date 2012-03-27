<form class="form-horizontal" action="" method="post">
  <fieldset>
    <legend></legend>
    <div class="control-group">
<?php foreach($table['fields'] as $field):?>
<?php
if($field->primary && $field->name=='id')continue;
?>
      <label class="control-label" for="<?php echo $table['name'];?>_<?php echo $field->name;?>"><?php echo $field->comment;?></label>
      <div class="controls">
         <?php if($field->data_type=='text'):?>
         <textarea  id="<?php echo $table['name'];?>_<?php echo $field->name;?>" name="<?php echo $table['name'];?>[<?php echo $field->name;?>]" rows="4" cols="75">[?php echo $<?php echo @$table['name'];?>['<?php echo $field->name;?>'];?]</textarea>
        <?php else:?>
        <input type="text" class="input-xlarge" id="<?php echo $table['name'];?>_<?php echo $field->name;?>" name="<?php echo $table['name'];?>[<?php echo $field->name;?>]" value="[?php echo @$<?php echo $table['name'];?>['<?php echo $field->name;?>'];?]"  placeholder="">
        <?php endif;?>
        <span class="help-inline"></span>
        <p class="help-block"></p>
      </div>
<?php endforeach;?>
    </div>
  </fieldset>

<div class="form-actions">
<button type="submit" class="btn btn-primary">保存</button>
<a href="<?php echo $table['name'];?>.php?act=list" class="btn">取消</a>
</div>
</form>