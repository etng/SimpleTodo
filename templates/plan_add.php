<h3><?php echo $title_for_layout;?></h3>
<?php
$tourist_cnt=rand(2,5);
$start_date=time();
$old_tours = $tours;
shuffle($old_tours);
$old_tours = array_splice($old_tours, 0, rand(1,3));
$contact = $contacts[array_rand($contacts)];
?>
<form method="post" action="" enctype="multipart/form-data">
<dl>
 <dt>联系人</dt>
    <dd>
    <dl>
        <dt>姓名</dt><dd><input type="text" id="contact_name" name="contact[name]" value="<?php echo $contact['name'];?>"/></dd>
        <dt>电话</dt><dd><input type="text" id="contact_phone" name="contact[phone]" value="<?php echo $contact['phone'];?>"/></dd>
        <dt>Email</dt><dd><input type="text" id="contact_email" name="contact[email]" value="<?php echo $contact['email'];?>"/></dd>
    </dl>
    </dd>
    <dt>人数</dt>
    <dd>
    <input type="text" id="tourist_cnt" name="plan[tourist_cnt]" value="<?php echo $tourist_cnt;?>" size="3" />
    <div id="tourists_tabs">
    <?php $i=0;while($i++<$tourist_cnt):?><dl>
 <dt>旅客<?php echo $i;?></dt><dd>
        <dl>
        <dt>旅客<?php echo $i;?>姓名</dt><dd><input type="text" id="tourist_name_<?php echo $i;?>" name="tourist[name][<?php echo $i;?>]" value="<?php echo @$tourist['name'];?>"/></dd>
        <dt>电话</dt><dd><input type="text" id="tourist_phone_<?php echo $i;?>" name="tourist[phone][<?php echo $i;?>]" value="<?php echo @$tourist['phone'];?>"/></dd>
        <dt>证件类型</dt><dd>
        <select id="tourist_card_type_<?php echo $i;?>" name="tourist[card_type][<?php echo $i;?>]">
        <?php foreach($config['id_card_types'] as $card_type=>$text):?>
            <option value="<?php echo $card_type;?>"<?php echo $card_type==@$tourist['card_type'] && print(' selected="true"');?>><?php echo $text;?></option>
        <?php endforeach;?>
    </select></dd>
        <dt>证件号码</dt><dd><input type="text" id="tourist_card_number_<?php echo $i;?>" name="tourist[card_number][<?php echo $i;?>]" value="<?php echo @$tourist['card_type'];?>"/></dd>
        <dt>证件照片</dt><dd>
        <label>网址：<input type="text" id="tourist_card_photo_url_<?php echo $i;?>" name="tourist[card_photo_url][<?php echo $i;?>]" size="80"   value="<?php echo @$tourist['card_photo'];?>"/></label><br />
            <label>上传：<input type="file" id="tourist_card_photo_file_<?php echo $i;?>" name="tourist_card_photo_file[<?php echo $i;?>]" /></label></dd>
        </dl> </dd></dl>

    <?php endwhile;?>
    </div>
    </dd>
 <dt>车辆要求</dt>
    <dd><textarea id="car_request" name="plan[car_request]" rows="3" cols="70">宽敞舒适的越野车就最好了</textarea></dd>
     <dt>房间要求</dt>
    <dd><textarea id="room_request" name="plan[room_request]" rows="3" cols="70">要么三星级以上，要么本地农家</textarea></dd>
    <dt>出发日期</dt>
    <dd><input type="text" id="start_date" name="plan[start_date]" value="<?php echo date("Y-m-d", $start_date)?>" size="10" /></dd>
    <dt>日程安排</dt>
    <dd><ul id="sortable">
    <?php foreach($old_tours as $i=>$tour):?>
        <li class="ui-state-default tour" id="item_<?php echo $i;?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class="tour_name"><?php echo $tour['name'];?></div>(<span class="tour_distance"><?php echo $tour['distance'];?>公里</span> 住<span class="tour_destination"><?php echo $tour['destination'];?>公里</span>)<input type="hidden" id="item_<?php echo $i;?>_tour_id" name="plan[item_tour_id][<?php echo $i;?>]" value="<?php echo $tour['id'];?>" />
        第<input type="text" id="item_<?php echo $i;?>_num" name="plan[item_the_num][<?php echo $i;?>]" value="<?php echo $i+1;?>" size="3"/>天，
        <input type="text" id="item_<?php echo $i;?>_date" name="plan[item_the_date][<?php echo $i;?>]" value="<?php echo date("Y-m-d", strtotime(sprintf("+%d days", $i), $start_date))?>" size="8" />

        <input type="text" id="item_<?php echo $i;?>_tourist_cnt" name="plan[item_tourist_cnt][<?php echo $i;?>]" value="<?php echo $tourist_cnt;?>" size="3"/>人
        <label>安排住宿：<input type="hidden" name="plan[item_need_room][<?php echo $i;?>]" value="0" /><input type="checkbox" id="item_<?php echo $i;?>_need_room" name="plan[item_need_room][<?php echo $i;?>]" value="1" checked="true" /></label>
        <label>安排车辆：<input type="hidden" name="plan[item_need_car][<?php echo $i;?>]" value="0" /><input type="checkbox" id="item_<?php echo $i;?>_need_car" name="plan[item_need_car][<?php echo $i;?>]" value="1" checked="true" /></label>
        <input type="button" value="取消" class="btn_cancel_tour" />
        </li>
    <?php endforeach;?>

    </ul>  <script id="tourTemplate" type="text/x-jquery-tmpl">
        <li class="ui-state-default tour" id="item_${i}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class="tour_name">${name}</div>(<span class="tour_distance">${distance}公里</span> 住 <span class="tour_destination">${destination}公里</span>)<input type="hidden" id="item_${i}_tour_id" name="plan[item_tour_id][${i}]" value="${id}" />
        第<input type="text" id="item_${i}_num" name="plan[item_the_num][${i}]" value="" size="3"/>天，
        <input type="text" id="item_${i}_date" name="plan[item_the_date][${i}]" value="" size="8" />

        <input type="text" id="item_${i}_tourist_cnt" name="plan[item_tourist_cnt][${i}]" value="<?php echo $tourist_cnt;?>" size="3"/>人
        <label>安排住宿：<input type="hidden" name="plan[item_need_room][${i}]" value="0" /> <input type="checkbox" id="item_${i}_need_room" name="plan[item_need_room][${i}]" value="1" checked="true" /></label>
        <label>安排车辆：<input type="hidden" name="plan[item_need_car][${i}]" value="0" /><input type="checkbox" id="item_${i}_need_car" name="plan[item_need_car][${i}]" value="1" checked="true" /></label>
        <input type="button" value="取消" class="btn_cancel_tour" />
        </li>
