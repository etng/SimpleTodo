  <div id="seeoff_detail_container"<?php 0==@$plan['need_seeoff'] && print(' style="display:none;"');?> >
    <dl>
      <dt>遣散日期</dt>
      <dd>
        <input type="text" id="seeoff_date" name="plan[seeoff_date]" value="<?php echo @$plan['seeoff_date'];?>" size="10" />
      </dd>
      <dt>遣散地点</dt>
      <dd>
        <select id="seeoff_destination" name="plan[seeoff_destination]">
          <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
          <option value="<?php echo $city;?>"<?php  $city==@$plan['seeoff_destination'] && print(' selected="true"');?>><?php echo $city;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>遣散方式</dt>
      <dd>
        <input type="text" id="seeoff_method" name="plan[seeoff_method]" value="<?php echo @$plan['seeoff_method'];?>" size="6" />
        <select id="seeoff_method_selector">
          <option value="" selected="selected">自定义</option>
          <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
          <option value="<?php echo $method;?>"<?php  $method==@$plan['seeoff_method'] && print(' selected="true"');?>><?php echo $method;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>送站地点等信息</dt>
      <dd>
        <textarea id="seeoff_detail" name="plan[seeoff_detail]" rows="3" cols="70" plcaceholder="班次、出发时间等信息"><?php echo @$plan['seeoff_detail'];?></textarea>
      </dd>
    </dl>
  </div>