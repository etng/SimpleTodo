<h3><?php echo $title_for_layout;?></h3>
<?php
$start_date=time();
$forum_url = '';
?>
<form method="post" action="" enctype="multipart/form-data">

      <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li><a href="#tab_contact" data-toggle="tab">联系人</a></li>
          <li><a href="#tab_tourist" data-toggle="tab">游客</a></li>
          <li class="active"><a href="#tab_schedule" data-toggle="tab">日程</a></li>
          <li><a href="#tab_request" data-toggle="tab">要求</a></li>
          <li><a href="#tab_staff" data-toggle="tab">跟单</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane" id="tab_contact">
            <dl>
                <dt>姓名</dt><dd><input type="text" id="contact_name" name="contact[name]" value="<?php echo @$contact['name'];?>"/></dd>
                <dt>电话</dt><dd><input type="text" id="contact_phone" name="contact[phone]" value="<?php echo @$contact['phone'];?>"/></dd>
                <dt>Email</dt><dd><input type="text" id="contact_email" name="contact[email]" value="<?php echo @$contact['email'];?>"/></dd>
                <dt>论坛Id</dt><dd><input type="text" id="contact_forum_uid" name="contact[forum_uid]" value="<?php echo @$contact['forum_uid'];?>"/></dd>
            </dl>
          </div>
          <div class="tab-pane" id="tab_tourist">
                <label>人数：<input type="text" id="tourist_cnt" name="plan[tourist_cnt]" value="<?php echo @$tourist_cnt;?>" size="3" /></label>
                <div class="alert alert-notice">旅客信息不用全部填写，仅保存有姓名的信息，可在订单中修改</div>
                <div id="tourists_tabs">
                <?php $i=0;while($i++<6):?>
                <dl>
                    <dt>旅客<?php echo $i;?></dt><dd>
                    <dl>
                    <dt>姓名</dt><dd><input type="text" id="tourist_name_<?php echo $i;?>" name="tourist[name][<?php echo $i;?>]" value="<?php echo @$tourist['name'];?>"/></dd>
                    <dt>电话</dt><dd><input type="text" id="tourist_phone_<?php echo $i;?>" name="tourist[phone][<?php echo $i;?>]" value="<?php echo @$tourist['phone'];?>"/></dd>
                    <dt>证件类型</dt><dd>
                    <select id="tourist_card_type_<?php echo $i;?>" name="tourist[card_type][<?php echo $i;?>]">
                    <?php foreach($config['id_card_types'] as $card_type=>$text):?>
                        <option value="<?php echo $card_type;?>"<?php $card_type==@$tourist['card_type'] && print(' selected="true"');?>><?php echo $text;?></option>
                    <?php endforeach;?>
                </select></dd>
                    <dt>证件号码</dt><dd><input type="text" id="tourist_card_number_<?php echo $i;?>" name="tourist[card_number][<?php echo $i;?>]" value="<?php echo @$tourist['card_type'];?>"/></dd>
                    <dt>证件照片</dt><dd>
                    <label>网址：<input type="text" id="tourist_card_photo_url_<?php echo $i;?>" name="tourist[card_photo_url][<?php echo $i;?>]" size="80" value="<?php echo @$tourist['card_photo'];?>"/></label><br />
                        <label>上传：<input type="file" class="span3" id="tourist_card_photo_file_<?php echo $i;?>" name="tourist_card_photo_file[<?php echo $i;?>]" /></label></dd>
                    </dl> </dd></dl>

                <?php endwhile;?>
                </div>
        </div>
          <div class="tab-pane active" id="tab_schedule">
<div>
<h4><label class="checkbox inline"><input type="hidden" name="plan[need_receive]" value="0" /><input type="checkbox" id="plan_need_receive" name="plan[need_receive]" value="1" />需要接站</label></h4>
<div id="receive_detail_container" style="display:none;"> <dl>
             <dt>集合日期</dt><dd><input type="text" id="arrive_date" name="plan[arrive_date]" value="<?php echo date("Y-m-d", $start_date)?>" size="10" /></dd>
             <dt>集合地点</dt><dd>
              <select id="arrive_destination" name="plan[arrive_destination]">
        <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
        <option value="<?php echo $city;?>"><?php echo $city;?></option>
        <?php endforeach;?>
    </select></dd>
             <dt>集合方式</dt><dd><input type="text" id="arrive_method" name="plan[arrive_method]" value="" size="6" />
              <select id="arrive_method_selector">
        <option value="" selected="selected">自定义</option>
        <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
        <option value="<?php echo $method;?>"><?php echo $method;?></option>
        <?php endforeach;?>
    </select></dd>
<dt>接站地点等信息</dt><dd>
<textarea id="arrive_detail" name="plan[arrive_detail]" rows="3" cols="70" plcaceholder="班次、到达时间等信息"></textarea>
</dd>
</dl>
</div>
</div>

