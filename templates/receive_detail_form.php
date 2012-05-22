  <div id="receive_detail_container"<?php 0==@$plan['need_receive'] && print(' style="display:none;"');?>>
    <dl>
      <dt>集合日期</dt>
      <dd>
        <input type="text" id="arrive_date" name="plan[arrive_date]" value="<?php echo @$plan['arrive_date'];?>" size="10" />
      </dd>
      <dt>集合地点</dt>
      <dd>
        <select id="arrive_destination" name="plan[arrive_destination]">
          <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
          <option value="<?php echo $city;?>"<?php  $city==@$plan['arrive_destination'] && print(' selected="true"');?>><?php echo $city;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>集合方式</dt>
      <dd>
        <input type="text" id="arrive_method" name="plan[arrive_method]" value="<?php echo @$plan['arrive_method'];?>" size="6" />
        <select id="arrive_method_selector">
          <option value="" selected="selected">自定义</option>
          <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
          <option value="<?php echo $method;?>"<?php $method==@$plan['arrive_method'] && print(' selected="true"');?>><?php echo $method;?></option>
          <?php endforeach;?>
        </select>
      </dd>
      <dt>接站地点等信息</dt>
      <dd>
        <textarea id="arrive_detail" name="plan[arrive_detail]" rows="3" cols="70" plcaceholder="班次、到达时间等信息"><?php echo @$plan['arrive_detail'];?></textarea>
      </dd>
    </dl>
  </div>