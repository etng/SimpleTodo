<div id="calendar"></div>
<h3>默认颜色</h3>
<div>
<label>前景色：<input type="color" id="text_color" value="ff9900"/></label>
<label>背景色：<input type="color" id="background_color" value="99ff00"/></label>
</div>
<script type='text/javascript'>

	$(document).ready(function() {

		$('#background_color, #text_color').colorpicker({
			title:				'请选择颜色',
			buttonText:			'颜色',	// Text on the button and/or title of button image.
			doneText: '确认',
			buttonImage:		'assets/images/ui-colorpicker.png',
			hsv: false,
			limit: 'websafe',
			parts: 'popup',
			alpha: false,

					showOn: 'both',
					showHeader: true,
					showSwatches: true,
					buttonColorize: true,
			showButtonPanel: true
		});


		var calendar = $('#calendar').fullCalendar({
			titleFormat: {
				month: 'yyyy年M月',
				week: "yyyy年M月d日 - {[yyyy年][M月]d日}",
				day: 'yyyy年M月d日'
			},
			columnFormat: {
				month: 'ddd',
				week: 'ddd M/d',
				day: 'dddd M/d'
			},
			timeFormat: { // for event elements
				'': 'HH(:mm)' // default
			},

			firstDay: 1,
			monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
			monthNamesShort: ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'],
			dayNames: ['星期日','星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
			dayNamesShort: ['日','一', '二', '三', '四', '五', '六'],
			buttonText: {
				prev: '&nbsp;&#9668;&nbsp;',
				next: '&nbsp;&#9658;&nbsp;',
				prevYear: '&nbsp;&lt;&lt;&nbsp;',
				nextYear: '&nbsp;&gt;&gt;&nbsp;',
				today: '今天',
				month: '月视图',
				week: '周视图',
				day: '日视图'
			},
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek'/*',agendaWeek,agendaDay'*/
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('请输入待办事项名称:');
				if (title) {
					Todo.create({
						title: title,
						start: start.getTime()/1000,
						end: end.getTime()/1000,
						all_day: allDay?1:0,
						text_color: '#'+$('#text_color').val(),
						background_color: '#'+$('#background_color').val()
					}, calendar, function(response)
					{
						if(response.status=='success')
						{
							var todo = response.todo;
							calendar.fullCalendar('renderEvent', todo, true);
						}
						else
						{
							alert('add todo fail');
						}
					});
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events:
			{
				url: "todo.php?act=list",
				cache: true
			},
			eventRender: function(event, element)
			{
				$(element).qtip({
					content:
					{
						title:event.title,
						text: event.description
					},
					position: {
					  target: 'mouse',
					  adjust: { x: 5, y:5 }
					}
				});
			},
			eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc, jsEvent, ui, view)
			{
				Todo.update({
					id: event.id,
					start: event.start.getTime()/1000,
					end: event.end.getTime()/1000 ,
					all_day: allDay?1:0
				}, calendar, revertFunc);
			},
			eventResize: function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view)
			{
				Todo.update({
					id: event.id,
					end: event.end.getTime()/1000
				}, calendar, revertFunc);
			},
			loading: function(bool) {
				if (bool)
				{
					$('#loading').show();
				}
				else
				{
					$('#loading').hide();
				}
			}
		});
	});
var Todo =
{
	create: function(data, calendar, successCallback)
	{
		$.ajax({
			type: "post",
			url: "todo.php?act=create",
			dataType: "json",
			data: data,
			success: successCallback
		});
	}
	,update: function(data, calendar, revertCallback)
	{
		$.ajax({
			type: "post",
			url: "todo.php?act=update",
			dataType: "json",
			data: data,
			success: function(response)
			{
				if(response.status=='success')
				{
					var todo = response.todo;
					calendar.fullCalendar('removeEvents', todo.id)
					calendar.fullCalendar('renderEvent', todo, true);
				}
				else
				{
					revertCallback();
				}
			}
		});
	}
};
</script>