<h3><?php echo $title_for_layout;?></h3>
<?php
$tourist_cnt=rand(2,5);
$start_date=time();
$old_tours = $tours;
shuffle($old_tours);
$old_tours = array_splice($old_tours, 0, rand(1,3));
$contact = $contacts[array_rand($contacts)];
$forum_url = '';
$schedule_templates = $db->fetchAll('select * from schedule_template', MYSQL_ASSOC, 'id');
?>
<form method="post" action="" enctype="multipart/form-data">

      <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li><a href="#tab_contact" data-toggle="tab">联系人</a></li>
          <li><a href="#tab_tourist" data-toggle="tab">游客</a></li>
          <li class="active"><a href="#tab_schedule" data-toggle="tab">日程</a></li>
          <li><a href="#tab_request" data-toggle="tab">要求</a></li>
          <li><a href="#tab_payment" data-toggle="tab">财务</a></li>
          <li><a href="#tab_note" data-toggle="tab">备忘</a></li>
          <li><a href="#tab_history" data-toggle="tab">日志</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane" id="tab_contact">
            <dl>
                <dt>姓名</dt><dd><input type="text" id="contact_name" name="contact[name]" value="<?php echo $contact['name'];?>"/></dd>
                <dt>电话</dt><dd><input type="text" id="contact_phone" name="contact[phone]" value="<?php echo $contact['phone'];?>"/></dd>
                <dt>Email</dt><dd><input type="text" id="contact_email" name="contact[email]" value="<?php echo $contact['email'];?>"/></dd>
                <dt>论坛Id</dt><dd><input type="text" id="contact_forum_uid" name="contact[forum_uid]" value="<?php echo $contact['forum_uid'];?>"/></dd>
            </dl>
          </div>
          <div class="tab-pane" id="tab_tourist">
                <label>人数：<input type="text" id="tourist_cnt" name="plan[tourist_cnt]" value="<?php echo $tourist_cnt;?>" size="3" /></label>
                <div id="tourists_tabs">
                <?php $i=0;while($i++<$tourist_cnt):?>
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
                    <label>网址：<input type="text" id="tourist_card_photo_url_<?php echo $i;?>" name="tourist[card_photo_url][<?php echo $i;?>]" size="80"   value="<?php echo @$tourist['card_photo'];?>"/></label><br />
                        <label>上传：<input type="file" id="tourist_card_photo_file_<?php echo $i;?>" name="tourist_card_photo_file[<?php echo $i;?>]" /></label></dd>
                    </dl> </dd></dl>

                <?php endwhile;?>
                </div>
        </div>
          <div class="tab-pane active" id="tab_schedule">
            <dl>
                <dt>出发日期</dt>
                <dd><input type="text" id="start_date" name="plan[start_date]" value="<?php echo date("Y-m-d", $start_date)?>" size="10" /></dd>
                 <dt>日程安排</dt>

                <dd>
                <select id="schedule_template_selector">
                    <option value="" selected="selected">--请选择--</option>
                    <?php foreach($schedule_templates as $schedule_template):?>
                    <option value="<?php echo $schedule_template['id'];?>"><?php echo $schedule_template['name'];?></option>
                    <?php endforeach;?>
                </select>
                <textarea id="schedule_txt" rows="8" cols="70" class="span4" height="200px">
                </textarea>
                <div class="btn-group">
                <input type="button" class="btn" value="倒排" onclick="" />
                <input type="button" class="btn" value="住宿" onclick="alert('需要安排住宿')" />
                <input type="button" class="btn" value="车辆" onclick="alert('需要安排车辆')" />
                <input type="button" class="btn" value="门票" onclick="alert('填写相关景点门票订购信息')" />
                <input type="button" class="btn" value="保险" onclick="alert('办理边防证')" />
                <input type="button" class="btn" value="边防" onclick="alert('办理边防证')" />
                <input type="button" class="btn" value="接客" onclick="alert('填写进藏时间、方式、接站地点等信息');" />
                <input type="button" class="btn" value="送客" onclick="alert('填写出藏时间、方式、节点地点等信息')" />
                </div>
                </dd>
                <dt>日程安排</dt>
                <dd>
                <ul id="schedules" class="unstyled sortable">
                <?php foreach($old_tours as $i=>$tour):?>
                    <li class="ui-state-default tour" id="item_<?php echo $i;?>">
                    <span class="sortable-handle">
                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        D<?php echo $i+1;?><input type="hidden" id="item_<?php echo $i;?>_num" name="plan[item_the_num][<?php echo $i;?>]" value="<?php echo $i+1;?>" size="3"/>(
                        <input type="hidden" id="item_<?php echo $i;?>_date" name="plan[item_the_date][<?php echo $i;?>]" value="<?php echo date("Y-m-d", strtotime(sprintf("+%d days", $i), $start_date))?>" /><?php echo date("Y-m-d", strtotime(sprintf("+%d days", $i), $start_date))?>)
                        <input type="hidden" id="item_<?php echo $i;?>_tourist_cnt" name="plan[item_tourist_cnt][<?php echo $i;?>]" value="<?php echo $tourist_cnt;?>" size="3"/><?php echo $tourist_cnt;?>人
                    </span>
                    <div class="tour_info">
                        <?php echo $tour['name'];?>(<span class="tour_distance"><?php echo $tour['distance'];?>公里</span> 住<span class="tour_destination"><?php echo $tour['destination'];?></span>)<input type="hidden" id="item_<?php echo $i;?>_tour_id" name="plan[item_tour_id][<?php echo $i;?>]" value="<?php echo $tour['id'];?>" />
                    </div>
                    <span class="controls">
                    <label class="checkbox inline"><input type="hidden" name="plan[item_need_room][<?php echo $i;?>]" value="0" /><input type="checkbox" id="item_<?php echo $i;?>_need_room" name="plan[item_need_room][<?php echo $i;?>]" value="1" checked="true" />是否安排住宿</label>
                    <label class="checkbox inline"><input type="hidden" name="plan[item_need_car][<?php echo $i;?>]" value="0" /><input type="checkbox" id="item_<?php echo $i;?>_need_car" name="plan[item_need_car][<?php echo $i;?>]" value="1" checked="true" />是否安排车辆</label>
                    <input type="button" value="取消" class="btn_cancel_tour btn btn-danger" />
                    </span>
                    </li>
                <?php endforeach;?>

                </ul>  <script id="tourTemplate" type="text/x-jquery-tmpl">
                    <li class="ui-state-default tour" id="item_${i}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class="tour_name">${name}</div>(<span class="tour_distance">${distance}公里</span> 住 <span class="tour_destination">${destination}公里</span>)<input type="hidden" id="item_${i}_tour_id" name="plan[item_tour_id][${i}]" value="${id}" />
                    第<input type="text" id="item_${i}_num" name="plan[item_the_num][${i}]" value="" size="3"/>天，
                    <input type="text" id="item_${i}_date" name="plan[item_the_date][${i}]" value="" size="8" />

                    <input type="text" id="item_${i}_tourist_cnt" name="plan[item_tourist_cnt][${i}]" value="<?php echo $tourist_cnt;?>" size="3"/>人
                    <label>安排住宿：<input type="hidden" name="plan[item_need_room][${i}]" value="0" /> <input type="checkbox" id="item_${i}_need_room" name="plan[item_need_room][${i}]" value="1" checked="true" /></label>
                    <label>安排车辆：<input type="hidden" name="plan[item_need_car][${i}]" value="0" /><input type="checkbox" id="item_${i}_need_car" name="plan[item_need_car][${i}]" value="1" checked="true" /></label>
                    <input type="button" class="btn btn-danger" value="取消" class="btn_cancel_tour" />
                    </li>
            </script>
                <input type="button" class="btn btn_select_tour" value="添加日程"/>
                <div id="tour_selector" style="display:none;">
                <h4>可选线路</h4><ul>
                <?php foreach($tours as $i=>$tour):?>
                <li class="tour"><?php echo $tour['name'];?>(<?php echo $tour['price'];?>/<?php echo $tour['market_price'];?>)<input data-tour_id=<?php echo $i;?> type="button" value="添加" class="btn btn_add_tour" /></li>
                <?php endforeach;?> </ul>
                </div>
                </dd>
            </dl>
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
          <div class="tab-pane" id="tab_payment">

          </div>
          <div class="tab-pane" id="tab_note"></div>
          <div class="tab-pane" id="tab_history"></div>
        </div>
      </div> <!-- /tabbable -->
