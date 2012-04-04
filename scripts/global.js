$(document).ready(function(){
    $.datepicker.setDefaults($.extend({}, {
    "dateFormat": 'yy-mm-dd',
    showMonthAfterYear: true,
    changeMonth: true,
    gotoCurrent: true,
    showButtonPanel: true,
    changeYear: true
    }, $.datepicker.regional['zh-CN']));
    $.facebox.settings.closeImage = 'scripts/images/facebox/closelabel.png';
    $.facebox.settings.loadingImage = 'scripts/images/facebox/loading.gif';
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


});