</script>
    <input type="button" value="添加日程" class="btn_select_tour"/>
    <div id="tour_selector" style="display:none;">
    <h4>可选线路</h4><ul>
    <?php foreach($tours as $i=>$tour):?>
    <li class="tour"><?php echo $tour['name'];?>(<?php echo $tour['price'];?>/<?php echo $tour['market_price'];?>)<input data-tour_id=<?php echo $i;?> type="button" value="添加" class="btn_add_tour" /></li>
    <?php endforeach;?> </ul>
    </div>
    </dd>
</dl>
<input type="submit" />
</form>
<script type='text/javascript'>
tours=<?php echo json_encode($tours);?>;
$(document).ready(function(){
    function updatetourDates()
    {
        var start_date = $.datepicker.parseDate('yy-mm-dd', $('#start_date').val());
        $($( "#sortable" ).sortable('toArray')).each(function(idx, li_id){
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
        var container = $("#sortable");
        var idx = container.find( "li" ).length;
        var li =
        $("#tourTemplate").tmpl({i: idx, id: tour.id, name: tour.name, distance: tour.distance, destination: tour.destination});
        li.appendTo(container);
        updatetourDates();

        jQuery(document).trigger('close.facebox');
    });
    $( "#start_date" ).datepicker({
        minDate: "+1W",
        maxDate: "+1Y",
        onClose: function(dateText, inst)
        {
            updatetourDates();
        }
    });

    $( "#sortable" ).sortable({
        update: function(evt, ui){
            updatetourDates();
        },
        placeholder: "ui-state-highlight"
    });
    $( "#sortable" ).disableSelection();


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