<div>
<h4><label class="checkbox inline"><input type="hidden" name="plan[need_seeoff]" value="0" /><input type="checkbox" id="plan_need_seeoff" name="plan[need_seeoff]" value="1" />需要送站</label></h4>
<div id="seeoff_detail_container" style="display:none;"> <dl>

             <dt>遣散日期</dt><dd><input type="text" id="seeoff_date" name="plan[seeoff_date]" value="<?php echo date("Y-m-d", $start_date)?>" size="10" /></dd>
             <dt>遣散地点</dt><dd>
              <select id="seeoff_destination" name="plan[seeoff_destination]">
        <?php foreach(explode(',', '拉萨,成都,西安') as $city):?>
        <option value="<?php echo $city;?>"><?php echo $city;?></option>
        <?php endforeach;?>
    </select></dd>
             <dt>遣散方式</dt><dd><input type="text" id="seeoff_method" name="plan[seeoff_method]" value="" size="6" />
              <select id="seeoff_method_selector">
        <option value="" selected="selected">自定义</option>
        <?php foreach(explode(',', '火车,飞机,自驾,长途车') as $method):?>
        <option value="<?php echo $method;?>"><?php echo $method;?></option>
        <?php endforeach;?>
    </select></dd>
<dt>送站地点等信息</dt><dd>
<textarea id="seeoff_detail" name="plan[seeoff_detail]" rows="3" cols="70" plcaceholder="班次、出发时间等信息"></textarea>
</dd>
</dl>
</div>
</div>

<div>
    <dl>
                <dt>出发日期</dt>
                <dd><input type="text" id="start_date" name="plan[start_date]" value="<?php echo date("Y-m-d", $start_date)?>" size="10" /></dd>
                 <dt>日程安排</dt>
                <dd>
                <select id="schedule_template_selector" name="plan[schedule_template_id]">
                    <option value="" selected="selected">--请选择--</option>
                    <?php foreach($schedule_templates as $schedule_template):?>
                    <option value="<?php echo $schedule_template['id'];?>"><?php echo $schedule_template['name'];?></option>
                    <?php endforeach;?>
                </select><br />
                <textarea id="schedule_txt" name="plan[schedule_txt]" rows="8" cols="70"></textarea>
                <div class="btn-group">
                <input type="button" class="btn btn-reverse-schedule" value="倒排"/>
                <input type="button" class="btn btn-preview-schedule" value="预览"/>
                </div>
                <label class="checkbox inline"><input type="hidden" name="plan[need_passport]" value="0" /><input type="checkbox" id="plan_need_passport" name="plan[need_passport]" value="1" checked="true" />办理边防证</label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_hotel]" value="0" /><input type="checkbox" id="plan_need_hotel" name="plan[need_hotel]" value="1" checked="true" />需要安排住宿</label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_car]" value="0" /><input type="checkbox" id="plan_need_car" name="plan[need_car]" value="1" checked="true" />需要安排车辆</label>
                <label class="checkbox inline"><input type="hidden" name="plan[need_insurance]" value="0" /><input type="checkbox" id="plan_need_insurance" name="plan[need_insurance]" value="1" checked="true" />办理保险</label>
                </dd>
            </dl>
</div>
          </div>
          <div class="tab-pane" id="tab_request">
              <dl>
                 <dt>车辆要求</dt>
                    <dd><textarea id="car_request" name="plan[car_request]" rows="3" cols="70">宽敞舒适的越野车就最好了</textarea></dd>
                     <dt>房间要求</dt>
                    <dd><textarea id="room_request" name="plan[room_request]" rows="3" cols="70">要么三星级以上，要么本地农家</textarea></dd>
                     <dt>其他要求</dt>
                    <dd><textarea id="other_request" name="plan[other_request]" rows="3" cols="70">就这些，劳驾</textarea></dd>
              </dl>
          </div>
          <div class="tab-pane" id="tab_staff">

          <dl>
        <dt>主贴地址</dt>
          <dd>
          <input type="text" id="forum_url" name="plan[forum_url]" value="<?php echo @$plan['forum_url'];?>" size="255" /></dd>
            <dt>旅行顾问</dt>
            <dd>
                <select id="plan_consult_staff_id" name="plan[consult_staff_id]">
                <?php foreach($consult_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['consult_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd>

            <dt>业务跟进</dt>
            <dd>
                <select id="plan_market_staff_id" name="plan[market_staff_id]">
                <?php foreach($market_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['market_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd>

            <dt>酒店跟进</dt>
            <dd>
                <select id="plan_room_staff_id" name="plan[room_staff_id]">
                <?php foreach($room_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['room_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd><dt>车辆跟进</dt>
            <dd>
                <select id="plan_car_staff_id" name="plan[car_staff_id]">
                <?php foreach($car_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['car_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd>
          </dl>
          </div>
        </div>
      </div> <!-- /tabbable -->
<input type="submit" class="btn btn-primary" />
</form>
<script type='text/javascript'>
jQuery(function($){
    <?php include(dirname(__file__) .'/plan_edit.js.php');?>
    var titles=[],contents=[];
    $('#tourists_tabs > dl').each(function(i, dl){
        var $dl = $(dl);
        titles.push($('>dt', $dl).html());
        contents.push($('>dd:first', $dl).html());
    	$dl.remove();
    });
    var ul=$('<ul/>');
    $('#tourists_tabs').empty();
    $.each(titles, function(i, title){
        $('#tourists_tabs').append($('<div/>').attr('id', 'tourist_tab_'+i).html(contents[i]));
        ul.append($('<li/>').html($('<a>').html(title).attr('href', '#tourist_tab_'+i)));
    });
    $('#tourists_tabs').prepend(ul).tabs();
});
</script>

