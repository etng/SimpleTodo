<div>
<h4><label class="checkbox inline"><input type="hidden" name="plan[need_receive]" value="0" /><input type="checkbox" id="plan_need_receive" name="plan[need_receive]" value="1"<?php 1==@$plan['need_receive'] && print(' checked="true"');?> />需要接站</label></h4>
<div id="receive_detail_container"<?php 0==@$plan['need_receive'] && print(' style="display:none;"');?>> <dl>
             <dt>集合日期</dt><dd><input type="text" id="arrive_date" name="plan[arrive_date]" value="<?php echo @$plan['arrive_date'];?>" size="10" /></dd>
             <dt>集合地点</dt><dd>
              <select id="arrive_destination" name="plan[arrive_destination]">
        <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
        <option value="<?php echo $city;?>"<?php  $city==@$plan['arrive_destination'] && print(' selected="true"');?>><?php echo $city;?></option>
        <?php endforeach;?>
    </select></dd>
             <dt>集合方式</dt><dd><input type="text" id="arrive_method" name="plan[arrive_method]" value="<?php echo @$plan['arrive_method'];?>" size="6" />
              <select id="arrive_method_selector">
        <option value="" selected="selected">自定义</option>
        <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
        <option value="<?php echo $method;?>"<?php $method==@$plan['arrive_method'] && print(' selected="true"');?>><?php echo $method;?></option>
        <?php endforeach;?>
    </select></dd>
<dt>接站地点等信息</dt><dd>
<textarea id="arrive_detail" name="plan[arrive_detail]" rows="3" cols="70" plcaceholder="班次、到达时间等信息"><?php echo @$plan['arrive_detail'];?></textarea>
</dd>
</dl>
</div>
</div>

<div>

<h4><label class="checkbox inline"><input type="hidden" name="plan[need_seeoff]" value="0" /><input type="checkbox" id="plan_need_seeoff" name="plan[need_seeoff]" value="1"<?php  1==@$plan['need_seeoff'] && print(' checked="true"');?> />需要送站</label></h4>
<div id="seeoff_detail_container"<?php 0==@$plan['need_seeoff'] && print(' style="display:none;"');?> > <dl>

             <dt>遣散日期</dt><dd><input type="text" id="seeoff_date" name="plan[seeoff_date]" value="<?php echo @$plan['seeoff_date'];?>" size="10" /></dd>
             <dt>遣散地点</dt><dd>
              <select id="seeoff_destination" name="plan[seeoff_destination]">
        <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
        <option value="<?php echo $city;?>"<?php  $city==@$plan['seeoff_destination'] && print(' selected="true"');?>><?php echo $city;?></option>
        <?php endforeach;?>
    </select></dd>
             <dt>遣散方式</dt><dd><input type="text" id="seeoff_method" name="plan[seeoff_method]" value="<?php echo @$plan['seeoff_method'];?>" size="6" />
              <select id="seeoff_method_selector">
        <option value="" selected="selected">自定义</option>
        <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
        <option value="<?php echo $method;?>"<?php  $method==@$plan['seeoff_method'] && print(' selected="true"');?>><?php echo $method;?></option>
        <?php endforeach;?>
    </select></dd>
<dt>送站地点等信息</dt><dd>
<textarea id="seeoff_detail" name="plan[seeoff_detail]" rows="3" cols="70" plcaceholder="班次、出发时间等信息"><?php echo @$plan['seeoff_detail'];?></textarea>
</dd>
</dl>
</div>
</div>

<div>
    <dl>

                <dt>出发日期</dt>
                <dd><input type="text" id="start_date" name="plan[start_date]" value="<?php echo @$plan['start_date'];?>" size="10" /></dd>
                 <dt>日程安排</dt>
                <dd>
                <select id="schedule_template_selector" name="plan[schedule_template_id]">
                    <option value="" selected="selected">--请选择--</option>
                    <?php foreach($schedule_templates as $schedule_template):?>
                    <option value="<?php echo $schedule_template['id'];?>"<?php  $schedule_template['id']==@$plan['schedule_template_id'] && print(' selected="true"');?>><?php echo $schedule_template['name'];?></option>
                    <?php endforeach;?>
                </select><br />
                <textarea id="schedule_txt" name="plan[schedule_txt]" rows="8" cols="70"><?php echo @$plan['schedule_txt'];?></textarea>
                <div class="btn-group">
                <input type="button" class="btn btn-reverse-schedule" value="倒排"/>
                <input type="button" class="btn btn-preview-schedule" value="预览"/>
                </div>
                <label class="checkbox inline"><input type="hidden" name="plan[need_passport]" value="0" /><input type="checkbox" id="plan_need_passport" name="plan[need_passport]" value="1"<?php  1==@$plan['need_passport'] && print(' checked="true"');?> />办理边防证</label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_hotel]" value="0" /><input type="checkbox" id="plan_need_hotel" name="plan[need_hotel]" value="1"<?php  1==@$plan['need_hotel'] && print(' checked="true"');?> />需要安排住宿</label>
                <label class="inline">房间数量：<input type="text" size="2" class="input-mini need_room_cnt"  id="plan_need_room_cnt" name="plan[need_room_cnt]" value="<?php echo @$plan['need_room_cnt'];?>" /></label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_car]" value="0" /><input type="checkbox" id="plan_need_car" name="plan[need_car]" value="1"<?php 1==@$plan['need_car'] && print(' checked="true"');?> />需要安排车辆</label>
<label class="inline">车辆数量：<input type="text" size="2" class="input-mini need_car_cnt"  id="plan_need_car_cnt" name="plan[need_car_cnt]" value="<?php echo @$plan['need_car_cnt'];?>" /></label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_insurance]" value="0" /><input type="checkbox" id="plan_need_insurance" name="plan[need_insurance]" value="1"<?php  1==@$plan['need_insurance'] && print(' checked="true"');?> />办理保险</label>
                </dd>
            </dl>
</div>