  <dl>
    <dt>出发日期</dt>
    <dd>
      <input type="text" id="start_date" name="plan[start_date]" value="<?php echo @$plan['start_date'];?>" size="10" />
    </dd>
    <dt>日程安排</dt>
    <dd>
      <select id="schedule_template_selector" name="plan[schedule_template_id]">
        <option value="" selected="selected">--请选择--</option>
        <?php foreach($schedule_templates as $schedule_template):?>
        <option value="<?php echo $schedule_template['id'];?>"<?php  $schedule_template['id']==@$plan['schedule_template_id'] && print(' selected="true"');?>><?php echo $schedule_template['name'];?></option>
        <?php endforeach;?>
      </select>
      <span>
      <input type="text" name="plan[schedule_name]" id="plan_schedule_name" value="<?php echo @$plan['schedule_name'];?>" />
      </span> <br />
      <textarea id="schedule_txt" name="plan[schedule_txt]" rows="8" cols="70"><?php echo @$plan['schedule_txt'];?></textarea>
      <div class="btn-group">
        <input type="button" class="btn btn-reverse-schedule" value="倒排"/>
        <input type="button" class="btn btn-preview-schedule" value="预览"/>
      </div>
        <div class="row">
        <div class="span2">住宿</div>
        <div class="span11"> <label class="checkbox inline">
        <input type="hidden" name="plan[need_hotel]" value="0" />
        <input type="checkbox" id="plan_need_hotel" name="plan[need_hotel]" value="1"<?php  1==@$plan['need_hotel'] && print(' checked="true"');?> />
        需要安排</label> <label class="inline">        <input type="text" size="2" class="input-mini need_room_cnt"  id="plan_need_room_cnt" name="plan[need_room_cnt]" value="<?php echo @$plan['need_room_cnt'];?>" />间
      </label></div>
        </div>



        <div class="row">
        <div class="span1">车辆</div>
        <div class="span11"> <label class="checkbox inline">
        <input type="hidden" name="plan[need_car]" value="0" />
        <input type="checkbox" id="plan_need_car" name="plan[need_car]" value="1"<?php 1==@$plan['need_car'] && print(' checked="true"');?> />
        需要安排</label>
<label class="inline">车型：<select name="plan[need_car_type]" class="input-mini need_car_type" id="plan_need_car_type">
        <option value="" selected="selected">--请选择--</option>
        <?php foreach($config['car_types'] as $car_type=>$text):?>
        <option value="<?php echo $car_type;?>"<?php $car_type==@$plan['need_car_type'] && print(' selected="true"');?>><?php echo $text;?></option>
        <?php endforeach;?>
      </select>
      </label>
<label class="inline">
        <input type="text" size="2" class="input-mini need_car_cnt"  id="plan_need_car_cnt" name="plan[need_car_cnt]" value="<?php echo @$plan['need_car_cnt'];?>" />辆
      </label>

            <label class="inline">报价：
        <input type="text" size="2" class="input-mini cost_per_car"  id="plan_cost_per_car" name="plan[cost_per_car]" value="<?php echo @$plan['cost_per_car'];?>" />元/辆
      </label>
<label class="inline">底价：
        <input type="text" size="2" class="input-mini price_per_car"  id="plan_price_per_car" name="plan[price_per_car]" value="<?php echo @$plan['price_per_car'];?>" />元/辆
      </label></div>
        </div>









      <label class="checkbox inline">
        <input type="hidden" name="plan[need_passport]" value="0" />
        <input type="checkbox" id="plan_need_passport" name="plan[need_passport]" value="1"<?php  1==@$plan['need_passport'] && print(' checked="true"');?> />
        办理边防证</label>


      <label class="checkbox inline">
        <input type="hidden" name="plan[need_insurance]" value="0" />
        <input type="checkbox" id="plan_need_insurance" name="plan[need_insurance]" value="1"<?php  1==@$plan['need_insurance'] && print(' checked="true"');?> />
        办理保险</label>

  <h4>
    <label class="checkbox inline">
      <input type="hidden" name="plan[need_receive]" value="0" />
      <input type="checkbox" id="plan_need_receive" name="plan[need_receive]" value="1"<?php 1==@$plan['need_receive'] && print(' checked="true"');?> />
      需要接站</label>
  </h4>
  <?php if(!empty($setting['receive_and_seeoff_detail'])):?>
<?php include('_receive_detail_form.php')?>

<?php endif;?>
  <h4>
    <label class="checkbox inline">
      <input type="hidden" name="plan[need_seeoff]" value="0" />
      <input type="checkbox" id="plan_need_seeoff" name="plan[need_seeoff]" value="1"<?php  1==@$plan['need_seeoff'] && print(' checked="true"');?> />
      需要送站</label>
  </h4>
<?php if(!empty($setting['receive_and_seeoff_detail'])):?>
<?php include('_seeoff_detail_form.php')?>
<?php endif;?>
    </dd>
  </dl>
