<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="setting.php">系统配置</a> <span class="divider">/</span></li>
<li class="active">修改</li>
</ul>

<form class="form-horizontal" method="post" action="?act=save">
  <fieldset>
    <legend>司机相关</legend>
    <div class="control-group">
      <label class="control-label" for="setting_driver_star">默认星级</label>
      <div class="controls">
       <?php $i=0;while($i++<5):?>
      <label class="inline radio"><input type="radio" id="setting_driver_star_<?php echo $i;?>" name="setting[driver_star]" value="<?php echo $i;?>"<?php $i==@$setting['driver_star'] && print(' checked="true"');?> /><?php echo $i;?></label>
      <?php endwhile;?>
        <p class="help-block"></p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="setting_driver_destination_id">默认所在地</label>
      <div class="controls">
      <select class="input-xlarge" name="setting[driver_destination_id]" id="setting_driver_destination_id">
        <?php foreach($destination_options as $id=>$destination):?>
            <option value="<?php echo $id;?>"<?php $id==@$setting['driver_destination_id'] && print(' selected="true"');?>><?php echo $destination;?></option>
        <?php endforeach;?>
      </select>
        <p class="help-block"></p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="setting_driver_destination_id">默认车型</label>
      <div class="controls">
        <select name="setting[driver_car_type]" id="setting_driver_car_type">
            <option value="" selected="selected">--请选择--</option>
            <?php foreach($config['car_types'] as $car_type=>$text):?>
            <option value="<?php echo $car_type;?>"<?php $car_type==@$setting['driver_car_type'] && print(' selected="true"');?>><?php echo $text;?></option>
            <?php endforeach;?>
        </select>
        <p class="help-block"></p>
      </div>
    </div>
  </fieldset>
   <button type="submit" class="btn btn-primary">保存</button>
</form>