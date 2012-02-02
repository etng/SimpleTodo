<?php
require "lib/common.php";
if($_SERVER['REQUEST_METHOD']=='POST')
{
    var_dump($_POST);
    die();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="scripts/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar.css" />
<link href="scripts/jquery.colorpicker.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="scripts/fullcalendar.print.css" media="print" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" type="text/css" media="all" />
<style type='text/css'>

	body {
		margin-top: 40px;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
	}
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
	}	#switcher {
		float: 			right;
		display: 		inline-block;
	}


#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px;text-align: left; }
	#sortable li span { position: absolute; margin-left: -1.3em; }
html>body #sortable li { height: 1.5em; line-height: 1.2em; }
    .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js" type="text/javascript"></script>
<script src="https://raw.github.com/akaihola/jquery-autogrow/master/jquery.autogrow.js" type="text/javascript"></script>
<script src="http://jqueryui.com/themeroller/themeswitchertool/"></script>
<script type="text/javascript" src="scripts/jquery.qtip.js"></script>
<script src="scripts/jquery.colorpicker.js"></script>
<title>排序</title>

</head>
<body>
<div id="switcher"></div>
<div id="loading" style="display:none">loading...</div>
<h3>排序</h3>
<div class="demo">
<?php
$tourit_cnt=rand(2,5);
$start_date=time();
?>
<form method="post" action="">
<dl>
    <dt>人数</dt>
    <dd><input type="text" id="tourit_cnt" name="tourit_cnt" value="<?php echo $tourit_cnt;?>" size="3" /></dd>
 <dt>车辆要求</dt>
    <dd><textarea id="car_request" name="car_request" rows="3" cols="70"></textarea></dd>
     <dt>房间要求</dt>
    <dd><textarea id="room_request" name="room_request" rows="3" cols="70"></textarea></dd>
    <dt>出发日期</dt>
    <dd><input type="text" id="start_date" name="start_date" value="<?php echo date("Y-m-d", $start_date)?>" size="10" /></dd>
    <dt>日程安排</dt>
    <dd><ul id="sortable">
    <?php foreach($config['destinations'] as $i=>$destination):?>
        <li class="ui-state-default routine" id="item_<?php echo $i;?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class="routine_name"><?php echo $destination;?></div><input type="hidden" id="item_<?php echo $i;?>_routine" name="item_routine[]" value="<?php echo $destination;?>" />
        第<input type="text" id="item_<?php echo $i;?>_num" name="item_num[]" value="<?php echo $i+1;?>" size="3"/>天，
        <input type="text" id="item_<?php echo $i;?>_date" name="item_date[]" value="<?php echo date("Y-m-d", strtotime(sprintf("+%d days", $i), $start_date))?>" size="8" />

        <input type="text" id="item_<?php echo $i;?>_tourit_cnt" name="item_tourit_cnt[]" value="<?php echo $tourit_cnt;?>" size="3"/>人
        <label>安排住宿：<input type="checkbox" id="item_<?php echo $i;?>_need_hotel" name="item_need_hotel[]" /></label>
        <label>安排车辆：<input type="checkbox" id="item_<?php echo $i;?>_need_car" name="item_need_car[]" /></label>
        <input type="button" value="取消" class="btn_cancel_routine" />
        </li>
    <?php endforeach;?>
    <script id="routineTemplate" type="text/x-jquery-tmpl">
        <li class="ui-state-default routine" id="item_${i}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class="routine_name"></div><input type="hidden" id="item_${i}_routine" name="item_routine[]" value="" />
        第<input type="text" id="item_${i}_num" name="item_num[]" value="" size="3"/>天，
        <input type="text" id="item_${i}_date" name="item_date[]" value="" size="8" />

        <input type="text" id="item_${i}_tourit_cnt" name="item_tourit_cnt[]" value="<?php echo $tourit_cnt;?>" size="3"/>人
        <label>安排住宿：<input type="checkbox" id="item_${i}_need_hotel" name="item_need_hotel[]" /></label>
        <label>安排车辆：<input type="checkbox" id="item_${i}_need_car" name="item_need_car[]" /></label>
        <input type="button" value="取消" class="btn_cancel_routine" />
        </li>
</script>
    </ul>
    <h4>可选线路</h4><ul id="sortable">
    <?php foreach($config['destinations'] as $i=>$destination):?>
    <li class="routine"><span class="routine_name"><?php echo $destination;?></span><input type="button" value="添加" class="btn_add_routine" /></li>

    <?php endforeach;?> </ul>
    </dd>
</dl>
<input type="submit" />
</form>
</div>
<script type='text/javascript'>

$(document).ready(function(){
    $.datepicker.setDefaults($.extend({}, {
    "dateFormat": 'yy-mm-dd',
    showMonthAfterYear: true,
    changeMonth: true,
    gotoCurrent: true,
    showButtonPanel: true,
    changeYear: true
    }, $.datepicker.regional['zh-CN']));

    function updateRoutineDates()
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
    $('input.btn_cancel_routine').live('click', function(){
        console.log($(this).parent('.routine'));
         $(this).parent('.routine').remove();
         updateRoutineDates();
    });
    $('input.btn_add_routine').live('click', function(){
        var routine = $(this).parent('.routine').find('.routine_name').html();
        var container = $( "#sortable" );
        var idx = container.find( "li" ).length;
        var li =
        $("#routineTemplate").tmpl({i: idx});
        li.find('.routine_name').html(routine);
        li.find('#item_'+idx+'_routine').val(routine);
        li.appendTo(container);
        updateRoutineDates();
    });
    $( "#start_date" ).datepicker({
        minDate: "+1W",
        maxDate: "+1Y",
        onClose: function(dateText, inst)
        {
            updateRoutineDates();
        }
    });

    $( "#sortable" ).sortable({
        update: function(evt, ui){
            updateRoutineDates();
        },
        placeholder: "ui-state-highlight"
    });
    $( "#sortable" ).disableSelection();
});
</script>
</body>
</html>