<input type="submit" class="btn btn-primary" />
</form>
<script type='text/javascript'>
tours=<?php echo json_encode($tours);?>;
schedule_templates=<?php echo json_encode($schedule_templates);?>;
$(document).ready(function(){
    function updatetourDates()
    {
        var start_date = $.datepicker.parseDate('yy-mm-dd', $('#start_date').val());
        $($( "#schedules" ).sortable('toArray')).each(function(idx, li_id){
            var li=$('#'+li_id);
            li.find('#'+li_id+"_date").val($.datepicker.formatDate('yy-mm-dd', new Date(start_date.getTime()+86400000*(idx))));
            li.find('#'+li_id+"_num").val(idx+1);
        });
    }
    $('textarea').autogrow ({
    });
    $('input.btn_select_tour').live('click', function(){
        jQuery.facebox({ div: '#tour_selector' });
    });
    $('input.btn_cancel_tour').live('click', function(){
         $(this).parent('.tour').remove();
         updatetourDates();
    });
    $('input.btn_add_tour').live('click', function(){
        var tour = tours[$(this).data('tour_id')];
        var container = $("#schedules");
        var idx = container.find( "li" ).length;
        var li =
        $("#tourTemplate").tmpl({i: idx, id: tour.id, name: tour.name, distance: tour.distance, destination: tour.destination});
        li.appendTo(container);
        updatetourDates();

        jQuery(document).trigger('close.facebox');
    });
    $('#schedule_template_selector').change(function(){
        var template_id = $(this).val();
        if(template_id>1)
        {
            $('#schedule_txt').val(schedule_templates[template_id]['content']);
        }
    });
    $( "#start_date" ).datepicker({
        minDate: "+1W",
        maxDate: "+1Y",
        onClose: function(dateText, inst)
        {
            updatetourDates();
        }
    });

    $( "#schedules" ).sortable({
        handle:'.sortable-handle',
        update: function(evt, ui){
            updatetourDates();
        },
        placeholder: "ui-state-highlight"
    });
//    $( "#schedules" ).disableSelection();


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

<style type="text/css">
    .sortable li span.ui-icon { position: absolute; margin-left: -1.3em; }
</style>