$(document).ready(function(){
    $.datepicker.setDefaults($.extend({}, {
    "dateFormat": 'yy-mm-dd',
    showMonthAfterYear: true,
    changeMonth: true,
    gotoCurrent: true,
    showButtonPanel: true,
    changeYear: true
    }, $.datepicker.regional['zh-CN']));
    $.facebox.settings.closeImage = 'assets/js/images/facebox/closelabel.png';
    $.facebox.settings.loadingImage = 'assets/js/images/facebox/loading.gif';
    $('a[rel*=facebox]').facebox();
    $('textarea.autogrow').autogrow ({
    });

    $('.btn-select-inverse').click(function()
    {
       $('.table-list td:first-child :checkbox').trigger('click');
       return false;
    });
    $('.btn-select-none').click(function()
    {
       $('.table-list td:first-child :checkbox').attr('checked', false);
       return false;
    });
    $('.btn-select-all').click(function()
    {
       $('.table-list td:first-child :checkbox').attr('checked', true);
       return false;
    });
        $('.btn-danger').click(function()
    {
       return window.confirm('请确认此项操作！');
    });
//    $('input[type="file"]').each(function(idx, f){
//        $('#'+$(f).attr('id')).customFileInput({
//            button_position : 'right'
//        });
//    });



$('a[data-toggle="tab"]').on('shown', function (e) {
    $.cookie(location.href.substr(location.origin.length), $(e.target).attr('href'));
})
var last_tab;
if(last_tab=$.cookie(location.href.substr(location.origin.length)))
{
    console.log('restore tab to ' + last_tab);
    $('a[data-toggle="tab"][href="'+last_tab+'"]').tab('show');
}

});