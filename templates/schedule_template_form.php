<form class="form-horizontal" action="" method="post">
  <fieldset>
    <legend></legend>
    <div class="control-group">
      <label class="control-label" for="schedule_template_cate_id">分类</label>
      <div class="controls">
      <select class="input-xlarge" id="schedule_template_cate_id" name="schedule_template[cate_id]">
        <?php foreach($schedule_template_cate_options as $id=>$name):?>
            <option value="<?php echo $id;?>"<?php $id==@$schedule_template['cate_id'] && print(' selected="true"');?>><?php echo $name;?></option>
        <?php endforeach;?>
    </select>
                <span class="help-inline"></span>
        <p class="help-block"></p>
      </div>
      <label class="control-label" for="schedule_template_name">名称</label>
      <div class="controls">
                 <input type="text" class="input-xlarge" id="schedule_template_name" name="schedule_template[name]" value="<?php echo @$schedule_template['name']?>"  placeholder="">
                <span class="help-inline"></span>
        <p class="help-block"></p>
      </div>
      <label class="control-label" for="schedule_template_code">代号</label>
      <div class="controls">
                 <input type="text" class="input-xlarge" id="schedule_template_code" name="schedule_template[code]" value="<?php echo @$schedule_template['code']?>"  placeholder="">
                <span class="help-inline"></span>
        <p class="help-block"></p>
      </div>

      <label class="control-label" for="schedule_template_need_passport">边防证</label>
      <div class="controls">
        <label class="checkbox inline"><input type="hidden" name="schedule_template[need_passport]" value="0" /><input type="checkbox" id="schedule_template_need_passport" name="schedule_template[need_passport]" value="1"<?php  @$schedule_template['need_passport'] && print ' checked="true"'; ?> />需要边防证</label>
                <span class="help-inline"></span>
        <p class="help-block"></p>
      </div>


      <label class="control-label" for="schedule_template_content">内容</label>
      <div class="controls">
                  <textarea  id="schedule_template_content" name="schedule_template[content]" rows="8" cols="70"><?php echo @$schedule_template['content']?></textarea>
                <span class="help-inline"></span>
        <p class="help-block"></p>
      </div>
      <label class="control-label" for="schedule_template_memo">备注</label>
      <div class="controls">
                 <input type="text" class="input-xlarge" id="schedule_template_memo" name="schedule_template[memo]" value="<?php echo @$schedule_template['memo']?>"  placeholder="">
                <span class="help-inline"></span>
        <p class="help-block"></p>
      </div>
    </div>
  </fieldset>

<div class="form-actions">
<button type="submit" class="btn btn-primary">保存</button>
<button class="btn">取消</button>
</div>
</form>