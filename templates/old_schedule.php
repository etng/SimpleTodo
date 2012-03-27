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
</div> </dd>



<style type="text/css">
    .sortable li span.ui-icon { position: absolute; margin-left: -1.3em; }
</style>
<script type="text/javascript">
    <!--

tours=<?php echo json_encode($tours);?>;
jQuery(function($){

 $( "#schedules" ).sortable({
        handle:'.sortable-handle',
        update: function(evt, ui){
            updatetourDates();
        },
        placeholder: "ui-state-highlight"
    });
//    $( "#schedules" ).disableSelection();
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
        function updatetourDates()
    {
        var start_date = $.datepicker.parseDate('yy-mm-dd', $('#start_date').val());
        $($( "#schedules" ).sortable('toArray')).each(function(idx, li_id){
            var li=$('#'+li_id);
            li.find('#'+li_id+"_date").val($.datepicker.formatDate('yy-mm-dd', new Date(start_date.getTime()+86400000*(idx))));
            li.find('#'+li_id+"_num").val(idx+1);
        });
    }
    });
    //-->
    </script>