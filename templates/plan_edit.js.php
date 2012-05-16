schedule_templates=<?php echo json_encode($schedule_templates);?>;
$('#schedule_template_selector').change(function(){
    var template_id = $(this).val();
    if(template_id>0)
    {
        var template = schedule_templates[template_id];
        $('#schedule_txt').val('').val(template['content']);
        $('#plan_schedule_name').val('').val(template['name']);
        $('#plan_need_passport').attr('checked', template['need_passport']==1);
    }
});
$( "#seeoff_date,#arrive_date,#start_date" ).datepicker({
    minDate: "+1W",
    maxDate: "+1Y"
});
function parseScheduleTemplate()
{
    var tours=[];
    $.each($('#schedule_txt').val().split("\n"), function(i, line){
        var line=$.trim(line);
        if(line.length){
            var tour = line.split(/[,，]/g);
            tours.push(tour);
        }
    });
    return tours;
}
window.tour_sep='<?php echo $tour_sep;?>';
$('.btn-reverse-schedule').click(function(){
    var tours =  parseScheduleTemplate().reverse();
    var tours_text=[];
    $.each(tours, function(i, tour){
        tour[1] = tour[1].split(tour_sep).reverse().join(tour_sep);
        tours_text.push(['D'+(i+1), tour[1]].join(','));
    });
    $('#schedule_txt').val(tours_text.join("\n"));
});
$('.btn-preview-schedule').click(function(){
    var tours =  parseScheduleTemplate();
    var tours_text=[];
    var start_date = $.datepicker.parseDate('yy-mm-dd', $('#start_date').val());
    $.each(tours, function(i, tour){
        cur_date = new Date(start_date.getTime()+86400000*i);
        tours_text.push(['D'+(i+1), $.datepicker.formatDate('yy-mm-dd', cur_date) ,tour[1]].join('  '));
    });
    jQuery.facebox(tours_text.join("<br>"));
});
$('#arrive_method_selector').change(function(){
  $('#arrive_method').val($(this).val());
});
$('#seeoff_method_selector').change(function(){
  $('#seeoff_method').val($(this).val());
});
$('#plan_need_receive').change(function(){
  $('#receive_detail_container').toggle($(this).attr('checked'));
});
$('#plan_need_seeoff').change(function(){
  $('#seeoff_detail_container').toggle($(this).attr('checked'));
});